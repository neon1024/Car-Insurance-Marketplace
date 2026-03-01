<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function checkIfUserExistsByEmail() {
        try {
            $validated_request = request()->validate([
                "email" => "required|email"
            ]);

            $email = $validated_request["email"];

            // TODO if email doesn't exist -> redirect to the previous page with data for a toast message

            $userExists = $this->userService->checkIfUserExistsByEmail($email);

            return response()->json([
                "error" => false,
                "status" => 200,
                "data" => $userExists
            ]);
        } catch(Exception $exception) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $exception->getMessage()
            ]);
        }
    }
}
