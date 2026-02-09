<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Date;
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

            set_time_limit(60);

            $responses = Http::pool(function (Pool $pool) use ($requestData, $token) {
                    $offersData = [];

                    foreach ($this->insurers as $insurer) {
                        $payload = $requestData;
                        $payload["provider"]["organization"]["businessName"] = $insurer;

                        $offersData[$insurer] = $pool->withoutVerifying()
                            ->withHeader("Token", $token)
                            ->post($this->rcaV2ApiService->getBaseUrl() . "/offer", $payload);
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

            return $offers;
        } catch(Exception $error) {
            throw $error;
        }
    }

    public function downloadOfferById($id) {
        try {
            $response = $this->rcaV2ApiService->get("/offer/" . $id);

            $response_json = $response->json();

            $error = $response_json["error"];
            $status = $response_json["status"];

            if($error) {
                $message = $response_json["message"];

                return response()->json([
                    "error" => true,
                    "status" => $status,
                    "message" => $message
                ], $status);
            }

            $data = $response_json["data"];

            $file = $data["files"][0];
            $fileType = $file["type"];
            $fileName = $file["name"];
            $fileContent = $file["content"];
            $fileContentDecoded = base64_decode($fileContent);

            return response($fileContentDecoded)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                ->header('Content-Length', strlen($fileContentDecoded));
        } catch(Exception $error) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ], 500);
        }
    }

    public function transformOfferIntoPolicy($offerData) {
        try {
            $offerId = $offerData["id"];
            $offerAmount = $offerData["amount"];
            $offerCurrency = $offerData["currency"];
//            $offerDate = $offerData["date"];

            $request_body = [
                    "offerId" => $offerId,
                    "includeDirectCompensation" => false,
                    "payment" => [
                        "method" => "payment order",
                        "currency" => $offerCurrency,
                        "amount" => $offerAmount,
                        "date" => Carbon::now('Europe/Bucharest')->format('Y-m-d'),
                        "documentNumber" => "AX4984"
                    ],
                    "additionalData" => [
                        "product" => [
                            "policyholder" => [
                                "residency" => "resident in Romania",
                                "politicallyExposed" => "no"
                            ],
                            "vehicle" => [
                                "owner" => [
                                    "residency" => "resident in Romania",
                                    "politicallyExposed" => "no"
                                ]
                            ]
                        ]
                    ]
            ];

            set_time_limit(60);

            $response = $this->rcaV2ApiService->post("/policy", $request_body);

            $response_json = $response->json();

            $error = $response_json["error"];
            $status = $response_json["status"];

            if($error) {
                $message = $response_json["message"];

                return response()->json([
                    "error" => true,
                    "status" => $status,
                    "message" => $message
                ], $status);
            }

            $data = $response_json["data"];

            $policyId = $data["policies"][0]["policyId"];
            $policySeries = $data["policies"][0]["series"];
            $policyNumber = $data["policies"][0]["number"];

            $policyPDFData = $this->rcaV2ApiService->get("/policy/" .  $policyId . "?series=" . $policySeries . "&number=" . $policyNumber);

            $policyPDFData = $policyPDFData->json();

            $policyPDFname = $policyPDFData["data"]["files"][0]["name"];
            $policyPDF = $policyPDFData["data"]["files"][0]["content"];
            $policyPDFDecoded = base64_decode($policyPDF);

            return response($policyPDFDecoded)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $policyPDFname . '"')
                ->header('Content-Length', strlen($policyPDFDecoded));
        } catch(Exception $error) {
            return response()->json([
                "error" => true,
                "status" => 500,
                "message" => $error->getMessage()
            ], 500);
        }
    }
}
