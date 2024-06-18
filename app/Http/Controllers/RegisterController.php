<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


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
                'phone' => 'required|string|max:20|unique:users,phone',
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
            $user->password = Hash::make($request->password);

            $user->save();

            // Send welcome email
            Mail::to($user->email)->queue(new WelcomeMail($user));

            // Show success message
            return redirect()->route('login')->with('success', 'Account created successfully! Welcome to our platform.');
        } catch (\Exception $e) {
            // Log the error for debugging

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
