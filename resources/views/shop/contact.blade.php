@extends('layouts.guest')

@section('content')

{{-- Contact Header --}}
<section class="px-4 py-8 sm:py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('landing.contactTitle')</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">@lang('messages.getInTouch')</p>
    </div>
</section>

{{-- Content --}}
<div class="px-4 py-12 sm:py-16 space-y-10 max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Left: Contact Info + Hours --}}
        <div class="lg:col-span-2 space-y-8 reveal">
            {{-- Contact Cards --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-800">
                <div class="space-y-8">
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2.5 rounded-xl" style="background-color: rgba({{ $restaurant->theme_rgb }}, 0.1)">
                                    <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.emailTitle')</h3>
                            </div>
                            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors block" href="mailto:{{ $restaurant->email }}">{{ $restaurant->email }}</a>
                        </div>
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2.5 rounded-xl" style="background-color: rgba({{ $restaurant->theme_rgb }}, 0.1)">
                                    <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.callTitle')</h3>
                            </div>
                            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors block" href="tel:{{ $restaurant->phone_number }}">{{ $restaurant->phone_number }}</a>
                        </div>
                    </div>
                    <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2.5 rounded-xl" style="background-color: rgba({{ $restaurant->theme_rgb }}, 0.1)">
                                <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.addressTitle')</h3>
                        </div>
                        <address class="text-sm text-gray-600 dark:text-gray-400 not-italic leading-relaxed">
                            {!! nl2br(e($shopBranch->address ?? $restaurant->address)) !!}
                        </address>
                    </div>
                </div>
            </div>

            {{-- Operating Hours --}}
            @if(isset($shopBranch) && $shopBranch->opening_time && $shopBranch->closing_time)
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-800">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 rounded-xl" style="background-color: rgba({{ $restaurant->theme_rgb }}, 0.1)">
                            <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">@lang('modules.settings.openingHours')</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $shopBranch->name ?? $restaurant->name }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">@lang('app.open')</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $shopBranch->opening_time }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">@lang('app.close')</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $shopBranch->closing_time }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Right: Map + Quick Actions --}}
        <div class="space-y-8">
            @if(isset($shopBranch) && $shopBranch->lat && $shopBranch->lng)
                @php $mapId = 'shop_map_'.uniqid(); @endphp
                <div class="bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800">
                    <div class="flex items-center justify-between px-5 py-4">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">@lang('landing.mapTitle')</h4>
                        </div>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $shopBranch->lat }},{{ $shopBranch->lng }}" target="_blank"
                            class="text-xs font-medium hover:underline" style="color: rgb({{ $restaurant->theme_rgb }})">@lang('landing.openInGoogleMaps')</a>
                    </div>
                    <div id="{{ $mapId }}" style="height:280px; width:100%;"></div>
                    <div class="px-5 py-3 bg-gray-50 dark:bg-gray-800/50 text-xs text-gray-500 dark:text-gray-400">
                        {{ $shopBranch->name ?? '' }} &middot; {{ $shopBranch->address ?? $restaurant->address }}
                    </div>
                </div>

                <script>
                    (function(){
                        var lat = parseFloat({{ $shopBranch->lat }});
                        var lng = parseFloat({{ $shopBranch->lng }});
                        var mapId = '{{ $mapId }}';
                        var zoom = 15;
                        var iframe = document.createElement('iframe');
                        iframe.width = '100%';
                        iframe.height = '280';
                        iframe.frameBorder = '0';
                        iframe.style.border = '0';
                        iframe.src = 'https://maps.google.com/maps?q=' + lat + ',' + lng + '&z=' + zoom + '&output=embed';
                        var container = document.getElementById(mapId);
                        if (container) { container.innerHTML = ''; container.appendChild(iframe); }
                    })();
                </script>
            @endif

            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-800 text-center">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-3">@lang('messages.quickLinks')</h3>
                <div class="space-y-3">
                    @if ($restaurant->allow_customer_orders)
                        <a href="{{ route('shop_restaurant', [$restaurant->hash]) }}" wire:navigate
                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl text-sm font-medium hover:opacity-90 transition-all shadow-sm"
                            style="background-color: rgb({{ $restaurant->theme_rgb }}); color: white;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            @lang('menu.newOrder')
                        </a>
                    @endif
                    @if (in_array('Table Reservation', $modules ?? []))
                        <a href="{{ route('book_a_table', [$restaurant->hash]) }}" wire:navigate
                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl text-sm font-medium bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            @lang('menu.bookTable')
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Social Proof --}}
    <div class="rounded-2xl p-8 sm:p-10 text-center reveal"
         style="background: linear-gradient(135deg, rgba({{ $restaurant->theme_rgb }}, 0.05), rgba({{ $restaurant->theme_rgb }}, 0.02)); border: 1px solid rgba({{ $restaurant->theme_rgb }}, 0.1);">
        <div class="flex justify-center gap-4 mb-5">
            @if ($restaurant->facebook_link)
                <a href="{{ $restaurant->facebook_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:shadow-md transition-all" aria-label="Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
            @endif
            @if ($restaurant->instagram_link)
                <a href="{{ $restaurant->instagram_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:shadow-md transition-all" aria-label="Instagram">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                </a>
            @endif
            @if ($restaurant->twitter_link)
                <a href="{{ $restaurant->twitter_link }}" target="_blank" class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:shadow-md transition-all" aria-label="Twitter">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
            @endif
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">@lang('messages.followUs')</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@lang('messages.stayConnected')</p>
    </div>
</div>

@endsection