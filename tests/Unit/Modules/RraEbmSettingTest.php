<?php

namespace Tests\Unit\Modules;

use Modules\RraEbm\Entities\RraEbmSetting;
use Tests\TestCase;

class RraEbmSettingTest extends TestCase
{
    public function test_is_initialized_returns_true_when_all_fields_present(): void
    {
        $setting = new RraEbmSetting([
            'last_initialized_at' => now(),
            'tin_number' => '123456789',
            'branch_id_rra' => 'BR01',
            'server_url' => 'http://192.168.1.100:8080',
        ]);

        $this->assertTrue($setting->isInitialized());
    }

    public function test_is_initialized_returns_false_when_missing_tin(): void
    {
        $setting = new RraEbmSetting([
            'last_initialized_at' => now(),
            'tin_number' => '',
            'branch_id_rra' => 'BR01',
            'server_url' => 'http://192.168.1.100:8080',
        ]);

        $this->assertFalse($setting->isInitialized());
    }

    public function test_is_initialized_returns_false_when_not_initialized(): void
    {
        $setting = new RraEbmSetting([
            'last_initialized_at' => null,
            'tin_number' => '123456789',
            'branch_id_rra' => 'BR01',
            'server_url' => 'http://192.168.1.100:8080',
        ]);

        $this->assertFalse($setting->isInitialized());
    }

    public function test_disabled_setting_does_not_submit_for_any_type(): void
    {
        $setting = new RraEbmSetting(['enabled' => false]);

        $this->assertFalse($setting->shouldSubmitFor('pos'));
        $this->assertFalse($setting->shouldSubmitFor('shop'));
        $this->assertFalse($setting->shouldSubmitFor('kiosk'));
        $this->assertFalse($setting->shouldSubmitFor(null));
    }

    public function test_should_submit_for_pos_when_enabled(): void
    {
        $setting = new RraEbmSetting([
            'enabled' => true,
            'submit_on_pos_complete' => true,
            'submit_on_online_order' => false,
            'submit_on_kiosk' => false,
        ]);

        $this->assertTrue($setting->shouldSubmitFor('pos'));
        $this->assertFalse($setting->shouldSubmitFor('shop'));
        $this->assertFalse($setting->shouldSubmitFor('kiosk'));
    }

    public function test_should_submit_for_online_order(): void
    {
        $setting = new RraEbmSetting([
            'enabled' => true,
            'submit_on_pos_complete' => false,
            'submit_on_online_order' => true,
            'submit_on_kiosk' => false,
        ]);

        $this->assertTrue($setting->shouldSubmitFor('shop'));
        $this->assertTrue($setting->shouldSubmitFor('delivery'));
        $this->assertTrue($setting->shouldSubmitFor('pickup'));
        $this->assertFalse($setting->shouldSubmitFor('pos'));
    }

    public function test_should_submit_for_kiosk(): void
    {
        $setting = new RraEbmSetting([
            'enabled' => true,
            'submit_on_pos_complete' => false,
            'submit_on_online_order' => false,
            'submit_on_kiosk' => true,
        ]);

        $this->assertTrue($setting->shouldSubmitFor('kiosk'));
        $this->assertFalse($setting->shouldSubmitFor('pos'));
    }
}
