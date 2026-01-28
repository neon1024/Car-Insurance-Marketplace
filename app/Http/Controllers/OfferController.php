<?php

namespace App\Http\Controllers;

use App\Services\OfferService;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class OfferController extends Controller
{
    private OfferService $offerService;
    public function __construct(OfferService $offerService) {
        $this->offerService = $offerService;
    }

    public function index()
    {
        try {
            // TODO handle errors on frontend
            $validated_request = request()->validate([
                "insuranceStartDate" => [Rule::date()->format('Y-m-d'), Rule::date()->afterToday()],
                "insuranceDurationInMonths" => "required|numeric|between:1,12",

                "policyHolderBusinessName" => "nullable|string",
                "policyHolderBusinessRegisterNumber" => "nullable|string",
                "policyHolderBusinessCAENCode" => "nullable|numeric",
                "policyHolderBusinessCUI" => "nullable|string",

                "policyHolderLastName" => "required|string",
                "policyHolderFirstName" => "required|string",
                "policyHolderCNP" => "nullable|string",
                "policyHolderEmail" => "nullable|email",
                "policyHolderPhone" => "nullable|string",

                "policyHolderCountyCode" => "required|string",
                "policyHolderCity" => "required|string",
                "policyHolderCityCode" => "required|numeric",
                "policyHolderStreet" => "required|string",
                "policyHolderHouseNumber" => "required|string",
                "policyHolderBuilding" => "required|string",
                "policyHolderStaircase" => "required|string",
                "policyHolderApartment" => "required|string",
                "policyHolderFloor" => "required|string",
                "policyHolderPostcode" => "required|string",

                "vehicleOwnerBusinessName" => "nullable|string",
                "vehicleOwnerBusinessRegisterNumber" => "nullable|string",
                "vehicleOwnerBusinessCAENCode" => "nullable|numeric",
                "vehicleOwnerBusinessCUI" => "nullable|string",

                "vehicleOwnerLastName" => "required|string",
                "vehicleOwnerFirstName" => "required|string",
                "vehicleOwnerCNP" => "nullable|string",
                "vehicleOwnerEmail" => "nullable|email",
                "vehicleOwnerPhone" => "nullable|string",

                "vehicleOwnerCountyCode" => "required|string",
                "vehicleOwnerCity" => "required|string",
                "vehicleOwnerCityCode" => "required|numeric",
                "vehicleOwnerStreet" => "required|string",
                "vehicleOwnerHouseNumber" => "required|string",
                "vehicleOwnerBuilding" => "required|string",
                "vehicleOwnerStaircase" => "required|string",
                "vehicleOwnerApartment" => "required|string",
                "vehicleOwnerFloor" => "required|string",
                "vehicleOwnerPostcode" => "required|string",

                "driverLastName" => "required|string",
                "driverFirstName" => "required|string",
                "driverCNP" => "required|string",
                "driverIDSeries" => "required|string",
                "driverIDNumber" => "required|string",
                "driverPhone" => "nullable|string",

                "vehicleLicensePlate" => "required|string",
                "vehicleRegistrationType" => "required|string",
                "vehicleVIN" => "required|string",
                "vehicleType" => "required|string",
                "vehicleBrand" => "required|string",
                "vehicleModel" => "required|string",
                "vehicleYearOfConstruction" => "required|numeric",
                "vehicleEngineDisplacement" => "required|numeric",
                "vehicleEnginePower" => "required|numeric",
                "vehicleTotalWeight" => "required|numeric",
                "vehicleSeats" => "required|numeric",
                "vehicleFuelType" => "required|string",
                "vehicleFirstRegistration" => ["required", Rule::date()->format("Y-m-d")],
                "vehicleUsageType" => "required|string",
                "vehicleCIV" => "required|string",

                "vehicleCurrentMileage" => "required|numeric|min:1",

                "vehicleExpirationDatePti" => ["required", Rule::date()->format("Y-m-d")],
                "isAcquiredFromRomanianDealer" => "required|boolean"
            ]);

            // TODO send only the request()->all() / body into the request

            // insurance
            $insuranceStartDate = $validated_request["insuranceStartDate"];
            $insuranceDurationInMonths = $validated_request["insuranceDurationInMonths"];

            // policyholder
            // if company
            $policyHolderBusinessName = $validated_request["policyHolderBusinessName"];
            $policyHolderBusinessRegisterNumber = $validated_request["policyHolderBusinessRegisterNumber"];
            $policyHolderBusinessCAENCode = $validated_request["policyHolderBusinessCAENCode"];
            $policyHolderBusinessCUI = $validated_request["policyHolderBusinessCUI"];

            // policyholder
            // if person
            $policyHolderLastName = $validated_request["policyHolderLastName"];
            $policyHolderFirstName = $validated_request["policyHolderFirstName"];
            $policyHolderCNP = $validated_request["policyHolderCNP"];
            $policyHolderEmail = $validated_request["policyHolderEmail"];
            $policyHolderPhone = $validated_request["policyHolderPhone"];

            // policyholder address
            $policyHolderCountyCode = $validated_request["policyHolderCountyCode"];
            $policyHolderCity = $validated_request["policyHolderCity"];
            $policyHolderCityCode = $validated_request["policyHolderCityCode"];
            $policyHolderStreet = $validated_request["policyHolderStreet"];
            $policyHolderHouseNumber = $validated_request["policyHolderHouseNumber"];
            $policyHolderBuilding = $validated_request["policyHolderBuilding"];
            $policyHolderStaircase = $validated_request["policyHolderStaircase"];
            $policyHolderApartment = $validated_request["policyHolderApartment"];
            $policyHolderFloor = $validated_request["policyHolderFloor"];
            $policyHolderPostcode = $validated_request["policyHolderPostcode"];

            // vehicle owner
            $vehicleOwnerBusinessName = $validated_request["vehicleOwnerBusinessName"];
            $vehicleOwnerBusinessRegisterNumber = $validated_request["vehicleOwnerBusinessRegisterNumber"];
            $vehicleOwnerBusinessCAENCode = $validated_request["vehicleOwnerBusinessCAENCode"];
            $vehicleOwnerBusinessCUI = $validated_request["vehicleOwnerBusinessCUI"];

            $vehicleOwnerLastName = $validated_request["vehicleOwnerLastName"];
            $vehicleOwnerFirstName = $validated_request["vehicleOwnerFirstName"];
            $vehicleOwnerCNP = $validated_request["vehicleOwnerCNP"];
            $vehicleOwnerEmail = $validated_request["vehicleOwnerEmail"];
            $vehicleOwnerPhone = $validated_request["vehicleOwnerPhone"];

            $vehicleOwnerCountyCode = $validated_request["vehicleOwnerCountyCode"];
            $vehicleOwnerCity = $validated_request["vehicleOwnerCity"];
            $vehicleOwnerCityCode = $validated_request["vehicleOwnerCityCode"];
            $vehicleOwnerStreet = $validated_request["vehicleOwnerStreet"];
            $vehicleOwnerHouseNumber = $validated_request["vehicleOwnerHouseNumber"];
            $vehicleOwnerBuilding = $validated_request["vehicleOwnerBuilding"];
            $vehicleOwnerStaircase = $validated_request["vehicleOwnerStaircase"];
            $vehicleOwnerApartment = $validated_request["vehicleOwnerApartment"];
            $vehicleOwnerFloor = $validated_request["vehicleOwnerFloor"];
            $vehicleOwnerPostcode = $validated_request["vehicleOwnerPostcode"];

            // drivers
            $driverLastName = $validated_request["driverLastName"];
            $driverFirstName = $validated_request["driverFirstName"];
            $driverCNP = $validated_request["driverCNP"];
            $driverIDSeries = $validated_request["driverIDSeries"];
            $driverIDNumber = $validated_request["driverIDNumber"];
            $driverId = $driverIDSeries . $driverIDNumber;
            $driverPhone = $validated_request["driverPhone"];

            // vehicle
            $vehicleLicensePlate = $validated_request["vehicleLicensePlate"];
            $vehicleRegistrationType = $validated_request["vehicleRegistrationType"];
            $vehicleVIN = $validated_request["vehicleVIN"];
            $vehicleType = $validated_request["vehicleType"];
            $vehicleBrand = $validated_request["vehicleBrand"];
            $vehicleModel = $validated_request["vehicleModel"];
            $vehicleYearOfConstruction = $validated_request["vehicleYearOfConstruction"];
            $vehicleEngineDisplacement = $validated_request["vehicleEngineDisplacement"];
            $vehicleEnginePower = $validated_request["vehicleEnginePower"];
            $vehicleTotalWeight = $validated_request["vehicleTotalWeight"];
            $vehicleSeats = $validated_request["vehicleSeats"];
            $vehicleFuelType = $validated_request["vehicleFuelType"];
            $vehicleFirstRegistration = $validated_request["vehicleFirstRegistration"];
            $vehicleUsageType = $validated_request["vehicleUsageType"];
            $vehicleCIV = $validated_request["vehicleCIV"];
            $vehicleCurrentMileage = $validated_request["vehicleCurrentMileage"];

            // additional data
            $vehicleExpirationDatePti = $validated_request["vehicleExpirationDatePti"];
            $isAcquiredFromRomanianDealer = $validated_request["isAcquiredFromRomanianDealer"];

            // authentication fields must be empty because the auth is provided by the token

            // TODO if registration type is registered => no car license plate required
            // TODO if normal person => no company data required + identification required
            // TODO if company => no person name + no identification required
            $request_body = [
                "provider" => [
                    "organization" => [
                        "businessName" => ""
                    ]
                ],
                "product" => [
                    "motor" => [
                        "startDate" => $insuranceStartDate,
                        "termTime" => $insuranceDurationInMonths,
                        "renewPolicy" => [
                            "series" => "XX/XX/XX",
                            "number" => 123456789
                        ]
                    ],
                    "policyholder" => [
                        "businessName" => $policyHolderBusinessName,
                        "companyRegistryNumber" => $policyHolderBusinessRegisterNumber,
                        "caenCode" => $policyHolderBusinessCAENCode,
                        "lastName" => $policyHolderLastName,
                        "firstName" => $policyHolderFirstName,
                        "taxId" => $policyHolderBusinessCUI ?? $policyHolderCNP,
                        "email" => $policyHolderEmail,
                        "mobileNumber" => $policyHolderPhone,
                        "address" => [
                            "county" => $policyHolderCountyCode,
                            "city" => $policyHolderCity,
                            "cityCode" => $policyHolderCityCode,
                            "street" => $policyHolderStreet,
                            "houseNumber" => $policyHolderHouseNumber,
                            "building" => $policyHolderBuilding,
                            "staircase" => $policyHolderStaircase,
                            "apartment" => $policyHolderApartment,
                            "floor" => $policyHolderFloor,
                            "postcode" => $policyHolderPostcode
                        ]
                    ],
                    "vehicle" => [
                        "owner" => [
                            "businessName" => $vehicleOwnerBusinessName,
                            "companyRegistryNumber" => $vehicleOwnerBusinessRegisterNumber,
                            "caenCode" => $vehicleOwnerBusinessCAENCode,
                            "lastName" => $vehicleOwnerLastName,
                            "firstName" => $vehicleOwnerFirstName,
                            "taxId" => $vehicleOwnerBusinessCUI ?? $vehicleOwnerCNP,
                            "email" => $vehicleOwnerEmail,
                            "mobileNumber" => $vehicleOwnerPhone,
                            "address" => [
                                "county" => $vehicleOwnerCountyCode,
                                "city" => $vehicleOwnerCity,
                                "cityCode" => $vehicleOwnerCityCode,
                                "street" => $vehicleOwnerStreet,
                                "houseNumber" => $vehicleOwnerHouseNumber,
                                "building" => $vehicleOwnerBuilding,
                                "staircase" => $vehicleOwnerStaircase,
                                "apartment" => $vehicleOwnerApartment,
                                "floor" => $vehicleOwnerFloor,
                                "postcode" => $vehicleOwnerPostcode
                            ]
                        ],
                        "driver" => [
                            [
                                "lastName" => $driverLastName,
                                "firstName" => $driverFirstName,
                                "taxId" => $driverCNP,
                                "identification" => [
                                    "idNumber" => $driverId
                                ],
                                "mobileNumber" => $driverPhone
                            ]
                        ],
                        "licensePlate" => $vehicleLicensePlate,
                        "registrationType" => $vehicleRegistrationType,
                        "vin" => $vehicleVIN,
                        "vehicleType" => $vehicleType,
                        "brand" => $vehicleBrand,
                        "model" => $vehicleModel,
                        "yearOfConstruction" => $vehicleYearOfConstruction,
                        "engineDisplacement" => $vehicleEngineDisplacement,
                        "enginePower" => $vehicleEnginePower,
                        "totalWeight" => $vehicleTotalWeight,
                        "seats" => $vehicleSeats,
                        "fuelType" => $vehicleFuelType,
                        "firstRegistration" => $vehicleFirstRegistration,
                        "usageType" => $vehicleUsageType,
                        "identification" => [
                            "idNumber" => $vehicleCIV
                        ],
                        "currentMileage" => $vehicleCurrentMileage
                    ],
                    "additionalData" => [
                        "product" => [
                            "isAcquiredFromRomanianDealer" => $isAcquiredFromRomanianDealer,
                            "vehicle" => [
                                "expirationDatePti" => $vehicleExpirationDatePti
                            ]
                        ]
                    ]
                ]
            ];

            $offersData = $this->offerService->getOffers($request_body);

            return Inertia::render("OfferResults", $offersData);
        } catch(ValidationException $error) {
            return Inertia::render('OfferResults', [
                "insurer" => "insurer",
                "offers" => [],
                'errors' => $error->getMessage() // send errors back to the component
            ]);
        } catch(Exception $error) {
            return Inertia::render('OfferResults', [
                "insurer" => "insurer",
                "offers" => [],
                'errors' => $error->getMessage() // send errors back to the component
            ]);
        }
    }
}
