<div class="mb-12" x-data="{ addTableOpen: false, openAddTable() { this.addTableOpen = true }, closeAddTable() { this.addTableOpen = false } }">
    <div class="p-4 bg-white block sm:flex items-center justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('modules.table.tableView'); ?></h1>
            </div>
            <div class="items-center justify-between block sm:flex dark:divide-gray-700">
                <div class="flex items-center gap-4">
                    <!-- View Toggle -->
                    <div class="inline-flex rounded-lg shadow-sm">
                        <button type="button" wire:click="$set('viewType', 'list')"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-l-lg focus:z-10',
                            'bg-skin-base text-white dark:bg-skin-base/50 dark:text-white' => $viewType === 'list',
                            'bg-white text-gray-700 hover:text-gray-900 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700' => $viewType !== 'list']); ?>">
                            <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <?php echo app('translator')->get('app.list'); ?>
                        </button>
                        <button type="button" wire:click="$set('viewType', 'grid')"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative inline-flex items-center px-3 py-2 text-sm font-medium focus:z-10',
                            'bg-skin-base text-white dark:bg-skin-base/50 dark:text-white' => $viewType === 'grid',
                            'bg-white text-gray-700 hover:text-gray-900 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700' => $viewType !== 'grid']); ?>">
                            <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <?php echo app('translator')->get('app.grid'); ?>
                        </button>
                        <button type="button" wire:click="$set('viewType', 'layout')"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-r-lg focus:z-10',
                            'bg-skin-base text-white dark:bg-skin-base/50 dark:text-white' => $viewType === 'layout',
                            'bg-white text-gray-700 hover:text-gray-900 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700' => $viewType !== 'layout']); ?>">
                            <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                            </svg>
                            <?php echo app('translator')->get('app.layout'); ?>
                        </button>
                    </div>

                    <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'left','dropdownClasses' => 'z-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'left','dropdownClasses' => 'z-10']); ?>
                         <?php $__env->slot('trigger', null, []); ?> 
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($filterAvailable)): ?>
                                        <?php echo app('translator')->get('modules.table.filterAvailable'); ?>
                                    <?php else: ?>
                                        <span class="font-bold text-gray-800 dark:text-neutral-200"><?php echo app('translator')->get('app.showing'); ?> <?php echo app('translator')->get('modules.table.' . $filterAvailable); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </button>
                            </span>
                         <?php $__env->endSlot(); ?>

                         <?php $__env->slot('content', null, []); ?> 
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\',  null)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\',  null)']); ?>
                                <?php echo app('translator')->get('app.showAll'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'available\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'available\')']); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-green-500" viewBox="0 0 16 16">
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                                <?php echo app('translator')->get('modules.table.available'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'running\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'running\')']); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-blue-500" viewBox="0 0 16 16">
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                                <?php echo app('translator')->get('modules.table.running'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'reserved\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'inline-flex items-center text-sm text-gray-600 dark:text-neutral-400 gap-1 font-medium cursor-pointer','wire:click' => '$set(\'filterAvailable\', \'reserved\')']); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-red-500" viewBox="0 0 16 16">
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                                <?php echo app('translator')->get('modules.table.reserved'); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>

                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user_can('Create Table')): ?>
                <div class="gap-2 flex">
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','@click' => 'openAddTable()']); ?><?php echo app('translator')->get('modules.table.addTable'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </div>
    </div>

    <div class="flex flex-col my-4 px-4">
        <div class="mb-6 lg:flex lg:justify-between">
            <ul class="inline-flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 mb-4">
                <li class="me-2" wire:key='area-fltr-<?php echo e(microtime()); ?>'>
                    <a href="javascript:;" wire:click="$set('areaID', null)"
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['inline-block px-4 py-3 rounded-lg', 'text-skin-base dark:bg-skin-base/[.1] bg-skin-base/[.2]' => (is_null($areaID)), 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white' => (!is_null($areaID))]); ?>" ><?php echo app('translator')->get('modules.table.allAreas'); ?></a>
                </li>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="me-2" wire:key='area-fltr-<?php echo e($item->id.microtime()); ?>'>
                        <a href="javascript:;" wire:click="$set('areaID', '<?php echo e($item->id); ?>')"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['inline-block px-4 py-3 rounded-lg', 'text-skin-base dark:bg-skin-base/[.1] bg-skin-base/[.2]' => ($areaID == $item->id), 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white' => ($areaID != $item->id)]); ?>" >
                            <?php echo e($item->area_name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </ul>

            <div class="inline-flex items-center gap-3 lg:fixed bottom-10 right-5 lg:bg-white dark:bg-gray-700 lg:px-3 lg:py-2 lg:shadow-md lg:rounded-md">
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium dark:text-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-green-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8"/>
                    </svg>
                    <?php echo app('translator')->get('modules.table.available'); ?>
                </div>
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium dark:text-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-blue-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8"/>
                    </svg>
                    <?php echo app('translator')->get('modules.table.running'); ?>
                </div>
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium dark:text-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill text-red-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8"/>
                    </svg>
                    <?php echo app('translator')->get('modules.table.reserved'); ?>
                </div>
            </div>

        </div>

        <!-- Card Section -->
        <div class="space-y-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col gap-3 sm:gap-4 space-y-1" wire:key='area-<?php echo e($area->id . microtime()); ?>'>
                    <h3 class="f-15 font-medium inline-flex gap-2 items-center dark:text-neutral-200"><?php echo e($area->area_name); ?>

                        <span class="px-2 py-1 text-sm rounded bg-slate-100 border-gray-300 border text-gray-800 "><?php echo e($area->tables->count()); ?> <?php echo app('translator')->get('modules.table.table'); ?></span>
                    </h3>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewType === 'layout'): ?>
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            <!-- Tables Layout -->
                            <div class="relative grid grid-cols-6 gap-2 p-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                <?php
                                $isReservationActive = false;

                                $startTime = $item->activeReservation ? $item->activeReservation->reservation_date_time : null;
                                $slotTime = $item->activeReservation ? $item->activeReservation->slot_time_difference : null;
                                $endTime = $item->activeReservation ? $item->activeReservation->reservation_date_time->addMinutes($slotTime) : null;
                                // dump($item->currentReservationOrders);

                                if ($item->currentReservationOrders) {
                                    // If there's a current reservation order, check if it's unpaid
                                    $isReservationActive = $item->currentReservationOrders->status !== 'paid';
                                } elseif ($startTime && $endTime) {
                                    // If no current reservation order, check time slot
                                    $now = now()->timezone(timezone());
                                    $nowValue = $now->format('His');
                                    $startValue = $startTime->format('His');
                                    $endValue = $endTime->format('His');
                                    if ($nowValue >= $startValue && $nowValue <= $endValue) {
                                        $isReservationActive = true;
                                    }
                                } else {
                                    $isReservationActive = false;
                                }

                            ?>


                                    <?php if (isset($component)) { $__componentOriginal90971a4eb7b58b9d8047e9db4862c46b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal90971a4eb7b58b9d8047e9db4862c46b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.restaurant-table','data' => ['wire:key' => 'table-'.e($item->id . microtime()).'','wire:click' => 'showTableOrder('.e($item->id).')','shape' => $item->seating_capacity >= 4 ? 'rectangle' : 'circle','seats' => $item->seating_capacity,'code' => $item->table_code,'status' => $item->available_status,'isInactive' => $item->status === 'inactive','kotCount' => $item->activeOrder ? $item->activeOrder->kot->count() : 0,'isReservationActive' => $isReservationActive,'tableId' => $item->id,'waiters' => $waiters ?? [],'currentWaiterId' => $item->activeOrder?->waiter_id,'class' => 'scale-75']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('restaurant-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'table-'.e($item->id . microtime()).'','wire:click' => 'showTableOrder('.e($item->id).')','shape' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->seating_capacity >= 4 ? 'rectangle' : 'circle'),'seats' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->seating_capacity),'code' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->table_code),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->available_status),'is-inactive' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status === 'inactive'),'kot-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->activeOrder ? $item->activeOrder->kot->count() : 0),'is-reservation-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReservationActive),'table-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->id),'waiters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($waiters ?? []),'current-waiter-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->activeOrder?->waiter_id),'class' => 'scale-75']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal90971a4eb7b58b9d8047e9db4862c46b)): ?>
