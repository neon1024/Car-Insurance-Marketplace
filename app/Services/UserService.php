<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function checkIfUserExistsByEmail(string $email): bool {
        return $this->userRepository->findByEmail($email) != null;
    }

    public function createNewUser(string $email, string $password) {
        $this->userRepository->add($email, $password);
    }

    public function loginUser(string $email, string $password): string | null {
        $user = User::where("email", $email)->first();

        if(!$user) {
            return false;
        }

        $userPassword = $user->password;

        if(Hash::check($password, $userPassword)) {
            $userId = $user->id;

            return $userId;
        }

        return null;
    }
}
