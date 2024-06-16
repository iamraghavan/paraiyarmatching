<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Mail\SuccessfulLoginEmail;
use Illuminate\Support\Facades\Mail;

use App\Jobs\SendSuccessfulLoginEmail;
use App\Models\Profile;

class PagesController extends Controller
{
    public function index()
    {

        $cities = Cities::select('name')->get();

        return view('pages.index', ['cities' => $cities]);
    }

    public function membership_package()
    {
        return view('pages.membership-package');
    }


    /* Regsiter */
    public function register()
    {

        return view('auth.register');
    }

    /* Login */

    public function login()
    {
        return view('auth.login');
    }


    public function verify_login(Request $request)
    {
        $key = $request->email . '|' . $request->ip();

        // Throttle login attempts by IP address
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
        }

        // Validate form data
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Check if the user has exceeded the maximum number of login attempts for the current IP address
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
        }

        // Attempt to authenticate user
        if (Auth::attempt($validatedData, $request->filled('remember'))) {
            RateLimiter::clear($key);

            // Dispatch job to send successful login email
            $userEmail = $request->user()->email;
            dispatch(new SendSuccessfulLoginEmail($userEmail));

            return redirect()->route('dashboard');
        }

        RateLimiter::hit($key);

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
        }

        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        return back()->withErrors(['password' => 'Incorrect password.']);
    }



    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flush();

        return redirect()->route('home');
    }



    public function info_update($id)
    {
        $user = Profile::where('user_pmid', $id)->first();
        return view('pages.profile-information', ['user' => $user]);
    }


    public function showSearchResult()
    {
        $cities = Cities::select('name')->get();
        return view('pages.search-results', ['cities' => $cities]);
    }
}