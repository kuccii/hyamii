@extends('layouts.guest')

@section('content')

{{-- Profile Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-4">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            @lang('menu.profile')
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">@lang('menu.profile')</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.manageYourProfile')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-8">
        @livewire('updateProfile')
    </div>
</section>

@endsection