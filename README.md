# laravel-firebase-cloud-messaging
Some helpful tools for using FCM in Laravel

Steps:

1. Create Event

2. Create a connection to this package by creating a Listener similar to this one:
`php artisan vendor:publish --provider="BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider" --tag="example-listener"`

3. Publish config via (highly recommended):
`php artisan vendor:publish --provider="BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider" --tag="config"`

4. Publish migration via  
`php artisan vendor:publish --provider="BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider" --tag="migrations"`

5. Publish default-service via  
`php artisan vendor:publish --provider="BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider" --tag="example-service"`

6. Publish example-translation (en/de) via  
`php arpublish --provider="BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider" --tag="example-translations"`

Give the User-class the trait 'HasCloudMessageTokens'. Make sure it has an 'id'-field.