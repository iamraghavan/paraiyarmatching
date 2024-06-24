<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\FirebaseException;

use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class LoginACValidate extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        // Fetch the Firebase credentials file path from configuration
        $firebaseCredentialsFile = config('services.firebase.credentials.file');
        // dd($firebaseCredentialsFile);
        // Check if the file path is valid
        if (empty($firebaseCredentialsFile)) {
            throw new \Exception('Firebase credentials file path is not configured properly.');
        }

        // Initialize Firebase Authentication using a factory
        $factory = (new Factory)->withServiceAccount($firebaseCredentialsFile);
        $this->firebaseAuth = $factory->createAuth();
    }

    public function admin_ad()
    {
        return view('pages.admin-control.pages.login');
    }

    public function admin_ads(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            // Attempt to authenticate user with Firebase
            $user = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);
            Session::put('firebaseUserId', $user->firebaseUserId());
            Session::put('idToken', $user->idToken());
            Session::save();
            // Redirect to the desired page after successful login
            return redirect()->intended('/dashboard');
        } catch (InvalidPassword | FirebaseException $e) {
            // Handle login errors
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    return back()->withErrors(['email' => 'Invalid email or password.']);
                case 'EMAIL_NOT_FOUND':
                    return back()->withErrors(['email' => 'Email not found.']);
                default:
                    return back()->withErrors(['email' => 'Login failed. Please try again later.']);
            }
        }
    }
}
