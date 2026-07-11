@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit RRA EBM Settings</h1>
        <p class="text-gray-600">{{ $setting->branch?->restaurant?->name ?? 'N/A' }} - {{ $setting->branch?->name ?? 'N/A' }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('superadmin.rra-ebm.update', $setting) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="enabled" id="enabled" value="1" {{ $setting->enabled ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                    <label for="enabled" class="ml-2 text-sm font-medium text-gray-700">Enable RRA EBM Integration</label>
                </div>

                @if($setting->isInitialized())
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Initialized {{ $setting->last_initialized_at?->diffForHumans() }}</span>
                @else
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Not Initialized</span>
                @endif
            </div>

            <fieldset class="border border-gray-200 rounded-lg p-4">
                <legend class="text-sm font-medium text-gray-700 px-2">RRA Connection Details</legend>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TIN Number</label>
                        <input type="text" name="tin_number" value="{{ old('tin_number', $setting->tin_number) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Branch ID (RRA)</label>
                        <input type="text" name="branch_id_rra" value="{{ old('branch_id_rra', $setting->branch_id_rra) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Server URL</label>
                        <input type="text" name="server_url" value="{{ old('server_url', $setting->server_url) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">App Name</label>
                        <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Device Serial No</label>
                        <input type="text" name="device_serial_no" value="{{ old('device_serial_no', $setting->device_serial_no) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Machine Reference Code</label>
                        <input type="text" name="machine_reference_code" value="{{ old('machine_reference_code', $setting->machine_reference_code) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Security Key</label>
                        <input type="text" name="security_key" value="{{ old('security_key', $setting->security_key) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                </div>
            </fieldset>

            <fieldset class="border border-gray-200 rounded-lg p-4">
                <legend class="text-sm font-medium text-gray-700 px-2">Submission Triggers</legend>

                <div class="space-y-3 mt-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_pos_complete" id="submit_on_pos_complete" value="1" {{ $setting->submit_on_pos_complete ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm">
                        <label for="submit_on_pos_complete" class="ml-2 text-sm text-gray-700">Submit on POS order completion</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_online_order" id="submit_on_online_order" value="1" {{ $setting->submit_on_online_order ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm">
                        <label for="submit_on_online_order" class="ml-2 text-sm text-gray-700">Submit on online orders</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_kiosk" id="submit_on_kiosk" value="1" {{ $setting->submit_on_kiosk ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm">
                        <label for="submit_on_kiosk" class="ml-2 text-sm text-gray-700">Submit on Kiosk orders</label>
                    </div>
                </div>
            </fieldset>

            <div class="flex items-center">
                <input type="checkbox" name="auto_sync_products" id="auto_sync_products" value="1" {{ $setting->auto_sync_products ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm">
                <label for="auto_sync_products" class="ml-2 text-sm font-medium text-gray-700">Auto-sync menu items to RRA</label>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <div>
                @if($setting->tin_number && $setting->branch_id_rra && $setting->server_url)
                    <form action="{{ route('superadmin.rra-ebm.initialize', $setting) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Initialize with RRA</button>
                    </form>
                @endif
            </div>
            <div>
                <a href="{{ route('superadmin.rra-ebm.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 mr-3">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-skin-base text-white rounded-md hover:bg-skin-base/[.8]">Update Settings</button>
            </div>
        </div>
    </form>
</div>
@endsection
