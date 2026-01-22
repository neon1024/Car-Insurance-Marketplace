<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// TODO controllers

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

    if(!$token) {
        return redirect()->route("login.page");
    }

    // TODO validate
    request()->validate([
        "policyHolderBusinessName" => "required|string"
    ]);

    // TODO send only the request()->all() / body into the request

    $insurer = request("insurer");

    $policyHolderBusinessName = request("policyHolderBusinessName");
    $policyHolderBusinessRegisterNumber = request("policyHolderBusinessRegisterNumber");
    $policyHolderBusinessCAENCode = request("policyHolderBusinessCAENCode");
    $policyHolderBusinessCUI = request("policyHolderBusinessCUI");

    $policyHolderLastName = request("policyHolderLastName");
    $policyHolderFirstName = request("policyHolderFirstName");
    $policyHolderCNP = request("policyHolderCNP");
    $policyHolderEmail = request("policyHolderEmail");
    $policyHolderPhone = request("policyHolderPhone");

    $policyHolderCountyCode = request("policyHolderCountyCode");
    $policyHolderCity = request("policyHolderCity");
    $policyHolderCityCode = request("policyHolderCityCode");
    $policyHolderStreet = request("policyHolderStreet");
    $policyHolderHouseNumber = request("policyHolderHouseNumber");
    $policyHolderBuilding = request("policyHolderBuilding");
    $policyHolderStaircase = request("policyHolderStaircase");
    $policyHolderApartment = request("policyHolderApartment");
    $policyHolderFloor = request("policyHolderFloor");
    $policyHolderPostcode = request("policyHolderPostcode");

    $vehicleOwnerBusinessName = request("vehicleOwnerBusinessName");
    $vehicleOwnerBusinessRegisterNumber = request("vehicleOwnerBusinessRegisterNumber");
    $vehicleOwnerBusinessCAENCode = request("vehicleOwnerBusinessCAENCode");
    $vehicleOwnerBusinessCUI = request("vehicleOwnerBusinessCUI");

    $vehicleOwnerLastName = request("vehicleOwnerLastName");
    $vehicleOwnerFirstName = request("vehicleOwnerFirstName");
    $vehicleOwnerCNP = request("vehicleOwnerCNP");
    $vehicleOwnerEmail = request("vehicleOwnerEmail");
    $vehicleOwnerPhone = request("vehicleOwnerPhone");

    $vehicleOwnerCountyCode = request("vehicleOwnerCountyCode");
    $vehicleOwnerCity = request("vehicleOwnerCity");
    $vehicleOwnerCityCode = request("vehicleOwnerCityCode");
    $vehicleOwnerStreet = request("vehicleOwnerStreet");
    $vehicleOwnerHouseNumber = request("vehicleOwnerHouseNumber");
    $vehicleOwnerBuilding = request("vehicleOwnerBuilding");
    $vehicleOwnerStaircase = request("vehicleOwnerStaircase");
    $vehicleOwnerApartment = request("vehicleOwnerApartment");
    $vehicleOwnerFloor = request("vehicleOwnerFloor");
    $vehicleOwnerPostcode = request("vehicleOwnerPostcode");

    // authentication fields must be empty because the auth is provided by the token
    // TODO get start date from user
    $request_body = [
        "provider" => [
            "organization" => [
                "businessName" => $insurer
            ]
        ],
        "product" => [
            "motor" => [
                "startDate" => "2026-01-28",
                "termTime" => 12,
                "renewPolicy" => [
                    "series" => "XX/XX/XX",
                    "number" => 123456789
                ]
            ],
            "policyholder" => [
                "businessName" => "Life is Hard",
                "companyRegistryNumber" => "J12/1403/2004",
                "caenCode" => "6202",
                "lastName" => "Pop",
                "firstName" => "Vasile",
                "taxId" => "16336490",
                "email" => "email@email.ro",
                "mobileNumber" => "0744444444",
                "address" => [
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
                ]
            ],
            "vehicle" => [
                "owner" => [
                    "businessName" => "Life is Hard",
                    "companyRegistryNumber" => "J12/1403/2004",
                    "caenCode" => "6202",
                    "lastName" => "Pop",
                    "firstName" => "Vasile",
                    "taxId" => "16336490",
                    "email" => "email@email.ro",
                    "mobileNumber" => "0744444444",
                    "address" => [
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
                    ]
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
                "currentMileage" => 180000
            ],
            "additionalData" => [
                "product" => [
                    "isAcquiredFromRomanianDealer" => true,
                    // TODO
                    "vehicle" => [
                        "expirationDatePti" => "2026-02-28"
                    ]
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
