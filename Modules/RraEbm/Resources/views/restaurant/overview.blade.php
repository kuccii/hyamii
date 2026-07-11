<div>
    <div class="p-4 mx-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-xl font-semibold dark:text-white">RRA EBM Configuration</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage Rwanda Revenue Authority Electronic Billing Machine settings per branch</p>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $branches->count() }}</span>
                <h4 class="text-lg font-semibold dark:text-white">Branches</h4>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                <span class="text-sm text-green-600 dark:text-green-400">{{ $settings->where('enabled', true)->count() }}</span>
                <h4 class="text-lg font-semibold text-green-800 dark:text-green-300">Enabled</h4>
            </div>
            <div class="bg-skin-base/10 dark:bg-skin-base/20 rounded-lg p-4 border border-skin-base/30">
                <span class="text-sm text-skin-base">{{ $submissionStats?->sum(fn($s) => $s->count) ?? 0 }}</span>
                <h4 class="text-lg font-semibold text-skin-base">Submissions</h4>
            </div>
        </div>

        {{-- Branch Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Branch</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Status</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">TIN</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Initialized</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Submissions</th>
                        <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse($branches as $branch)
                        @php
                            $setting = $settings->get($branch->id);
                            $stats = $submissionStats?->get($branch->id);
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                            <td class="py-3 px-4 text-sm font-medium text-gray-900 dark:text-white">
                                {{ $branch->name }}
                            </td>
                            <td class="py-3 px-4">
                                @if($setting?->enabled)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400 rounded-full text-xs">Enabled</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded-full text-xs">Disabled</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm font-mono text-gray-600 dark:text-gray-400">
                                {{ $setting?->tin_number ?? '—' }}
                            </td>
                            <td class="py-3 px-4 text-sm">
                                @if($setting?->last_initialized_at)
                                    <span class="text-green-600 dark:text-green-400">
                                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        {{ $setting->last_initialized_at->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="text-yellow-600 dark:text-yellow-400">Not initialized</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">
                                @if($stats)
                                    <span class="font-semibold">{{ $stats->count }}</span>
                                    @if($stats->last_at)
                                        <span class="text-xs text-gray-400 ml-1">last {{ $stats->last_at->diffForHumans() }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right space-x-2">
                                <x-secondary-button wire:click="configure({{ $branch->id }})">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2z" clip-rule="evenodd"/></svg>
                                    {{ $setting ? 'Edit' : 'Configure' }}
                                </x-secondary-button>
                                @if($setting?->isInitialized())
                                    <x-secondary-button wire:click="initialize({{ $branch->id }})">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                        Refresh
                                    </x-secondary-button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-500 dark:text-gray-400">No branches configured</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Configure Modal --}}
    <x-right-modal wire:model.live="showConfigModal">
        <x-slot name="title">
            {{ $editingSetting ? 'Edit RRA EBM Configuration' : 'Add RRA EBM Configuration' }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit="save" class="space-y-4">
                @if(!$editingSetting)
                    <div class="p-3 bg-skin-base/5 dark:bg-skin-base/20 border border-skin-base/30 rounded-lg">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Selected branch: <strong>{{ \App\Models\Branch::find($branch_id)?->name ?? 'Unknown' }}</strong>
                        </p>
                    </div>
                @endif

                <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 p-4">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">General Settings</h4>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Enable RRA EBM</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="enabled" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-skin-base"></div>
                            <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ $enabled ? 'Enabled' : 'Disabled' }}</span>
                        </label>
                    </div>

                    @if($enabled)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-label value="TIN Number"/>
                            <x-input wire:model="tin_number" class="w-full" placeholder="RRA TIN"/>
                        </div>
                        <div>
                            <x-label value="Branch ID (RRA)"/>
                            <x-input wire:model="branch_id_rra" class="w-full" placeholder="Assigned by RRA"/>
                        </div>
                        <div class="sm:col-span-2">
                            <x-label value="Server URL"/>
                            <x-input wire:model="server_url" class="w-full" placeholder="https://ebm.rra.gov.rw/ebm"/>
                        </div>
                        <div>
                            <x-label value="App Name"/>
                            <x-input wire:model="app_name" class="w-full" placeholder="Registered app name"/>
                        </div>
                    </div>
                    @endif
                </div>

                @if($enabled && ($editingSetting || $tin_number))
                <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 p-4">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Device Identity</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <x-label value="Device Serial No"/>
                            <x-input wire:model="device_serial_no" class="w-full"/>
                        </div>
                        <div>
                            <x-label value="Machine Ref Code"/>
                            <x-input wire:model="machine_reference_code" class="w-full"/>
                        </div>
                        <div>
                            <x-label value="Security Key"/>
                            <input type="password" wire:model="security_key" autocomplete="new-password" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:border-skin-base focus:ring-skin-base"/>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 p-4">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Submission Settings</h4>

                    <div class="space-y-3">
                        <label class="flex items-center justify-between">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Auto-sync products</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="auto_sync_products" class="sr-only peer">
                                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-skin-base"></div>
                            </label>
                        </label>

                        <div class="border-t border-gray-100 dark:border-gray-700 pt-3 mt-3">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Submit on sale types:</span>
                            <div class="mt-2 grid grid-cols-3 gap-3">
                                @foreach([
                                    'submit_on_pos_complete' => 'POS / Dine-in',
                                    'submit_on_online_order' => 'Online / Delivery',
                                    'submit_on_kiosk' => 'Kiosk',
                                ] as $field => $label)
                                    <label class="relative flex flex-col items-center p-2 border-2 rounded-lg cursor-pointer transition-all duration-150 hover:shadow-sm"
                                        @class([
                                            'border-skin-base bg-skin-base/10' => $this->$field,
                                            'border-gray-200 dark:border-gray-600' => !$this->$field,
                                        ])>
                                        <span class="text-xs font-medium mb-1">{{ $label }}</span>
                                        <input type="checkbox" wire:model="{{ $field }}" class="sr-only peer">
                                        <div wire:click="$toggle('{{ $field }}')" class="w-8 h-4 bg-gray-200 rounded-full peer-checked:bg-skin-base"></div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                    <x-secondary-button wire:click="closeConfig" class="mr-3">Cancel</x-secondary-button>
                    <x-button wire:click="save" wire:loading.attr="disabled">Save Configuration</x-button>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeConfig" wire:loading.attr="disabled">Close</x-secondary-button>
            @if($editingSetting?->isInitialized())
                <x-button wire:click="initialize({{ $editingSetting?->branch_id }})" class="ml-2">Re-initialize</x-button>
            @endif
        </x-slot>
    </x-right-modal>
</div>