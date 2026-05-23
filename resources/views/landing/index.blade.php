@extends('layouts.landing')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden mesh-gradient pt-24">
    <div class="absolute inset-0 geometric-pattern pointer-events-none"></div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-20" style="background: radial-gradient(circle, rgba(var(--color-base), 0.3) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full opacity-15" style="background: radial-gradient(circle, rgba(var(--color-base), 0.2) 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-[0.04] dark:opacity-[0.08]" style="background: radial-gradient(circle, rgba(var(--color-base), 1) 0%, transparent 70%);"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-label font-semibold bg-skin-secondary/10 text-skin-secondary border border-skin-secondary/20 mb-8 animate-fade-in">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                @lang('landing.heroSearchEngine')
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight animate-fade-in-up" style="letter-spacing: -0.02em">
                @lang('landing.heroTitle')
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200">
                @lang('landing.heroSubTitle')
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up animation-delay-300">
                <a href="{{ route('restaurant_signup') }}" class="btn-primary">
                    @if($trialPackage)
                        @lang('landing.startTrial', ['days' => $trialPackage->trial_days])
                    @else
                        @lang('landing.heroCtaPrimary')
                    @endif
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#features" class="btn-secondary">
                    @lang('landing.heroCtaSecondary')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </a>
            </div>

            <p class="mt-4 text-sm text-gray-400 dark:text-gray-500 animate-fade-in-up animation-delay-400">@lang('landing.ctaNoCard')</p>
        </div>

        <div class="mt-16 relative animate-fade-in-up animation-delay-500">
            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent dark:from-gray-950 z-10 pointer-events-none"></div>
            <div class="relative mx-auto max-w-5xl">
                <div class="elevation-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('landing/dashboard.png') }}" class="w-full h-auto" alt="Hyamii Dashboard">
                </div>
            </div>
            <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 w-3/4 h-12 bg-skin-base/10 blur-3xl rounded-full"></div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="relative -mt-12 z-10 reveal">
    <div class="mx-auto max-w-5xl px-4 sm:px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 dark:bg-gray-800 rounded-xl overflow-hidden elevation-2">
            <div class="bg-white dark:bg-gray-900 p-6 lg:p-8 text-center">
                <p class="text-3xl lg:text-4xl font-bold text-skin-base dark:text-skin-base">10,000+</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@lang('landing.statsRestaurants')</p>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 lg:p-8 text-center">
                <p class="text-3xl lg:text-4xl font-bold text-skin-base dark:text-skin-base">5M+</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@lang('landing.statsOrders')</p>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 lg:p-8 text-center">
                <p class="text-3xl lg:text-4xl font-bold text-skin-base dark:text-skin-base">50+</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@lang('landing.statsCountries')</p>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 lg:p-8 text-center">
                <p class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">@lang('landing.statsUptimeValue')</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">@lang('landing.statsUptime')</p>
            </div>
        </div>
    </div>
</section>

{{-- Features --}}
<section id="features" class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.featureSection1')</h2>
        </div>

        <div class="space-y-24">
            {{-- Feature 1 --}}
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="order-2 lg:order-1 reveal-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-skin-secondary bg-skin-secondary/10 border border-skin-secondary/20 mb-4 font-label">Orders</div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">@lang('landing.featureTitle1')</h3>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.featureDescription1')</p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Real-time order syncing to kitchen displays</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Split bills, combine tables, partial payments</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Dine-in, takeaway, delivery — unified flow</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 lg:order-2 reveal-right">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-br from-skin-secondary/20 to-transparent rounded-3xl blur-2xl"></div>
                        <img src="{{ asset('landing/order-management.png') }}" class="relative rounded-xl border border-gray-200 dark:border-gray-800 shadow-xl" alt="Order Management">
                    </div>
                </div>
            </div>

            {{-- Feature 2 --}}
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="reveal-left">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-br from-skin-secondary/20 to-transparent rounded-3xl blur-2xl"></div>
                        <img src="{{ asset('landing/table-reservation.png') }}" class="relative rounded-2xl border border-gray-200 dark:border-gray-800 shadow-xl" alt="Table Management">
                    </div>
                </div>
                <div class="reveal-right">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-skin-secondary bg-skin-secondary/10 border border-skin-secondary/20 mb-4 font-label">Tables</div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">@lang('landing.featureTitle2')</h3>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.featureDescription2')</p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Drag-and-drop floor plan designer</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Real-time occupancy &amp; reservation overview</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Automated waitlist &amp; table assignment</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Feature 3 --}}
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="order-2 lg:order-1 reveal-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold text-skin-secondary bg-skin-secondary/10 border border-skin-secondary/20 mb-4 font-label">Menu</div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white leading-tight">@lang('landing.featureTitle3')</h3>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.featureDescription3')</p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Multi-language menus with dietary labels</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">QR code digital menus for contactless ordering</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-skin-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-600 dark:text-gray-400">Instant updates across all ordering channels</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 lg:order-2 reveal-right">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-br from-skin-secondary/20 to-transparent rounded-3xl blur-2xl"></div>
                        <img src="{{ asset('landing/menu-management.png') }}" class="relative rounded-xl border border-gray-200 dark:border-gray-800 shadow-xl" alt="Menu Management">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Icon Features --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="icon-features">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.featureSection2')</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature1')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc1')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature2')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc2')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature3')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc3')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature4')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc4')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature5')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc5')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature6')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc6')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature7')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc7')</p>
            </div>

            <div data-tilt class="reveal group p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-skin-secondary/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-skin-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">@lang('landing.iconFeature8')</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">@lang('landing.iconFeatureDesc8')</p>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.testimonialSection1')</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
            <div class="reveal group p-6 lg:p-8 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300">
                <div class="flex gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">"@lang('landing.testimonial1')"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-skin-secondary/20 flex items-center justify-center text-skin-secondary font-bold text-sm">{{ substr(__('landing.testimonialName1'), 0, 1) }}</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">@lang('landing.testimonialName1')</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">@lang('landing.testimonialDesignation1')</p>
                    </div>
                </div>
            </div>

            <div class="reveal group p-6 lg:p-8 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300" style="transition-delay: 0.1s">
                <div class="flex gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">"@lang('landing.testimonial2')"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-skin-secondary/20 flex items-center justify-center text-skin-secondary font-bold text-sm">{{ substr(__('landing.testimonialName2'), 0, 1) }}</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">@lang('landing.testimonialName2')</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">@lang('landing.testimonialDesignation2')</p>
                    </div>
                </div>
            </div>

            <div class="reveal group p-6 lg:p-8 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 hover:border-skin-secondary/30 elevation-2 transition-all duration-300" style="transition-delay: 0.2s">
                <div class="flex gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">"@lang('landing.testimonial3')"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-skin-secondary/20 flex items-center justify-center text-skin-secondary font-bold text-sm">{{ substr(__('landing.testimonialName3'), 0, 1) }}</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">@lang('landing.testimonialName3')</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">@lang('landing.testimonialDesignation3')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pricing --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="pricing">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.pricingTitle1')</h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">@lang('landing.pricingSubTitle1')</p>
        </div>

        @include('landing.pricing', ['packages' => $packages, 'modules' => $AllModulesWithFeature])
    </div>
