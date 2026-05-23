@extends('layouts.guest')

@section('content')

{{-- Orders Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-4">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
            @lang('modules.order.myOrders')
        </span>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">@lang('modules.order.myOrders')</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.viewOrderHistory')</p>
    </div>
</section>

<section class="px-4 py-8 sm:py-12 max-w-6xl mx-auto">
    @livewire('shop.orders', ['restaurant' => $restaurant])
</section>

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection