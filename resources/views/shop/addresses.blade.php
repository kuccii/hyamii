@extends('layouts.guest')

@section('content')

{{-- Addresses Header --}}
<section class="px-4 py-8 sm:py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('menu.myAddresses')</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">@lang('messages.manageYourAddresses')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-6xl mx-auto">
    @livewire('shop.addresses', ["shopBranch" => $shopBranch])
</section>

@endsection