<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// TODO move all custom routes to /api.php

Route::get("/", function () {
    return Inertia::render("Home");
})->name("home.page");

Route::get("/login", function () {
    return Inertia::render("Login");
})->name("login.page");

Route::post("/login", function () {
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

    if($error) {
        return redirect()->route("login.page")->with("error", $auth_data["message"]);
    }

    $auth_token = $auth_data["data"]["token"];
    $auth_token_expires_at = $auth_data["data"]["expires_at"];
    $refresh_auth_token = $auth_data["data"]["refresh_token"];

    session([
        "auth_token" => $auth_token,
        "auth_token_expires_at" => $auth_token_expires_at,
        "refresh_auth_token" => $refresh_auth_token
    ]);

    return redirect()->route("home.page");
})->name("login.logic");

Route::get("/offers", function () {
    return Inertia::render("Offers");
})->name("offers.page");

Route::post("/offers", function () {
    $token = session("auth_token");

    // authentication fields must be empty because the auth is provided by the token
    // TODO get start date from user
    $request_body = [
        "provider" => [
            "organization" => [
                "businessName" => "asirom"
            ],
            "authentication" => [
                "account" => "",
                "password" => "",
                "code" => ""
            ]
        ],
        "product" => [
            "motor" => [
                "startDate" => "2026-01-09",
                "termTime" => 12,
                "installmentCount" => 1,
                "commissionPercentLimit" => 12,
                "renewPolicy" => [
                    "series" => "XX/XX/XX",
                    "number" => 123456789
                ],
                "generatePaymentLink" => false,
                "webhookLink" => "https://domain.com/webhook/example"
            ],
            "policyholder" => [
                "businessName" => "Life is Hard",
                "companyRegistryNumber" => "J12/1403/2004",
                "caenCode" => 6202,
                "lastName" => "Pop",
                "firstName" => "Vasile",
                "isForeignPerson" => false,
                "taxId" => "16336490",
                "nationality" => "RO",
                "citizenship" => "RO",
                "gender" => "m",
                "birthdate" => "1996-01-01",
                "email" => "email@email.ro",
                "mobileNumber" => "0744444444",
                "identification" => [
                    "idType" => "CI",
                    "idNumber" => "CJ123456",
                    "issueAuthority" => "SPCLEP Cluj",
                    "issueDate" => "2022-11-24"
                ],
                "drivingLicense" => [
                    "issueDate" => "2022-11-24"
                ],
                "address" => [
                    "country" => "RO",
                    "county" => "CJ",
                    "city" => "Cluj-Napoca",
                    "cityCode" => 54984,
                    "street" => "Principala",
                    "houseNumber" => "19-21",
                    "building" => "A1",
                    "staircase" => "1",
                    "apartment" => "12",
                    "floor" => "3",
                    "postcode" => "400356"
                ],
                "hasDisability" => false,
                "isRetired" => false
            ],
            "vehicle" => [
                "owner" => [
                    "businessName" => "Life is Hard",
                    "companyRegistryNumber" => "J12/1403/2004",
                    "caenCode" => 6202,
                    "lastName" => "Pop",
                    "firstName" => "Vasile",
                    "isForeignPerson" => false,
                    "taxId" => "16336490",
                    "nationality" => "RO",
                    "citizenship" => "RO",
                    "gender" => "m",
                    "birthdate" => "1996-01-01",
                    "email" => "email@email.ro",
                    "mobileNumber" => "0744444444",
                    "identification" => [
                        "idType" => "CI",
                        "idNumber" => "CJ123456"
                    ],
        "drivingLicense" => [
            "issueDate" => "2022-11-24"
        ],
        "address" => [
            "country" => "RO",
          "county" => "CJ",
          "city" => "Cluj-Napoca",
          "cityCode" => 54984,
          "street" => "Principala",
          "houseNumber" => "19-21",
          "building" => "A1",
          "staircase" => "1",
          "apartment" => "12",
          "floor" => "3",
          "postcode" => "400356"
        ],
        "hasDisability" => false,
        "isRetired" => false
      ],
      "driver" => [
          [
              "lastName" => "Pop",
          "firstName" => "Vasile",
          "taxId" => "5030904270032",
          "identification" => [
            "idNumber" => "CJ123456"
          ],
          "mobileNumber" => "0766999000"
        ]
      ],
      "licensePlate" => "CJ10ABC",
      "registrationType" => "registered",
      "vin" => "WBA4H31080BH08057",
      "vehicleType" => "M1",
      "brand" => "Dacia",
      "model" => "Logan",
      "yearOfConstruction" => 2020,
      "engineDisplacement" => 1400,
      "enginePower" => 90,
      "totalWeight" => 1500,
      "seats" => 5,
      "fuelType" => "diesel",
      "firstRegistration" => "2020-01-06",
      "usageType" => "personal",
      "identification" => [
          "idNumber" => "H123456"
      ],
      "currentMileage" => 50000,
      "hasMobilityModifications" => false,
      "isLeased" => false,
      "isNew" => false
    ],
    "additionalData" => [
                "product" => [
                    "motor" => [
                        "hasCasco" => true
        ],
        "coordinatorId" => 76241,
        "recommenderTaxId" => "5030904270032",
        "protocolId" => 222,
        "extraCoverage" => true,
        "isAcquiredFromRomanianDealer" => true
                ]
            ]
        ]
    ];

    $quote_response = Http::withoutVerifying()->withHeader("Token", $token)->post(
        "https://rca-qa.api.lifeishard.ro/offer",
        $request_body
    );

    $quote_data = $quote_response->json();

    dd($quote_data);

})->name("offers.logic");

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
