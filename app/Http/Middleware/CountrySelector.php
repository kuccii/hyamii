<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountrySelector
{
    /**
     * Supported countries for localized marketing pricing.
     * key = ISO-3166 alpha-2 country code.
     */
    public static array $map = [
        'RW' => ['name' => 'Rwanda', 'currency_code' => 'RWF', 'currency_symbol' => 'RWF'],
        'TZ' => ['name' => 'Tanzania', 'currency_code' => 'TZS', 'currency_symbol' => 'TZS'],
        'UG' => ['name' => 'Uganda', 'currency_code' => 'UGX', 'currency_symbol' => 'UGX'],
        'KE' => ['name' => 'Kenya', 'currency_code' => 'KES', 'currency_symbol' => 'KES'],
        'BI' => ['name' => 'Burundi', 'currency_code' => 'BIF', 'currency_symbol' => 'BIF'],
        'US' => ['name' => 'United States', 'currency_code' => 'USD', 'currency_symbol' => '$'],
    ];

    public static function resolve(string $code): ?array
    {
        return self::$map[strtoupper($code)] ?? null;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $override = strtoupper((string) $request->query('country', ''));

        if ($override && isset(self::$map[$override])) {
            session(['selected_country_code' => $override]);
            cookie()->queue(cookie('hy_country', $override, 60 * 24 * 365, '/'));
        }

        $code = session('selected_country_code')
            ?? $request->cookie('hy_country')
            ?? $this->detect($request)
            ?? 'RW';

        $code = strtoupper($code);

        if (!isset(self::$map[$code])) {
            $code = 'RW';
        }

        session(['selected_country_code' => $code]);

        return $next($request);
    }

    protected function detect(Request $request): ?string
    {
        $header = $request->header('CF-IPCountry') ?: $request->header('X-Country');

        if ($header) {
            $header = strtoupper(trim($header));
            if (isset(self::$map[$header])) {
                return $header;
            }
        }

        return null;
    }
}
