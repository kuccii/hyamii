@extends('layouts.guest')

@section('content')

{{-- About Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-950 dark:to-gray-900{{ $heroImageUrl ? ' hero-cover' : '' }}" @if($heroImageUrl) style="background-image: url('{{ $heroImageUrl }}')" @endif>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-20 sm:py-28 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-800 rounded-full text-xs font-medium text-gray-600 dark:text-gray-400 mb-5">
            <svg class="w-3.5 h-3.5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @lang('modules.settings.aboutUsSettings')
        </span>
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white tracking-tight">
            {{ $restaurant->name }}
        </h1>
        @if($restaurant->short_description)
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
                {{ $restaurant->short_description }}
            </p>
        @endif
    </div>
</section>

{{-- About Content --}}
<section class="px-4 py-12 sm:py-16">
    <div class="max-w-5xl mx-auto space-y-10">
        {{-- Main content --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-8 sm:p-10 reveal">
            <div class="max-w-4xl mx-auto">
                @if($restaurant->about_us)
                    <div class="prose prose-gray dark:prose-invert max-w-none leading-relaxed">
                        {!! $restaurant->about_us !!}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.374-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">@lang('messages.noDescription')</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Info Cards --}}
        @php
            $quickItems = collect();
            if ($restaurant->phone_number) {
                $quickItems->push(['icon' => 'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z', 'value' => $restaurant->phone_number, 'label' => __('landing.callTitle')]);
            }
            if ($restaurant->email) {
                $quickItems->push(['icon' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75', 'value' => $restaurant->email, 'label' => __('landing.emailTitle')]);
            }
        @endphp
        @if($quickItems->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 reveal">
                @foreach($quickItems as $item)
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-5 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 rounded-xl" style="background-color: rgba({{ $restaurant->theme_rgb }}, 0.1)">
                                <svg class="w-5 h-5" style="color: rgb({{ $restaurant->theme_rgb }})" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['value'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Operating Hours --}}
        @if(isset($shopBranch) && $shopBranch->opening_time && $shopBranch->closing_time)
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 sm:p-10 border border-gray-200 dark:border-gray-800 reveal">
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

        {{-- CTA --}}
        <div class="rounded-2xl p-8 sm:p-10 text-center reveal"
             style="background: linear-gradient(135deg, rgba({{ $restaurant->theme_rgb }}, 0.05), rgba({{ $restaurant->theme_rgb }}, 0.02)); border: 1px solid rgba({{ $restaurant->theme_rgb }}, 0.1);">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('messages.visitUsToday')</h2>
            <p class="mt-2 text-gray-500 dark:text-gray-400">@lang('messages.experienceOurService')</p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                @if(isset($shopBranch) && $shopBranch->address)
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($shopBranch->address) }}" target="_blank"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium hover:opacity-90 transition-all shadow-sm"
                        style="background-color: rgb({{ $restaurant->theme_rgb }}); color: white;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        @lang('landing.openInGoogleMaps')
                    </a>
                @endif
                @if($restaurant->phone_number)
                    <a href="tel:{{ $restaurant->phone_number }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        {{ $restaurant->phone_number }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection