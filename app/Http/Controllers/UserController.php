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

    public function createNewUser() {
        try {
            $validated_request = request()->validate([
                "email" => "required|email",
                "password" => "required|string"
            ]);

            $email = $validated_request["email"];
            $password = $validated_request["password"];

            $this->userService->createNewUser($email, $password);

            return response()->json([
                "error" => false,
                "status" => 200,
                "data" => ["User successfully created"]
            ]);
        } catch(Exception $exception) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $exception->getMessage()
            ]);
        }
    }

    public function loginUser() {
        try {
            $validated_request = request()->validate([
                "email" => "required|email",
                "password" => "required|string"
            ]);

            $email = $validated_request["email"];
            $password = $validated_request["password"];

            $userId = $this->userService->loginUser($email, $password);

            if($userId) {
                request()->session()->put("user_id", $userId);

                return response()->json([
                    "error" => false,
                    "status" => 200,
                    "data" => $userId
                ]);
            } else {
                return response()->json([
                    "error" => true,
                    "status" => 403,
                    "message" => "Failed to log user in"
                ]);
            }
        } catch(Exception $exception) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $exception->getMessage()
            ]);
        }
    }

    public function logoutUser() {
        request()->session()->forget("user_id");

        return response()->json([
            "error" => false,
            "status" => 200,
            "message" => "Logged out successfully"
        ]);
    }
}
