<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Traits;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Models\CloudMessagingToken;

trait HasCloudMessageTokens
{
    public function cloudMessagingTokens()
    {
        return $this->hasMany(CloudMessagingToken::class);
    }
}