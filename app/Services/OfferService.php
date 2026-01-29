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

            $responses = Http::pool(function (Pool $pool) use ($requestData, $token) {
                    $offersData = [];

                    foreach ($this->insurers as $insurer) {
                        $payload = $requestData;
                        $payload["provider"]["organization"]["businessName"] = $insurer;

                        $offersData[$insurer] = $pool->withoutVerifying()->withHeader("Token", $token)->timeout(3)->post(
                            $this->rcaV2ApiService->getBaseUrl() . "/offer",
                            $payload
                        );
                    }

                    return $offersData;
            });

            // TODO rework
            $offersData = [];

            foreach ($responses as $response) {
                // Handle connection exceptions
                if ($response instanceof \Illuminate\Http\Client\ConnectionException) {
                    $offersData[] = [
                        'success' => false,
                        'status' => null,
                        'data' => null,
                        'error' => 'Connection refused or timed out',
                    ];
                    continue;
                }

                /** @var \Illuminate\Http\Client\Response $response */
                $offersData[] = [
                    'success' => $response->successful(),
                    'status' => $response->status(),
                    'data' => $response->successful() ? [
                        "insurer" => $response->json()['data']["provider"]["organization"]["businessName"],
                        "offers" => $response->json()['data']['offers']
                    ] ?? [] : null,
                    'error' => $response->successful() ? null : $response->body(),
                ];
            }

            $offers = [];

            foreach($offersData as $offerData) {
                if($offerData["success"]) {
                    $offers[] = [
                        "insurer" => $offerData["data"]["insurer"],
                        "offers" => $offerData["data"]["offers"]
                    ];
                }
            }

            // TODO returns 5 but dd shows 3?
            return $offers;
        } catch(Exception $error) {
            throw $error;
        }
    }
}
