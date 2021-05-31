<?php

return [

    // Credentials
    'firebaseCredentials' => env('FIREBASE_CREDENTIALS'),

    // API routes
    'prefix' => 'cloud-messaging-token',
    'middleware' => ['auth:sanctum'],

    // Custom Paths
    'servicePathFromRoot' => 'Services/CloudMessaging',

];