<?php


namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();

            if ($profile) {
                // Calculate profile completion percentage
                $completionPercentage = $this->calculateProfileCompletion($profile);

                // Define completion thresholds for different levels of completion
                if ($completionPercentage >= 100) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage'));
                } elseif ($completionPercentage >= 50) {
                    // If 50% or more completed, consider profile half complete
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage'))->with('info', 'Your profile is half complete.');
                } else {
                    // If less than 50% completed, redirect to profile edit page
                    return redirect()->route('user-profile-edit');
                }
            } else {
                // If profile doesn't exist, redirect to profile edit page
                return redirect()->route('user-profile-edit');
            }
        } else {
            // If not authenticated, redirect to the login page
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
    public function user_profile_edit()
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
}
