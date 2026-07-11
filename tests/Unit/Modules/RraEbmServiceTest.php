<?php

namespace Tests\Unit\Modules;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraEbmService;
use Tests\TestCase;

class RraEbmServiceTest extends TestCase
{
    private RraEbmService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new RraEbmService();
    }

    public function test_build_url_with_full_url(): void
    {
        $url = $this->service->buildUrl('http://192.168.1.100:8080', 'app', 'endpoint/test');
        $this->assertEquals('http://192.168.1.100:8080/app/endpoint/test', $url);
    }

    public function test_build_url_with_ip_only(): void
    {
        $url = $this->service->buildUrl('192.168.1.100:8080', 'app', 'endpoint');
        $this->assertEquals('http://192.168.1.100:8080/app/endpoint', $url);
    }

    public function test_build_url_with_empty_endpoint(): void
    {
        $url = $this->service->buildUrl('http://192.168.1.100:8080', 'app', '');
        $this->assertEquals('http://192.168.1.100:8080/app', $url);
    }

    public function test_is_successful_returns_true_for_valid_response(): void
    {
        Http::fake([
            '*' => Http::response(['resultCd' => '000', 'resultMsg' => 'Success'], 200),
        ]);

        $setting = new RraEbmSetting(['server_url' => 'http://test.com', 'app_name' => 'app']);
        $response = $this->service->post($setting, 'test', []);

        $this->assertTrue($this->service->isSuccessful($response));
    }

    public function test_is_successful_returns_false_for_error_code(): void
    {
        Http::fake([
            '*' => Http::response(['resultCd' => '999', 'resultMsg' => 'Error'], 200),
        ]);

        $setting = new RraEbmSetting(['server_url' => 'http://test.com', 'app_name' => 'app']);
        $response = $this->service->post($setting, 'test', []);

        $this->assertFalse($this->service->isSuccessful($response));
    }

    public function test_is_successful_returns_false_for_http_error(): void
    {
        Http::fake([
            '*' => Http::response('Server Error', 500),
        ]);

        $setting = new RraEbmSetting(['server_url' => 'http://test.com', 'app_name' => 'app']);
        $response = $this->service->post($setting, 'test', []);

        $this->assertFalse($this->service->isSuccessful($response));
    }

    public function test_get_error_message_from_http_error(): void
    {
        Http::fake([
            '*' => Http::response('Not Found', 404),
        ]);

        $setting = new RraEbmSetting(['server_url' => 'http://test.com', 'app_name' => 'app']);
        $response = $this->service->post($setting, 'test', []);

        $this->assertStringContainsString('404', $this->service->getErrorMessage($response));
    }

    public function test_get_error_message_from_api_error(): void
    {
        Http::fake([
            '*' => Http::response(['resultCd' => '999', 'resultMsg' => 'Invalid TIN'], 200),
        ]);

        $setting = new RraEbmSetting(['server_url' => 'http://test.com', 'app_name' => 'app']);
        $response = $this->service->post($setting, 'test', []);

        $this->assertEquals('Invalid TIN', $this->service->getErrorMessage($response));
    }
}
