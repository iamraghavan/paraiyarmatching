<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;


use Illuminate\Support\Facades\Log;

class VerifyOtpController extends Controller
{
    public function sendOTP(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');

        // Prefix phone number with '91' for WhatsApp
        $whatsappNumber = '91' . $phone;

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in the session with a timestamp
        Session::put('otp', $otp);
        Session::put('otp_phone', $phone);
        Session::put('otp_email', $email);
        Session::put('otp_expires_at', now()->addMinutes(3)); // OTP valid for 3 minutes

        // Send OTP via Email
        // $emailResponse = $this->sendEmailOTP($email, $otp);

        // Send OTP via WhatsApp
        $whatsappResponse = $this->sendWhatsAppOTP($whatsappNumber, $otp);

        return response()->json([
            // 'email_response' => $emailResponse,
            'whatsapp_response' => $whatsappResponse
        ]);
    }



    private function sendWhatsAppOTP($whatsappNumber, $otp)
    {
        // Prefix phone number with '91' if it's not already prefixed
        if (substr($whatsappNumber, 0, 2) !== '91') {
            $whatsappNumber = '91' . $whatsappNumber;
        }

        $client = new Client();

        try {
            // Log the request details
            Log::info('Sending WhatsApp OTP', [
                'url' => 'https://api.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/',
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authkey' => '409648ACCWWwhe65ec22faP1',
                ],
                'json' => [
                    'integrated_number' => '917603809257',
                    'content_type' => 'template',
                    'payload' => [
                        'to' => $whatsappNumber,
                        'type' => 'template',
                        'template' => [
                            'name' => 'ktd', // Replace with your template name in MSG91
                            'language' => [
                                'code' => 'en',
                                'policy' => 'deterministic',
                            ],
                            'components' => [
                                [
                                    'type' => 'body',
                                    'parameters' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'users', // Replace 'users' with the dynamic name if needed
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $otp,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'messaging_product' => 'whatsapp',
                    ],
                ],
            ]);

            $response = $client->request('POST', 'https://api.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'authkey' => '409648ACCWWwhe65ec22faP1',
                ],
                'json' => [
                    'integrated_number' => '917603809257',
                    'content_type' => 'template',
                    'payload' => [
                        'to' => $whatsappNumber,
                        'type' => 'template',
                        'template' => [
                            'name' => 'ktd', // Replace with your template name in MSG91
                            'language' => [
                                'code' => 'en',
                                'policy' => 'deterministic',
                            ],
                            'components' => [
                                [
                                    'type' => 'body',
                                    'parameters' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'users', // Replace 'users' with the dynamic name if needed
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => $otp,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'messaging_product' => 'whatsapp',
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            // Log the response details
            Log::info('WhatsApp OTP Response', [
                'statusCode' => $statusCode,
                'body' => $body,
            ]);

            return $body; // Return response body or handle further as needed
        } catch (\Exception $e) {
            // Log the error
            Log::error('WhatsApp OTP Error', ['error' => $e->getMessage()]);
            return $e->getMessage(); // Example: return error message
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





    public function verifyOTP(Request $request)
    {
        $otp = $request->input('otp');

        // Retrieve OTP and related data from session
        $storedOtp = Session::get('otp');
        $otpExpiresAt = Session::get('otp_expires_at');

        // Check if OTP is correct and not expired
        if ($storedOtp == $otp && now()->lessThanOrEqualTo($otpExpiresAt)) {
            // OTP is valid
            Session::forget('otp');
            Session::forget('otp_expires_at');
            Session::forget('otp_phone');
            Session::forget('otp_email');

            return response()->json(['status' => 'success', 'message' => 'OTP verified successfully']);
        } else {
            // OTP is invalid or expired
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired OTP'], 400);
        }
    }
}