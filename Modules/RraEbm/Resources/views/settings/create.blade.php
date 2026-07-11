@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Create RRA EBM Settings</h1>
        <p class="text-gray-600">Configure RRA EBM integration for a branch</p>
    </div>

    <form action="{{ route('superadmin.rra-ebm.store') }}" method="POST" class="max-w-2xl">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                <select name="branch_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ (old('branch_id') == $branch->id || ($selectedBranchId > 0 && $selectedBranchId == $branch->id)) ? 'selected' : '' }}>
                            {{ $branch->restaurant?->name ?? 'N/A' }} - {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="enabled" id="enabled" value="1" {{ old('enabled') ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                <label for="enabled" class="ml-2 text-sm font-medium text-gray-700">Enable RRA EBM Integration</label>
            </div>

            <fieldset class="border border-gray-200 rounded-lg p-4">
                <legend class="text-sm font-medium text-gray-700 px-2">RRA Connection Details</legend>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TIN Number</label>
                        <input type="text" name="tin_number" value="{{ old('tin_number') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Branch ID (RRA)</label>
                        <input type="text" name="branch_id_rra" value="{{ old('branch_id_rra') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Server URL</label>
                        <input type="text" name="server_url" value="{{ old('server_url') }}" placeholder="http://192.168.1.100:8080" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">App Name</label>
                        <input type="text" name="app_name" value="{{ old('app_name') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Device Serial No</label>
                        <input type="text" name="device_serial_no" value="{{ old('device_serial_no') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Machine Reference Code</label>
                        <input type="text" name="machine_reference_code" value="{{ old('machine_reference_code') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Security Key</label>
                        <input type="password" name="security_key" value="{{ old('security_key') }}" autocomplete="new-password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-skin-base focus:ring-skin-base">
                    </div>
                </div>
            </fieldset>

            <fieldset class="border border-gray-200 rounded-lg p-4">
                <legend class="text-sm font-medium text-gray-700 px-2">Submission Triggers</legend>

                <div class="space-y-3 mt-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_pos_complete" id="submit_on_pos_complete" value="1" {{ old('submit_on_pos_complete', '1') ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                        <label for="submit_on_pos_complete" class="ml-2 text-sm text-gray-700">Submit on POS order completion</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_online_order" id="submit_on_online_order" value="1" {{ old('submit_on_online_order') ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                        <label for="submit_on_online_order" class="ml-2 text-sm text-gray-700">Submit on online orders</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="submit_on_kiosk" id="submit_on_kiosk" value="1" {{ old('submit_on_kiosk') ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                        <label for="submit_on_kiosk" class="ml-2 text-sm text-gray-700">Submit on Kiosk orders</label>
                    </div>
                </div>
            </fieldset>

            <div class="flex items-center">
                <input type="checkbox" name="auto_sync_products" id="auto_sync_products" value="1" {{ old('auto_sync_products', '1') ? 'checked' : '' }} class="rounded border-gray-300 text-skin-secondary shadow-sm focus:border-skin-base focus:ring-skin-base">
                <label for="auto_sync_products" class="ml-2 text-sm font-medium text-gray-700">Auto-sync menu items to RRA</label>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('superadmin.rra-ebm.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 mr-3">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-skin-base text-white rounded-md hover:bg-skin-base/[.8]">Save Settings</button>
        </div>
    </form>
</div>
@endsection
