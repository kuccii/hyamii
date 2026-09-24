@extends('layouts.guest')

@section('hide-footer', true)

@php
    $availability = \App\Services\RestaurantAvailabilityService::getAvailability($restaurant, $shopBranch ?? null, null, 'order');
    $isOpen = $availability['is_open'] ?? true;
    $heroImage = $heroImageUrl ?? null;
@endphp

@section('content')

{{-- Restaurant Hero Header --}}
<section class="relative">
    {{-- Cover image or gradient fallback --}}
    <div class="relative h-44 sm:h-56 lg:h-64 overflow-hidden bg-gradient-to-br from-[rgb(var(--color-base))] via-[rgb(var(--color-base))]/90 to-[rgb(var(--color-base))]/70">
        @if($heroImage)
            <img src="{{ $heroImage }}"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="{{ $restaurant->name }}"
                 loading="eager" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/25 to-transparent"></div>
        @else
            <div class="absolute inset-0 opacity-20"
                 style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,.35) 0, transparent 40%), radial-gradient(circle at 75% 70%, rgba(255,255,255,.22) 0, transparent 45%);"></div>
        @endif

        {{-- Name + status over the cover --}}
        <div class="absolute bottom-0 left-0 right-0">
            <div class="container-lg px-4 pb-4">
                <div class="flex items-end gap-3">
                    <img src="{{ $restaurant->logoUrl }}"
                         class="h-16 w-16 sm:h-20 sm:w-20 rounded-2xl object-cover ring-4 ring-white dark:ring-gray-950 shadow-xl flex-shrink-0 -mb-2"
                         alt="{{ $restaurant->name }}" />
                    <div class="min-w-0 flex-1 pb-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-xl sm:text-2xl font-hanken font-extrabold text-white truncate drop-shadow-md">
                                {{ $restaurant->name }}
                            </h1>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide shadow-sm {{ $isOpen ? 'bg-emerald-500/95 text-white' : 'bg-red-500/95 text-white' }}">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isOpen ? 'bg-white opacity-75' : 'bg-white opacity-60' }}"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-white"></span>
                                </span>
                                {{ $isOpen ? __('app.open') : __('app.closed') }}
                            </span>
                        </div>
                        @if($restaurant->short_description)
                            <p class="text-sm text-white/85 mt-0.5 line-clamp-1 drop-shadow">{{ $restaurant->short_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info chips bar --}}
    <div class="bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-gray-800 shadow-[0_4px_16px_-8px_rgba(0,0,0,0.08)]">
        <div class="container-lg">
            <div class="flex flex-wrap items-center gap-2 px-4 py-3 text-xs">
                @if(isset($shopBranch) && $shopBranch->address)
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($shopBranch->address) }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <span class="material-symbols-outlined text-sm text-[rgb(var(--color-base))]">location_on</span>
                        <span class="truncate max-w-[200px]">{{ $shopBranch->address }}</span>
                    </a>
                @endif
                @if(isset($shopBranch) && $shopBranch->opening_time && $shopBranch->closing_time)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-full text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined text-sm text-[rgb(var(--color-base))]">schedule</span>
                        <span>{{ $shopBranch->opening_time }} - {{ $shopBranch->closing_time }}</span>
                    </span>
                @endif
                @if($restaurant->phone_number)
                    <a href="tel:{{ $restaurant->phone_number }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <span class="material-symbols-outlined text-sm text-[rgb(var(--color-base))]">call</span>
                        <span>{{ $restaurant->phone_number }}</span>
                    </a>
                @endif
                {{-- Currency chip --}}
                @if($restaurant->currency)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-full text-gray-600 dark:text-gray-300">
                        <span class="material-symbols-outlined text-sm text-[rgb(var(--color-base))]">payments</span>
                        <span>{{ $restaurant->currency->currency_code }}</span>
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Menu Section --}}
<section id="order-section" class="section !pt-2">
    <div class="container-lg">
        @livewire('shop.cart', [
            'tableID' => $tableHash ?? null,
            'restaurant' => $restaurant ?? null,
            'shopBranch' => $shopBranch ?? null,
            'getTable' => $getTable ?? false,
            'canCreateOrder' => $canCreateOrder,
        ])
    </div>
</section>

{{-- Footer with proper spacing --}}
<footer class="border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-950">
    <div class="container py-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2.5 min-w-0">
                <img src="{{ $restaurant->logoUrl }}"
                     class="h-7 w-7 rounded-lg object-cover flex-shrink-0"
                     alt="" />
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $restaurant->name }}
                    </p>
                    <p class="text-xs text-gray-400">
                        &copy; {{ now()->year }} @lang('app.allRightsReserved')
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1 flex-shrink-0">
                @if ($restaurant->facebook_link)
                    <a href="{{ $restaurant->facebook_link }}"
                       class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all"
                       aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                @endif
                @if ($restaurant->instagram_link)
                    <a href="{{ $restaurant->instagram_link }}"
                       class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all"
                       aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15.137.353.3.882.344 1.857.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                    </a>
                @endif
                @if ($restaurant->twitter_link)
                    <a href="{{ $restaurant->twitter_link }}"
                       class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all"
                       aria-label="Twitter">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection
