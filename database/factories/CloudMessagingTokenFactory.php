<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Database\Factories;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Models\CloudMessagingToken;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Tests\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CloudMessagingTokenFactory extends Factory
{
    protected $model = CloudMessagingToken::class;

    public function definition()
    {
        $user = User::factory()->create();

        return [
            'token' => Str::random(10),
            'user_id' => $user->id,
        ];
    }
}