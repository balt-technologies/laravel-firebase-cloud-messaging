<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Models;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Traits\Uuids;
use BaltTechnologies\LaravelFirebaseCloudMessaging\Database\Factories\CloudMessagingTokenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudMessagingToken extends Model
{
    use Uuids, HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['token', 'user_id'];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    protected static function newFactory()
    {
        return CloudMessagingTokenFactory::new();
    }
}
