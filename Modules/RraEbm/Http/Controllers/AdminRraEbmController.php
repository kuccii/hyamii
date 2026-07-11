<?php

namespace Modules\RraEbm\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraEbmService;
use Modules\RraEbm\Services\RraInitializationService;

class AdminRraEbmController extends Controller
{
    public function __construct(
        protected RraInitializationService $initializationService
    ) {}

    public function index()
    {
        $settings = RraEbmSetting::with('branch.restaurant')->get();

        return view('rraebm::settings.index', compact('settings'));
    }

    public function create(?Branch $branch = null)
    {
        $branches = Branch::with('restaurant')->get();
        $selectedBranchId = $branch?->id ?? 0;

        return view('rraebm::settings.create', compact('branches', 'selectedBranchId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'enabled' => 'boolean',
            'tin_number' => 'nullable|string|max:20',
            'branch_id_rra' => 'nullable|string|max:20',
            'server_url' => ['nullable', 'string', 'max:255', function ($attribute, $value, $fail) {
                if ($value && !app(RraEbmService::class)->validateServerUrl($value)) {
                    $fail('The server URL must point to a valid RRA EBM server (no localhost, private IPs, or link-local addresses).');
                }
            }],
            'app_name' => 'nullable|string|max:255',
            'device_serial_no' => 'nullable|string|max:255',
            'machine_reference_code' => 'nullable|string|max:255',
            'security_key' => 'nullable|string|max:255',
            'auto_sync_products' => 'boolean',
            'submit_on_pos_complete' => 'boolean',
            'submit_on_online_order' => 'boolean',
            'submit_on_kiosk' => 'boolean',
        ]);

        $validated['enabled'] = $request->boolean('enabled', false);
        $validated['auto_sync_products'] = $request->boolean('auto_sync_products', true);
        $validated['submit_on_pos_complete'] = $request->boolean('submit_on_pos_complete', true);
        $validated['submit_on_online_order'] = $request->boolean('submit_on_online_order', false);
        $validated['submit_on_kiosk'] = $request->boolean('submit_on_kiosk', false);

        RraEbmSetting::create($validated);

        return redirect()->route('superadmin.rra-ebm.index')
            ->with('success', 'RRA EBM settings created successfully.');
    }

    public function edit(RraEbmSetting $setting)
    {
        $branches = Branch::with('restaurant')->get();

        return view('rraebm::settings.edit', compact('setting', 'branches'));
    }

    public function update(Request $request, RraEbmSetting $setting)
    {
        $validated = $request->validate([
            'enabled' => 'boolean',
            'tin_number' => 'nullable|string|max:20',
            'branch_id_rra' => 'nullable|string|max:20',
            'server_url' => ['nullable', 'string', 'max:255', function ($attribute, $value, $fail) {
                if ($value && !app(RraEbmService::class)->validateServerUrl($value)) {
                    $fail('The server URL must point to a valid RRA EBM server (no localhost, private IPs, or link-local addresses).');
                }
            }],
            'app_name' => 'nullable|string|max:255',
            'device_serial_no' => 'nullable|string|max:255',
            'machine_reference_code' => 'nullable|string|max:255',
            'security_key' => 'nullable|string|max:255',
            'auto_sync_products' => 'boolean',
            'submit_on_pos_complete' => 'boolean',
            'submit_on_online_order' => 'boolean',
            'submit_on_kiosk' => 'boolean',
        ]);

        $validated['enabled'] = $request->boolean('enabled', false);
        $validated['auto_sync_products'] = $request->boolean('auto_sync_products', true);
        $validated['submit_on_pos_complete'] = $request->boolean('submit_on_pos_complete', true);
        $validated['submit_on_online_order'] = $request->boolean('submit_on_online_order', false);
        $validated['submit_on_kiosk'] = $request->boolean('submit_on_kiosk', false);

        if (empty($validated['security_key'])) {
            unset($validated['security_key']);
        }

        $setting->update($validated);

        return redirect()->route('superadmin.rra-ebm.index')
            ->with('success', 'RRA EBM settings updated successfully.');
    }

    public function destroy(RraEbmSetting $setting)
    {
        $setting->delete();

        return redirect()->route('superadmin.rra-ebm.index')
            ->with('success', 'RRA EBM settings deleted successfully.');
    }

    public function initialize(Request $request, RraEbmSetting $setting)
    {
        try {
            $this->initializationService->initialize($setting);

            return redirect()->route('superadmin.rra-ebm.edit', $setting)
                ->with('success', 'RRA EBM initialization successful.');
        } catch (\Exception $e) {
            Log::error('RRA EBM initialization error', [
                'setting_id' => $setting->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('superadmin.rra-ebm.edit', $setting)
                ->with('error', 'RRA initialization failed: ' . $e->getMessage());
        }
    }
}
