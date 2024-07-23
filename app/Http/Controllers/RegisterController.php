<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\File;
use App\Models\UserPayment;

class RegisterController extends Controller
{
    protected $firebaseStorage;

    public function __construct()
    {
        try {
            $credentialsPath = config('services.firebase.credentials');
            $credentialsContent = File::get($credentialsPath);

            Log::info('Firebase Credentials Path: ' . $credentialsPath);
            Log::info('Firebase Credentials Content: ' . $credentialsContent);

            $factory = (new Factory)
                ->withServiceAccount($credentialsPath);

            $this->firebaseStorage = $factory->createStorage();
        } catch (FirebaseException $e) {
            Log::error('Firebase initialization error: ' . $e->getMessage());
            abort(500, 'Could not initialize Firebase');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|size:10|unique:users,phone',
            'aadhaar_number' => [
                'required',
                'string',
                'size:14',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('aadhaar_number', $request->aadhaar_number);
                }),
            ],
            'password' => 'required|string|min:8',
            'agree' => 'required|accepted',
            'aadhar_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB file size and only jpeg, png, jpg
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            // Generate unique PMID
            $pmid = $this->generatePMID($request->gender);
            $uploadedFile = $request->file('aadhar_image');
            $fileName = $uploadedFile->getClientOriginalName();
            $filePath = '/pariyarmatching/docs/ekyc/userpmid/' . strtolower($request->name) . '/' . $fileName;
            $fileContents = file_get_contents($uploadedFile->getRealPath());
            $bucket = $this->firebaseStorage->getBucket();

            // Upload file to Firebase Storage
            $object = $bucket->upload($fileContents, [
                'name' => $filePath,
            ]);

            // Generate a signed URL for the uploaded file
            $fileReference = $bucket->object($filePath);
            $signedUrl = $fileReference->signedUrl(new \DateTime('+1 hour'));

            // Store user data
            $user = User::create([
                'pmid' => $pmid,
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'aadhaar_number' => $request->aadhaar_number,
                'password' => Hash::make($request->password),
                'aadhar_image_url' => $signedUrl, // Store Firebase Storage URL
            ]);

            UserPayment::create([
                'user_pmid' => $pmid,
                'name' => $request->name,
                'phone_number' => $request->phone,
                'package_details' => '0 Months',
                'paid_status' => 0,
                'date_of_paid' => null,
                'plan_expired_date' => null,
            ]);

            // Extract necessary details for the email
            $userName = $user->name;
            $aadhaarLastFourDigits = substr($user->aadhaar_number, -4);

            // Send welcome email
            // Mail::to($user->email)->send(new WelcomeMail($userName, $aadhaarLastFourDigits));

            // Redirect to the next step after successful registration
            return redirect()->route('login')->with('success', 'Account created successfully! Please update your Aadhaar photo.');
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('An error occurred while processing registration: ' . $e->getMessage());

            // Return a generic error message to the user
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    // Function to generate unique PMID
    private function generatePMID($gender)
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomAlph = substr(str_shuffle($alphabet), 0, 3);

        // Determine the gender prefix
        $genderPrefix = strtoupper(substr($gender, 0, 1));

        // Generate the random number suffix
        $randomNum = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Construct the PMID
        return $randomAlph . $genderPrefix . $randomNum;
    }
}
