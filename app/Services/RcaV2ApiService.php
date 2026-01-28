<?php

namespace App\Services;

use RuntimeException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RcaV2ApiService
{
    private const AUTH_DATA = "rca_v2_api_auth_data";

    public function auth(): void {
        $response = Http::withoutVerifying()->post(
            config("services.rca_v2_api.base_url") . "/auth",
            [
                "account" => config("services.rca_v2_api.account"),
                "password" => config("services.rca_v2_api.password")
            ]
        );

        $response_json = $response->json();

        $error = $response_json["error"];

        if($error) {
            $status = $response_json["status"];
            $message = $response_json["message"];

            throw new RuntimeException("RCA V2 Auth failed with status code " . $status . ": " . $message);
        }

        $data = $response_json["data"];
        $expires_at = $data["expires_at"];

        $ttl = max(strtotime($expires_at) - time(), 60);

        Cache::put(self::AUTH_DATA, $data, $ttl);
    }

    private function ensureAuthData(): array
    {
        $data = Cache::get(self::AUTH_DATA);

        if (!$data || strtotime($data['expires_at']) <= time()) {
            $this->auth();
            $data = Cache::get(self::AUTH_DATA);
        }

        return $data;
    }

    /**
     * Get current valid token
     */
    public function getToken(): string
    {
        $data = $this->ensureAuthData();
        return $data['token'] ?? '';
    }

    /**
     * Get token expiration timestamp
     */
    public function getExpiresAt(): string
    {
        $data = $this->ensureAuthData();
        return $data['expires_at'] ?? '';
    }

    /**
     * Get refresh token
     */
    public function getRefreshToken(): string
    {
        $data = $this->ensureAuthData();
        return $data['refresh_token'] ?? '';
    }

    /**
     * Clear cached token data
     */
    public function clear(): void
    {
        Cache::forget(self::AUTH_DATA);
    }

    /**
     * Make a GET request to the RCA API with automatic token
     */
    public function get(string $endpoint, array $query = [])
    {
        return Http::withToken($this->getToken())
            ->get(config('services.rca_v2_api.base_url') . "/" . ltrim($endpoint, "/"), $query);
    }

    /**
     * Make a POST request to the RCA API with automatic token
     */
    public function post(string $endpoint, array $payload = [])
    {
        return Http::withToken($this->getToken())
            ->post(config('services.rca_v2_api.base_url') . "/" . ltrim($endpoint, "/"), $payload);
    }
}
