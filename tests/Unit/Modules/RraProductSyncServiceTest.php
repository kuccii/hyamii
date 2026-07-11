<?php

namespace Tests\Unit\Modules;

use Illuminate\Support\Facades\Http;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraEbmService;
use Modules\RraEbm\Services\RraProductSyncService;
use Tests\TestCase;

class RraProductSyncServiceTest extends TestCase
{
    private RraProductSyncService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new RraProductSyncService(new RraEbmService());
    }

    public function test_resolve_tax_code_for_zero_percent(): void
    {
        $this->assertEquals('A', $this->service->resolveTaxCode(0));
    }

    public function test_resolve_tax_code_for_eighteen_percent(): void
    {
        $this->assertEquals('B', $this->service->resolveTaxCode(18));
    }

    public function test_resolve_tax_code_defaults_to_a(): void
    {
        $this->assertEquals('A', $this->service->resolveTaxCode(5));
    }

    public function test_generate_item_code(): void
    {
        $setting = new RraEbmSetting();
        $code = $this->service->generateItemCode($setting, ['id' => 42, 'name' => 'Brochettes']);

        $this->assertEquals('RWSWEAEA0000042', $code);
    }

    public function test_sync_product_returns_false_when_not_initialized(): void
    {
        $setting = new RraEbmSetting(['enabled' => true, 'last_initialized_at' => null]);

        $result = $this->service->syncProduct($setting, [
            'name' => 'Test Item',
            'price' => 1000,
            'tax_percent' => 18,
        ]);

        $this->assertFalse($result);
    }

    public function test_sync_product_successful(): void
    {
        Http::fake([
            '*' => Http::response(['resultCd' => '000', 'resultMsg' => 'Success'], 200),
        ]);

        $setting = new RraEbmSetting([
            'enabled' => true,
            'tin_number' => '123456789',
            'branch_id_rra' => 'BR01',
            'server_url' => 'http://test.com',
            'app_name' => 'app',
            'last_initialized_at' => now(),
        ]);

        $result = $this->service->syncProduct($setting, [
            'name' => 'Brochettes',
            'price' => 5000,
            'tax_percent' => 0,
        ]);

        $this->assertTrue($result);
    }

    public function test_sync_product_failure(): void
    {
        Http::fake([
            '*' => Http::response(['resultCd' => '999', 'resultMsg' => 'Invalid item'], 200),
        ]);

        $setting = new RraEbmSetting([
            'enabled' => true,
            'tin_number' => '123456789',
            'branch_id_rra' => 'BR01',
            'server_url' => 'http://test.com',
            'app_name' => 'app',
            'last_initialized_at' => now(),
        ]);

        $result = $this->service->syncProduct($setting, [
            'name' => 'Bad Item',
            'price' => 1000,
            'tax_percent' => 18,
        ]);

        $this->assertFalse($result);
    }
}
