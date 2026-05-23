@extends('layouts.guest')

@section('content')

{{-- Addresses Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-4">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            @lang('menu.myAddresses')
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">@lang('menu.myAddresses')</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.manageYourAddresses')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-6xl mx-auto">
    @livewire('shop.addresses', ["shopBranch" => $shopBranch])
</section>

@endsection