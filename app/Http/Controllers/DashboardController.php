<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard index page
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();

            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();



            // If profile exists
            if ($profile) {
                // Calculate profile completion percentage
                $completionPercentage = $this->calculateProfileCompletion($profile);

                // Redirect based on completion percentage
                if ($completionPercentage >= 100) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage'));
                } elseif ($completionPercentage >= 80) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage'))->with('info', 'Please complete the remaining profile information.');
                } elseif ($completionPercentage >= 50) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage'))->with('info', 'Your profile is halfway complete.');
                } else {
                    // Redirect to profile edit page if completion percentage is less than 50%
                    return redirect()->route('user-profile-edit', ['id' => $user->pmid])->with('info', 'Could you please provide the missing data to complete your profile?');
                }
            } else {
                // If profile doesn't exist, redirect to profile edit page
                return redirect()->route('user-profile-edit', ['id' => $user->pmid]);
            }
        } else {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login');
        }
    }

    // Calculate profile completion percentage
    public function calculateProfileCompletion($profile)
    {
        $requiredFields = ['age', 'dob', 'religion', 'mother_tongue', 'marital_status'];

        // Count the completed fields
        $completedFields = 0;
        foreach ($requiredFields as $field) {
            if ($profile->$field) {
                $completedFields++;
            }
        }

        // Calculate completion percentage based on the number of completed fields
        $totalFields = count($requiredFields);
        $completionPercentage = ($completedFields / $totalFields) * 100;

        return $completionPercentage;
    }

    // Profile edit page
    public function user_profile_edit($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If authenticated, fetch the authenticated user
            $user = Auth::user();

            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();

            return view('pages.dashboard.pages.user-profile-edit', compact('user', 'profile'));
        } else {
            // If not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }

    // Edit user profile
    public function editUserProfile($id)
    {
        $user = User::findOrFail($id); // Assuming you have a User model
        $profile = Profile::where('user_id', $id)->first(); // Assuming you have a 'user_id' column in your profiles table

        if ($profile) {
            return view('user-profile-edit', compact('user', 'profile'));
        } else {
            return redirect()->route('user-profile-edit', ['id' => $user->pmid])->with('info', 'Could you please provide the missing data to complete your profile?');
        }
    }
}
