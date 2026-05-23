<!DOCTYPE html>
<html lang="{{ session('customer_locale') ?? $restaurant->customer_site_language }}" dir="{{ session('customer_is_rtl') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ $restaurant->faviconUrl }}">
    <title>{{ $restaurant->name }} - @lang('menu.deliveryExecutivePortal')</title>

    {{-- Fonts: Manrope + Hanken Grotesk per DESIGN.md --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --color-base: {{ $restaurant->theme_rgb }};
            --color-secondary: 163, 59, 56;
            --livewire-progress-bar-color: {{ $restaurant->theme_hex }};
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-lg lg:max-w-screen-xl min-h-svh shadow-md lg:shadow-none">
        @livewire('deliveryNavigation', ['restaurant' => $restaurant, 'shopBranch' => $shopBranch])
        @livewire('deliveryDesktopNavigation', ['restaurant' => $restaurant, 'shopBranch' => $shopBranch])

        <div class="flex mt-4 overflow-hidden dark:bg-gray-900">
            <div id="main-content" class="w-full h-full overflow-y-auto dark:bg-gray-900">
                <main>
                    @yield('content')
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}" defer data-navigate-track></script>
    <x-livewire-alert::flash />
</body>

</html>
