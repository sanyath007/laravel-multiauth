<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect' => 'http://your-callback-url',
    ],

    'facebook' => [
        'client_id' => '168703220418141',
        'client_secret' => '83989b455d49d05216f55ef80c3b008f',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'OTIjQsWl3M2EpBLiQwXi5ulkP',
        'client_secret' => 'X38E0rECWqWplD35WdfsfA3dXBVfDfyJO1gTchziEbumuCHdDz',
        'redirect' => 'http://localhost:8000/login/twitter/callback',
    ],

    'google' => [
        'client_id' => '581030412095-ajagijava3j2slofb0grhatdadb25grr.apps.googleusercontent.com',
        'client_secret' => '3jQ6OC4OQlUlVxhw_vVAqT1i',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

];
