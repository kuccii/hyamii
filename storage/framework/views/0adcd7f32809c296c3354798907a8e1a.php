<div>

    <div class="flex flex-1 flex-col overflow-hidden lg:flex-row">

        <div class="relative flex w-full shrink-0 flex-col border-b border-gray-100 bg-white text-sm font-medium text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 lg:w-52 lg:min-w-[208px] lg:flex-none lg:border-b-0 lg:border-r"
            x-data="{
                menuOpen: false,
                largeScreen: typeof window !== 'undefined' && window.matchMedia('(min-width: 1024px)').matches,
                bindMq() {
                    const mq = window.matchMedia('(min-width: 1024px)');
                    mq.addEventListener('change', () => { this.largeScreen = mq.matches; });
                }
            }"
            x-init="bindMq()"
            @settings-close-sections-menu.window="menuOpen = false"
            @keydown.escape.window="if (!largeScreen) menuOpen = false">
            <!-- Compact search trigger (doesn't take layout space like an always-visible input) -->
            <button id="settingsTabSearchToggle" type="button"
                class="absolute right-2 top-2 z-10 inline-flex h-8 w-8 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 shadow-sm hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-skin-base/40 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                aria-label="<?php echo e(__('app.search')); ?>" aria-expanded="false" aria-controls="settingsTabSearchPanel">
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3a6 6 0 104.472 10.03l2.249 2.249a.75.75 0 101.06-1.06l-2.249-2.249A6 6 0 009 3zm-4.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Overlay search (absolute, so it won't push the UI down) -->
            <div id="settingsTabSearchPanel"
                class="absolute left-16 top-3 z-20 hidden w-[min(20rem,calc(100vw-1rem))] rounded-xl border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-800"
                role="dialog" aria-label="<?php echo e(__('app.search')); ?>">
                <div class="relative">
                    <label for="settingsTabSearch" class="sr-only"><?php echo e(__('app.search')); ?></label>

                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3a6 6 0 104.472 10.03l2.249 2.249a.75.75 0 101.06-1.06l-2.249-2.249A6 6 0 009 3zm-4.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <input id="settingsTabSearch" type="search" placeholder="<?php echo e(__('app.search')); ?>"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-2 pl-10 pr-20 text-sm text-gray-900 shadow-sm outline-none transition focus:border-skin-base focus:ring-2 focus:ring-skin-base/40 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" />

                    <div class="absolute inset-y-0 right-0 flex items-center gap-1 pr-2">
                        <button id="settingsTabSearchClear" type="button"
                            class="hidden h-7 w-7 items-center justify-center rounded-md text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300"
                            aria-label="<?php echo e(__('app.clear')); ?>">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.53-10.47a.75.75 0 00-1.06-1.06L10 8.94 8.53 7.47a.75.75 0 10-1.06 1.06L8.94 10l-1.47 1.47a.75.75 0 101.06 1.06L10 11.06l1.47 1.47a.75.75 0 101.06-1.06L11.06 10l1.47-1.47z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button id="settingsTabSearchClose" type="button"
                            class="h-7 w-7 items-center justify-center rounded-md text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300"
                            aria-label="<?php echo e(__('app.close') ?? 'Close'); ?>">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-100 p-4 pr-12 dark:border-gray-700 bg-skin-base/5 dark:bg-skin-base/20">
                <button type="button"
                    class="flex w-full items-center justify-between gap-2 rounded-lg py-0.5 text-left lg:hidden "
                    @click="menuOpen = !menuOpen"
                    :aria-expanded="menuOpen"
                    aria-controls="settingsTabsList">
                    <span class="min-w-0 flex-1 text-sm font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('menu.settings'); ?></span>
                    <svg class="h-5 w-5 shrink-0 text-gray-500 transition-transform dark:text-gray-400" :class="menuOpen && 'rotate-180'" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <h1 class="hidden text-sm font-semibold text-gray-900 dark:text-white lg:block"><?php echo app('translator')->get('menu.settings'); ?></h1>
            </div>

            <ul id="settingsTabsList"
                class="w-full min-w-0 flex-col overflow-y-auto max-lg:max-h-[min(70vh,28rem)] lg:flex lg:max-h-none lg:w-52 lg:min-w-[208px] lg:shrink-0"
                :class="!largeScreen && !menuOpen ? 'hidden' : 'flex'"
                @click="if (!largeScreen && $event.target.closest('a[href]')) { menuOpen = false }">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_'.user()->restaurant_id)): ?>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=restaurant'); ?>" wire:navigate
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'restaurant'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'restaurant')]); ?>">
                        <?php echo app('translator')->get('modules.settings.restaurantSettings'); ?>
                    </a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=app'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'app'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'app')]); ?>"><?php echo app('translator')->get('modules.settings.appSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=operationalShifts'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'operationalShifts'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'operationalShifts')]); ?>"><?php echo app('translator')->get('modules.settings.operationalShifts'); ?></a>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_'.user()->restaurant_id) || user_can('Show Restaurant Open/Close')): ?>
                    <li class="me-2">
                        <a href="<?php echo e(route('settings.index').'?tab=restaurantOpenClose'); ?>" wire:navigate
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'restaurantOpenClose'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'restaurantOpenClose')]); ?>"><?php echo app('translator')->get('modules.settings.restaurantOpenCloseSettings'); ?></a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=branch'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'branch'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'branch')]); ?>"><?php echo app('translator')->get('modules.settings.branchSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=currency'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'currency'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'currency')]); ?>"><?php echo app('translator')->get('modules.settings.currencySettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=email'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'email'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'email')]); ?>"><?php echo app('translator')->get('modules.settings.emailSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=tax'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'tax'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'tax')]); ?>"><?php echo app('translator')->get('modules.settings.taxSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=payment'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'payment'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'payment')]); ?>"><?php echo app('translator')->get('modules.settings.paymentgatewaySettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=theme'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'theme'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'theme')]); ?>"><?php echo app('translator')->get('modules.settings.themeSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=role'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'role'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'role')]); ?>"><?php echo app('translator')->get('modules.settings.roleSettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=billing'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'billing'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'billing')]); ?>"><?php echo app('translator')->get('modules.settings.billing'); ?></a>
                </li>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!user()->hasRole('Admin_'.user()->restaurant_id) && user_can('Show Restaurant Open/Close')): ?>
                    <li class="me-2">
                        <a href="<?php echo e(route('settings.index').'?tab=restaurantOpenClose'); ?>" wire:navigate
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'restaurantOpenClose'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'restaurantOpenClose')]); ?>"><?php echo app('translator')->get('modules.settings.restaurantOpenCloseSettings'); ?></a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=reservation'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'reservation'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'reservation')]); ?>"><?php echo app('translator')->get('modules.settings.reservationSettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=aboutus'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'aboutus'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'aboutus')]); ?>"><?php echo app('translator')->get('modules.settings.aboutUsSettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=customerSite'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'customerSite'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'customerSite')]); ?>"><?php echo app('translator')->get('modules.settings.customerSiteSettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=receipt'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'receipt'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'receipt')]); ?>"><?php echo app('translator')->get('modules.settings.receiptSetting'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=printer'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'printer'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'printer')]); ?>"><?php echo app('translator')->get('modules.settings.printerSetting'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=downloads'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'downloads'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'downloads')]); ?>"><?php echo app('translator')->get('modules.settings.downloads'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=deliverySettings'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'deliverySettings'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'deliverySettings')]); ?>"><?php echo app('translator')->get('modules.settings.deliverySettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=kotSettings'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'kotSettings'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'kotSettings')]); ?>"><?php echo app('translator')->get('modules.settings.kotSettings'); ?></a>
                </li>
                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=cancelSettings'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'cancelSettings'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'cancelSettings')]); ?>"><?php echo app('translator')->get('modules.settings.cancelSettings'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=orderSettings'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'orderSettings'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'orderSettings')]); ?>"><?php echo app('translator')->get('modules.settings.orderSetting'); ?></a>
                </li>

                <li class="me-2">
                    <a href="<?php echo e(route('settings.index').'?tab=refundReasons'); ?>" wire:navigate
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(["inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full", 'border-transparent' => ($activeSetting != 'refundReasons'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activeSetting == 'refundReasons')]); ?>"><?php echo app('translator')->get('modules.settings.refundReasons'); ?></a>
                </li>


                <!-- NAV ITEM - CUSTOM MODULES  -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = custom_module_plugins(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if ($__env->exists(strtolower($item) . '::sections.settings.restaurant.sidebar')) echo $__env->make(strtolower($item) . '::sections.settings.restaurant.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    <?php if (! $__env->hasRenderedOnce('6a68f029-b6f1-4c20-8898-63849e871b1f')): $__env->markAsRenderedOnce('6a68f029-b6f1-4c20-8898-63849e871b1f'); ?>
        <?php $__env->startPush('scripts'); ?>
            <script>
                (function () {
                    function initSettingsTabSearch() {
                        const input = document.getElementById('settingsTabSearch');
                        const clearBtn = document.getElementById('settingsTabSearchClear');
                        const toggleBtn = document.getElementById('settingsTabSearchToggle');
                        const panel = document.getElementById('settingsTabSearchPanel');
                        const closeBtn = document.getElementById('settingsTabSearchClose');
                        const list = document.getElementById('settingsTabsList');
                        if (!input || !list || !toggleBtn || !panel) return;
                        if (input.dataset.bound === '1') return;
                        input.dataset.bound = '1';

                        const openPanel = () => {
                            panel.classList.remove('hidden');
                            toggleBtn.setAttribute('aria-expanded', 'true');
                            setTimeout(() => input.focus(), 0);
                        };

                        const closePanel = () => {
                            panel.classList.add('hidden');
                            toggleBtn.setAttribute('aria-expanded', 'false');
                        };

                        const filter = () => {
                            const q = (input.value || '').trim().toLowerCase();
                            if (clearBtn) {
                                clearBtn.classList.toggle('hidden', q.length === 0);
                                clearBtn.classList.toggle('flex', q.length > 0);
                            }

                            Array.from(list.children).forEach((child) => {
                                if (!child || child.tagName !== 'LI') return;
                                const text = (child.textContent || '').replace(/\s+/g, ' ').trim().toLowerCase();
                                child.classList.toggle('hidden', q.length > 0 && !text.includes(q));
                            });
                        };

                        input.addEventListener('input', filter);
                        toggleBtn.addEventListener('click', () => {
                            if (panel.classList.contains('hidden')) openPanel();
                            else closePanel();
                        });
                        if (closeBtn) closeBtn.addEventListener('click', closePanel);
                        if (clearBtn) {
                            clearBtn.addEventListener('click', () => {
                                input.value = '';
                                input.focus();
                                filter();
                            });
                        }

                        // Close on escape
                        input.addEventListener('keydown', (e) => {
                            if (e.key === 'Escape') {
                                e.preventDefault();
                                closePanel();
                                toggleBtn.focus();
                            }
                        });

                        // Close when clicking outside of the panel/toggle
                        document.addEventListener('click', (e) => {
                            if (panel.classList.contains('hidden')) return;
                            const target = e.target;
                            if (panel.contains(target) || toggleBtn.contains(target)) return;
                            closePanel();
                        });

                        filter();
                    }

                    document.addEventListener('DOMContentLoaded', initSettingsTabSearch);
                    document.addEventListener('livewire:navigated', () => {
                        initSettingsTabSearch();
                        window.dispatchEvent(new CustomEvent('settings-close-sections-menu'));
                    });
                })();
            </script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>

        <div class="min-w-0 flex-1 overflow-y-auto p-4 space-y-5">
            <div class="grid grid-cols-1  dark:bg-gray-900">

                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($activeSetting):
                        case ('restaurant'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.generalSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('app'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.timezoneSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('email'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.notificationSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('currency'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.currencySettings');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('payment'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.paymentSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-4', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('theme'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.themeSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-5', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('role'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.roleSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-6', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('tax'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.taxSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-7', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('reservation'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.reservationSettings');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-8', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('branch'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.branchSettings');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-9', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>
                        <?php case ('billing'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.billingSettings');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-10', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('aboutus'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.aboutUsSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-11', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('customerSite'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.customerSiteSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-12', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('receipt'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.ReceiptSetting', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-13', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('printer'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.PrinterSetting', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-14', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('downloads'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.DownloadSettings');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-15', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('deliverySettings'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.branchDeliverySettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-16', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('operationalShifts'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.branchOperationalShifts', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-17', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('restaurantOpenClose'): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_'.user()->restaurant_id) || user_can('Show Restaurant Open/Close')): ?>
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.restaurantOpenCloseSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-18', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php break; ?>

                        <?php case ('kotSettings'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.kotSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-19', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('cancelSettings'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.CancellationSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-20', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('orderSettings'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.OrderSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-21', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>

                        <?php case ('refundReasons'): ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.RefundReasonSettings', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-22', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php break; ?>


                        <?php default: ?>

                    <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- NAV ITEM - CUSTOM MODULES  -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = custom_module_plugins(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeSetting == strtolower($item).'Settings'): ?>
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(strtolower($item).'::restaurant.setting', ['settings' => $settings]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3050095043-23', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/settings/master.blade.php ENDPATH**/ ?>