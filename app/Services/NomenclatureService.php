<?php

namespace App\Services;

use Exception;
use RuntimeException;

class NomenclatureService
{
    private RcaV2ApiService $rcaV2ApiService;

    public function __construct(RcaV2ApiService $rcaV2ApiService)
    {
        $this->rcaV2ApiService = $rcaV2ApiService;
    }

    public function getCountries() {
        try {
            $response = $this->rcaV2ApiService->get("nomenclature/country");

            $response_json = $response->json();

            $error = $response_json["error"];

            if ($error) {
                $status = $response_json["status"];
                $message = $response_json["message"];

                return response()->json([
                    "error" => true,
                    "status" => $status,
                    "message" => $message
                ], $status);
            }

            $data = $response_json["data"];

            $countries = [];

            foreach ($data as $country) {
                $countries[] = [
                    "code" => $country["iso2"],
                    "name" => $country["nameRO"]
                ];
            }

            return response()->json([
                "error" => false,
                "status" => 200,
                "data" => $countries
            ]);
        } catch(Exception $error) {
            throw new RuntimeException("Get countries failed: " . $error->getMessage());
        }
    }

    public function getCounties() {
        try {
            $response = $this->rcaV2ApiService->get("nomenclature/county");

            $response_json = $response->json();

            $error = $response_json["error"];

            if($error) {
                $status = $response_json["status"];
                $message = $response_json["message"];

                return response()->json([
                    "error" => true,
                    "status" => $status,
                    "message" => $message,
                ], $status);
            }

            $data = $response_json["data"];

            $counties = [];

            foreach($data as $county) {
                $counties[] = [
                    "code" => $county["code"],
                    "name" => $county["name"]
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
    }

    public function getCitiesByCountyCode($county_code) {
        if(!$county_code) {
            return response()->json([
                "error" => true,
                "status" => 400,
                "message" => "Get cities failed. No county code provided"
            ], 400);
        }

        try {
            $response = $this->rcaV2ApiService->get("nomenclature/locality/" . $county_code);

            $response_json = $response->json();

            $error = $response_json["error"];

            if ($error) {
                $status = $response_json["status"];
                $message = $response_json["message"];

                return response()->json([
                    "error" => true,
                    "status" => $status,
                    "message" => $message
                ], $status);
            }

            $data = $response_json["data"];

            $cities = [];

            foreach ($data as $city) {
                $cities[] = [
                    "siruta" => $city["siruta"],
                    "name" => $city["name"]
                ];
            }

            return response()->json([
                "error" => false,
                "status" => 200,
                "data" => $cities
            ]);
        } catch(Exception $error) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ], 500);
        }
    }
}
