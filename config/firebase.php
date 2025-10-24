<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Firebase services integration
    |
    */

    'credentials' => env('FIREBASE_CREDENTIALS_PATH', storage_path('app/firebase/credentials.json')),

    'project_id' => env('FIREBASE_PROJECT_ID'),

    'database_url' => env('FIREBASE_DATABASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Cloud Messaging Configuration
    |--------------------------------------------------------------------------
    */

    'messaging' => [
        'enabled' => env('FIREBASE_MESSAGING_ENABLED', true),
        'timeout' => env('FIREBASE_MESSAGING_TIMEOUT', 30),
    ],
];
