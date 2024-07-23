<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class VerifyOtpController extends Controller
{
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $email = $request->email;

        // Check if the email is already registered
        if (User::where('email', $email)->exists()) {
            return response()->json(['message' => 'Email is already registered.'], 400);
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        session(['otp' => $otp]);

        // Send OTP to email
        $this->sendEmailOTP($request->email, $otp);

        return response()->json(['message' => 'OTP sent successfully.']);
    }


    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer',
        ]);

        $otp = Session::get('otp');
        $otpEmail = Session::get('otp_email');

        if ($otp && $request->otp == $otp) {
            Session::forget('otp');
            Session::forget('otp_email');
            return response()->json(['message' => 'OTP verified successfully.']);
        } else {
            return response()->json(['message' => 'Invalid OTP.'], 422);
        }
    }

    private function sendEmailOTP($email, $otp)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://control.msg91.com/api/v5/email/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'for_panel_id' => '1',
                'from' => [
                    'email' => 'no-reply@paraiyarmatching.bumblebeesprojects.in'
                ],
                'domain' => 'paraiyarmatching.bumblebeesprojects.in',
                'template_id' => 'paraiyarmatching',
                'to' => [
                    [
                        'email' => $email,
                        'name' => 'User'
                    ]
                ],
                'variables' => [
                    'name' => 'User',
                    'OTP' => $otp
                ]
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'authkey: 409648ACCWWwhe65ec22faP1',
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
