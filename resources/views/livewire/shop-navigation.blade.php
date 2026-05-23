<div x-data="{ mobileOpen: false }" class="lg:hidden">
    <nav class="py-3">
        <div class="flex items-center justify-between gap-2">
            <a href="{{ route('shop_restaurant', [$restaurant->hash]).'?branch=' . $shopBranch->id }}" wire:navigate class="flex items-center gap-2 min-w-0">
                <img src="{{ $restaurant->logoUrl }}" class="h-8 w-8 rounded-lg object-cover ring-2 ring-white dark:ring-gray-800 shadow-sm flex-shrink-0" alt="" />
                @if ($restaurant->show_logo_text)
                    <span class="text-base font-semibold text-gray-900 dark:text-white truncate">{{ $restaurant->name }}</span>
                @endif
            </a>

            <div class="flex items-center gap-1 flex-shrink-0">
                @if (languages()->count() > 1)
                    @livewire('shop.languageSwitcher')
                @endif

                <button id="theme-toggle-mobile" type="button"
                    class="w-9 h-9 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                    <svg id="theme-toggle-dark-icon-mobile" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon-mobile" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                @if ($restaurant->show_wifi_icon && $restaurant->wifi_name && $restaurant->wifi_password)
                    @livewire('forms.wifi-button', ['restaurant' => $restaurant])
                @endif

                <button @click="mobileOpen = !mobileOpen" type="button"
                    class="w-9 h-9 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all"
                    aria-controls="mobile-menu-2" :aria-expanded="mobileOpen">
                    <span class="sr-only">@lang('menu.openMainMenu')</span>
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile drawer overlay --}}
    <div x-show="mobileOpen" x-cloak
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="fixed inset-0 z-40 bg-black/30 backdrop-blur-sm"></div>

    {{-- Mobile drawer panel --}}
    <div x-show="mobileOpen" x-cloak
        x-transition:enter="transition-transform duration-300 ease-out"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform duration-200 ease-in"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 bottom-0 z-50 w-72 max-w-[85vw] bg-white dark:bg-gray-950 border-r border-gray-200 dark:border-gray-800 flex flex-col shadow-xl">

        {{-- Drawer header --}}
        <div class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-2.5">
                <img src="{{ $restaurant->logoUrl }}" class="h-8 w-8 rounded-lg object-cover ring-2 ring-white dark:ring-gray-800 shadow-sm" alt="" />
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $restaurant->name }}</p>
                    @if (!is_null(customer()))
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[160px]">{{ customer()->name }}</p>
                    @endif
                </div>
            </div>
            <button @click="mobileOpen = false" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Branch selector --}}
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-800">
            @livewire('forms.shopSelectBranchMobile', ['restaurant' => $restaurant, 'shopBranch' => $shopBranch])
        </div>

        {{-- Navigation items --}}
        <div class="flex-1 overflow-y-auto py-2">
            @php
                $navItems = [
                    'newOrder' => ['route' => 'shop_restaurant', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'menu.newOrder', 'condition' => $restaurant->allow_customer_orders],
                    'bookTable' => ['route' => 'book_a_table', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'menu.bookTable', 'condition' => in_array('Table Reservation', $modules)],
                    'myAddresses' => ['route' => 'my_addresses', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'menu.myAddresses', 'condition' => !is_null(customer())],
                    'myOrders' => ['route' => 'my_orders', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'menu.myOrders', 'condition' => !is_null(customer())],
                    'myBookings' => ['route' => 'my_bookings', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'menu.myBookings', 'condition' => !is_null(customer()) && in_array('Table Reservation', $modules)],
                    'profile' => ['route' => 'profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'menu.profile', 'condition' => !is_null(customer())],
                ];
            @endphp

            <ul class="space-y-0.5 px-3">
                @foreach ($navItems as $key => $item)
                    @if ($item['condition'])
                        @php
                            $routeName = $item['route'];
                            $isActive = request()->routeIs([$routeName, 'table_order']);
                            if ($routeName === 'shop_restaurant') {
                                $isActive = request()->routeIs(['shop_restaurant', 'table_order', 'order_success']);
                            }
                            $routeUrl = route($routeName, [$restaurant->hash]) . '?branch=' . $shopBranch->id;
                        @endphp
                        <li>
                            <a href="{{ $routeUrl }}" wire:navigate @click="mobileOpen = false"
                                @class([
                                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all',
                                    'text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800' => $isActive,
                                    'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800/50' => !$isActive,
                                ])>
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                                </svg>
                                <span>@lang($item['label'])</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            {{-- Loyalty --}}
            @if (!is_null(customer()))
                @php
                    $showLoyaltyMenu = false;
                    if (function_exists('module_enabled') && module_enabled('Loyalty') && function_exists('restaurant_modules') && in_array('Loyalty', restaurant_modules($restaurant))) {
                        $loyaltySettings = \Modules\Loyalty\Entities\LoyaltySetting::getForRestaurant($restaurant->id);
                        if ($loyaltySettings && $loyaltySettings->isEnabled()) {
                            $pointsEnabled = ($loyaltySettings->enable_points ?? false) && ($loyaltySettings->enable_points_for_customer_site ?? true);
                            $stampsEnabled = ($loyaltySettings->enable_stamps ?? false) && ($loyaltySettings->enable_stamps_for_customer_site ?? true);
                            $showLoyaltyMenu = $pointsEnabled || $stampsEnabled;
                        }
                    }
                @endphp
                @if ($showLoyaltyMenu)
                    <div class="px-3 mt-2">
                        <a href="{{ route('loyalty.customer.account', [$restaurant->hash]).'?branch=' . $shopBranch->id }}" wire:navigate @click="mobileOpen = false"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span>@lang('loyalty::app.myLoyaltyAccount')</span>
                        </a>
                    </div>
                @endif
            @endif
        </div>

        {{-- Drawer footer --}}
        @if (!is_null(customer()))
            <div class="p-3 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('customer-logout').'?restaurant=' . $restaurant->hash }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span>@lang('app.logout')</span>
                </a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
            const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
            const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');

            if (themeToggleDarkIconMobile && themeToggleLightIconMobile && themeToggleBtnMobile) {
                if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    themeToggleLightIconMobile.classList.remove('hidden');
                } else {
                    themeToggleDarkIconMobile.classList.remove('hidden');
                }

                themeToggleBtnMobile.addEventListener('click', function() {
                    themeToggleDarkIconMobile.classList.toggle('hidden');
                    themeToggleLightIconMobile.classList.toggle('hidden');

                    if (localStorage.getItem('color-theme')) {
                        if (localStorage.getItem('color-theme') === 'light') {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        }
                    } else {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        }
                    }
                    document.dispatchEvent(new Event('dark-mode'));
                });
            }
        });
    </script>
</div>