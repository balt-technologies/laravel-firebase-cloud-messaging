<?php


namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Tests;

use BaltTechnologies\LaravelFirebaseCloudMessaging\LaravelFirebaseCloudMessagingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelFirebaseCloudMessagingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_cloud_messaging_tokens_table.php.stub';


        // run the up() method (perform the migration)
        (new \CreateCloudMessagingTokensTable)->up();
        (new \CreateUsersTable)->up();
    }
}