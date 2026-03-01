<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail(string $email): bool {
        return User::where("email", $email)->get();
    }
}
