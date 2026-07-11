<?php

namespace Modules\RraEbm\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraEbmService
{
    private const ALLOWED_HOSTS = [
        'ebm.rra.gov.rw',
    ];

    public function buildUrl(string $serverUrl, string $appName, string $endpoint): string
    {
        $serverUrl = trim($serverUrl);

        $baseUrl = rtrim($serverUrl, '/');
        if (!preg_match('#^https?://#', $baseUrl)) {
            $baseUrl = 'http://' . $baseUrl;
        }

        $appPart = trim($appName, '/');
        $endpointPart = trim($endpoint, '/');

        return $baseUrl . '/' . $appPart . ($endpointPart ? '/' . $endpointPart : '');
    }

    public function validateServerUrl(string $serverUrl): bool
    {
        $url = preg_match('#^https?://#', $serverUrl) ? $serverUrl : 'http://' . $serverUrl;
        $parsed = parse_url($url);

        if (!$parsed || !isset($parsed['host'])) {
            return false;
        }

        $host = strtolower($parsed['host']);

        if (in_array($host, ['localhost', '127.0.0.1', '::1', '0.0.0.0'])) {
            Log::warning('RRA EBM: blocked localhost URL', ['url' => $serverUrl]);
            return false;
        }

        if (preg_match('/^10\./', $host) || preg_match('/^172\.(1[6-9]|2\d|3[01])\./', $host) || preg_match('/^192\.168\./', $host)) {
            Log::warning('RRA EBM: blocked private IP URL', ['url' => $serverUrl]);
            return false;
        }

        if (preg_match('/^169\.254\./', $host)) {
            Log::warning('RRA EBM: blocked link-local URL', ['url' => $serverUrl]);
            return false;
        }

        return true;
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
