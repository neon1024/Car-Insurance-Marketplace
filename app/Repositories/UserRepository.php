<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findByEmail(string $email) {
        return User::where("email", $email)->first();
    }

    public function add(string $email, string $password) {
        User::create([
            "email" => $email,
            "password" => Hash::make($password),
        ]);
    }
}
