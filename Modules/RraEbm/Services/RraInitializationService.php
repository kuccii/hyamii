<?php

namespace Modules\RraEbm\Services;

use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraInitializationService
{
    public function __construct(
        protected RraEbmService $ebmService
    ) {}

    public function initialize(RraEbmSetting $setting): bool
    {
        if (!$setting->tin_number || !$setting->branch_id_rra) {
            throw new \InvalidArgumentException('TIN number and branch ID are required for initialization');
        }

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
        ];

        if ($setting->isOsdc()) {
            // OSDC: cloud-signed, uses cmcKey (communication key from RRA)
            $payload['cmcKey'] = $setting->cmc_key ?? '';
            $endpoint = $this->ebmService->resolveEndpoint(RraEbmSetting::MODE_OSDC, 'initialization');
        } else {
            // Physical EBM: hardware device, uses dvcSrlNo (device serial number)
            $payload['dvcSrlNo'] = $setting->device_serial_no ?? '';
            $endpoint = $this->ebmService->resolveEndpoint(RraEbmSetting::MODE_PHYSICAL_EBM, 'initialization');
        }

        $response = $this->ebmService->post($setting, $endpoint, $payload);

        if ($this->ebmService->isSuccessful($response)) {
            $setting->update(['last_initialized_at' => now()]);
            Log::info('RRA EBM initialization successful', [
                'branch_id' => $setting->branch_id,
                'tin' => $setting->tin_number,
                'mode' => $setting->mode,
            ]);
            return true;
        }

        $error = $this->ebmService->getErrorMessage($response);
        Log::error('RRA EBM initialization failed', [
            'branch_id' => $setting->branch_id,
            'mode' => $setting->mode,
            'error' => $error,
        ]);

        throw new \RuntimeException("RRA initialization failed: {$error}");
    }
}
