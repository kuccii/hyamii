<!DOCTYPE html>
<html lang="{{ session('customer_locale', $restaurant->customer_site_language) }}" dir="{{ session('customer_is_rtl') ? 'rtl' : 'ltr' }}">
<head>
    <link rel="manifest" href="{{ url('manifest.json') }}?url={{ urlencode(ltrim(Request::getRequestUri(), '/')) }}&hash={{ $restaurant->hash }}" crossorigin="use-credentials">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ $restaurant->uploadFavIconAppleTouchIconUrl }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ $restaurant->uploadFavIconAndroidChrome192Url }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ $restaurant->uploadFavIconAndroidChrome512Url }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $restaurant->uploadFavIcon16Url }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $restaurant->uploadFavIcon32Url }}">
    <link rel="stylesheet" href="{{ asset('vendor/pikaday.css') }}" />

    <link rel="shortcut icon" href="{{ $restaurant->faviconUrl }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $restaurant->logoUrl }}">

    <meta name="keyword" content="{{ $restaurant->meta_keyword ?? '' }}">
    <meta name="description" content="{{ $restaurant->meta_description ?? $restaurant->name }}">
    <title>{{ $restaurant->name }}</title>

    {{-- Fonts: Manrope & Hanken Grotesk + Material Symbols --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Hanken+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        :root {
            --color-base: {{ $restaurant->theme_rgb }};
            --color-secondary: 163, 59, 56;
            --livewire-progress-bar-color: {{ $restaurant->theme_hex }};
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Manrope', sans-serif;
        }

        .font-label, .font-hanken {
            font-family: 'Hanken Grotesk', sans-serif;
        }

        /* Subtle reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes badge-pop {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }
        .badge-pop {
            animation: badge-pop 0.4s ease-in-out;
        }
    </style>

    @if (File::exists(public_path() . '/css/app-custom.css'))
        <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    @endif

    @includeIf('sections.custom_script_customer')
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-svh">

    <div class="min-h-svh flex flex-col">
        {{-- Navigation --}}
        <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-xl border-b border-[rgb(var(--color-base))]/10 dark:border-gray-800">
            <div class="max-w-6xl mx-auto px-4">
                @livewire('shopNavigation', ['restaurant' => $restaurant, 'shopBranch' => $shopBranch])
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        {{-- Footer --}}
        @hasSection('hide-footer')
        @else
        <footer class="border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ $restaurant->logoUrl }}" class="h-8 w-8 rounded-lg object-cover" alt="{{ $restaurant->name }}" />
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $restaurant->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">&copy; {{ now()->year }} @lang('app.allRightsReserved')</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @if (languages()->count() > 1)
                            @livewire('shop.languageSwitcher')
                        @endif
                        <div class="flex items-center gap-1">
                            @if ($restaurant->facebook_link)
                                <a href="{{ $restaurant->facebook_link }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all" aria-label="Facebook">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                </a>
                            @endif
                            @if ($restaurant->instagram_link)
                                <a href="{{ $restaurant->instagram_link }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all" aria-label="Instagram">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                                </a>
                            @endif
                            @if ($restaurant->twitter_link)
                                <a href="{{ $restaurant->twitter_link }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all" aria-label="Twitter">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if ($restaurant->yelp_link)
                                <a href="{{ $restaurant->yelp_link }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all" aria-label="Yelp">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 30 30"><path d="M13.961 22.279c0.246-0.273 0.601-0.444 0.995-0.444 0.739 0 1.338 0.599 1.338 1.338 0 0.016-0 0.032-0.001 0.048l0-0.002-0.237 6.483c-0.027 0.719-0.616 1.293-1.34 1.293-0.077 0-0.153-0.006-0.226-0.019l0.008 0.001c-1.763-0.303-3.331-0.962-4.69-1.902l0.039 0.025c-0.351-0.245-0.578-0.647-0.578-1.102 0-0.346 0.131-0.661 0.346-0.898l-0.001 0.001 4.345-4.829zM12.853 20.434l-6.301 1.572c-0.097 0.025-0.208 0.039-0.322 0.039-0.687 0-1.253-0.517-1.332-1.183l-0.001-0.006c-0.046-0.389-0.073-0.839-0.073-1.295 0-1.324 0.223-2.597 0.635-3.781l-0.024 0.081c0.183-0.534 0.681-0.911 1.267-0.911 0.214 0 0.417 0.050 0.596 0.14l-0.008-0.004 5.833 2.848c0.45 0.221 0.754 0.677 0.754 1.203 0 0.623-0.427 1.147-1.004 1.294l-0.009 0.002z"/></svg>
                                </a>
                            @endif
                            @if ($restaurant->google_business_link)
                                <a href="{{ $restaurant->google_business_link }}" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all" aria-label="Google">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M21.35 11.1h-9.3v2.95h5.43c-.235 1.34-1.22 3.925-5.43 3.925-3.27 0-5.94-2.705-5.94-6.05s2.67-6.05 5.94-6.05c1.87 0 3.12.8 3.84 1.48l2.62-2.52C17.65 2.3 15.84 1.4 13.5 1.4 7.68 1.4 3 5.92 3 11.4s4.68 10 10.5 10c5.97 0 9.9-4.22 9.9-10 0-.67-.08-1.33-.05-1.7z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @endif
    </div>

    @stack('modals')

    @livewireScripts

    @include('layouts.update-uri')
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}" defer data-navigate-track></script>

    @if ($restaurant->paymentGateways->razorpay_status)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif

    @if ($restaurant->paymentGateways->epay_status)
        @php
            $isSandbox = $restaurant->paymentGateways->epay_mode === 'sandbox';
            $epayJsUrl = $isSandbox
                ? 'https://test-epay.epayment.kz/payform/payment-api.js'
                : 'https://epay.homebank.kz/payform/payment-api.js';
        @endphp
        <script src="{{ $epayJsUrl }}"></script>
    @endif

    @if ($restaurant->paymentGateways->stripe_status)
        <script src="https://js.stripe.com/v3/"></script>
        <form action="{{ route('stripe.order_payment') }}" method="POST" id="order-payment-form" class="hidden">
            @csrf
            <input type="hidden" id="order_payment" name="order_payment">
            <div class="form-row">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button>Submit Payment</button>
        </form>
        <script>
            const stripe = Stripe('{{ $restaurant->paymentGateways->stripe_key }}');
            const elements = stripe.elements({
                currency: '{{ strtolower($restaurant->currency->currency_code) }}',
            });
        </script>
    @endif

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('{{ asset('service-worker.js') }}')
                    .then(registration => {
                        console.log('Service Worker registered:', registration);
                    })
                    .catch(error => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }
        self.addEventListener("fetch", (event) => {
            if (event.request.mode === "navigate") {
                event.respondWith(
                    fetch(event.request.url)
                );
            }
        });
    </script>

    <script>
        @if ($restaurant->is_pwa_install_alert_show == 1)
            var isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);
            var isInStandaloneMode = ('standalone' in window.navigator) && window.navigator.standalone;
            var deferredPrompt;

            window.addEventListener("beforeinstallprompt", (event) => {
                event.preventDefault();
                deferredPrompt = event;
                if (!sessionStorage.getItem("pwaDismissed")) {
                    ['scroll', 'click'].forEach(evt => {
                        window.addEventListener(evt, showInstallPrompt, { once: true });
                    });
                }
            });

            function showInstallPrompt() {
                if (deferredPrompt) {
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice.then(({ outcome }) => {
                        if (outcome === 'dismissed') {
                            sessionStorage.setItem("pwaDismissed", "true");
                        }
                        deferredPrompt = null;
                    });
                }
            }

            if (isIOS && !isInStandaloneMode) {
                const lastPrompt = localStorage.getItem('iosPromptLastShown');
                const now = new Date().getTime();
                if (!lastPrompt || (now - parseInt(lastPrompt)) > 24 * 60 * 60 * 1000) {
                    ['scroll', 'click'].forEach(evt => {
                        window.addEventListener(evt, showIOSInstallInstructions, { once: true });
                    });
                }
            }

            function showIOSInstallInstructions() {
                if (document.getElementById('iosInstallInstructions')) return;
                localStorage.setItem('iosPromptLastShown', new Date().getTime());
                const instructions = document.createElement('div');
                instructions.id = 'iosInstallInstructions';
                instructions.innerHTML = `
                    <div style="position: fixed; bottom: 10px; left: 10px; right: 10px; background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 5px; text-align: center; z-index: 1000;">
                        <p class="flex items-center justify-center gap-2 m-0">
                            @lang('messages.installAppInstruction')
                            <img class="ml-2" src="{{ asset('img/share-ios.svg') }}" alt="Share Icon" style="width: 20px; vertical-align: middle;">
                        </p>
                        @lang('messages.addToHomeScreen').
                        <button id="closeInstructions" class="block text-center mx-auto" style="margin-top: 10px; padding: 5px 10px;">@lang('app.close')</button>
                    </div>
                `;
                document.body.appendChild(instructions);
                document.getElementById('closeInstructions').addEventListener('click', function () {
                    document.getElementById('iosInstallInstructions').remove();
                });
            }
        @endif
    </script>

    <x-livewire-alert::flash />
    @include('sections.pusher-script')

    <script src="https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js" data-navigate-track></script>
    <script src="{{ asset('js/print-image-handler.js') }}" data-navigate-track></script>
    <script src="{{ asset('vendor/pikaday.js') }}"></script>

    {{-- Scroll Reveal Observer --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ('IntersectionObserver' in window) {
                const revealElements = document.querySelectorAll('.reveal');
                if (revealElements.length > 0) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('visible');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
                    revealElements.forEach(el => observer.observe(el));
                }
            } else {
                document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
            }
        });
    </script>

    @stack('scripts')
</body>
</html>