<?php $attributes = $__attributesOriginal90971a4eb7b58b9d8047e9db4862c46b; ?>
<?php unset($__attributesOriginal90971a4eb7b58b9d8047e9db4862c46b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal90971a4eb7b58b9d8047e9db4862c46b)): ?>
<?php $component = $__componentOriginal90971a4eb7b58b9d8047e9db4862c46b; ?>
<?php unset($__componentOriginal90971a4eb7b58b9d8047e9db4862c46b); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                    <?php elseif($viewType === 'grid'): ?>
                        <div class="grid grid-cols-8 gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $isReservationActive = false;

                                $startTime = $item->activeReservation ? $item->activeReservation->reservation_date_time : null;
                                $slotTime = $item->activeReservation ? $item->activeReservation->slot_time_difference : null;
                                $endTime = $item->activeReservation ? $item->activeReservation->reservation_date_time->addMinutes($slotTime) : null;

                                if ($item->currentReservationOrders) {
                                    // If there's a current reservation order, check if it's unpaid
                                    $isReservationActive = $item->currentReservationOrders->status !== 'paid';
                                } elseif ($startTime && $endTime) {
                                    // If no current reservation order, check time slot
                                    $now = now()->timezone(timezone());
                                    $nowValue = $now->format('His');
                                    $startValue = $startTime->format('His');
                                    $endValue = $endTime->format('His');
                                    if ($nowValue >= $startValue && $nowValue <= $endValue) {
                                        $isReservationActive = true;
                                    }
                                } else {
                                    $isReservationActive = false;
                                }

                                // Lock status variables
                                $isLocked = $item->tableSession?->isLocked() ?? false;
                                $isLockedByCurrentUser = $isLocked && $item->tableSession?->locked_by_user_id === auth()->id();
                                $isLockedByOtherUser = $isLocked && $item->tableSession?->locked_by_user_id !== auth()->id();
                                ?>

                                <div wire:key='table-<?php echo e($item->id . microtime()); ?>'
                                    wire:click='showTableOrder(<?php echo e($item->id); ?>)'
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'aspect-square rounded-lg p-2 cursor-pointer flex flex-col items-center justify-center transition-all transform hover:scale-105 hover:shadow-md relative',
                                        'bg-green-100 border-green-200' => $item->available_status == 'available',
                                        'bg-red-100 border-red-200' => $item->available_status == 'reserved',
                                        'bg-blue-100 border-blue-200' => $item->available_status == 'running',
                                        'opacity-50' => $item->status == 'inactive'
                                    ]); ?>">

                                    <!-- Lock indicator for locked tables -->
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLocked): ?>
                                        <div class="absolute top-1.5 right-1.5 z-10" wire:key="lock-<?php echo e($item->id . '-' . $loop->index . microtime()); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_' . user()->restaurant_id)): ?>
                                                <!-- Admin can unlock any table -->
                                                <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                        'p-1 relative rounded-full group shadow-sm hover:shadow-md transition-all duration-200 text-white text-xs',
                                                        'bg-blue-500 hover:bg-blue-600' => $isLockedByCurrentUser,
                                                        'bg-red-500 hover:bg-red-600' => !$isLockedByCurrentUser,
                                                    ]); ?>"
                                                    title="<?php echo e($isLockedByCurrentUser ? __('modules.table.lockedByYou') : __('modules.table.forceUnlock')); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <!-- Locked icon (shows by default) -->
                                                    <svg class="w-4 h-4 group-hover:opacity-0 group-hover:scale-0 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                    </svg>

                                                    <!-- Unlock icon (shows on hover) -->
                                                    <svg class="w-4 h-4 absolute inset-0 m-auto opacity-0 scale-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                                                    </svg>
                                                </button>
                                            <?php elseif($isLockedByCurrentUser): ?>
                                                <!-- User can unlock their own locked tables -->
                                                <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                    class="bg-blue-500 text-white p-1 rounded-full shadow hover:shadow-md transition-all duration-200"
                                                    title="<?php echo app('translator')->get('modules.table.lockedByYou'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                                                    </svg>
                                                </button>
                                            <?php else: ?>
                                                <!-- Other users can only see the lock status -->
                                                <div class="bg-orange-500 text-white p-1 rounded-full shadow cursor-help hover:shadow-md transition-all duration-200"
                                                    title="<?php echo app('translator')->get('modules.table.locked'); ?> by <?php echo e($item->tableSession?->lockedByUser->name ?? 'Unknown'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                    </svg>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <span class="text-lg font-bold"><?php echo e($item->table_code); ?></span>
                                    <span class="text-xs"><?php echo e($item->seating_capacity); ?> <?php echo app('translator')->get('modules.table.seats'); ?></span>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isReservationActive): ?>
                                        <div class="mt-1 px-2 py-1 rounded text-xs font-medium bg-white shadow-sm text-red-600">
                                            <?php echo app('translator')->get('modules.table.reserved'); ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->activeOrder): ?>
                                        <span class="text-xs mt-1"><?php echo e($item->activeOrder->kot->count()); ?> <?php echo app('translator')->get('modules.order.kot'); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <!-- Waiter Assignment Select -->
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($waiters) && !user()->hasRole('Waiter_' . user()->restaurant_id)): ?>
                                      <button wire:click.stop='showWaiterSelect(<?php echo e($item->id); ?>)' class="text-xs px-2 py-1 rounded-md border border-gray-300 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <?php echo app('translator')->get('modules.table.assignWaiter'); ?>
                                      </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isReservationActive = false;

                                    $startTime = $item->activeReservation ? $item->activeReservation->reservation_date_time : null;
                                    $slotTime = $item->activeReservation ? $item->activeReservation->slot_time_difference : null;
                                    $endTime = $item->activeReservation ? $item->activeReservation->reservation_date_time->addMinutes($slotTime) : null;

                                    if ($item->currentReservationOrders) {
                                        // If there's a current reservation order, check if it's unpaid
                                        $isReservationActive = $item->currentReservationOrders->status !== 'paid';
                                    } elseif ($startTime && $endTime) {
                                        // If no current reservation order, check time slot
                                        $now = now()->timezone(timezone());
                                        $nowValue = $now->format('His');
                                        $startValue = $startTime->format('His');
                                        $endValue = $endTime->format('His');
                                        if ($nowValue >= $startValue && $nowValue <= $endValue) {
                                            $isReservationActive = true;
                                        }
                                    } else {
                                        $isReservationActive = false;
                                    }

                                    // Lock status variables for layout view
                                    $isLocked = $item->tableSession?->isLocked() ?? false;
                                    $isLockedByCurrentUser = $isLocked && $item->tableSession?->locked_by_user_id === auth()->id();
                                    $isLockedByOtherUser = $isLocked && $item->tableSession?->locked_by_user_id !== auth()->id();
                                ?>

                             <a
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses(['flex flex-col gap-2 border shadow-sm rounded-lg hover:shadow-md dark:bg-gray-700 dark:border-gray-600 p-3 relative overflow-hidden cursor-pointer',
                                'bg-red-50' => ($item->status == 'inactive'),
                                'bg-white hover:bg-gray-50' => ($item->status == 'active'),
                                ]); ?>"
                                    wire:key='table-<?php echo e($item->id . '-' . $loop->index . microtime()); ?>'
                                    href="javascript:;"
                                    <?php if($item->activeOrder): ?>
                                        wire:click='showTableOrderDetail(<?php echo e($item->id); ?>)'
                                    <?php else: ?>
                                        wire:click='showTableOrder(<?php echo e($item->id); ?>)'
                                    <?php endif; ?>
                                >
                                <div class="flex items-center gap-4 justify-between w-full">
                                    <div class="flex items-center gap-x-2">
                                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['p-3 rounded-lg tracking-wide ',
                                    'bg-green-100 text-green-600' => ($item->available_status == 'available'),
                                    'bg-red-100 text-red-600' => ($item->available_status == 'reserved'),
                                    'bg-blue-100 text-blue-600' => ($item->available_status == 'running')]); ?>">
                                        <h3 wire:loading.class.delay='opacity-50'
                                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['font-semibold']); ?>">
                                            <?php echo e($item->table_code); ?>

                                        </h3>
                                    </div>
                                    <!-- Lock indicator for locked tables -->
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLocked): ?>
                                        <div wire:key="lock-list-<?php echo e($item->id . '-' . $loop->index . microtime()); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_' . user()->restaurant_id)): ?>
                                                <!-- Admin can unlock any table -->
                                                <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                        'p-1 relative rounded-full group shadow-sm hover:shadow-md transition-all duration-200 text-white text-xs',
                                                        'bg-blue-500 hover:bg-blue-600' => $isLockedByCurrentUser,
                                                        'bg-red-500 hover:bg-red-600' => !$isLockedByCurrentUser,
                                                    ]); ?>"
                                                    title="<?php echo e($isLockedByCurrentUser ? __('modules.table.lockedByYou') : __('modules.table.forceUnlock')); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <!-- Locked icon (shows by default) -->
                                                    <svg class="w-4 h-4 group-hover:opacity-0 group-hover:scale-0 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                    </svg>

                                                    <!-- Unlock icon (shows on hover) -->
                                                    <svg class="w-4 h-4 absolute inset-0 m-auto opacity-0 scale-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0  0 1 1-1Z"/>
                                                    </svg>
                                                </button>
                                            <?php elseif($isLockedByCurrentUser): ?>
                                                <!-- User can unlock their own locked tables -->
                                                <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                    class="bg-blue-500 text-white p-1 rounded-full shadow hover:shadow-md transition-all duration-200"
                                                    title="<?php echo app('translator')->get('modules.table.lockedByYou'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                                                    </svg>
                                                </button>
                                            <?php else: ?>
                                                <!-- Other users can only see the lock status -->
                                                <div class="bg-orange-500 text-white p-1 rounded-full shadow cursor-help hover:shadow-md transition-all duration-200"
                                                    title="<?php echo app('translator')->get('modules.table.locked'); ?> by <?php echo e($item->tableSession?->lockedByUser->name ?? 'Unknown'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                    </svg>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="space-y-1">
                                        <p
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-xs font-medium dark:text-neutral-200 text-gray-500']); ?>">
                                            <?php echo e($item->seating_capacity); ?> <?php echo app('translator')->get('modules.table.seats'); ?>
                                        </p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status == 'inactive'): ?>
                                            <div class="inline-flex text-xs gap-1 text-red-600 font-semibold">
                                                <?php echo app('translator')->get('app.inactive'); ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <p class="text-sm font-medium dark:text-neutral-400">
                                            <?php echo e($item->activeOrder ? $item->activeOrder->kot->count() . ' ' . __('modules.order.kot') : ''); ?>

                                        </p>

                                        <!-- Waiter Assignment Select -->
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($waiters) && !user()->hasRole('Waiter_' . user()->restaurant_id)): ?>
                                        <button wire:click.stop='showWaiterSelect(<?php echo e($item->id); ?>)' class="text-xs px-2 py-1 rounded-md border border-gray-300 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                          <?php echo app('translator')->get('modules.table.assignWaiter'); ?>
                                        </button>
                                      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                    <div class="flex items-center gap-4 justify-between w-full">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->activeOrder): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user_can('Show Order')): ?>
                                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click.stop' => 'showTableOrderDetail('.e($item->id).')','class' => 'text-xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click.stop' => 'showTableOrderDetail('.e($item->id).')','class' => 'text-xs']); ?><?php echo app('translator')->get('modules.order.showOrder'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->activeOrder->status == 'kot' && user_can('Create Order')): ?>
                                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['class' => 'text-xs','wire:click.stop' => 'showTableOrder('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-xs','wire:click.stop' => 'showTableOrder('.e($item->id).')']); ?><?php echo app('translator')->get('modules.order.newKot'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isReservationActive): ?>
                                            <div class="inline-flex flex-col items-start text-xs font-medium px-2 py-1 rounded uppercase tracking-wide whitespace-nowrap bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-400 border border-red-400">
                                                <span><?php echo app('translator')->get('modules.table.reserved'); ?></span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user_can('Update Table')): ?>
                                        <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click.stop' => 'showEditTable('.e($item->id).')','class' => 'text-xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click.stop' => 'showEditTable('.e($item->id).')','class' => 'text-xs']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                                    </div>
                            </a>
                            <!-- End Card -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
        <!-- End Card Section -->

    </div>

    
    <div
        x-cloak
        class="jetstream-modal fixed inset-0 overflow-y-auto overflow-x-hidden px-4 py-6 sm:px-0 z-40"
        style="display: none;"
        x-show="addTableOpen"
        x-on:keydown.escape.window="closeAddTable()"
        @close-add-table-modal.window="closeAddTable()"
        >
        <div
            x-show="addTableOpen"
            class="fixed inset-0 transform transition-all"
            x-on:click="closeAddTable()"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div
            x-show="addTableOpen"
            class="mb-6 bg-white dark:bg-gray-800 overflow-y-auto overflow-x-hidden shadow-xl transform transition-all fixed top-0 left-0 right-0 w-screen max-w-full sm:left-auto sm:right-0 sm:w-full h-screen sm:max-w-md flex flex-col"
            x-trap.noscroll="addTableOpen"
            x-on:click.stop
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
        >
            <div class="px-6 py-4 flex-1">
                <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    <?php echo e(__("modules.table.addTable")); ?>

                </div>
                <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.addTable');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4258111069-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <button type="button" @click="closeAddTable()"
                    class="inline-flex items-center px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <?php echo e(__('app.close')); ?>

                </button>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTable): ?>
    <?php if (isset($component)) { $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.right-modal','data' => ['wire:model.live' => 'showEditTableModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('right-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showEditTableModal']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo e(__("modules.table.editTable")); ?>

         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.editTable', ['activeTable' => $activeTable]);

$__key = str()->random(50);

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4258111069-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => '$set(\'showEditTableModal\', false)','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$set(\'showEditTableModal\', false)','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('app.close')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $attributes = $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $component = $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Assign Waiter Modal -->
    <?php if (isset($component)) { $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.right-modal','data' => ['wire:model.live' => 'showAssignWaiterModal','maxWidth' => 'md','wire:key' => 'assign-waiter-modal-'.e($selectedTableId ?? 'new').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('right-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showAssignWaiterModal','maxWidth' => 'md','wire:key' => 'assign-waiter-modal-'.e($selectedTableId ?? 'new').'']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTable): ?>
                <?php echo e(__('modules.table.assignWaiter')); ?> - <?php echo e($selectedTable->table_code ?? ''); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTable): ?>
                <div class="mt-6" wire:key="assign-form-<?php echo e($selectedTableId); ?>">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.assign-waiter-to-table-form', ['tableId' => $selectedTableId]);

$__key = 'assign-waiter-' . $selectedTableId;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4258111069-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex gap-2">
                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => '$set(\'showAssignWaiterModal\', false)','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$set(\'showAssignWaiterModal\', false)','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('app.close')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$dispatch(\'saveWaiterAssignment\')','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('app.save')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $attributes = $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $component = $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>

    <!-- Update Waiter Assignment Modal -->
    <?php if (isset($component)) { $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.right-modal','data' => ['wire:model.live' => 'showUpdateWaiterModal','maxWidth' => 'md','wire:key' => 'update-waiter-modal-'.e($selectedTableId ?? 'new').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('right-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showUpdateWaiterModal','maxWidth' => 'md','wire:key' => 'update-waiter-modal-'.e($selectedTableId ?? 'new').'']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTable): ?>
                <?php echo e(__('modules.table.updateWaiterAssignment')); ?> - <?php echo e($selectedTable->table_code ?? ''); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTable): ?>
                <div class="mt-6" wire:key="update-form-<?php echo e($selectedTableId); ?>">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.update-waiter-to-table-form', ['tableId' => $selectedTableId]);

$__key = 'update-waiter-' . $selectedTableId;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4258111069-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex gap-2">
                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => '$set(\'showUpdateWaiterModal\', false)','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$set(\'showUpdateWaiterModal\', false)','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('app.close')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'showUpdateConfirmation','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('app.update')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $attributes = $__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__attributesOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13)): ?>