</section>

{{-- FAQ --}}
<section class="py-20 lg:py-28" id="faq">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.faqTitle1')</h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">@lang('landing.faqSubTitle1')</p>
        </div>

        <div class="space-y-4" x-data="{ open: null }">
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 1 }">
                <button @click="open = open === 1 ? null : 1" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues1')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 1 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 1" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns1')</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 2 }">
                <button @click="open = open === 2 ? null : 2" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues2')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 2 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 2" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns2')</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 3 }">
                <button @click="open = open === 3 ? null : 3" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues3')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 3 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 3" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns3')</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 4 }">
                <button @click="open = open === 4 ? null : 4" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues4')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 4 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 4" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns4')</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 5 }">
                <button @click="open = open === 5 ? null : 5" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues5')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 5 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 5" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns5')</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden" :class="{ 'border-skin-base/30': open === 6 }">
                <button @click="open = open === 6 ? null : 6" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-base font-semibold text-gray-900 dark:text-white">@lang('landing.faqQues6')</span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open === 6 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open === 6" x-collapse>
                    <div class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed">@lang('landing.faqAns6')</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-900/50" id="contact">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center reveal-scale">
        <div class="relative p-8 lg:p-12 rounded-xl bg-gradient-to-br from-skin-secondary/10 via-white to-skin-base/5 dark:from-skin-secondary/5 dark:via-gray-900 dark:to-transparent border border-skin-base/20">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(var(--color-base),0.08),transparent_70%)] rounded-xl pointer-events-none"></div>
            <div class="relative">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white">@lang('landing.ctaTitle')</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">@lang('landing.ctaSubTitle')</p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('restaurant_signup') }}" class="btn-primary">
                        @lang('landing.ctaButton')
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
                <p class="mt-3 text-sm text-gray-400 dark:text-gray-500">@lang('landing.ctaNoCard')</p>
            </div>
        </div>
    </div>
</section>

@endsection