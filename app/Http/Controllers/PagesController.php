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
use App\Models\UserPayment; // Assuming UserPayment model location
use App\Mail\SuccessfulLoginNotification;
use App\Models\Profile;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Services\SeoService;
use App\Jobs\SendSuccessfulLoginEmail;


$seo = seo();

$seo = app(SeoService::class);

$seo = Seo::make();

class PagesController extends Controller
{
    public function index()
    {

        seo()->addFromArray([
            'title' => 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);


        $cities = Cities::select('name')->get();

        return view('pages.index', ['cities' => $cities]);
    }

    public function membership_package()
    {

        seo()->addFromArray([
            'title' => 'Membership - Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Membership - Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);

        return view('pages.membership-package');
    }


    /* Regsiter */
    public function register()
    {

        seo()->addFromArray([
            'title' => 'Register - Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Register - Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);

        return view('auth.register');
    }

    /* Login */

    public function login()
    {

        seo()->addFromArray([
            'title' => 'Login - Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Login - Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);
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

            // Get login time and browser info
            $loginTime = now(); // Replace with actual login time
            $browserInfo = $request->header('User-Agent'); // Replace with actual browser info

            // Dispatch job to send successful login email
            SendSuccessfulLoginEmail::dispatch(Auth::id(), $loginTime, $browserInfo)->onQueue('emails');

            // Redirect user to dashboard
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


        seo()->addFromArray([
            'title' => 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to access this page.');
        }

        // Validate the user_pmid format
        if (!preg_match('/^[A-Z0-9]+$/', $id)) {
            abort(400, 'Invalid user PM ID.');
        }

        // Fetch the user profile information securely with photo gallery
        $user = Profile::where('profiles.user_pmid', $id)
            ->join('users', 'profiles.user_pmid', '=', 'users.pmid')
            ->select('profiles.*', 'users.*')
            ->with('photo_gallery')  // Fetch related photo gallery
            ->first();

        // Check if user data is found
        if (!$user) {
            abort(404, 'User not found.');
        }

        // Check if the authenticated user's pmid matches the profile's user_pmid
        // if (Auth::user()->pmid != $user->user_pmid) {
        //     abort(403, 'Unauthorized access.');
        // }

        // Check if the authenticated user has a valid payment status
        $userPayment = UserPayment::where('user_pmid', Auth::user()->pmid)->first();

        // Ensure the user has a UserPayment record and paid_status is 1
        if (!$userPayment || $userPayment->paid_status != 1) {
            abort(403, 'Unauthorized access.');
        }

        // Pass the user data to the view
        return view('pages.profile-information', ['user' => $user]);
    }




    public function showSearchResult()
    {

        seo()->addFromArray([
            'title' => 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
            'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
            'meta' => [
                [
                    'name' => 'author',
                    'content' => 'Raghavan Jeeva',
                ],
                [
                    'name' => 'site_name',
                    'content' => 'Paraiyar Matching',
                ],
            ],
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'site_name' => 'Paraiyar Matching',
            ],

        ]);

        $cities = Cities::select('name')->get();
        return view('pages.search-results', ['cities' => $cities]);
    }
}
