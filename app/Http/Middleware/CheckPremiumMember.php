<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\UserPayment;

class CheckPremiumMember
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', 'Please login to continue.');
        }

        $user = Auth::user();

        // Fetch user's payment details from the database
        $userPayment = UserPayment::where('user_pmid', $user->pmid)->first();

        // Check if the user has a valid payment status
        if ($userPayment && $userPayment->paid_status == 1) {
            // Allow user to proceed
            return $next($request);
        } elseif (!Session::has('membership_page_shown_' . $user->id)) {
            // Set a flag to indicate the user has seen the membership page
            Session::put('membership_page_shown_' . $user->id, true);

            // Redirect to the membership page
            return Redirect::route('membership')->with('error', 'You are not a premium member. Please choose a payment plan.');
        }

        // If the membership page has been shown once, allow the user to proceed
        return $next($request);
    }
}