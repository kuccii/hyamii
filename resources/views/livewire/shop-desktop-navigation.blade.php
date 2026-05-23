<header class="hidden lg:block">
    <nav class="py-3">
        <div class="flex items-center justify-between gap-4">
            {{-- Left: Logo + Nav Links --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('shop_restaurant', [$restaurant->hash]) . '?branch=' . $shopBranch->id }}" wire:navigate
                    class="flex items-center gap-2.5">
                    <img src="{{ $restaurant->logoUrl }}" class="h-8 w-8 rounded-lg object-cover ring-2 ring-white dark:ring-gray-800 shadow-sm" alt="" />
                    @if ($restaurant->show_logo_text)
                        <span class="text-base font-semibold text-gray-900 dark:text-white">{{ $restaurant->name }}</span>
                    @endif
                </a>

                <div class="flex items-center">
                    <ul class="flex items-center gap-1">
                        @php
                            $menuItems = [
                                ['route' => 'shop_restaurant', 'label' => 'menu.home', 'activeRoutes' => ['shop_restaurant', 'table_order']],
                                ['route' => 'book_a_table', 'label' => 'menu.bookTable', 'activeRoutes' => ['book_a_table'], 'condition' => in_array('Table Reservation', $modules)],
                                ['route' => 'shop_about', 'label' => 'menu.about', 'activeRoutes' => ['shop_about']],
                                ['route' => 'shop_contact', 'label' => 'menu.contact', 'activeRoutes' => ['shop_contact']],
                            ];
                        @endphp
                        @foreach ($menuItems as $item)
                            @if (isset($item['condition']) && !$item['condition'])
                                @continue
                            @endif
                            @php
                                $isActive = request()->routeIs($item['activeRoutes']);
                            @endphp
                            <li>
                                <a href="{{ route($item['route'], [$restaurant->hash]) . '?branch=' . $shopBranch->id }}" wire:navigate
                                    @class([
                                        'px-3 py-2 text-sm font-medium rounded-lg transition-all',
                                        'text-gray-900 dark:text-white' => $isActive,
                                        'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800' => !$isActive,
                                    ])>
                                    @lang($item['label'])
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    @livewire('forms.shopSelectBranch', ['restaurant' => $restaurant, 'shopBranch' => $shopBranch])
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-1">
                @if ($showWaiterButtonCheck)
                    @livewire('forms.callWaiterButton', ['tableNumber' => $table->id ?? null, 'shopBranch' => $shopBranch])
                @endif

                <button id="theme-toggle" type="button"
                    class="w-9 h-9 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                    <svg id="theme-toggle-dark-icon" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                @if ($restaurant->show_wifi_icon && $restaurant->wifi_name && $restaurant->wifi_password)
                    @livewire('forms.wifi-button', ['restaurant' => $restaurant])
                @endif

                <a href="javascript:;" wire:click="$dispatch('showCartItems')"
                    class="w-9 h-9 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg relative transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                    </svg>
                    @if (isset($orderItemCount) && $orderItemCount > 0)
                        <div class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-gray-900 dark:bg-white dark:text-gray-900 rounded-full -top-0.5 -right-0.5 shadow-sm">
                            {{ $orderItemCount > 99 ? '99+' : $orderItemCount }}</div>
                    @endif
                </a>

                @if (is_null(customer()) && $restaurant->customer_login_required)
                    <button type="button" wire:click="$dispatch('showSignup')"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition-all hover:opacity-90"
                        style="background-color: rgb({{ $restaurant->theme_rgb }}); color: white;">
                        @lang('app.login')
                    </button>
                @endif

                @if (!is_null(customer()))
                    <div class="relative" x-data="{ accountOpen: false }" @click.outside="accountOpen = false">
                        <button type="button" @click="accountOpen = !accountOpen"
                            class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all"
                            :class="{ 'bg-gray-100 dark:bg-gray-800': accountOpen }">
                            <div class="w-7 h-7 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <svg class="w-3 h-3 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': accountOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="accountOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute right-0 mt-2 z-50 w-56 bg-white dark:bg-gray-950 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <div class="p-2">
                                <div class="px-3 py-2 mb-1 border-b border-gray-100 dark:border-gray-800">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ customer()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ customer()->email ?? customer()->mobile ?? '' }}</p>
                                </div>
                                <a href="{{ route('profile', [$restaurant->hash]) }}" wire:navigate
                                    class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                    @lang('menu.profile')
                                </a>
                                <a href="{{ route('my_orders', [$restaurant->hash]) }}" wire:navigate
                                    class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" /></svg>
                                    @lang('menu.myOrders')
                                </a>
                                <a href="{{ route('my_addresses', [$restaurant->hash]) }}" wire:navigate
                                    class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                    @lang('menu.myAddresses')
                                </a>
                                @if (in_array('Table Reservation', $modules))
                                <a href="{{ route('my_bookings', [$restaurant->hash]) }}" wire:navigate
                                    class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                    @lang('menu.myBookings')
                                </a>
                                @endif
                            </div>
                            <div class="border-t border-gray-100 dark:border-gray-800 p-2">
                                <a href="{{ url('customer-logout').'?restaurant=' . $restaurant->hash }}"
                                    class="flex items-center gap-3 px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                    @lang('app.logout')
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            const themeToggleBtn = document.getElementById('theme-toggle');

            if (themeToggleDarkIcon && themeToggleLightIcon && themeToggleBtn) {
                if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    themeToggleLightIcon.classList.remove('hidden');
                } else {
                    themeToggleDarkIcon.classList.remove('hidden');
                }

                themeToggleBtn.addEventListener('click', function() {
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

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
</header>