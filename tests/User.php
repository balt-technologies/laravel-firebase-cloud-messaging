<?php


namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Tests;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Traits\HasCloudMessageTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use HasCloudMessageTokens, Authorizable, Authenticatable, HasFactory;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}