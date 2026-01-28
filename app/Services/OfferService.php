<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class OfferService
{
    /** @var string[] **/
    private array $insurers = [
        "allianz",
        "asirom",
        "axeria",
        "generali",
        "groupama",
        "hellas_autonom",
        "hellas_nextins",
        "omniasig",
        "grawe",
        "eazy_insure"
    ];

    public function getOffers($requestData, $token) {
        try {
            $responses = Http::withoutVerifying()
                ->withHeader("Token", $token)
                ->pool(function (Pool $pool) use ($requestData) {
                    $offersData = [];

                    foreach ($this->insurers as $insurer) {
                        $payload = $requestData;
                        $payload["provider"]["organization"]["businessName"] = $insurer;

                        $offersData[$insurer] = $pool->post(
                            "https://rca-qa.api.lifeishard.ro/offer",
                            $payload);
                    }

                    return $offersData;
            });

            $offers = [];

            foreach($responses as $insurer => $response) {
                $response_json = $response->json();

                $error = $response_json["error"];
                $status = $response_json["status"];

                // TODO handle error
                if($error) {
                    $message = $response_json["message"];
                }

                $data = $response_json["data"];

                $offers[] = [
                    "insurer" => $insurer,
                    "offers" => $data["offers"]
                ];
            }

            return $offers;
        } catch(Exception $error) {
            throw $error;
        }
    }
}
