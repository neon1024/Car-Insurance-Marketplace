<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class OfferService
{
    private RcaV2ApiService $rcaV2ApiService;

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

    public function __construct(RcaV2ApiService $rcaV2ApiService) {
        $this->rcaV2ApiService = $rcaV2ApiService;
    }

    public function getOffers($requestData) {
        try {
            $token = $this->rcaV2ApiService->getToken();

            $responses = Http::withoutVerifying()
                ->withHeader("Token", $token)
                ->pool(function (Pool $pool) use ($requestData) {
                    $offersData = [];

                    foreach ($this->insurers as $insurer) {
                        $payload = $requestData;
                        $payload["provider"]["organization"]["businessName"] = $insurer;

                        $offersData[$insurer] = $pool->post(
                            $this->rcaV2ApiService->getBaseUrl() . "/offer",
                            $payload
                        );
                    }

                    return $offersData;
            });

            $offers = [];

            foreach($responses as $insurer => $response) {
                $response_json = $response->json();

                $error = $response_json["error"];

                // TODO handle error
                if($error) {
                    $status = $response_json["status"];
                    $message = $response_json["message"];

                    continue;
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
