<!DOCTYPE html>
<html lang="{{ session('customer_locale') ?? global_setting()->locale }}" dir="{{ session('customer_is_rtl') ? 'rtl' : 'ltr' }}">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}" crossorigin="use-credentials">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- FONTS: Manrope + Hanken Grotesk per DESIGN.md --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FAVICONS --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ global_setting()->upload_fav_icon_apple_touch_icon_url }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ global_setting()->upload_fav_icon_android_chrome_192_url }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ global_setting()->upload_fav_icon_android_chrome_512_url }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ global_setting()->upload_fav_icon_16_url }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ global_setting()->upload_fav_icon_32_url }}">
    <link rel="shortcut icon" href="{{ global_setting()->favicon_url }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ global_setting()->logoUrl }}">

    {{-- META TAGS --}}
    <meta name="keywords" content="{{ global_setting()->meta_keyword ?? global_setting()->name }}">
    <meta name="description" content="{{ global_setting()->meta_description ?? global_setting()->name }}">

    <title>{{ global_setting()->meta_title ?? global_setting()->name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @include('sections.theme_style', [
        'baseColor' => global_setting()->theme_rgb,
        'baseColorHex' => global_setting()->theme_hex,
    ])

    @if (File::exists(public_path() . '/css/app-custom.css'))
    <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    @endif

    @includeIf('sections.custom_script_landing')
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-950">
    <div class="min-h-svh">
        <header class="fixed top-0 inset-x-0 z-50 transition-all duration-300" id="site-header">
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 app-logo shrink-0">
                        <img src="{{ global_setting()->logoUrl }}" class="h-8 w-auto lg:h-9" alt="App Logo" />
                        @if (global_setting()->show_logo_text)
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ global_setting()->name }}</span>
                        @endif
                    </a>

                    <div class="hidden lg:flex lg:items-center lg:gap-8">
                        <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors">@lang('landing.navHome')</a>
                        <a href="{{ url('/') }}#features" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors">@lang('landing.navFeatures')</a>
                        <a href="{{ url('/') }}#pricing" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors">@lang('landing.navPricing')</a>
                        <a href="{{ url('/') }}#faq" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors">@lang('landing.navFaq')</a>
                        @php
                            $customMenu = App\Models\CustomMenu::orderBy('sort_order')->get();
                        @endphp
                        @foreach ($customMenu as $menu)
                            @if ($menu->is_active && $menu->position == 'header')
                                <a href="{{ route('customMenu', ['slug' => $menu->menu_slug]) }}" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors">{{ $menu->menu_name }}</a>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="theme-toggle" type="button" class="rounded-lg p-2.5 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700" aria-label="Toggle dark mode">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586"/></svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                        </button>

                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors">
                            @if (user())
                                @lang('menu.dashboard')
                            @else
                                @lang('landing.navLogin')
                            @endif
                        </a>

                        @if (!user())
                            <a href="{{ route('restaurant_signup') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-skin-base hover:bg-skin-base/90 shadow-sm transition-all">
                                @lang('landing.getStarted')
                            </a>
                        @endif

                        <button type="button" id="mobile-menu-toggle" class="lg:hidden rounded-lg p-2.5 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none" aria-label="Open menu">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="hidden lg:hidden pb-4">
                    <div class="flex flex-col gap-2 px-2 py-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                        <a href="{{ url('/') }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">@lang('landing.navHome')</a>
                        <a href="{{ url('/') }}#features" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">@lang('landing.navFeatures')</a>
                        <a href="{{ url('/') }}#pricing" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">@lang('landing.navPricing')</a>
                        <a href="{{ url('/') }}#faq" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">@lang('landing.navFaq')</a>
                        @foreach ($customMenu as $menu)
                            @if ($menu->is_active && $menu->position == 'header')
                                <a href="{{ route('customMenu', ['slug' => $menu->menu_slug]) }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">{{ $menu->menu_name }}</a>
                            @endif
                        @endforeach
                        <hr class="border-gray-200 dark:border-gray-700 my-1">
                        <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800">@lang('landing.navLogin')</a>
                        @if (!user())
                            <a href="{{ route('restaurant_signup') }}" class="px-3 py-2 text-sm font-medium text-white rounded-lg bg-skin-base text-center">@lang('landing.getStarted')</a>
                        @endif
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
                    <div class="col-span-2 md:col-span-1">
                        <a href="{{ url('/') }}" class="flex items-center gap-2 app-logo mb-4">
                            <img src="{{ global_setting()->logoUrl }}" class="h-8 w-auto" alt="App Logo" />
                            @if (global_setting()->show_logo_text)
                                <span class="text-lg font-bold text-gray-900 dark:text-white">{{ global_setting()->name }}</span>
                            @endif
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">@lang('landing.heroSearchEngine')</p>
                        <div class="flex gap-4">
                            @if (global_setting()->facebook_link)
                                <a href="{{ global_setting()->facebook_link }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                                </a>
                            @endif
                            @if (global_setting()->twitter_link)
                                <a href="{{ global_setting()->twitter_link }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if (global_setting()->instagram_link)
                                <a href="{{ global_setting()->instagram_link }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                                </a>
                            @endif
                            @if (global_setting()->google_business_link)
                                <a href="{{ global_setting()->google_business_link }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21.35 11.1h-9.3v2.95h5.43c-.235 1.34-1.22 3.925-5.43 3.925-3.27 0-5.94-2.705-5.94-6.05s2.67-6.05 5.94-6.05c1.87 0 3.12.8 3.84 1.48l2.62-2.52C17.65 2.3 15.84 1.4 13.5 1.4 7.68 1.4 3 5.92 3 11.4s4.68 10 10.5 10c5.97 0 9.9-4.22 9.9-10 0-.67-.08-1.33-.05-1.7z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">@lang('landing.footerProduct')</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ url('/') }}#features" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.features')</a></li>
                            <li><a href="{{ url('/') }}#pricing" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.pricing')</a></li>
                            <li><a href="{{ route('restaurant_signup') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.getStarted')</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">@lang('landing.footerCompany')</h3>
                        <ul class="space-y-3">
                            @foreach ($customMenu as $menu)
                                @if ($menu->is_active && $menu->position == 'footer')
                                    <li><a href="{{ route('customMenu', ['slug' => $menu->menu_slug]) }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">{{ $menu->menu_name }}</a></li>
                                @endif
                            @endforeach
                            <li><a href="{{ url('/') }}#contact" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.footerContact')</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">@lang('landing.footerSupport')</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ url('/') }}#faq" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.faq')</a></li>
                            <li><a href="mailto:{{ __('landing.contactEmail') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">@lang('landing.emailTitle')</a></li>
                        </ul>
                        @if (languages()->count() > 1)
                            <div class="mt-6">
                                @livewire('shop.languageSwitcher')
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-800">
                    <p class="text-sm text-gray-400 dark:text-gray-500 text-center">© {{ now()->year }} <a href="{{ url('/') }}" class="hover:underline">{{ global_setting()->name }}</a>. @lang('landing.rightsReserved')</p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    @include('layouts.update-uri')
    @include('layouts.service-worker-js')
    @include('sections.pusher-script')
    <x-livewire-alert::flash />
    @stack('scripts')

    <style>
        .btn-primary {
            @apply inline-flex items-center gap-2 px-8 py-3.5 text-base font-semibold text-white rounded-xl bg-skin-base hover:bg-skin-base/90 shadow-lg shadow-skin-base/25 hover:shadow-xl hover:shadow-skin-base/30 transition-all duration-200;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .btn-secondary {
            @apply inline-flex items-center gap-2 px-8 py-3.5 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-750 shadow-sm transition-all duration-200;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            border-color: rgba(var(--color-base), 0.3);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('site-header');
            if (header) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        header.classList.add('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-xl', 'shadow-sm');
                        header.classList.remove('bg-transparent');
                    } else {
                        header.classList.remove('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-xl', 'shadow-sm');
                        header.classList.add('bg-transparent');
                    }
                });
            }

            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });

            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            if (revealElements.length && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
                revealElements.forEach(function(el) { observer.observe(el); });
            }
    </script>
</body>

</html>