<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div >
                <h1 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('menu.qrCodes'); ?></h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col my-4 px-4">
        <div class="mb-6 lg:flex lg:justify-between">
            <ul class="inline-flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 mb-4">
                <li class="me-2" wire:key='area-fltr-<?php echo e(microtime()); ?>'>
                    <a href="javascript:;" wire:click="$set('areaID', null)"
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'inline-block px-4 py-3 rounded-lg',
                            'text-skin-base dark:bg-skin-base/[.1] bg-skin-base/[.2]' => is_null(
                                $areaID),
                            'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white' => !is_null(
                                $areaID),
                        ]); ?>"><?php echo app('translator')->get('modules.table.allAreas'); ?></a>
                </li>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="me-2" wire:key='area-fltr-<?php echo e($item->id . microtime()); ?>'>
                        <a href="javascript:;" wire:click="$set('areaID', '<?php echo e($item->id); ?>')"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'inline-block px-4 py-3 rounded-lg',
                                'text-skin-base dark:bg-skin-base/[.1] bg-skin-base/[.2]' =>
                                    $areaID == $item->id,
                                'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white' =>
                                    $areaID != $item->id,
                            ]); ?>">
                            <?php echo e($item->area_name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            </ul>

            <div
                class="inline-flex items-center gap-3 lg:fixed bottom-10 right-5 lg:bg-white lg:px-3 lg:py-2 lg:shadow-md lg:rounded-md">
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-circle-fill text-green-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <?php echo app('translator')->get('modules.table.available'); ?>
                </div>
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-circle-fill text-blue-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <?php echo app('translator')->get('modules.table.running'); ?>
                </div>
                <div class="inline-flex items-center text-sm text-gray-600 gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-circle-fill text-red-500" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <?php echo app('translator')->get('modules.table.reserved'); ?>
                </div>
            </div>

        </div>

        <!-- Card Section -->
        <div class="space-y-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($areaID) && branch()->qRCodeUrl): ?>
                <div class="flex flex-col gap-3 sm:gap-4 space-y-1" wire:key='area-mainqr-<?php echo e(microtime()); ?>'>
                    <!-- Card -->
                    <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                        <div class='group flex flex-col gap-3 border shadow-sm rounded-lg hover:shadow-md transition dark:bg-gray-700 dark:border-gray-600 p-3'
                            href="javascript:;">
                            <div class="w-full flex justify-center">
                                <img src="<?php echo e(branch()->qRCodeUrl); ?>" alt="QR Code">
                            </div>
                            <div class="flex items-center gap-4 justify-center w-full">
                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'downloadBranchQrCode','class' => 'text-xs','dataTooltipTarget' => 'download-tooltip-toggle','type' => 'button','dataTooltipPlacement' => 'top','ariaLabel' => '@lang(\'app.download\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'downloadBranchQrCode','class' => 'text-xs','data-tooltip-target' => 'download-tooltip-toggle','type' => 'button','data-tooltip-placement' => 'top','aria-label' => '@lang(\'app.download\')']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
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
                                <div id="download-tooltip-toggle" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    <?php echo app('translator')->get('app.download'); ?>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <?php if (isset($component)) { $__componentOriginala6c1b2378c7a756a2b58951b1494d68f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6c1b2378c7a756a2b58951b1494d68f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-link','data' => ['target' => '_blank','href' => route('table_order', [restaurant()->id]) .
                                    '?branch=' .branch()->unique_hash .'&hash='. restaurant()->hash .'&from_qr=1','class' => 'text-xs','dataTooltipTarget' => 'visit-tooltip-toggle','type' => 'button','dataTooltipPlacement' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['target' => '_blank','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('table_order', [restaurant()->id]) .
                                    '?branch=' .branch()->unique_hash .'&hash='. restaurant()->hash .'&from_qr=1'),'class' => 'text-xs','data-tooltip-target' => 'visit-tooltip-toggle','type' => 'button','data-tooltip-placement' => 'top']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6c1b2378c7a756a2b58951b1494d68f)): ?>
