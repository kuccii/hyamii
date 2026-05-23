<!-- Comparison Table -->
<div class="relative">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 mx-auto">
        <!-- Mobile View (Package Cards) -->
        <div class="lg:hidden space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $packageAllModules = array_merge(
                    $package->modules->pluck('name')->toArray(),
                    $package->additional_features ? json_decode($package->additional_features, true) : []
                );
            ?>
            <div class="bg-white border border-gray-200 rounded-xl p-6 dark:bg-neutral-900 dark:border-neutral-800">
                <div class="mb-4">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
                        <?php echo e($package->package_name); ?>

                    </h3>
                    <p class="text-sm text-gray-500 dark:text-neutral-500 mt-1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->package_type == \App\Enums\PackageType::LIFETIME): ?>
                            <span class="font-bold text-skin-base text-lg">
                                <?php echo e(global_currency_format($package->price, $package->currency_id)); ?>

                            </span>
                            <?php echo e(__('modules.package.payOnce')); ?>

                        <?php elseif($monthlyPackages->count() > 0): ?>
                            <span class="font-bold text-skin-base text-lg">
                                <?php echo e(global_currency_format($package->monthly_price, $package->currency_id)); ?>

                            </span>
                            <?php echo e(__('modules.package.payMonthly')); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->package_type == \App\Enums\PackageType::STANDARD && !is_null($package->annual_price) && $annualPackages->count() > 0): ?>
                    <p class="text-sm text-gray-500 dark:text-neutral-500 mt-1">
                        <span class="font-bold text-skin-base text-lg">
                            <?php echo e(global_currency_format($package->annual_price, $package->currency_id)); ?>

                        </span>
                        <?php echo e(__('modules.package.payAnnually')); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($package->description)): ?>
                <p class="text-sm text-gray-600 dark:text-neutral-400 mb-3">
                    <?php echo e($package->description); ?>

                </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <a class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 mb-4" href="#">
                    <?php echo app('translator')->get('landing.getStarted'); ?>
                </a>

                <!-- Module List -->
                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isEnabled = in_array($moduleName, $packageAllModules);
                        $showLimit = false;
                        $limitValue = null;

                        // Check if this module should show limit count
                        if ($isEnabled) {
                            if ($moduleName === 'Menu Item') {
                                $showLimit = true;
                                $limitValue = $package->menu_items_limit;
                            } elseif ($moduleName === 'Order') {
                                $showLimit = true;
                                $limitValue = $package->order_limit;
                            } elseif ($moduleName === 'Staff') {
                                $showLimit = true;
                                $limitValue = $package->staff_limit;
                            }
                        }
                    ?>
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <span class="text-sm text-gray-800 dark:text-neutral-200"><?php echo e(__('permissions.modules.'.$moduleName)); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showLimit && $limitValue !== null): ?>
                                <span class="ml-2 text-xs font-semibold text-skin-base">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($limitValue == -1): ?>
                                        (Unlimited)
                                    <?php else: ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($moduleName === 'Order'): ?>
                                            (<?php echo e(number_format($limitValue)); ?> per day)
                                        <?php else: ?>
                                            (<?php echo e(number_format($limitValue)); ?>)
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$showLimit): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEnabled): ?>
                            <svg class="shrink-0 size-5 text-skin-base" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <?php else: ?>
                            <svg class="shrink-0 size-5 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Desktop View (Comparison Table) -->
        <div class="hidden lg:block overflow-x-auto" x-data="{ isAnnual: <?php echo e($monthlyPackages->count() == 0 && $annualPackages->count() > 0 ? 'true' : 'false'); ?> }">
            <!-- Pricing Switch -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($monthlyPackages->count() > 0 && $annualPackages->count() > 0): ?>
            <div class="flex justify-center items-center gap-3 mb-8">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200" :class="{ 'text-skin-base': !isAnnual }">
                    <?php echo app('translator')->get('modules.package.payMonthly'); ?>
                </span>

                <button
                    type="button"
                    @click="isAnnual = !isAnnual"
                    class="relative inline-flex h-6 w-11 items-center rounded-full bg-skin-base/20"
                    :class="{ 'bg-skin-base': isAnnual }">
                    <span class="sr-only">Toggle annual billing</span>
                    <span
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition"
                        :class="{ 'translate-x-6 ltr:translate-x-6 rtl:-translate-x-6': isAnnual, 'translate-x-1 ltr:translate-x-1 rtl:-translate-x-1': !isAnnual }">
                    </span>
                </button>

                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200" :class="{ 'text-skin-base': isAnnual }">
                    <?php echo app('translator')->get('modules.package.payAnnually'); ?>
                </span>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Header -->
            <div class="flex gap-6">
                <div class="lg:pb-1.5 lg:py-3 min-w-48 sticky left-0 bg-white dark:bg-gray-900 z-10">
              <!-- Header -->
                    <div class="h-full"></div>
                    <!-- End Header -->
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-64"  x-show="(!isAnnual && <?php echo e($package->monthly_status ? 'true' : 'false'); ?> || isAnnual && <?php echo e($package->annual_status ? 'true' : 'false'); ?> || <?php echo e($package->package_type == \App\Enums\PackageType::LIFETIME ? 'true' : 'false'); ?> || <?php echo e($package->package_type == \App\Enums\PackageType::FREE ? 'true' : 'false'); ?>)">
                    <!-- Header -->
                    <div class="h-full p-6 flex flex-col justify-between bg-white border border-gray-200 rounded-xl dark:bg-neutral-900 dark:border-neutral-800 transition-all hover:shadow-lg" >
                        <div class="flex flex-col gap-3">
                            <span class="font-bold text-xl text-gray-800 dark:text-neutral-200">
                                <?php echo e($package->package_name); ?>

                            </span>
                            <div class="gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->package_type == \App\Enums\PackageType::LIFETIME): ?>
                                <p class="text-sm text-gray-500 dark:text-neutral-500">
                                    <span class="font-bold text-skin-base text-2xl">
                                        <?php echo e(global_currency_format($package->price, $package->currency_id)); ?>

                                    </span>
                                    <span class="ml-1"><?php echo e(__('modules.package.payOnce')); ?></span>
                                </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->package_type == \App\Enums\PackageType::STANDARD && !is_null($package->monthly_price) && $package->monthly_status): ?>
                                <p class="text-sm text-gray-500 dark:text-neutral-500 monthly-price"
                                   x-show="!isAnnual">
                                    <span class="font-bold text-skin-base text-2xl">
                                        <?php echo e(global_currency_format($package->monthly_price, $package->currency_id)); ?>

                                    </span>
                                    <span class="ml-1"><?php echo e(__('modules.package.payMonthly')); ?></span>
                                </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($package->package_type == \App\Enums\PackageType::STANDARD && !is_null($package->annual_price) && $package->annual_status): ?>
                                <p class="text-sm text-gray-500 dark:text-neutral-500 annual-price"
                                   x-show="isAnnual">
                                    <span class="font-bold text-skin-base text-2xl">
                                        <?php echo e(global_currency_format($package->annual_price, $package->currency_id)); ?>

                                    </span>
                                    <span class="ml-1"><?php echo e(__('modules.package.payAnnually')); ?></span>
                                </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($package->description)): ?>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <?php echo e($package->description); ?>

                            </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mt-4">
                            <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg bg-skin-base text-white hover:bg-skin-base/90 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-skin-base focus:ring-offset-2 dark:focus:ring-offset-neutral-900 transition-colors" href="<?php echo e(route('restaurant_signup')); ?>">
                                <?php echo app('translator')->get('landing.getStarted'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Features Section -->
            <div class="space-y-4 mt-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="flex gap-6 relative">
                    <li class="lg:pb-1.5 lg:py-3 min-w-48 sticky left-0 bg-white dark:bg-gray-900 z-10">
                        <span class="text-sm text-gray-800 dark:text-neutral-200 break-words w-48 inline-flex">
                            <?php echo e(__('permissions.modules.'.$moduleName)); ?>

                        </span>
                    </li>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $packageAllModules = array_merge(
                            $package->modules->pluck('name')->toArray(),
                            $package->additional_features ? json_decode($package->additional_features, true) : []
                        );
                        $isEnabled = in_array($moduleName, $packageAllModules);
                        $showLimit = false;
                        $limitValue = null;

                        // Check if this module should show limit count
                        if ($isEnabled) {
                            if ($moduleName === 'Menu Item') {
                                $showLimit = true;
                                $limitValue = $package->menu_items_limit;
                            } elseif ($moduleName === 'Order') {
                                $showLimit = true;
                                $limitValue = $package->order_limit;
                            } elseif ($moduleName === 'Staff') {
                                $showLimit = true;
                                $limitValue = $package->staff_limit;
                            }
                        }
                    ?>
                    <li class="py-1.5 lg:py-3 px-4 lg:px-0 lg:text-center bg-gray-50 dark:bg-neutral-800 w-64" x-show="(!isAnnual && <?php echo e($package->monthly_status ? 'true' : 'false'); ?> || isAnnual && <?php echo e($package->annual_status ? 'true' : 'false'); ?> || <?php echo e($package->package_type == \App\Enums\PackageType::LIFETIME ? 'true' : 'false'); ?> || <?php echo e($package->package_type == \App\Enums\PackageType::FREE ? 'true' : 'false'); ?>)">
                        <div class="grid grid-cols-6 lg:block">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEnabled): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showLimit && $limitValue !== null): ?>
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="text-xs font-semibold text-skin-base">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($limitValue == -1): ?>
                                                <?php echo e(__('modules.billing.unlimited')); ?>

                                            <?php else: ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($moduleName === 'Order'): ?>
                                                    <?php echo e(number_format($limitValue)); ?> <?php echo e(__('modules.billing.perDay')); ?>

                                                <?php else: ?>
                                                    <?php echo e(number_format($limitValue)); ?> <?php echo e(__('modules.billing.perPlan')); ?>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <svg class="shrink-0 lg:mx-auto size-5 text-skin-base" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                            <svg class="shrink-0 lg:mx-auto size-5 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
  </div>
  <!-- End Comparison Table -->
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/landing/pricing.blade.php ENDPATH**/ ?>