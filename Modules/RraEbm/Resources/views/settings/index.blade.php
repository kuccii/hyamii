@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">RRA EBM Settings</h1>
        <a href="{{ route('superadmin.rra-ebm.create') }}" class="px-4 py-2 bg-skin-base text-white rounded-md hover:bg-skin-base/[.8] text-sm">+ Add Configuration</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Branch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restaurant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TIN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Initialized</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($settings as $setting)
                    <tr>
                        <td class="px-6 py-4">{{ $setting->branch?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $setting->branch?->restaurant?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if($setting->enabled)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Enabled</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Disabled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-sm">{{ $setting->tin_number ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($setting->last_initialized_at)
                                <span class="text-green-600">Yes</span>
                            @else
                                <span class="text-red-500">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('superadmin.rra-ebm.edit', $setting) }}" class="text-skin-secondary hover:text-skin-secondary/[.8] mr-3">Edit</a>
                            <form action="{{ route('superadmin.rra-ebm.destroy', $setting) }}" method="POST" class="inline" onsubmit="return confirm('Delete this RRA EBM configuration?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No RRA EBM settings configured yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
