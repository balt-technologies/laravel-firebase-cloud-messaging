<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Tests\Unit;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Tests\TestCase;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Models\CloudMessagingToken;

class CloudMessagingTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function cloudTokenHasToken()
    {
        $token = CloudMessagingToken::factory()->create(['token' => 'FakeToken123']);
        self::assertEquals('FakeToken123', $token->token);
    }

    /** @test */
    function cloudTokenBelongsToUser()
    {
        // Given we have an author
        $user = User::factory()->create();
        // And this author has a Post
        $user->cloudMessagingTokens()->create([
            'token' => 'FakeToken123',
        ]);

        self::assertCount(1, CloudMessagingToken::all());
        self::assertCount(1, $user->cloudMessagingTokens);

        tap($user->cloudMessagingTokens()->first(), function ($cloudMessagingTokens) use ($user) {
            $this->assertEquals('FakeToken123', $cloudMessagingTokens->token);
            $this->assertTrue($cloudMessagingTokens->user->is($user));
        });
    }


}