<?php $component = $__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13; ?>
<?php unset($__componentOriginal2b7129b9a6e7f6a1be2b5d072517af13); ?>
<?php endif; ?>

    <!-- Update Confirmation Modal -->
    <?php if (isset($component)) { $__componentOriginal5b8b2d0f151a30be878e1a760ec3900c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirmation-modal','data' => ['wire:model.defer' => 'showUpdateConfirmationModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.defer' => 'showUpdateConfirmationModal']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo e(__('app.update')); ?> <?php echo e(__('modules.table.assignWaiter')); ?>?
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentWaiter && $this->currentWaiterUser): ?>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <?php echo e(__('modules.table.currentWaiter')); ?>: <strong><?php echo e($this->currentWaiterUser->name); ?></strong>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    <?php echo e(__('messages.waiterAssignmentUpdateConfirmation')); ?>

                </p>
            <?php else: ?>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <?php echo e(__('messages.waiterAssignmentUpdateConfirmation')); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => '$set(\'showUpdateConfirmationModal\', false)','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$set(\'showUpdateConfirmationModal\', false)','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('app.cancel')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-3','wire:click' => 'confirmUpdateWaiter','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('app.update')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c)): ?>
<?php $attributes = $__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c; ?>
<?php unset($__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b8b2d0f151a30be878e1a760ec3900c)): ?>
<?php $component = $__componentOriginal5b8b2d0f151a30be878e1a760ec3900c; ?>
<?php unset($__componentOriginal5b8b2d0f151a30be878e1a760ec3900c); ?>
<?php endif; ?>

</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/table/tables.blade.php ENDPATH**/ ?>