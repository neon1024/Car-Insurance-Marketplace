<?php

namespace App\Models;

class User
{
    protected $fillable = [
//        'first_name',
//        'last_name',
        'email',
        'password',
//        'phone',
//        'role',
//        'is_active',
    ];

    protected $hidden = [
        'password',
//        'remember_token',
    ];
}
