<?php

namespace Modules\RraEbm\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraEbmService
{
    public function buildUrl(string $serverUrl, string $appName, string $endpoint): string
    {
        $serverUrl = trim($serverUrl);
        $isValidUrl = filter_var($serverUrl, FILTER_VALIDATE_URL);
        $isValidIp = filter_var($serverUrl, FILTER_VALIDATE_IP) ||
            filter_var('http://' . $serverUrl, FILTER_VALIDATE_URL);

        $baseUrl = rtrim($serverUrl, '/');
        if (!preg_match('#^https?://#', $baseUrl) && $isValidIp) {
            $baseUrl = 'http://' . $baseUrl;
        }

        $appPart = trim($appName, '/');
        $endpointPart = trim($endpoint, '/');

        return $baseUrl . '/' . $appPart . ($endpointPart ? '/' . $endpointPart : '');
    }

    public function client(RraEbmSetting $setting): PendingRequest
    {
        return Http::timeout(config('rraebm.http.timeout', 30))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
    }

    public function post(RraEbmSetting $setting, string $endpoint, array $payload): Response
    {
        $url = $this->buildUrl($setting->server_url, $setting->app_name, $endpoint);

        $response = Http::timeout(config('rraebm.http.timeout', 30))
            ->retry(
                config('rraebm.http.retry_times', 3),
                config('rraebm.http.retry_delay', 100)
            )
            ->post($url, $payload);

        if (!$response->successful()) {
            Log::error('RRA EBM API request failed', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $response;
        }

        $body = $response->json();

        if (($body['resultCd'] ?? '') !== '000') {
            Log::error('RRA EBM API returned error code', [
                'url' => $url,
                'resultCd' => $body['resultCd'] ?? 'N/A',
                'resultMsg' => $body['resultMsg'] ?? 'Unknown error',
                'payload' => $payload,
            ]);
        }

        return $response;
    }

    public function isSuccessful(Response $response): bool
    {
        return $response->successful() && ($response->json()['resultCd'] ?? '') === '000';
    }

    public function getErrorMessage(Response $response): string
    {
        if (!$response->successful()) {
            return "HTTP {$response->status()}: {$response->body()}";
        }

        return $response->json()['resultMsg'] ?? 'Unknown RRA EBM error';
    }
}
