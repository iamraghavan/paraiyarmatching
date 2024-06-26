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

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate form data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone' => 'required|string|size:10|unique:users,phone',
                'aadhaar_number' => [
                    'required',
                    'string',
                    'size:14', // Aadhaar number should be exactly 14 digits
                    Rule::unique('users')->where(function ($query) use ($request) {
                        return $query->where('aadhaar_number', $request->aadhaar_number);
                    }),
                ],
                'password' => 'required|string|min:8',
                'agree' => 'required|accepted',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            // Generate unique PMID
            $pmid = $this->generatePMID($request->gender);

            // Store user data
            $user = new User();
            $user->pmid = $pmid;
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->aadhaar_number = $request->aadhaar_number;
            $user->password = Hash::make($request->password);
            $user->save();

            // Send welcome email
            Mail::to($user->email)->queue(new WelcomeMail($user));

            // Show success message and redirect to Aadhaar photo update page
            return redirect()->route('aadhaar.photo.update')->with('success', 'Account created successfully! Please update your Aadhaar photo.');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
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
        $randomAlph = $alphabet[rand(0, strlen($alphabet) - 1)]
            . $alphabet[rand(0, strlen($alphabet) - 1)]
            . $alphabet[rand(0, strlen($alphabet) - 1)];

        // Determine the gender prefix
        $genderPrefix = '';
        if (strtolower($gender) === 'male') {
            $genderPrefix = 'M';
        } elseif (strtolower($gender) === 'female') {
            $genderPrefix = 'F';
        } else {
            // Default to M if gender is not specified or invalid
            $genderPrefix = 'X';
        }

        // Generate the random number suffix
        $randomNum = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Construct the PMID
        $pmid = $randomAlph . $genderPrefix . $randomNum;

        return $pmid;
    }
}