<?php $attributes = $__attributesOriginala6c1b2378c7a756a2b58951b1494d68f; ?>
<?php unset($__attributesOriginala6c1b2378c7a756a2b58951b1494d68f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6c1b2378c7a756a2b58951b1494d68f)): ?>
<?php $component = $__componentOriginala6c1b2378c7a756a2b58951b1494d68f; ?>
<?php unset($__componentOriginala6c1b2378c7a756a2b58951b1494d68f); ?>
<?php endif; ?>
                                <div id="visit-tooltip-toggle" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    <?php echo app('translator')->get('app.visitLink'); ?>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'generateQrCode','class' => 'text-xs','type' => 'button','dataTooltipTarget' => 'generate-qr-code-tooltip-toggle','dataTooltipPlacement' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'generateQrCode','class' => 'text-xs','type' => 'button','data-tooltip-target' => 'generate-qr-code-tooltip-toggle','data-tooltip-placement' => 'top']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
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

                                <div id="generate-qr-code-tooltip-toggle" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    <?php echo app('translator')->get('modules.table.generateQrCode'); ?>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col gap-3 sm:gap-4 space-y-1" wire:key='area-<?php echo e($area->id . microtime()); ?>'>
                    <h3 class="f-15 font-medium inline-flex gap-2 items-center dark:text-neutral-200">
                        <?php echo e($area->area_name); ?>

                        <span
                            class="px-2 py-1 text-sm rounded bg-slate-100 border-gray-300 border text-gray-800 "><?php echo e($area->tables->count()); ?>

                            <?php echo app('translator')->get('modules.table.table'); ?></span>
                    </h3>
                    <!-- Card -->

                    <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'group flex flex-col gap-3 border shadow-sm rounded-lg hover:shadow-md transition dark:bg-gray-700 dark:border-gray-600 p-3',
                                'bg-red-50' => $item->status == 'inactive',
                                'bg-white' => $item->status == 'active',
                            ]); ?>" wire:key='table-<?php echo e($item->id . microtime()); ?>'
                                href="javascript:;">

                                <div class="flex items-center gap-4 justify-between w-full">
                                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'p-3 rounded-lg tracking-wide ',
                                        'bg-green-100 text-green-600' => $item->available_status == 'available',
                                        'bg-red-100 text-red-600' => $item->available_status == 'reserved',
                                        'bg-blue-100 text-blue-600' => $item->available_status == 'running',
                                    ]); ?>">
                                        <h3 wire:loading.class.delay='opacity-50' class="<?php echo \Illuminate\Support\Arr::toCssClasses(['font-semibold']); ?>">
                                            <?php echo e($item->table_code); ?>

                                        </h3>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-xs font-medium dark:text-neutral-200 text-gray-500']); ?>">
                                            <?php echo e($item->seating_capacity); ?> <?php echo app('translator')->get('modules.table.seats'); ?>
                                        </p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->available_status == 'reserved'): ?>
                                            <div class="px-1 py-0.5 border border-red-700 text-xs text-red-700 rounded">
                                                <?php echo app('translator')->get('modules.table.reserved'); ?></div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status == 'inactive'): ?>
                                            <div class="inline-flex text-xs gap-1 text-red-600 font-semibold">
                                                <?php echo app('translator')->get('app.inactive'); ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>

                                <div class="w-full flex justify-center">
                                    <img src="<?php echo e($item->qRCodeUrl); ?>" alt="">
                                </div>

                                <div class="flex items-center gap-4 justify-center w-full">
                                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'downloadQrCode(\''.e($item->table_code).'\', \''.e($item->branch_id).'\')','class' => 'text-xs','dataTooltipTarget' => 'download-tooltip-toggle-'.e($item->id).'','type' => 'button','dataTooltipPlacement' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'downloadQrCode(\''.e($item->table_code).'\', \''.e($item->branch_id).'\')','class' => 'text-xs','data-tooltip-target' => 'download-tooltip-toggle-'.e($item->id).'','type' => 'button','data-tooltip-placement' => 'top']); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
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

                                    <div id="download-tooltip-toggle-<?php echo e($item->id); ?>" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        <?php echo app('translator')->get('app.download'); ?>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <?php if (isset($component)) { $__componentOriginala6c1b2378c7a756a2b58951b1494d68f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6c1b2378c7a756a2b58951b1494d68f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-link','data' => ['target' => '_blank','href' => ''.e(route('table_order', [$item->hash]) . '?hash=' . restaurant()->hash).'','class' => 'text-xs','dataTooltipTarget' => 'visit-tooltip-toggle-'.e($item->id).'','type' => 'button','dataTooltipPlacement' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['target' => '_blank','href' => ''.e(route('table_order', [$item->hash]) . '?hash=' . restaurant()->hash).'','class' => 'text-xs','data-tooltip-target' => 'visit-tooltip-toggle-'.e($item->id).'','type' => 'button','data-tooltip-placement' => 'top']); ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6c1b2378c7a756a2b58951b1494d68f)): ?>
<?php $attributes = $__attributesOriginala6c1b2378c7a756a2b58951b1494d68f; ?>
<?php unset($__attributesOriginala6c1b2378c7a756a2b58951b1494d68f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6c1b2378c7a756a2b58951b1494d68f)): ?>
<?php $component = $__componentOriginala6c1b2378c7a756a2b58951b1494d68f; ?>
<?php unset($__componentOriginala6c1b2378c7a756a2b58951b1494d68f); ?>
<?php endif; ?>


                                    <div id="visit-tooltip-toggle-<?php echo e($item->id); ?>" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        <?php echo app('translator')->get('app.visitLink'); ?>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'generateQrCode(\''.e($item->id).'\')','class' => 'text-xs','type' => 'button','dataTooltipTarget' => 'generate-qr-code-tooltip-toggle-'.e($item->id).'','dataTooltipPlacement' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'generateQrCode(\''.e($item->id).'\')','class' => 'text-xs','type' => 'button','data-tooltip-target' => 'generate-qr-code-tooltip-toggle-'.e($item->id).'','data-tooltip-placement' => 'top']); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
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

                                    <div id="generate-qr-code-tooltip-toggle-<?php echo e($item->id); ?>" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        <?php echo app('translator')->get('modules.table.generateQrCode'); ?>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>


                                </div>
                            </div>
                            <!-- End Card -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
        <!-- End Card Section -->


    </div>

</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/qr-code/qr-codes.blade.php ENDPATH**/ ?>