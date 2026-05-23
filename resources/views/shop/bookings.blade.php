@extends('layouts.guest')

@section('content')

{{-- Bookings Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-4">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            @lang('menu.myBookings')
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">@lang('menu.myBookings')</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.viewYourReservations')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-6xl mx-auto">
    <livewire:shop.bookings :$restaurant />
</section>

@endsection