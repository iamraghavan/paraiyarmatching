<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Update or create user profile
    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_pmid' => 'required|string',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer',
            'height' => 'nullable|string',
            'religion' => 'nullable|string',
            'mother_tongue' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'disability' => 'nullable|string',
            'family_status' => 'nullable|string',
            'family_type' => 'nullable|string',
            'family_value' => 'nullable|string',
            'education' => 'nullable|string',
            'employed_in' => 'nullable|string',
            'occupation' => 'nullable|string',
            'annual_income' => 'nullable|string',
            'work_location' => 'nullable|string',
            'residing_state' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Find the profile by user_pmid
        $profile = Profile::where('user_pmid', $validatedData['user_pmid'])->first();

        // If profile doesn't exist, create a new one
        if (!$profile) {
            $profile = new Profile();
            $profile->user_pmid = $validatedData['user_pmid'];
        }

        // Update the profile data
        $profile->fill($validatedData);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $fileName = strtolower($validatedData['user_pmid']) . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the desired directory in public assets folder
            $image->move(public_path('assets/images/profile/' . strtolower($validatedData['user_pmid'])), $fileName);

            // Store the file path in the profile
            $profile->profile_image = '/assets/images/profile/' . strtolower($validatedData['user_pmid']) . '/' . $fileName;
        }
        // Save the profile data
        $profile->save();

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}