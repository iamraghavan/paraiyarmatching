<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'turnstile' => [
        'key' => env('TURNSTILE_SITE_KEY'),
        'secret' => env('TURNSTILE_SECRET_KEY'),
    ],

    // 'firebase' => [
    //     'credentials' => storage_path('app/firebase/firebase_credentials.json'),
    //     'database_url' => env('FIREBASE_DATABASE_URL'),
    //     'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
    //     'project_id' => env('FIREBASE_PROJECT_ID'),
    //     'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
    //     'messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID'),
    //     'app_id' => env('FIREBASE_APP_ID'),
    //     'measurement_id' => env('FIREBASE_MEASUREMENT_ID'),
    // ],



    'firebase' => [
        'credentials' => storage_path('app/firebase/firebase_credentials.json'),
    ],




];