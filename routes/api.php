<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

$base_url = "https://rca-qa.api.lifeishard.ro";

// TODO form response to include error, status, message and countries as data

// TODO /nomenclature/country
Route::get('/countries', function() use ($base_url) {
    $token = request()->header("Token");

    if (!$token) {
        return response()->json(['error' => 'Token missing'], 401);
    }

    try {
        $response = Http::withoutVerifying()->withHeader(
            "Token",
            $token
        )->get($base_url . '/nomenclature/country');

        $response_json = $response->json();

        $error = $response_json["error"];
        $status = $response_json["status"];

        if($error) {
            $message = $response_json["message"];

            return response()->json([
                "error" => true,
                "message" => $message
            ], $status);
        }

        $data = $response_json["data"];

        $countries = [];

        foreach($data as $item) {
            $countries[] = [
                "iso" => $item["iso2"],
                "name" => $item["nameRO"]
            ];
        }

        // TODO form response to include error, status, message and countries as data
        return response()->json($countries);

    } catch (Exception $error) {
        return response()->json([
            'error' => true,
            'message' => $error->getMessage()
        ], 500);
    }
})->name("countries.get");

// TODO /nomenclature/county
Route::get("/counties", function() use ($base_url) {
    $token = request()->header("Token");

    if(!$token) {
        return response()->json([
            "error" => true,
            "status" => 401,
            "message" => "Token missing"
        ], 401);
    }

    try {
        $response = Http::withoutVerifying()->withHeader(
            "Token",
            $token)->get($base_url . "/nomenclature/county");

        $response_json = $response->json();

        $error = $response_json["error"];
        $status = $response_json["status"];

        if($error) {
            $message = $response_json["message"];

            return response()->json([
                "error" => true,
                "status" => $status,
                "message" => $message,
            ], $status);
        }

        $data = $response_json["data"];

        $counties = [];

        foreach($data as $item) {
            $counties[] = [
                "code" => $item["code"],
                "name" => $item["name"]
            ];
        }

        return response()->json([
            "error" => false,
            "status" => 200,
            "data" => $counties
        ]);
    } catch(Exception $error) {
        return response()->json([
            "error" => true,
            "status" => 500,
            "message" => $error->getMessage()
        ], 500);
    }
})->name("counties.get");

// TODO /nomenclature/locality/{county_code}
