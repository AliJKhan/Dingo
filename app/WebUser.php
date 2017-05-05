<?php

namespace App;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;


class WebUser extends CartalystUser
{

    protected $fillable = [
        'email',
        'phone_number',
        'token',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];
}
