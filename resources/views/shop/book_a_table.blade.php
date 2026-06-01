@extends('layouts.guest')

@section('content')

{{-- Book a Table Hero --}}
<section class="px-4 py-8 sm:py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('menu.bookTable')</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">@lang('messages.reserveYourTable')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sm:p-8">
        @livewire('shop.bookATable', ['restaurant' => $restaurant])
    </div>
</section>

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection