<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        try {
            request()->validate([
                "username" => "required",
                "password" => "required"
            ]);

            $auth_response = Http::withoutVerifying()->post(
                "https://rca-qa.api.lifeishard.ro/auth", [
                "account" => request()->input("username"),
                "password" => request()->input("password")
            ]);

            $auth_data = $auth_response->json();
            $error = $auth_data["error"];
            $status = $auth_data["error"];

            if ($error) {
                return redirect()->back()->with("error", $auth_data["message"]);
            }

            $auth_token = $auth_data["data"]["token"];
            $auth_token_expires_at = $auth_data["data"]["expires_at"];
            $refresh_auth_token = $auth_data["data"]["refresh_token"];

            request()->session([
                "auth_token" => $auth_token,
                "auth_token_expires_at" => $auth_token_expires_at,
                "refresh_auth_token" => $refresh_auth_token
            ]);

            return redirect()->route("home.page");
        } catch(ValidationException $error) {
            // TODO handle
            return redirect()->back()->with("error", $error->getMessage());
        } catch (Exception $error) {
            // TODO handle
            return redirect()->back()->with("error", $error->getMessage());
        }
    }
}
