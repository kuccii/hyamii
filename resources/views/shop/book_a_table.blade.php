@extends('layouts.guest')

@section('content')

{{-- Book a Table Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-4">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            @lang('menu.bookTable')
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">@lang('menu.bookTable')</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.reserveYourTable')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-8">
        @livewire('shop.bookATable', ['restaurant' => $restaurant])
    </div>
</section>

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection