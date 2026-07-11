<?php

namespace Modules\RraEbm\Livewire\Restaurant;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraInitializationService;
use App\Models\Branch;
use App\Models\Order;

#[Layout('layouts.app')]
class RraEbm extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshRraEbm' => 'mount'];

    public $branches;
    public $settings;
    public $submissionStats;
    public $editingSetting;
    public $showConfigModal = false;
    public $activeTab = 'overview';

    public $branch_id;
    public $enabled = false;
    public $tin_number;
    public $branch_id_rra;
    public $server_url;
    public $app_name;
    public $device_serial_no;
    public $machine_reference_code;
    public $security_key;
    public $auto_sync_products = true;
    public $submit_on_pos_complete = true;
    public $submit_on_online_order = false;
    public $submit_on_kiosk = false;

    public function mount()
    {
        $this->branches = Branch::get();
        $this->loadSettings();
    }

    private function loadSettings(): void
    {
        $this->settings = RraEbmSetting::with('branch')->get()->keyBy('branch_id');

        try {
            $this->submissionStats = Order::where('rra_ebm_submitted', true)
                ->selectRaw('branch_id, COUNT(*) as count, MAX(rra_ebm_submitted_at) as last_at')
                ->groupBy('branch_id')
                ->get()
                ->keyBy('branch_id');
        } catch (\Exception $e) {
            $this->submissionStats = collect();
        }
    }

    public function configure($branchId)
    {
        $existing = $this->settings->get($branchId);

        if ($existing) {
            $this->editingSetting = $existing;
            $this->branch_id = $existing->branch_id;
            $this->enabled = $existing->enabled;
            $this->tin_number = $existing->tin_number;
            $this->branch_id_rra = $existing->branch_id_rra;
            $this->server_url = $existing->server_url;
            $this->app_name = $existing->app_name;
            $this->device_serial_no = $existing->device_serial_no;
            $this->machine_reference_code = $existing->machine_reference_code;
            $this->security_key = $existing->security_key;
            $this->auto_sync_products = $existing->auto_sync_products;
            $this->submit_on_pos_complete = $existing->submit_on_pos_complete;
            $this->submit_on_online_order = $existing->submit_on_online_order;
            $this->submit_on_kiosk = $existing->submit_on_kiosk;
        } else {
            $this->editingSetting = null;
            $this->resetConfigFields();
            $this->branch_id = $branchId;
        }

        $this->showConfigModal = true;
    }

    private function resetConfigFields(): void
    {
        $this->enabled = false;
        $this->tin_number = null;
        $this->branch_id_rra = null;
        $this->server_url = null;
        $this->app_name = null;
        $this->device_serial_no = null;
        $this->machine_reference_code = null;
        $this->security_key = null;
        $this->auto_sync_products = true;
        $this->submit_on_pos_complete = true;
        $this->submit_on_online_order = false;
        $this->submit_on_kiosk = false;
    }

    public function save()
    {
        $data = [
            'branch_id' => $this->branch_id,
            'enabled' => $this->enabled,
            'tin_number' => $this->tin_number,
            'branch_id_rra' => $this->branch_id_rra,
            'server_url' => $this->server_url,
            'app_name' => $this->app_name,
            'device_serial_no' => $this->device_serial_no,
            'machine_reference_code' => $this->machine_reference_code,
            'security_key' => $this->security_key,
            'auto_sync_products' => $this->auto_sync_products,
            'submit_on_pos_complete' => $this->submit_on_pos_complete,
            'submit_on_online_order' => $this->submit_on_online_order,
            'submit_on_kiosk' => $this->submit_on_kiosk,
        ];

        if ($this->editingSetting) {
            $this->editingSetting->update($data);
        } else {
            $this->editingSetting = RraEbmSetting::create($data);
        }

        $this->showConfigModal = false;
        $this->loadSettings();
        $this->dispatch('refreshRraEbm');

        $this->alert('success', __('messages.saved'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
        ]);
    }

    public function initialize($branchId)
    {
        $setting = RraEbmSetting::where('branch_id', $branchId)->first();

        if (!$setting) {
            $this->alert('error', 'RRA EBM settings not found for this branch.', ['toast' => true, 'position' => 'top-end']);
            return;
        }

        try {
            app(RraInitializationService::class)->initialize($setting);
            $this->loadSettings();

            $this->alert('success', 'RRA EBM initialized successfully.', ['toast' => true, 'position' => 'top-end']);
        } catch (\Exception $e) {
            $this->alert('error', 'Initialization failed: ' . $e->getMessage(), ['toast' => true, 'position' => 'top-end']);
        }
    }

    public function closeConfig()
    {
        $this->showConfigModal = false;
    }

    public function render()
    {
        return view('rraebm::restaurant.overview');
    }
}