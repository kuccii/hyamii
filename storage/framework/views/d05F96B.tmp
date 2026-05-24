<?php

app()->setLocale(session('customer_locale', app()->getLocale()));
?>

<div>
    <!-- Order Type Selection Modal -->
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showOrderTypeModal','maxWidth' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showOrderTypeModal','maxWidth' => 'xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <div class="text-center">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    <?php echo app('translator')->get('modules.order.selectOrderType'); ?>
                </h2>
                <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                    <?php echo app('translator')->get('modules.order.selectOrderTypeDescription'); ?>
                </p>
            </div>
         <?php $__env->endSlot(); ?>
         <?php $__env->slot('content', null, []); ?> 
            <div class="grid grid-cols-1 gap-3 py-2 sm:grid-cols-2 lg:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderTypes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType->type === 'room_service' || $orderType->slug === 'room_service'): ?>
                        <?php continue; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <button
                        type="button"
                        wire:click="selectOrderTypeFromModal(<?php echo e($orderType->id); ?>)"
                        class="group flex flex-col items-center justify-center p-5 transition-all duration-200 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-md hover:-translate-y-0.5 hover:border-[rgb(var(--color-base))] dark:hover:border-[rgb(var(--color-base))]"
                        wire:key="modal-order-type-<?php echo e($orderType->id); ?>">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-14 h-14 mb-3 rounded-xl transition-all duration-200 group-hover:scale-110"
                             style="background-color: rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.08)">
                            <svg class="w-7 h-7" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType->type === 'dine_in'): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                <?php elseif($orderType->type === 'delivery'): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                <?php elseif($orderType->type === 'pickup'): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </svg>
                        </div>

                        <!-- Order Type Name -->
                        <span class="text-base font-semibold text-gray-900 dark:text-white">
                            <?php echo e($orderType->translated_name); ?>

                        </span>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType->type === 'dine_in'): ?>
                            <span class="mt-1.5 text-xs text-center text-gray-500 dark:text-gray-400 leading-relaxed">
                                <?php echo app('translator')->get('messages.dineInDescription'); ?>
                            </span>
                        <?php elseif($orderType->type === 'delivery'): ?>
                            <span class="mt-1.5 text-xs text-center text-gray-500 dark:text-gray-400 leading-relaxed">
                                <?php echo app('translator')->get('messages.deliveryDescription'); ?>
                            </span>
                        <?php elseif($orderType->type === 'pickup'): ?>
                            <span class="mt-1.5 text-xs text-center text-gray-500 dark:text-gray-400 leading-relaxed">
                                <?php echo app('translator')->get('messages.pickupDescription'); ?>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <!-- No footer buttons - force selection -->
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <!-- Location Access Modal -->
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.defer' => 'showLocationModal','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.defer' => 'showLocationModal','maxWidth' => 'sm']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('app.locationAccess'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                <p><?php echo app('translator')->get('app.locationAccessMessage'); ?></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    <?php echo app('translator')->get('app.locationAccessOptional'); ?>
                </p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-xs mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex gap-3">
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-1 h-9 inline-flex items-center justify-center border-0 px-3 py-2','wire:click' => 'requestCustomerLocation']); ?>
                    <?php echo app('translator')->get('app.allow'); ?>
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

                <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-1 h-9 inline-flex items-center justify-center px-3 py-2','wire:click' => '$toggle(\'showLocationModal\')','wire:loading.attr' => 'disabled']); ?>
                    <?php echo app('translator')->get('app.cancel'); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>




    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isHeaderDisabled): ?>
        <section class="px-4 bg-white dark:bg-gray-900">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($headerType === 'text'): ?>
                <div class="py-4 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
                    <h1 class="text-3xl lg:text-4xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">
                        <?php echo e($headerText); ?>

                    </h1>
                </div>
                <?php elseif($headerType === 'image' && count($headerImages) > 0): ?>
                <!-- Image Carousel -->
                <div id="default-carousel" class="relative w-full touch-pan-y" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-24 overflow-hidden border border-gray-200 rounded-lg shadow-lg sm:h-32 md:h-40 lg:h-48 dark:border-gray-700">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $headerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Item <?php echo e($index + 1); ?> -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="<?php echo e($image->image_url); ?>"
                                    class="absolute block object-cover w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="<?php echo e($image->alt_text ?? 'Header Image'); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php elseif($headerType === 'image' && count($headerImages) > 0): ?>
                    <!-- Image Carousel -->
                    <div id="default-carousel" class="relative w-full touch-pan-y" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-24 overflow-hidden border border-gray-200 rounded-lg shadow-lg sm:h-32 md:h-40 lg:h-48 dark:border-gray-700">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $headerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Item <?php echo e($index + 1); ?> -->
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="<?php echo e($image->image_url); ?>"
                                        class="absolute block object-cover w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="<?php echo e($image->alt_text ?? 'Header Image'); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($headerImages) > 1): ?>
                            <!-- Slider indicators -->
                            <div class="absolute z-30 flex space-x-2 -translate-x-1/2 bottom-3 sm:bottom-5 left-1/2 sm:space-x-3 rtl:space-x-reverse">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $headerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button"
                                            class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-200 <?php echo e($index === 0 ? 'bg-white dark:bg-gray-200' : 'bg-white/50 dark:bg-gray-200/50 hover:bg-white/75 dark:hover:bg-gray-200/75'); ?>"
                                            aria-current="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                            aria-label="Slide <?php echo e($index + 1); ?>"
                                            data-carousel-slide-to="<?php echo e($index); ?>"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Slider controls - Hidden on mobile for better touch experience -->
                            <button type="button" class="absolute top-0 z-30 items-center justify-center hidden h-full px-2 cursor-pointer start-0 sm:flex sm:px-4 group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-3 h-3 text-white sm:w-4 sm:h-4 dark:text-gray-200 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 z-30 items-center justify-center hidden h-full px-2 cursor-pointer end-0 sm:flex sm:px-4 group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-3 h-3 text-white sm:w-4 sm:h-4 dark:text-gray-200 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Default header if no custom settings -->
                    <div
                    class="py-4 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
                    <h1
                        class="text-3xl lg:text-4xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">
                            <?php echo app('translator')->get('messages.frontHeroHeading'); ?></h1>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$showCart && !$showOrderTypeModal): ?>

        
        <div class="px-4 my-6" x-data="{ showAll: false }">
            <h4 class="font-label text-xs uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-3 font-semibold"><?php echo app('translator')->get('modules.menu.menu'); ?></h4>
            
            <div class="flex items-center gap-3 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory">
                <!-- All Menu Pill -->
                <button type="button"
                    wire:click='filterMenuItems(null)'
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'snap-start flex-shrink-0 px-6 py-3 rounded-xl border font-semibold text-sm transition-all duration-300 flex items-center gap-2.5',
                        'bg-[rgb(163,59,56)] text-white border-transparent shadow-[0_8px_20px_-6px_rgba(163,59,56,0.35)]' => is_null($menuId),
                        'bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800 hover:border-[rgb(163,59,56)] dark:hover:border-[rgb(163,59,56)] hover:shadow-sm' => !is_null($menuId),
                    ]); ?>"
                    wire:key='menu-all-pill'>
                    <span class="material-symbols-outlined text-lg">restaurant_menu</span>
                    <span><?php echo app('translator')->get('app.showAll'); ?></span>
                </button>

                <!-- Dynamic Menu Pills -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->menuList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <button type="button"
                        wire:click='filterMenuItems(<?php echo e($item->id); ?>)'
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'snap-start flex-shrink-0 px-6 py-3 rounded-xl border font-semibold text-sm transition-all duration-300 flex items-center gap-2.5',
                            'bg-[rgb(163,59,56)] text-white border-transparent shadow-[0_8px_20px_-6px_rgba(163,59,56,0.35)]' => $menuId == $item->id,
                            'bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800 hover:border-[rgb(163,59,56)] dark:hover:border-[rgb(163,59,56)] hover:shadow-sm' => $menuId != $item->id,
                        ]); ?>"
                        wire:key='menu-pill-<?php echo e($item->id); ?>'>
                        <span class="material-symbols-outlined text-lg">dinner_dining</span>
                        <span><?php echo e($item->getTranslation('menu_name', session('locale', app()->getLocale()))); ?></span>
                        <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'text-xs px-2 py-0.5 rounded-full font-label font-medium',
                            'bg-white/20 text-white' => $menuId == $item->id,
                            'bg-gray-100 dark:bg-gray-850 text-gray-500 dark:text-gray-400' => $menuId != $item->id,
                        ]); ?>"><?php echo e($item->items_count); ?></span>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="inline-flex items-center text-sm text-gray-400 font-light">
                        <?php echo app('translator')->get('messages.noMenuAdded'); ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="mx-4 mt-6">
            <h4 class="font-label text-xs uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-3 font-semibold"><?php echo app('translator')->get('modules.menu.category'); ?></h4>
            
            <!-- Mobile Custom Selector Dropdown (Sleek Glassmorphic Pill) -->
            <div class="relative lg:hidden mb-4" x-data="{ open: false }">
                <button type="button" @click="open = !open" @click.away="open = false"
                    class="w-full bg-white/70 dark:bg-gray-900/60 backdrop-blur-md border border-gray-200 dark:border-gray-800 text-gray-800 dark:text-gray-200 rounded-xl px-4 py-3 flex items-center justify-between shadow-sm hover:bg-white dark:hover:bg-gray-900 transition-all duration-200">
                    <span class="text-sm font-semibold truncate flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-gray-400">layers</span>
                        <?php echo e(is_null($filterCategories) ? __('app.showAll') : $this->categoryList->firstWhere('id', $filterCategories)?->getTranslation('category_name', session('locale', app()->getLocale()))); ?>

                    </span>
                    <svg class="w-4 h-4 transition-transform duration-250 text-gray-400" :class="{ 'rotate-180': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute left-0 right-0 z-50 mt-2 overflow-hidden bg-white/95 dark:bg-gray-950/95 backdrop-blur-lg rounded-xl shadow-xl border border-gray-200 dark:border-gray-800">
                    <div class="overflow-y-auto max-h-80 py-1.5">
                        <button wire:click="filterMenu(null); $nextTick(() => { open = false })"
                            class="w-full px-4 py-2.5 text-left text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors flex items-center justify-between
                            <?php echo e(is_null($filterCategories) ? 'bg-[rgb(163,59,56)]/10 text-[rgb(163,59,56)]' : 'text-gray-700 dark:text-gray-300'); ?>">
                            <span><?php echo app('translator')->get('app.showAll'); ?></span>
                            <span class="material-symbols-outlined text-base">check</span>
                        </button>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button wire:click="filterMenu(<?php echo e($item->id); ?>); $nextTick(() => { open = false })"
                                class="w-full px-4 py-2.5 text-left text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors flex items-center justify-between
                                <?php echo e($filterCategories == $item->id ? 'bg-[rgb(163,59,56)]/10 text-[rgb(163,59,56)]' : 'text-gray-700 dark:text-gray-300'); ?>">
                                <span><?php echo e($item->getTranslation('category_name', session('locale', app()->getLocale()))); ?></span>
                                <span class="px-2 py-0.5 text-xs font-semibold bg-gray-150/80 dark:bg-gray-800/80 rounded-full text-gray-500 dark:text-gray-400">
                                    <?php echo e($item->items_count); ?>

                                </span>
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Desktop Category Navigation (Sleek Outline Capsule Bar) -->
            <div class="hidden p-2 rounded-xl lg:block bg-gray-50 dark:bg-gray-950 border border-gray-200/50 dark:border-gray-850">
                <nav class="flex gap-1.5 overflow-x-auto scrollbar-none py-1" aria-label="Categories">
                    <button type="button" wire:click="filterMenu(null)" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all whitespace-nowrap flex items-center gap-1.5',
                        'bg-white dark:bg-gray-900 text-[rgb(163,59,56)] shadow-sm border border-gray-200 dark:border-gray-800' => is_null($filterCategories),
                        'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-100/50 dark:hover:bg-gray-900/50' => !is_null($filterCategories),
                    ]); ?>">
                        <span><?php echo app('translator')->get('app.showAll'); ?></span>
                    </button>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" wire:click="filterMenu(<?php echo e($item->id); ?>)"
                            wire:key="category-desktop-<?php echo e($item->id); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all whitespace-nowrap inline-flex items-center gap-2',
                                'bg-white dark:bg-gray-900 text-[rgb(163,59,56)] shadow-sm border border-gray-200 dark:border-gray-800' => $filterCategories == $item->id,
                                'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 hover:bg-gray-100/50 dark:hover:bg-gray-900/50' => $filterCategories != $item->id,
                            ]); ?>">
                            <span><?php echo e($item->getTranslation('category_name', session('locale', app()->getLocale()))); ?></span>
                            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'px-2 py-0.5 text-xs rounded-full font-label font-bold',
                                'bg-[rgb(163,59,56)]/10 text-[rgb(163,59,56)]' => $filterCategories == $item->id,
                                'bg-gray-150 dark:bg-gray-800 text-gray-500' => $filterCategories != $item->id,
                            ]); ?>">
                                <?php echo e($item->items_count); ?>

                            </span>
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </nav>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mx-4 my-8 items-end">
            
            <div class="md:col-span-2">
                <label for="menu_name" class="block mb-1.5 font-label text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                    <?php echo app('translator')->get('modules.menu.searchMenuItems'); ?>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                        <span class="material-symbols-outlined text-lg">search</span>
                    </span>
                    <input id="menu_name" 
                        class="block w-full font-label pl-10 pr-4 py-3 bg-white/70 dark:bg-gray-900/40 backdrop-blur-sm border border-gray-200 dark:border-gray-800 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/20 focus:border-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition-all duration-200" 
                        type="text"
                        placeholder="<?php echo e(__('placeholders.searchMenuItems')); ?>" 
                        wire:model.live.debounce.500ms="search" />
                </div>
            </div>

            
            <div class="flex items-center justify-start md:justify-end gap-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant?->show_veg): ?>
                    <label class="inline-flex items-center cursor-pointer group" id="veg_toggle">
                        <input type="checkbox" value="1" wire:model.live='showVeg' class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 dark:bg-gray-800 rounded-full peer peer-checked:bg-emerald-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:after:translate-x-full border border-transparent peer-focus:ring-2 peer-focus:ring-emerald-500/20"></div>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 ms-3 font-label group-hover:text-gray-900 dark:group-hover:text-white transition duration-200">
                            <?php echo app('translator')->get('modules.menu.typeVeg'); ?>
                        </span>
                    </label>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant?->show_halal): ?>
                    <label class="inline-flex items-center cursor-pointer group" id="halal_toggle">
                        <input type="checkbox" value="1" wire:model.live='showHalal' class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 dark:bg-gray-800 rounded-full peer peer-checked:bg-emerald-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:after:translate-x-full border border-transparent peer-focus:ring-2 peer-focus:ring-emerald-500/20"></div>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 ms-3 font-label group-hover:text-gray-900 dark:group-hover:text-white transition duration-200">
                            <?php echo app('translator')->get('modules.menu.typeHalal'); ?>
                        </span>
                    </label>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showMenu && !$showOrderTypeModal): ?>
        <div class="px-4 mb-32 space-y-4 lg:gap-8"
            x-data="{
                loadedCount: <?php if ((object) ('menuItemsLoaded') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('menuItemsLoaded'->value()); ?>')<?php echo e('menuItemsLoaded'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('menuItemsLoaded'); ?>')<?php endif; ?>,
                totalCount: <?php echo e($this->totalMenuItemsCount); ?>,
                isLoading: false,

                get allItemsLoaded() {
                    return this.loadedCount >= this.totalCount;
                },

                scrollHandler() {
                    if (this.allItemsLoaded || this.isLoading) {
                        return;
                    }

                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const windowHeight = window.innerHeight;
                    const documentHeight = document.documentElement.scrollHeight;

                    if (documentHeight - scrollTop <= windowHeight + 250) {
                        this.isLoading = true;
                        $wire.loadMoreMenuItems().then(() => {
                            this.isLoading = false;
                        });
                    }
                }
            }"
            x-init="
                window.addEventListener('scroll', () => scrollHandler());
                // Update totalCount when component updates
                $watch('loadedCount', () => {
                    totalCount = <?php echo e($this->totalMenuItemsCount); ?>;
                });
            "
            @scroll.window.throttle.200ms="scrollHandler()">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $itemCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <h3 class="my-4 text-base font-semibold text-gray-900 lg:text-xl dark:text-white"><?php echo e($key); ?>

                </h3>
                <div class="space-y-4 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $itemCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'flex items-center justify-between gap-6 border shadow-sm rounded-lg hover:shadow-md transition dark:border-gray-600 dark:lg:bg-gray-900 dark:shadow-sm lg:rounded-md',
                            'bg-gray-100 dark:bg-gray-800' => !$item->in_stock,
                            'bg-white dark:bg-gray-900' => $item->in_stock,
                                ]); ?>" wire:key='menu-item-<?php echo e($item->id . microtime()); ?>'>
                             <div class="flex w-full p-3 space-x-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant && !$restaurant->hide_menu_item_image_on_customer_site): ?>
                                    <img class="object-cover w-20 h-20 rounded-lg cursor-pointer lg:w-28 lg:h-28 flex-shrink-0 aspect-square"
                                        wire:click="showItemDetail(<?php echo e($item->id); ?>)"
                                        src="<?php echo e($item->item_photo_url); ?>" alt="<?php echo e($item->item_name); ?>">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div
                                    class="flex flex-col w-full gap-1 text-sm font-normal text-gray-500 lg:text-base dark:text-gray-400">
                                    <div
                                        class="inline-flex items-center text-sm font-semibold text-gray-900 lg:text-base dark:text-white">
                                        <img src="<?php echo e(asset('img/' . $item->type . '.svg')); ?>" class="h-4 mr-1"
                                            title="<?php echo app('translator')->get('modules.menu.' . $item->type); ?>" alt="" />
                                        <?php echo e($item->getTranslatedValue('item_name', session('locale'))); ?>

                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                        <div class="w-full text-xs font-normal text-gray-500 cursor-pointer lg:text-sm dark:text-gray-400"
                                            wire:click="showItemDetail(<?php echo e($item->id); ?>)">
                                            <?php echo e(str($item->getTranslatedValue('description', session('locale')))->limit(50)); ?>

                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->preparation_time): ?>
                                        <div
                                            class="inline-flex items-center my-1 text-xs font-normal text-gray-700 dark:text-gray-400 max-w-56">
                                            <?php echo app('translator')->get('modules.menu.preparationTime'); ?> :
                                            <?php echo e($item->preparation_time); ?> <?php echo app('translator')->get('modules.menu.minutes'); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="flex items-center justify-between w-full">
                                        <div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->variations_count == 0): ?>
                                                <span
                                                    class="font-semibold text-gray-900 dark:text-white text-skin-base"><?php echo e(currency_format($item->price, $restaurant->currency_id)); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCreateOrder): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$item->in_stock): ?>
                                                <div class="text-red-500">Out of stock</div>
                                            <?php elseif($restaurant->allow_customer_orders): ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($cartItemQty[$item->id]) && $cartItemQty[$item->id] > 0): ?>
                                                    <div class="relative flex items-center justify-start max-w-24 me-2"
                                                        wire:key='orderItemQty-<?php echo e($item->id); ?>-counter'>
                                                        <button type="button"
                                                            <?php if($item->variations_count > 0): ?> wire:click="subCartItems(<?php echo e($item->id); ?>)"
                                                    <?php elseif($item->modifier_groups_count > 0): ?>
                                                        wire:click="subModifiers(<?php echo e($item->id); ?>)"
                                                    <?php else: ?>
                                                        wire:click="subQty('<?php echo e($item->id); ?>')" <?php endif; ?>
                                                            class="h-8 p-3 border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-s-md">
                                                            <svg class="w-2 h-2 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 2">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 1h16" />
                                                            </svg>
                                                        </button>

                                                        <input type="text"
                                                            wire:model='cartItemQty.<?php echo e($item->id); ?>'
                                                            class="min-w-10 bg-white border-x-0 border-gray-300 h-8 text-center text-gray-900 text-sm  block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                                                            value="1" readonly />
                                                        <button type="button"
                                                            wire:click="
                                                        <?php if($item->variations_count > 0 || $item->modifier_groups_count > 0): ?> addCartItems(<?php echo e($item->id); ?>, <?php echo e($item->variations_count); ?>, <?php echo e($item->modifier_groups_count); ?>)
                                                        <?php else: ?>
                                                            addQty('<?php echo e($item->id); ?>') <?php endif; ?>
                                                    "
                                                            class="h-8 p-3 border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-e-md">
                                                            <svg class="w-2 h-2 text-gray-900 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 18 18">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 1v16M1 9h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                <?php else: ?>
                                                    <?php
                                                        $orderStats = getRestaurantOrderStats($shopBranch->id);
                                                    ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($orderStats['unlimited'] || $orderStats['current_count'] < $orderStats['order_limit'])): ?>
                                                        <?php if (isset($component)) { $__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cart-button','data' => ['wire:click' => 'addCartItems('.e($item->id).', '.e($item->variations_count).' , '.e($item->modifier_groups_count).')','wire:key' => 'item-input-'.e($item->id . microtime()).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cart-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'addCartItems('.e($item->id).', '.e($item->variations_count).' , '.e($item->modifier_groups_count).')','wire:key' => 'item-input-'.e($item->id . microtime()).'']); ?><?php echo app('translator')->get('app.add'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc)): ?>
<?php $attributes = $__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc; ?>
<?php unset($__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc)): ?>
<?php $component = $__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc; ?>
<?php unset($__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc); ?>
<?php endif; ?>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php elseif($item->variations_count > 0 && $restaurant->allow_customer_orders): ?>
                                                <?php if (isset($component)) { $__componentOriginal23a929514ef7d57034cc7b8bddc2b226 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a929514ef7d57034cc7b8bddc2b226 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button-table','data' => ['wire:click' => 'showItemVariations('.e($item->id).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'showItemVariations('.e($item->id).')']); ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="w-4 h-4 mr-1"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                    </svg>
                                                    <?php echo app('translator')->get('modules.menu.showVariations'); ?> (<?php echo e($item->variations_count); ?>)
                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a929514ef7d57034cc7b8bddc2b226)): ?>
<?php $attributes = $__attributesOriginal23a929514ef7d57034cc7b8bddc2b226; ?>
<?php unset($__attributesOriginal23a929514ef7d57034cc7b8bddc2b226); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a929514ef7d57034cc7b8bddc2b226)): ?>
<?php $component = $__componentOriginal23a929514ef7d57034cc7b8bddc2b226; ?>
<?php unset($__componentOriginal23a929514ef7d57034cc7b8bddc2b226); ?>
<?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div
                    class="flex flex-col items-center justify-center p-6 text-center text-gray-500 dark:text-gray-400">
                    <svg width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        fill="none">
                        <path d="M4 14a8 8 0 0 1 16 0z" fill="#e5e7eb" />
                        <rect x="3" y="14" width="18" height="2.5" rx=".5" fill="#d1d5db" />
                        <circle cx="12" cy="4.5" r=".8" fill="#9ca3af" />
                        <circle cx="9.5" cy="10" r=".5" fill="#4b5563" />
                        <circle cx="14.5" cy="10" r=".5" fill="#4b5563" />
                    </svg>
                    <span class="text-lg">
                        <?php echo app('translator')->get('messages.noItemAdded'); ?>
                    </span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="flex items-center justify-center py-6 px-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$this->allItemsLoaded): ?>
                    <div wire:loading wire:target="loadMoreMenuItems" class="flex items-center justify-center gap-3 text-gray-600 dark:text-gray-400">
                        <svg class="inline animate-spin h-6 w-6 text-skin-base" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12zm2 5.291A7.96 7.96 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938z"/>
                        </svg>
                        <span class="text-sm font-medium"><?php echo app('translator')->get('messages.loadingData'); ?></span>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-x-1 text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0"/>
                        </svg>
                        <span class="text-sm font-medium"><?php echo app('translator')->get('messages.allItemsLoaded'); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="fixed inset-x-0 bottom-24 z-10 flex justify-center gap-3 px-4 lg:hidden">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->shouldShowWaiterButtonMobile && $orderTypeSlug === 'dine_in'): ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('forms.callWaiterButton', ['tableNumber' => $table->id ?? null, 'shopBranch' => $shopBranch]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3713676885-0', $__key);

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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null(customer()) && $restaurant->customer_login_required): ?>
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:click' => '$dispatch(\'showSignup\')']); ?><?php echo app('translator')->get('app.login'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartQty > 0): ?>
                <div
                    class="fixed inset-x-0 bottom-1 z-10 mx-3 flex items-center justify-between gap-3 rounded-md bg-skin-base p-3 text-white shadow-lg dark:bg-gray-800 sm:mx-auto sm:max-w-lg lg:max-w-screen-xl">
                    <div class="min-w-0 text-sm font-bold leading-5 sm:text-base">
                        <div class="truncate"><?php echo app('translator')->get('modules.order.totalItem'); ?>: <?php echo e($cartQty); ?></div>
                        <div class="truncate"><?php echo e(currency_format($subTotal, $restaurant->currency_id)); ?> + <?php echo app('translator')->get('modules.order.taxes'); ?></div>
                    </div>

                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'showCartItems','class' => 'flex-shrink-0 whitespace-nowrap']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'showCartItems','class' => 'flex-shrink-0 whitespace-nowrap']); ?><?php echo app('translator')->get('modules.order.viewCart'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCart): ?>

        

        <div class="px-4 mt-4 space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderItemList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between gap-6 transition bg-white border rounded-lg shadow-sm hover:shadow-md dark:border-gray-600 dark:lg:bg-gray-900 dark:shadow-sm"
                    wire:key='menu-item-<?php echo e($item->id . microtime()); ?>'>
                    <div class="flex w-full p-4 space-x-4 dark:bg-gray-800 dark:text-gray-200">
                        <!-- Item Image -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant && !$restaurant->hide_menu_item_image_on_customer_site): ?>

                            <img class="object-cover w-10 h-10 rounded-lg cursor-pointer lg:w-16 lg:h-16"
                                wire:click="showItemDetail(<?php echo e($item->id); ?>)" src="<?php echo e($item->item_photo_url); ?>"
                                alt="<?php echo e($item->item_name); ?>">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Item Details -->
                        <div class="flex-1 min-w-0">
                            <div
                                class="flex flex-col items-start justify-between w-full gap-2 sm:flex-row sm:items-baseline">
                                <!-- Item Name and Details -->
                                <div class="flex flex-wrap items-center gap-2">
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        <img src="<?php echo e(asset('img/' . $item->type . '.svg')); ?>" class="h-4 mr-2"
                                            title="<?php echo app('translator')->get('modules.menu.' . $item->type); ?>" alt="" />
                                        <?php echo e($item->item_name); ?>

                                    </div>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($orderItemVariation[$key])): ?>
                                        <span
                                            class="px-2.5 py-0.5 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-sm text-xs font-sm">
                                            <?php echo e($orderItemVariation[$key]->variation); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    
                                </div>

                                <!-- Quantity Controls and Price -->
                                <div class="flex flex-wrap items-center justify-between gap-3 sm:w-auto md:w-1/3">
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center">
                                        <button type="button" wire:click="subQty('<?php echo e($key); ?>')"
                                            class="h-8 p-2 border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-s-md">
                                            <svg class="w-2 h-2 text-gray-900 dark:text-white" aria-hidden="true"
                                                viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>

                                        <input type="text" wire:model='orderItemQty.<?php echo e($key); ?>'
                                            class="w-12 h-8 text-sm text-center text-gray-900 bg-white border-gray-300 border-x-0 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            readonly />

                                        <button type="button" wire:click="addQty('<?php echo e($key); ?>')"
                                            class="h-8 p-2 border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 rounded-e-md">
                                            <svg class="w-2 h-2 text-gray-900 dark:text-white" aria-hidden="true"
                                                viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Price and Amount -->
                                    <?php
                                        // Use display price (base price without tax for inclusive items)
                                        $displayPrice = $this->getItemDisplayPrice($key);
                                        // Total amount per line (what customer pays)
                                        $totalAmount = $orderItemAmount[$key];
                                    ?>
                                    <div class="flex flex-col items-end gap-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($taxMode === 'item' && $restaurant?->tax_inclusive): ?>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                <?php echo e(currency_format($displayPrice, $restaurant->currency_id)); ?> ×
                                                <?php echo e($orderItemQty[$key]); ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <span
                                            class="text-base font-semibold text-gray-900 dark:text-white text-skin-base whitespace-nowrap">
                                            <?php echo e(currency_format($totalAmount, $restaurant->currency_id)); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Modifiers (Shown below if present) -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($itemModifiersSelected[$key])): ?>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $itemModifiersSelected[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifierOptionId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-skin-base/10 text-skin-base">
                                            <?php echo e($this->modifierOptions[$modifierOptionId]->name); ?>

                                            <span class="ml-1 text-skin-base">
                                                <?php echo e(currency_format($this->modifierOptions[$modifierOptionId]->price, $this->modifierOptions[$modifierOptionId]->modifierGroup->branch->restaurant->currency_id)); ?>

                                            </span>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Item Notes Section -->
                            <div class="mt-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($this->itemNotes[$key]) && !empty($this->itemNotes[$key])): ?>
                                    <div class="flex items-center mt-2">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="w-3.5 h-3.5 mr-1.5" viewBox="0 0 24 24" stroke="currentColor"
                                                fill="none">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8-4-4H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3z" />
                                            </svg>
                                            <span class="mr-1.5"><?php echo e($this->itemNotes[$key]); ?></span>
                                            <button wire:click="$set('itemNotes.<?php echo e($key); ?>', '')"
                                                class="text-gray-400 transition-colors duration-200 hover:text-red-500">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <div x-data="{ showNoteInput: false, noteText: '' }" class="mt-2">
                                        <button x-show="!showNoteInput"
                                            @click="showNoteInput = true; $nextTick(() => $refs.noteInput.focus())"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-full text-gray-700 hover:bg-skin-base/10  hover:text-skin-base dark:text-gray-300 dark:hover:text-gray-200 dark:hover:bg-gray-600 transition-all duration-200 group">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                                class="w-3.5 h-3.5 group-hover:scale-110 transition-transform duration-200"
                                                xml:space="preserve">
                                                <path
                                                    d="M11.3 26.5 4 28l1.5-7.3L21.6 4.5c.8-.8 2.1-.8 2.9 0l2.9 2.9c.8.8.8 2.1 0 2.9zm7.4-19 5.8 5.8m-5.8 0-8.8 8.8"
                                                    style="fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                                            </svg>
                                            <span class="whitespace-nowrap"><?php echo app('translator')->get('modules.order.addNote'); ?></span>
                                        </button>
                                        <div x-show="showNoteInput" x-cloak @click.away="showNoteInput = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            class="flex items-center mt-2">

                                            <div class="flex w-full">
                                                <div class="relative flex-1">
                                                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['xRef' => 'noteInput','xModel' => 'noteText','type' => 'text','class' => 'w-full pr-20 text-sm border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-skin-base focus:border-skin-base','placeholder' => __('placeholders.addItemNotesPlaceholder'),'@keydown.enter' => '$wire.set(\'itemNotes.'.e($key).'\', noteText); showNoteInput = false']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'noteInput','x-model' => 'noteText','type' => 'text','class' => 'w-full pr-20 text-sm border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-skin-base focus:border-skin-base','placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('placeholders.addItemNotesPlaceholder')),'@keydown.enter' => '$wire.set(\'itemNotes.'.e($key).'\', noteText); showNoteInput = false']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                                                    <div
                                                        class="absolute inset-y-0 right-0 flex items-center gap-1 pr-2">
                                                        <button
                                                            @click="$wire.set('itemNotes.<?php echo e($key); ?>', noteText); showNoteInput = false"
                                                            class="p-1.5 text-white rounded-md bg-skin-base hover:bg-skin-base/90 transition-colors duration-200"
                                                            title="<?php echo app('translator')->get('app.save'); ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-3.5 h-3.5" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="m5 13 4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                        <button @click="showNoteInput = false"
                                                            class="p-1.5 text-gray-500 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                                                            title="<?php echo app('translator')->get('app.cancel'); ?>">
                                                            <svg class="w-3.5 h-3.5"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartQty > 0): ?>
                <div>
                    <div
                        class="w-full h-auto p-4 mt-3 space-y-4 text-center rounded select-none bg-gray-50 dark:bg-gray-700">
                        <div class="mb-3">
                            <div x-data="{ showNotes: false }" x-cloak>
                                <!-- Add Note Button -->
                                <div x-show="!showNotes && !$wire.orderNote" class="flex">
                                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['@click' => 'showNotes = true','class' => 'inline-flex items-center gap-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'showNotes = true','class' => 'inline-flex items-center gap-2']); ?>
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        <?php echo app('translator')->get('modules.order.addNote'); ?>
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
                                </div>

                                <!-- Notes Form -->
                                <div x-show="showNotes" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100" class="mt-3">

                                    <div
                                        class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                                        <!-- Header -->
                                        <div
                                            class="flex items-center justify-between p-3 border-b border-gray-200 dark:border-gray-700">
                                            <h3 class="font-medium text-gray-900 dark:text-white">
                                                <?php echo app('translator')->get('modules.order.addNote'); ?>
                                            </h3>
                                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['@click' => 'showNotes = false','class' => '!p-1.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'showNotes = false','class' => '!p-1.5']); ?>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18 18 6M6 6l12 12" />
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
                                        </div>

                                        <!-- Form Content -->
                                        <div class="p-3">
                                            <?php if (isset($component)) { $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['id' => 'orderNote','class' => 'block w-full mt-1','rows' => '3','wire:model.live.debounce.750ms' => 'orderNote','placeholder' => ''.e(__('placeholders.addOrderNotesPlaceholder')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'orderNote','class' => 'block w-full mt-1','rows' => '3','wire:model.live.debounce.750ms' => 'orderNote','placeholder' => ''.e(__('placeholders.addOrderNotesPlaceholder')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Note -->
                                <div x-show="!showNotes && $wire.orderNote"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-3">
                                    <div
                                        class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700/50 dark:border-gray-600">
                                        <!-- Note Icon & Text -->
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-gray-400" width="24" height="24"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M6 11h8V9H6zm0 4h8v-2H6zm0-8h4V5H6zm6-5H5.5A1.5 1.5 0 0 0 4 3.5v13A1.5 1.5 0 0 0 5.5 18h9a1.5 1.5 0 0 0 1.5-1.5V6z"
                                                    fill="currentColor" />
                                            </svg>
                                            <p class="text-sm text-gray-600 dark:text-gray-300"><?php echo e($orderNote); ?>

                                            </p>
                                        </div>

                                        <!-- Edit Button -->
                                        <button @click="showNotes = true"
                                            class="flex items-center gap-1.5 text-skin-base hover:text-skin-base/80 hover:scale-110 p-1">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m15.232 5.232 3.536 3.536m-2.036-5.036a2.5 2.5 0 1 1 3.536 3.536L6.5 21.036H3v-3.572z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                            <div>
                                <?php echo app('translator')->get('modules.order.totalItem'); ?>
                            </div>
                            <div>
                                <?php echo e(count($orderItemList)); ?>

                            </div>
                        </div>

                        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                            <div>
                                <?php echo app('translator')->get('modules.order.subTotal'); ?>
                            </div>
                            <div>
                                <?php echo e(currency_format($subTotal, $restaurant->currency_id)); ?>

                            </div>
                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(
                            count($orderItemList) > 0 && $this->applicableExtraCharges && count($this->applicableExtraCharges) > 0
                        ): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->applicableExtraCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div wire:key="extra-charge-<?php echo e($loop->index); ?>"
                                    class="flex justify-between text-sm text-gray-500 dark:text-neutral-400">
                                    <div class="inline-flex items-center gap-x-1">
                                        <?php echo e($charge->charge_name); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($charge->charge_type == 'percent'): ?>
                                            (<?php echo e($charge->charge_value); ?>%)
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </div>
                                    <div>
                                        <?php echo e(currency_format($charge->getAmount($subTotal), $restaurant->currency_id)); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($taxMode == 'order'): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $taxes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400" wire:key="order-tax-<?php echo e($item->id); ?>">
                                    <div>
                                        <?php echo e($item->tax_name); ?> (<?php echo e($item->tax_percent); ?>%)
                                    </div>
                                    <div>
                                        <?php echo e(currency_format(($item->tax_percent / 100) * $taxBase, $restaurant->currency_id)); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php else: ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($orderItemTaxDetails) && count($orderItemTaxDetails)): ?>
                                <?php
                                    $taxTotals = [];
                                    $totalTax = 0;
                                    foreach ($orderItemTaxDetails as $item) {
                                        $qty = $item['qty'] ?? 1;
                                        foreach ($item['tax_breakup'] as $taxName => $taxInfo) {
                                            if (!isset($taxTotals[$taxName])) {
                                                $taxTotals[$taxName] = [
                                                    'percent' => $taxInfo['percent'],
                                                    'amount' => $taxInfo['amount'] * $qty,
                                                ];
                                            } else {
                                                $taxTotals[$taxName]['amount'] += $taxInfo['amount'] * $qty;
                                            }
                                        }
                                        $totalTax += collect($item['tax_amount'])->sum();
                                    }
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $taxTotals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-neutral-400">
                                        <div>
                                            <?php echo e($taxName); ?> (<?php echo e($taxInfo['percent']); ?>%)
                                        </div>
                                        <div>
                                            <?php echo e(currency_format($taxInfo['amount'], $restaurant->currency_id)); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="flex justify-between mt-2 text-sm text-gray-500 dark:text-neutral-400">
                                    <div>
                                        <?php echo app('translator')->get('modules.order.totalTax'); ?>
                                        <span
                                            class="ml-2 px-2 py-0.5 rounded text-xs bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300">
                                            <?php echo app('translator')->get($restaurant?->tax_inclusive ? 'modules.settings.taxInclusive' : 'modules.settings.taxExclusive'); ?>
                                        </span>
                                    </div>
                                    <div>
                                        <?php echo e(currency_format($totalTax, $restaurant->currency_id)); ?>

                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'delivery' && !is_null($deliveryFee)): ?>
                            <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                                <div>
                                    <?php echo app('translator')->get('modules.delivery.deliveryFee'); ?>
                                </div>
                                <div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deliveryFee > 0): ?>
                                        <?php echo e(currency_format($deliveryFee, $restaurant->currency_id)); ?>

                                    <?php else: ?>
                                        <span class="font-medium text-green-500"><?php echo app('translator')->get('modules.delivery.freeDelivery'); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(function_exists('module_enabled') && module_enabled('Loyalty') && function_exists('restaurant_modules') && in_array('Loyalty', restaurant_modules())): ?>
                            <?php echo $__env->make('loyalty::components.loyalty-discount-display', [
                                'loyaltyPointsRedeemed' => $loyaltyPointsRedeemed ?? 0,
                                'loyaltyDiscountAmount' => $loyaltyDiscountAmount ?? 0,
                                'currencyId' => $restaurant->currency_id,
                                'showEditIcon' => true,
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="flex items-center justify-between font-medium text-gray-900 dark:text-white">
                            <div>
                                <?php echo app('translator')->get('modules.order.total'); ?>
                            </div>
                            <div class="flex items-center gap-2">
                                <span><?php echo e(currency_format($total, $restaurant->currency_id)); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'delivery' && !empty($deliveryAddress)): ?>
                        <div class="w-full h-auto p-4 mt-3 rounded select-none bg-gray-50 dark:bg-gray-700">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-base font-medium text-gray-900 dark:text-white"><?php echo app('translator')->get('modules.delivery.deliveryAddress'); ?></h3>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($deliveryAddress)): ?>
                                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['class' => 'text-xs','wire:click' => '$toggle(\'showDeliveryAddressModal\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-xs','wire:click' => '$toggle(\'showDeliveryAddressModal\')']); ?>
                                        <?php echo app('translator')->get('modules.delivery.changeDeliveryAddress'); ?>
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

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($deliveryAddress)): ?>
                                <div
                                    class="p-3 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 mt-0.5 text-gray-500 dark:text-gray-400 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div class="text-sm text-gray-700 dark:text-gray-300">
                                            <p class="font-medium"><?php echo e($deliveryAddress); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="w-full h-auto pt-3 pb-4 text-center select-none"
                        wire:key='order-<?php echo e(microtime()); ?>'>
                        <div class="flex gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isRestaurantOpenForOrders): ?>
                                <div class="w-full p-3 text-sm font-medium text-center text-red-700 bg-red-50 border border-red-200 rounded-lg dark:bg-red-900/20 dark:text-red-300 dark:border-red-800">
                                    <?php echo e($restaurantClosedMessage); ?>

                                </div>
                            <?php elseif(is_null($customer) && ($restaurant->customer_login_required || $orderTypeSlug == 'delivery')): ?>
                                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'justify-center w-full','wire:click' => '$dispatch(\'showSignup\')']); ?>
                                    <?php echo app('translator')->get('app.next'); ?>
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
                            <?php elseif($orderTypeSlug == 'pickup'): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_null($customer)): ?>
                                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'justify-center w-full','wire:click' => '$dispatch(\'showSignup\')']); ?>
                                        <?php echo app('translator')->get('app.next'); ?>
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
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'justify-center w-full','wire:click' => 'placeOrder','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?>
                                        <span wire:loading wire:target="placeOrder" class="mr-2">
                                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                        <?php echo app('translator')->get('app.next'); ?>
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
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                                <div class="grid w-full grid-cols-2 gap-2">
                                    <?php
                                        $isPaymentEnabled =
                                            in_array($orderTypeSlug, ['dine_in', 'delivery', 'pickup']) &&
                                            (($orderTypeSlug == 'dine_in' && $paymentGateway->is_dine_in_payment_enabled) ||
                                                ($orderTypeSlug == 'delivery' &&
                                                    $paymentGateway->is_delivery_payment_enabled) ||
                                                ($orderTypeSlug == 'pickup' && $paymentGateway->is_pickup_payment_enabled));

                                        $showPayNow =
                                            $paymentGateway->is_qr_payment_enabled ||
                                            $paymentGateway->stripe_status ||
                                            $paymentGateway->razorpay_status ||
                                            $paymentGateway->flutterwave_status ||
                                            $paymentGateway->paypal_status ||
                                            $paymentGateway->payfast_status ||
                                            $paymentGateway->paystack_status ||
                                            $paymentGateway->xendit_status ||
                                            $paymentGateway->epay_status ||
                                            $paymentGateway->mollie_status ||
                                            $paymentGateway->tap_status ||
                                            count($offlinePaymentMethods) > 0;

                                        $loadingSpinner = '
                                            <div role="status" class="flex items-center">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-700"
                                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                            </div>';
                                    ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$order): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPayNow): ?>
                                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex items-center justify-center w-full gap-2','wire:click' => 'placeOrder(true)','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?>
                                                <span wire:loading wire:target="placeOrder"><?php echo $loadingSpinner; ?></span>
                                                <?php echo app('translator')->get('modules.order.payNow'); ?>
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

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isPaymentEnabled): ?>
                                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['class' => 'flex items-center justify-center w-full gap-2','wire:click' => 'placeOrder','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex items-center justify-center w-full gap-2','wire:click' => 'placeOrder','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?>
                                                    <span wire:loading wire:target="placeOrder"><?php echo $loadingSpinner; ?></span>
                                                    <?php echo app('translator')->get('modules.order.payLater'); ?>
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
                                        <?php else: ?>
                                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex items-center justify-center w-full gap-2','wire:click' => 'placeOrder','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?>
                                                <span wire:loading wire:target="placeOrder"><?php echo $loadingSpinner; ?></span>
                                                <?php echo app('translator')->get('modules.order.placeOrder'); ?>
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
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php else: ?>
                                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex items-center justify-center w-full gap-2','wire:click' => 'placeOrder','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?>
                                            <span wire:loading wire:target="placeOrder"><?php echo $loadingSpinner; ?></span>
                                            <?php echo app('translator')->get('modules.order.placeOrder'); ?>
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
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="flex mt-4">
                            <a href="javascript:;" wire:click="showMenuItems"
                                class="relative text-gray-500 transition-colors duration-300 group hover:text-skin-base">
                                <span class="inline-block"><?php echo app('translator')->get('app.back'); ?></span>
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-skin-base group-hover:w-full transition-all duration-300 ease-in-out"></span>
                            </a>
                        </div>
                    </div>

                </div>
            <?php else: ?>
                <div class="p-4 text-center md:py-7 md:px-5">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        <?php echo app('translator')->get('messages.cartEmpty'); ?>
                    </h3>

                    <a class="inline-flex items-center justify-center px-3 py-2 mt-3 text-sm font-medium text-white border border-transparent rounded-lg gap-x-2 bg-skin-base hover:bg-skin-base focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                        href="<?php echo e(module_enabled('Subdomain') ? url('/') : route('shop_restaurant', [$restaurant->hash])); ?>"
                        wire:navigate>
                        <?php echo app('translator')->get('modules.order.placeOrder'); ?>
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showCustomerNameModal','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showCustomerNameModal','maxWidth' => 'sm']); ?>
         <?php $__env->slot('title', null, []); ?> 

         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_null($customer)): ?>
                <form wire:submit="submitCustomerName">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-4">
                        <div>
                            <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'customerName','value' => ''.e(__('modules.customer.enterName')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerName','value' => ''.e(__('modules.customer.enterName')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'customerName','class' => 'block w-full mt-1','type' => 'text','wire:model' => 'customerName']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customerName','class' => 'block w-full mt-1','type' => 'text','wire:model' => 'customerName']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'customerName','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerName','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'customerPhone','value' => ''.e(__('modules.customer.phone')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerPhone','value' => ''.e(__('modules.customer.phone')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                            <div class="flex gap-2 mt-1">
                                <!-- Phone Code Dropdown -->
                                <div x-data="{ isOpen: <?php if ((object) ('phoneCodeIsOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('phoneCodeIsOpen'->value()); ?>')<?php echo e('phoneCodeIsOpen'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('phoneCodeIsOpen'); ?>')<?php endif; ?>.live }" @click.away="isOpen = false" class="relative w-28">
                                    <div @click="isOpen = !isOpen"
                                        class="p-2 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customerPhoneCode): ?>
                                                    +<?php echo e($customerPhoneCode); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('modules.settings.select')); ?>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <ul x-show="isOpen" x-transition class="absolute z-50 w-full mt-1 overflow-auto bg-white rounded-lg shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                        <li class="sticky top-0 px-2 py-2 bg-white dark:bg-gray-700 z-10">
                                            <input wire:model.live.debounce.300ms="phoneCodeSearch" class="block w-full px-2 py-1 text-sm border border-gray-300 rounded dark:bg-gray-600 dark:border-gray-500 dark:text-white" type="text" placeholder="<?php echo e(__('placeholders.search')); ?>" />
                                        </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $phonecodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phonecode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li @click="$wire.selectPhoneCode('<?php echo e($phonecode); ?>')"
                                                wire:key="cart-phone-code-<?php echo e($phonecode); ?>"
                                                class="relative py-2 pl-3 text-gray-900 cursor-pointer select-none pr-9 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-300"
                                                :class="{ 'bg-gray-100 dark:bg-gray-600': '<?php echo e($phonecode); ?>' === '<?php echo e($customerPhoneCode); ?>' }">
                                                <span class="block text-sm">+<?php echo e($phonecode); ?></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li class="py-2 pl-3 text-gray-500 dark:text-gray-400">
                                                <?php echo e(__('modules.settings.noPhoneCodesFound')); ?>

                                            </li>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </ul>
                                </div>

                                <!-- Phone Number Input -->
                                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'customerPhone','class' => 'block w-full','type' => 'tel','wire:model' => 'customerPhone','placeholder' => '1234567890']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customerPhone','class' => 'block w-full','type' => 'tel','wire:model' => 'customerPhone','placeholder' => '1234567890']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'customerPhoneCode','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerPhoneCode','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'customerPhone','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerPhone','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'delivery' || $orderTypeSlug === 'delivery'): ?>
                            <div>
                                <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'customerAddress','value' => ''.e(__('modules.customer.address')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerAddress','value' => ''.e(__('modules.customer.address')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.textarea','data' => ['id' => 'customerAddress','class' => 'block w-full mt-1','wire:model' => 'customerAddress','rows' => '4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customerAddress','class' => 'block w-full mt-1','wire:model' => 'customerAddress','rows' => '4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $attributes = $__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__attributesOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886)): ?>
<?php $component = $__componentOriginal4727f9fd7c3055c2cf9c658d89b16886; ?>
<?php unset($__componentOriginal4727f9fd7c3055c2cf9c658d89b16886); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'customerAddress','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerAddress','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="flex justify-between w-full pb-4 mt-6 space-x-4">
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo app('translator')->get('app.continue'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showCustomerNameModal\')','wire:loading.attr' => 'disabled']); ?><?php echo app('translator')->get('app.cancel'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
                    </div>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <!-- Pickup DateTime Dialog Modal -->
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showPickupDateTimeModal','maxWidth' => '2xl','maxHeight' => '3xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showPickupDateTimeModal','maxWidth' => '2xl','maxHeight' => '3xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.order.pickUpDateTime'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <form wire:submit="savePickupDateTime">
                <?php echo csrf_field(); ?>
                <div class="space-y-4 sm:space-y-8 py-1 sm:py-12 min-h-[200px]">
                    <div class="gap-2 sm:gap-4 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 w-full">
                            <label for="pickup_datetime" class="text-sm sm:text-base font-medium text-gray-600 dark:text-gray-300">
                                <?php echo app('translator')->get('modules.order.selectPickupDateTime'); ?>:
                            </label>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3 flex-1">
                                <div class="relative flex-1 w-full">
                                    <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.live' => 'pickupDate','minDate' => ''.e($minDate).'','maxDate' => ''.e($maxDate).'','restaurant' => $restaurant,'class' => 'pl-2 sm:pl-5 pr-4 sm:pr-6 py-2 sm:py-4 text-base sm:text-xl text-gray-700 dark:text-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'pickupDate','minDate' => ''.e($minDate).'','maxDate' => ''.e($maxDate).'','restaurant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($restaurant),'class' => 'pl-2 sm:pl-5 pr-4 sm:pr-6 py-2 sm:py-4 text-base sm:text-xl text-gray-700 dark:text-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 w-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $attributes = $__attributesOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $component = $__componentOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__componentOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
                                </div>

                                <div class="relative flex-1 w-full" style="overflow: visible;">
                                    <?php if (isset($component)) { $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.time-picker','data' => ['wire:model.live' => 'pickupTime','value' => $pickupTime,'restaurant' => $restaurant,'class' => 'pl-4 sm:pl-5 pr-5 sm:pr-6 py-3 sm:py-4 text-base sm:text-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('time-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'pickupTime','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pickupTime),'restaurant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($restaurant),'class' => 'pl-4 sm:pl-5 pr-5 sm:pr-6 py-3 sm:py-4 text-base sm:text-xl']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $attributes = $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $component = $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'pickupDateTime','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'pickupDateTime','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>
                <div class="flex flex-col sm:flex-row justify-between w-full gap-3 sm:gap-4 pb-3 pt-3 sm:pb-6 mt-4 sm:mt-8">
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-auto']); ?><?php echo app('translator')->get('app.continue'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showPickupDateTimeModal\')','wire:loading.attr' => 'disabled','class' => 'w-full sm:w-auto']); ?><?php echo app('translator')->get('app.cancel'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
                </div>
            </form>

         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showTableModal','maxWidth' => '2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showTableModal','maxWidth' => '2xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.table.selectTable'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showTableModal && $getTable): ?>
                <!-- Card Section -->
                <div class="col-span-2 space-y-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex flex-col gap-3 space-y-3 sm:gap-4"
                            wire:key='area-table-<?php echo e($loop->index); ?>'>
                            <h3 class="inline-flex items-center gap-2 font-medium f-15 dark:text-neutral-200">
                                <?php echo e($area->area_name); ?>

                                <span
                                    class="px-2 py-1 text-sm text-gray-800 border border-gray-300 rounded bg-slate-100 "><?php echo e($area->tables_count); ?>

                                    <?php echo app('translator')->get('modules.table.table'); ?></span>
                            </h3>
                            <!-- Card -->

                            <div class="grid grid-cols-2 gap-3 md:grid-cols-4 sm:gap-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'group cursor-pointer flex items-center justify-center border shadow-sm rounded-lg hover:shadow-md transition dark:bg-gray-700 dark:border-gray-600',
                                        'bg-red-50' => $item->status == 'inactive',
                                        'bg-white' => $item->status == 'active',
                                    ]); ?>" wire:key='table-<?php echo e($loop->index); ?>'
                                        wire:click="selectTableOrder('<?php echo e($item->hash); ?>')">
                                        <div class="p-3">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status == 'inactive'): ?>
                                                    <div class="inline-flex gap-1 text-xs font-semibold text-red-600">
                                                        <?php echo app('translator')->get('app.inactive'); ?>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                    'p-2 rounded-lg tracking-wide ',
                                                    ' bg-green-100 text-green-600' => $item->available_status == 'available',
                                                    'bg-red-100 text-red-600' => $item->available_status == 'reserved',
                                                    'bg-blue-100 text-blue-600' => $item->available_status == 'running',
                                                ]); ?>">
                                                    <h3 wire:loading.class.delay='opacity-50'
                                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses(['font-semibold']); ?>">
                                                        <?php echo e($item->table_code); ?>

                                                    </h3>
                                                </div>
                                                <p class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-xs font-medium dark:text-neutral-200 text-gray-500']); ?>">
                                                    <?php echo e($item->seating_capacity); ?> <?php echo app('translator')->get('modules.table.seats'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- End Card -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div>
                            <?php echo app('translator')->get('messages.noTablesFound'); ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>
                <!-- End Card Section -->
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showVariationModal','maxWidth' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showVariationModal','maxWidth' => 'xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.menu.itemVariations'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menuItem): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pos.itemVariations', [
                    'menuItemId' => $menuItem->id,
                    'orderTypeId' => $orderTypeId,
                    'deliveryAppId' => null
                ]);

$__key = str()->random(50);

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3713676885-1', $__key);

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
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showVariationModal\')','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showCartVariationModal','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showCartVariationModal','maxWidth' => 'sm']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.menu.itemVariations'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menuItem): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('shop.cartItemVariations', ['menuItem' => $menuItem, 'orderItemQty' => $orderItemQty]);

$__key = str()->random(50);

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3713676885-2', $__key);

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
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showCartVariationModal\')','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showItemDetailModal','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showItemDetailModal','maxWidth' => 'sm']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.menu.itemDescription'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedItem): ?>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant && !$restaurant->hide_menu_item_image_on_customer_site): ?>

                            <img src="<?php echo e($selectedItem->item_photo_url); ?>" alt="<?php echo e($selectedItem->item_name); ?>"
                                class="object-cover w-full rounded-md">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="flex flex-col gap-1">
                            <h3 class="text-lg font-semibold dark:text-white"><?php echo e($selectedItem->item_name); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(strlen($selectedItem->description) > 100): ?>
                                <div x-data="{ expanded: false }">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <span
                                            x-show="!expanded"><?php echo e(Str::limit($selectedItem->description, 100)); ?></span>
                                        <span x-show="expanded"><?php echo e($selectedItem->description); ?></span>
                                    </p>
                                    <button @click="expanded = !expanded"
                                        class="mt-1 text-sm font-medium text-skin-base">
                                        <span x-text="expanded ? '<?php echo app('translator')->get('modules.menu.showLess'); ?>' : '<?php echo app('translator')->get('modules.menu.showMore'); ?>'"></span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo e($selectedItem->description); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo app('translator')->get('modules.menu.preparationTime'); ?>
                                    <?php echo e($selectedItem->preparation_time); ?> <?php echo app('translator')->get('modules.menu.minutes'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex justify-end space-x-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedItem && ($restaurant?->allow_customer_orders ?? false)): ?>
                    <?php if (isset($component)) { $__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cart-button','data' => ['wire:click' => 'addCartItems('.e($selectedItem->id).', '.e($selectedItem->variations_count ?? 0).', '.e($selectedItem->modifier_groups_count ?? 0).')','wire:key' => 'item-input-'.e($selectedItem->id . microtime()).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cart-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'addCartItems('.e($selectedItem->id).', '.e($selectedItem->variations_count ?? 0).', '.e($selectedItem->modifier_groups_count ?? 0).')','wire:key' => 'item-input-'.e($selectedItem->id . microtime()).'']); ?>
                        <?php echo app('translator')->get('app.add'); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc)): ?>
<?php $attributes = $__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc; ?>
<?php unset($__attributesOriginal7cb8ce508f0c0323a1ef462cf7f26cbc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc)): ?>
<?php $component = $__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc; ?>
<?php unset($__componentOriginal7cb8ce508f0c0323a1ef462cf7f26cbc); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showItemDetailModal\')','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPaymentModal): ?>
        <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showPaymentModal','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showPaymentModal','maxWidth' => 'md']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo app('translator')->get('modules.order.chooseGateway'); ?>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <?php
                    $offlinePaymentMethodMap = isset($offlinePaymentMethods)
                        ? $offlinePaymentMethods->keyBy('name')
                        : collect();
                    $activeOfflinePaymentMethodName = $selectedOfflinePaymentMethod ?? 'bank_transfer';
                    $activeOfflinePaymentMethod = $offlinePaymentMethodMap->get($activeOfflinePaymentMethodName);
                ?>
                <div
                    class="flex items-center justify-between p-2 mb-6 rounded-md cursor-pointer bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center min-w-0">
                        <div>
                            <div class="font-medium text-gray-700 truncate dark:text-white">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentOrder): ?>
                                    <?php echo e($paymentOrder->show_formatted_order_number); ?>

                                <?php else: ?>
                                    <?php echo app('translator')->get('modules.order.orderTotal'); ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="inline-flex flex-col text-base font-semibold text-right text-gray-900 dark:text-white">
                        <div><?php echo e(currency_format($paymentOrder?->total ?? $total, $restaurant->currency_id)); ?></div>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showQrCode || $showPaymentDetail): ?>
                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => ''.e($showQrCode ? 'toggleQrCode' : 'togglePaymenntDetail').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => ''.e($showQrCode ? 'toggleQrCode' : 'togglePaymenntDetail').'']); ?>
                        <span class="ml-2"><?php echo app('translator')->get('modules.billing.showOtherPaymentOption'); ?></span>
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

                    <div class="flex items-center mt-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showQrCode): ?>
                            <img src="<?php echo e($paymentGateway->qr_code_image_url); ?>" alt="QR Code Preview"
                                class="object-cover rounded-md h-30 w-30">
                        <?php elseif($showPaymentDetail): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeOfflinePaymentMethod && !empty($activeOfflinePaymentMethod->description)): ?>
                                <div class="w-full p-3 bg-gray-50 dark:bg-gray-900/30 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        <?php echo e(ucwords(str_replace('_', ' ', $activeOfflinePaymentMethod->name))); ?>

                                    </p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line break-words">
                                        <?php echo nl2br(e($activeOfflinePaymentMethod->description)); ?>

                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="w-full p-3 bg-gray-50 dark:bg-gray-900/30 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        <?php echo e(ucwords(str_replace('_', ' ', $activeOfflinePaymentMethodName))); ?>

                                    </p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        <?php echo app('translator')->get('app.noDescription'); ?>
                                    </p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                 <?php else: ?>
                    <div class="grid items-center w-full grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->stripe_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateStripePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateStripePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg height="21" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 468 222.5"
                                        xml:space="preserve">
                                        <path
                                            d="M414 113.4c0-25.6-12.4-45.8-36.1-45.8-23.8 0-38.2 20.2-38.2 45.6 0 30.1 17 45.3 41.4 45.3 11.9 0 20.9-2.7 27.7-6.5v-20c-6.8 3.4-14.6 5.5-24.5 5.5-9.7 0-18.3-3.4-19.4-15.2h48.9c0-1.3.2-6.5.2-8.9m-49.4-9.5c0-11.3 6.9-16 13.2-16 6.1 0 12.6 4.7 12.6 16zm-63.5-36.3c-9.8 0-16.1 4.6-19.6 7.8l-1.3-6.2h-22v116.6l25-5.3.1-28.3c3.6 2.6 8.9 6.3 17.7 6.3 17.9 0 34.2-14.4 34.2-46.1-.1-29-16.6-44.8-34.1-44.8m-6 68.9c-5.9 0-9.4-2.1-11.8-4.7l-.1-37.1c2.6-2.9 6.2-4.9 11.9-4.9 9.1 0 15.4 10.2 15.4 23.3 0 13.4-6.2 23.4-15.4 23.4m-71.3-74.8 25.1-5.4V36l-25.1 5.3zm0 7.6h25.1v87.5h-25.1zm-26.9 7.4-1.6-7.4h-21.6v87.5h25V97.5c5.9-7.7 15.9-6.3 19-5.2v-23c-3.2-1.2-14.9-3.4-20.8 7.4m-50-29.1-24.4 5.2-.1 80.1c0 14.8 11.1 25.7 25.9 25.7 8.2 0 14.2-1.5 17.5-3.3V135c-3.2 1.3-19 5.9-19-8.9V90.6h19V69.3h-19zM79.3 94.7c0-3.9 3.2-5.4 8.5-5.4 7.6 0 17.2 2.3 24.8 6.4V72.2c-8.3-3.3-16.5-4.6-24.8-4.6C67.5 67.6 54 78.2 54 95.9c0 27.6 38 23.2 38 35.1 0 4.6-4 6.1-9.6 6.1-8.3 0-18.9-3.4-27.3-8v23.8c9.3 4 18.7 5.7 27.3 5.7 20.8 0 35.1-10.3 35.1-28.2-.1-29.8-38.2-24.5-38.2-35.7"
                                            style="fill-rule:evenodd;clip-rule:evenodd;fill:#635bff" />
                                    </svg>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->razorpay_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiatePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiatePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg height="21" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 122.88 26.53"
                                        style="enable-background:new 0 0 122.88 26.53" xml:space="preserve">
                                        <style type="text/css">
                                            <![CDATA[
                                            .strp0 {
                                                fill: #3395FF;
                                            }

                                            .st1 {
                                                fill: #072654;
                                            }
                                            ]]>
                                        </style>
                                        <g>
                                            <polygon class="st1"
                                                points="11.19,9.03 7.94,21.47 0,21.47 1.61,15.35 11.19,9.03" />
                                            <path class="st1"
                                                d="M28.09,5.08C29.95,5.09,31.26,5.5,32,6.33s0.92,2.01,0.51,3.56c-0.27,1.06-0.82,2.03-1.59,2.8 c-0.8,0.8-1.78,1.38-2.87,1.68c0.83,0.19,1.34,0.78,1.5,1.79l0.03,0.22l0.6,5.09h-3.7l-0.62-5.48c-0.01-0.18-0.06-0.36-0.15-0.52 c-0.09-0.16-0.22-0.29-0.37-0.39c-0.31-0.16-0.65-0.24-1-0.25h-0.21h-2.28l-1.74,6.63h-3.46l4.3-16.38H28.09L28.09,5.08z M122.88,9.37l-4.4,6.34l-5.19,7.52l-0.04,0.04l-1.16,1.68l-0.04,0.06L112,25.09l-1,1.44h-3.44l4.02-5.67l-1.82-11.09h3.57 l0.9,7.23l4.36-6.19l0.06-0.09l0.07-0.1l0.07-0.09l0.54-1.15H122.88L122.88,9.37z M92.4,10.25c0.66,0.56,1.09,1.33,1.24,2.19 c0.18,1.07,0.1,2.18-0.21,3.22c-0.29,1.15-0.78,2.23-1.46,3.19c-0.62,0.88-1.42,1.61-2.35,2.13c-0.88,0.48-1.85,0.73-2.85,0.73 c-0.71,0.03-1.41-0.15-2.02-0.51c-0.47-0.28-0.83-0.71-1.03-1.22l-0.06-0.2l-1.77,6.75h-3.43l3.51-13.4l0.02-0.06l0.01-0.06 l0.86-3.25h3.35l-0.57,1.88l-0.01,0.08c0.49-0.7,1.15-1.27,1.91-1.64c0.76-0.4,1.6-0.6,2.45-0.6C90.84,9.43,91.7,9.71,92.4,10.25 L92.4,10.25z M88.26,12.11c-0.4-0.01-0.8,0.07-1.18,0.22c-0.37,0.15-0.71,0.38-1,0.66c-0.68,0.7-1.15,1.59-1.36,2.54 c-0.3,1.11-0.28,1.95,0.02,2.53c0.3,0.58,0.87,0.88,1.72,0.88c0.81,0.02,1.59-0.29,2.18-0.86c0.66-0.69,1.12-1.55,1.33-2.49 c0.29-1.09,0.27-1.96-0.03-2.57S89.08,12.11,88.26,12.11L88.26,12.11z M103.66,9.99c0.46,0.29,0.82,0.72,1.02,1.23l0.07,0.19 l0.44-1.66h3.36l-3.08,11.7h-3.37l0.45-1.73c-0.51,0.61-1.15,1.09-1.87,1.42c-0.7,0.32-1.45,0.49-2.21,0.49 c-0.88,0.04-1.76-0.21-2.48-0.74c-0.66-0.52-1.1-1.28-1.24-2.11c-0.18-1.06-0.12-2.14,0.19-3.17c0.3-1.15,0.8-2.24,1.49-3.21 c0.63-0.89,1.44-1.64,2.38-2.18c0.86-0.5,1.84-0.77,2.83-0.77C102.36,9.43,103.06,9.61,103.66,9.99L103.66,9.99z M101.92,12.14 c-0.41,0-0.82,0.08-1.19,0.24c-0.38,0.16-0.72,0.39-1.01,0.68c-0.67,0.71-1.15,1.59-1.36,2.55c-0.28,1.08-0.28,1.9,0.04,2.49 c0.31,0.59,0.89,0.87,1.75,0.87c0.4,0.01,0.8-0.07,1.18-0.22s0.71-0.38,1-0.66c0.59-0.63,1.02-1.38,1.26-2.22l0.08-0.31 c0.3-1.11,0.29-1.96-0.03-2.53C103.33,12.44,102.76,12.14,101.92,12.14L101.92,12.14z M81.13,9.63l0.22,0.09l-0.86,3.19 c-0.49-0.26-1.03-0.39-1.57-0.39c-0.82-0.03-1.62,0.24-2.27,0.75c-0.56,0.48-0.97,1.12-1.18,1.82l-0.07,0.27l-1.6,6.11h-3.42 l3.1-11.7h3.37l-0.44,1.72c0.42-0.58,0.96-1.05,1.57-1.4c0.68-0.39,1.44-0.59,2.22-0.59C80.51,9.48,80.83,9.52,81.13,9.63 L81.13,9.63z M68.5,10.19c0.76,0.48,1.31,1.24,1.52,2.12c0.25,1.06,0.21,2.18-0.11,3.22c-0.3,1.18-0.83,2.28-1.58,3.22 c-0.71,0.91-1.61,1.63-2.64,2.12c-1.05,0.49-2.19,0.74-3.35,0.73c-1.22,0-2.22-0.24-3-0.73c-0.77-0.48-1.32-1.24-1.54-2.12 c-0.24-1.06-0.2-2.18,0.11-3.22c0.3-1.17,0.83-2.27,1.58-3.22c0.71-0.9,1.62-1.63,2.66-2.12c1.06-0.49,2.22-0.75,3.39-0.73 C66.57,9.41,67.6,9.67,68.5,10.19L68.5,10.19z M64.84,12.1c-0.81-0.01-1.59,0.3-2.18,0.86c-0.61,0.58-1.07,1.43-1.36,2.57 c-0.6,2.29-0.02,3.43,1.74,3.43c0.8,0.02,1.57-0.29,2.15-0.85c0.6-0.57,1.04-1.43,1.34-2.58c0.3-1.13,0.31-1.98,0.01-2.57 C66.25,12.37,65.68,12.1,64.84,12.1L64.84,12.1z M57.89,9.76l-0.6,2.32l-7.55,6.67h6.06l-0.72,2.73H45.05l0.63-2.41l7.43-6.57 h-5.65l0.72-2.73H57.89L57.89,9.76z M40.96,9.99c0.46,0.29,0.82,0.72,1.02,1.23l0.07,0.19l0.44-1.66h3.37l-3.07,11.7h-3.37 l0.45-1.73c-0.51,0.6-1.14,1.08-1.85,1.41s-1.48,0.5-2.27,0.5c-0.88,0.04-1.74-0.22-2.45-0.74c-0.66-0.52-1.1-1.28-1.24-2.11 c-0.18-1.06-0.12-2.14,0.19-3.17c0.29-1.15,0.8-2.24,1.49-3.21c0.63-0.89,1.44-1.64,2.37-2.18c0.86-0.5,1.84-0.76,2.83-0.76 C39.66,9.44,40.36,9.62,40.96,9.99L40.96,9.99z M39.23,12.14c-0.41,0-0.81,0.08-1.19,0.24c-0.38,0.16-0.72,0.39-1.01,0.68 c-0.68,0.71-1.15,1.59-1.36,2.55c-0.28,1.08-0.27,1.9,0.04,2.49c0.31,0.59,0.89,0.87,1.75,0.87c0.4,0.01,0.8-0.07,1.18-0.22 c0.37-0.15,0.72-0.38,1-0.66c0.59-0.62,1.03-1.38,1.26-2.22l0.08-0.31c0.29-1.11,0.26-1.94-0.03-2.53 C40.64,12.44,40.06,12.14,39.23,12.14L39.23,12.14z M26.85,7.81h-3.21l-1.13,4.28h3.21c1.01,0,1.81-0.17,2.35-0.52 c0.57-0.37,0.98-0.95,1.13-1.63c0.2-0.72,0.11-1.27-0.27-1.62C28.55,7.99,27.86,7.81,26.85,7.81L26.85,7.81z" />
                                            <polygon class="strp0"
                                                points="18.4,0 12.76,21.47 8.89,21.47 12.7,6.93 6.86,10.78 7.9,6.95 18.4,0" />
                                        </g>
                                    </svg>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->flutterwave_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateFlutterwavePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateFlutterwavePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="h-5 dark:mix-blend-plus-lighter" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 916.7 144.7">
                                        <path
                                            d="M280.5 33.8h16.1v82.9h-16.1zM359 87.3c0 11.4-7.4 16.6-17.2 16.6s-16.4-5.1-16.4-16V58.3h-16.1v33.3c0 16.6 10.4 26.3 27.7 26.3 10.9 0 16.9-4 21-8.5h.9l1.4 7.4h14.8V58.3H359zm158 17.9c-11.8 0-18.4-5.4-19.5-13.2h51.1c.2-1.6.4-3.3.3-4.9-.1-21-16-29.9-33-29.9-19.7 0-34.6 11.8-34.6 30.8 0 18.1 14.2 29.9 35.6 29.9 17.9 0 29.8-7.9 32.2-20.1h-15.9c-1.8 4.8-7.5 7.4-16.2 7.4m-1-35.3c10.3 0 16.2 4.6 17.2 11h-35.3c1.5-6.2 7.5-11 18.1-11m60.4-3.2h-1l-1.5-8.4h-14.6v58.4h16.1V91.6c0-11.3 6.5-17.6 18.7-17.6q3.3 0 6.6.6V58.3h-2.2c-10.9 0-17.5 2.3-22.1 8.4m103.3 31.8h-.9L665 62h-16.6l-13.5 36.4h-1.1L621 58.3h-16l19.7 58.4h17.5l14-37.2h1l13.8 37.2h17.6l19.7-58.4h-16zm92.7 1.2V80.2c0-15.9-13.4-23-30.1-23-17.7 0-28.8 8.4-30.3 21h16.1c1.2-5.5 5.8-8.5 14.2-8.5s14 3.2 14 9.6v1.5l-26.3 2c-12.1.9-21 6.3-21 17.8 0 11.8 10.2 17.4 25.1 17.4 12.1 0 19.4-3.4 23.9-8.4h.8c2.5 5.7 7.7 7.3 13.2 7.3h6.8V105h-1.5c-3.3-.2-4.9-1.8-4.9-5.3m-16.1-6.2c0 9.2-11 12.3-20.4 12.3-6.4 0-10.6-1.6-10.6-6.1 0-4 3.6-5.9 9-6.4l22.1-1.6zM832 58.3l-18.8 42.3h-1l-19.1-42.3h-17.4l27.2 58.4h19.3l27.1-58.4zm68.8 39.5c-2 4.8-7.7 7.4-16.3 7.4-11.8 0-18.4-5.4-19.5-13.2h51.1c.2-1.6.4-3.3.3-4.9-.1-21-16-29.9-33-29.9-19.7 0-34.5 11.8-34.5 30.8 0 18.1 14.2 29.9 35.6 29.9 17.9 0 29.8-7.9 32.2-20.1zm-17.4-27.9c10.3 0 16.2 4.6 17.2 11h-35.3c1.5-6.2 7.4-11 18.1-11M254.4 54c0-5.1 3.6-7.3 8.3-7.3 2.2 0 4.3.3 6.4.9l2.7-11.7c-3.9-1.4-8-2.1-12.1-2.1-11.9 0-21.5 6.3-21.5 19.4v5.1h-13.9v12.8h13.9v45.6h16.2V71.1h18.2V58.3h-18.2zm156.4-12.1h-15l-.8 16.5h-12.7v12.8h12.4V100c0 9.8 5 18 20 18 3.9 0 7.8-.4 11.6-1.3v-12.3c-2.2.5-4.4.8-6.7.8-8 0-8.8-4.6-8.8-8.1v-26h16V58.3h-16zm50.6 0h-14.9l-.8 16.5H433v12.8h12.4V100c0 9.8 5 18 20 18 3.9 0 7.7-.5 11.5-1.3v-12.3c-2.2.5-4.4.8-6.7.8-8 0-8.8-4.6-8.8-8.1v-26h16V58.3h-16.1V41.9z"
                                            style="fill:#2a3362" />
                                        <path
                                            d="M0 31.6c0-9.4 2.7-17.4 8.5-23.1l10 10C7.4 29.6 17.1 64.1 48.8 95.8s66.2 41.4 77.3 30.3l10 10c-18.8 18.8-61.5 5.4-97.3-30.3C14 80.9 0 52.8 0 31.6"
                                            style="fill:#009a46" />
                                        <path
                                            d="M63.1 144.7c-9.4 0-17.4-2.7-23.1-8.5l10-10c11.1 11.1 45.6 1.4 77.3-30.3s41.4-66.2 30.3-77.3l10-10c18.8 18.8 5.4 61.5-30.3 97.3-24.9 24.8-53.1 38.8-74.2 38.8"
                                            style="fill:#ff5805" />
                                        <path
                                            d="M140.5 91.6C134.4 74.1 122 55.4 105.6 39 69.8 3.2 27.1-10.1 8.3 8.6 7 10 8.2 13.3 10.9 16s6.1 3.9 7.4 2.6c11.1-11.1 45.6-1.4 77.3 30.3 15 15 26.2 31.8 31.6 47.3 4.7 13.6 4.3 24.6-1.2 30.1-1.3 1.3-.2 4.6 2.6 7.4s6.1 3.9 7.4 2.6c9.6-9.7 11.2-25.6 4.5-44.7"
                                            style="fill:#f5afcb" />
                                        <path
                                            d="M167.5 8.6C157.9-1 142-2.6 122.9 4c-17.5 6.1-36.2 18.5-52.6 34.9-35.8 35.8-49.1 78.5-30.3 97.3 1.3 1.3 4.7.2 7.4-2.6s3.9-6.1 2.6-7.4c-11.1-11.1-1.4-45.6 30.3-77.3 15-15 31.8-26.2 47.2-31.6 13.6-4.7 24.6-4.3 30.1 1.2 1.3 1.3 4.6.2 7.4-2.6s3.9-5.9 2.5-7.3"
                                            style="fill:#ff9b00" />
                                    </svg>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->paypal_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiatePaypalPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiatePaypalPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg height="21" viewBox="0 0 916.7 144.7" class="h-6 w-22"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <style>
                                                .text {
                                                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                                    font-size: 80px;
                                                    font-weight: bold;
                                                }

                                                .dark-blue {
                                                    fill: #002E6D;
                                                }

                                                .blue {
                                                    fill: #009CDE;
                                                }
                                            </style>
                                        </defs>
                                        <!-- P Shape -->
                                        <path class="dark-blue" d="M60,30 h50 a30,30 0 0 1 0,60 h-35 l-10,60 h-30z" />
                                        <!-- Overlay light P -->
                                        <path class="blue" d="M75,40 h25 a20,20 0 0 1 0,40 h-20 l-8,40 h-20z" />
                                        <!-- PayPal Text -->
                                        <text x="140" y="95" class="text">
                                            <tspan class="dark-blue">Pay</tspan>
                                            <tspan class="blue">Pal</tspan>
                                        </text>
                                    </svg>

                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->payfast_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiatePayfastPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiatePayfastPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 6 L14 12 L8 18" fill="none" stroke="#E63950"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <?php echo app('translator')->get('modules.billing.payfast'); ?>

                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->paystack_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiatePaystackPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiatePaystackPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        width="24" height="24" fill="#0AA5FF">
                                        <path
                                            d="M2 3.6c0-.331.269-.6.6-.6H21.4c.331 0 .6.269.6.6v1.8a.6.6 0 0 1-.6.6H2.6a.6.6 0 0 1-.6-.6V3.6Zm0 4.8c0-.331.269-.6.6-.6H15.4c.331 0 .6.269.6.6v1.8a.6.6 0 0 1-.6.6H2.6a.6.6 0 0 1-.6-.6V8.4Zm0 4.8c0-.331.269-.6.6-.6H21.4c.331 0 .6.269.6.6v1.8a.6.6 0 0 1-.6.6H2.6a.6.6 0 0 1-.6-.6v-1.8Zm0 4.8c0-.331.269-.6.6-.6H15.4c.331 0 .6.269.6.6v1.8a.6.6 0 0 1-.6.6H2.6a.6.6 0 0 1-.6-.6v-1.8Z"
                                            fill-rule="evenodd" />
                                    </svg>
                                    <?php echo app('translator')->get('modules.billing.paystack'); ?>

                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->xendit_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateXenditPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateXenditPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" id="Xendit--Streamline-Simple-Icons" height="24" width="24">
                                            <desc>
                                            Xendit Streamline Icon: https://streamlinehq.com
                                            </desc>
                                            <title>Xendit</title>
                                            <path d="M11.781 2.743H7.965l-5.341 9.264 5.341 9.263 -1.312 2.266L0 12.007 6.653 0.464h6.454l-1.326 2.279Zm-5.128 2.28 1.312 -2.28L9.873 6.03 8.561 8.296 6.653 5.023Zm9.382 -2.28 1.312 2.28L7.965 21.27l-1.312 -2.279 9.382 -16.248Zm-5.128 20.793 1.298 -2.279h3.83L14.1 17.931l1.312 -2.267 1.926 3.337 4.038 -6.994 -5.341 -9.264L17.347 0.464 24 12.007l-6.653 11.529h-6.44Z" fill="#000000" stroke-width="1"></path>
                                        </svg>
                                        <?php echo app('translator')->get('modules.billing.xendit'); ?>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->epay_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateEpayPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateEpayPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                        <rect x="1.5" y="1.5" width="21" height="21" rx="3" ry="3"
                                            stroke="currentColor" stroke-width="2"/>

                                        <path d="M9.3 7.8L6.1 11C5.7 11.4 5.7 12 6.1 12.4L9.3 15.6C9.7 16 10.3 16 10.7 15.6L13.9 12.4C14.3 12 14.3 11.4 13.9 11L10.7 7.8C10.3 7.4 9.7 7.4 9.3 7.8Z"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                        <path d="M14.7 7.8L11.5 11C11.1 11.4 11.1 12 11.5 12.4L14.7 15.6C15.1 16 15.7 16 16.1 15.6L19.3 12.4C19.7 12 19.7 11.4 19.3 11L16.1 7.8C15.7 7.4 15.1 7.4 14.7 7.8Z"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                    </svg>
                                    <?php echo app('translator')->get('modules.billing.epay'); ?>

                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->mollie_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateMolliePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateMolliePayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 ltr:mr-1 rtl:ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#C6D300">
                                        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 1.5c5.799 0 10.5 4.701 10.5 10.5S17.799 22.5 12 22.5 1.5 17.799 1.5 12 6.201 1.5 12 1.5z"/>
                                        <path d="M12 3C7.029 3 3 7.029 3 12s4.029 9 9 9 9-4.029 9-9-4.029-9-9-9zm0 1.5c4.136 0 7.5 3.364 7.5 7.5S16.136 21 12 21 4.5 17.636 4.5 13.5 7.864 4.5 12 4.5z"/>
                                        <path d="M12 6c-3.314 0-6 2.686-6 6s2.686 6 6 6 6-2.686 6-6-2.686-6-6-6zm0 1.5c2.485 0 4.5 2.015 4.5 4.5S14.485 16.5 12 16.5 7.5 14.485 7.5 12 9.515 7.5 12 7.5z"/>
                                    </svg>
                                    <?php echo app('translator')->get('modules.billing.mollie'); ?>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->tap_status): ?>
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'initiateTapPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'initiateTapPayment('.e($paymentOrder?->id ?: 'null').')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-current" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="currentColor" stroke-width="8" />
                                        <circle cx="60" cy="60" r="30" fill="none" stroke="currentColor" stroke-width="8" />
                                    </svg>
                                    <?php echo app('translator')->get('modules.billing.tap'); ?>
                                </span>
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentGateway->is_qr_payment_enabled && $paymentGateway->qr_code_image_url): ?>
                            <!-- Button -->
                            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'toggleQrCode','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,toggleQrCode,placeOrder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'toggleQrCode','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'initiatePayment,initiateStripePayment,initiateFlutterwavePayment,initiatePaypalPayment,initiatePayfastPayment,initiatePaystackPayment,initiateXenditPayment,initiateEpayPayment,initiateMolliePayment,initiateTapPayment,toggleQrCode,placeOrder']); ?>
                                <span class="inline-flex items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g stroke-width="0" />
                                        <g stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M16 17v-1h-3v-3h3v2h2v2h-1v2h-2v2h-2v-3h2v-1zm5 4h-4v-2h2v-2h2zM3 3h8v8H3zm2 2v4h4V5zm8-2h8v8h-8zm2 2v4h4V5zM3 13h8v8H3zm2 2v4h4v-4zm13-2h3v2h-3zM6 6h2v2H6zm0 10h2v2H6zM16 6h2v2h-2z" />
                                    </svg>
                                    <span class="ml-2"><?php echo app('translator')->get('modules.billing.paybyQr'); ?></span>
                                </span>
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

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($offlinePaymentMethods) > 0): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $offlinePaymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'selectOfflinePaymentMethod(\''.e($offlineMethod->name).'\')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'selectOfflinePaymentMethod']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'selectOfflinePaymentMethod(\''.e($offlineMethod->name).'\')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'selectOfflinePaymentMethod']); ?>
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 15V17M6 7H18C18.5523 7 19 7.44772 19 8V16C19 16.5523 18.5523 17 18 17H6C5.44772 17 5 16.5523 5 16V8C5 7.44772 5.44772 7 6 7ZM6 7L18 7C18.5523 7 19 6.55228 19 6V4C19 3.44772 18.5523 3 18 3H6C5.44772 3 5 3.44772 5 4V6C5 6.55228 5.44772 7 6 7Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 11C13.1046 11 14 10.1046 14 9C14 7.89543 13.1046 7 12 7C10.8954 7 10 7.89543 10 9C10 10.1046 10.8954 11 12 11Z"
                                                stroke="currentColor" stroke-width="2" />
                                        </svg>
                                        <span class="ml-2"><?php echo e(ucwords(str_replace('_', ' ', $offlineMethod->name))); ?></span>
                                    </span>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'hidePaymentModal','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showQrCode): ?>
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-3','wire:click' => 'placeOrder(false, '.e($paymentOrder?->id ?? 'null').', \''.e($showQrCode ? 'upi' : 'others').'\')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?><?php echo app('translator')->get('modules.billing.paymentDone'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>

                <?php elseif($showPaymentDetail): ?>
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-3','wire:click' => 'placeOrder(false, '.e($paymentOrder?->id ?? 'null').', \''.e($activeOfflinePaymentMethodName).'\')','wire:loading.attr' => 'disabled','wire:loading.class' => 'opacity-50 cursor-not-allowed','wire:target' => 'placeOrder']); ?><?php echo app('translator')->get('modules.billing.paymentDone'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showModifiersModal','maxWidth' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showModifiersModal','maxWidth' => 'xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.modifier.itemModifiers'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedModifierItem): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pos.itemModifiers', [
                    'menuItemId' => $selectedModifierItem,
                    'orderTypeId' => $orderTypeId,
                    'deliveryAppId' => null
                ]);

$__key = str()->random(50);

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3713676885-3', $__key);

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
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showItemVariationsModal','maxWidth' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showItemVariationsModal','maxWidth' => 'xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.menu.itemVariations'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menuItem): ?>
                <div>
                    <div class="flex flex-col">
                        <div class="flex gap-4 mb-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant && !$restaurant->hide_menu_item_image_on_customer_site): ?>

                                <img class="w-16 h-16 rounded-md" src="<?php echo e($menuItem->item_photo_url); ?>"
                                    alt="<?php echo e($menuItem->item_name); ?>">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    <img src="<?php echo e(asset('img/' . $menuItem->type . '.svg')); ?>" class="h-4 mr-2"
                                        title="<?php echo app('translator')->get('modules.menu.' . $menuItem->type); ?>" alt="" />
                                    <?php echo e($menuItem->item_name); ?>

                                </div>
                                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    <?php echo e($menuItem->description); ?></div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow">
                                    <table
                                        class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col"
                                                    class="py-2.5 px-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    <?php echo app('translator')->get('modules.menu.itemName'); ?>
                                                </th>
                                                <th scope="col"
                                                    class="py-2.5 px-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    <?php echo app('translator')->get('modules.menu.setPrice'); ?>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                                            wire:key='menu-item-list-<?php echo e(microtime()); ?>'>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $menuItem->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700"
                                                    wire:key='menu-item-<?php echo e($item->id . microtime()); ?>'>
                                                    <td
                                                        class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                                        <div
                                                            class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div
                                                                class="inline-flex items-center text-base text-gray-900 dark:text-white">
                                                                <?php echo e($item->variation); ?>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="py-2.5 px-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php echo e($item->price ? currency_format($item->price, $restaurant->currency_id) : '--'); ?>

                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'showItemVariationsModal\')','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showDeliveryAddressModal','maxWidth' => '4xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showDeliveryAddressModal','maxWidth' => '4xl']); ?>
         <?php $__env->slot('title', null, []); ?>  <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shopBranch?->deliverySetting): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('customer.location-selector', ['shopBranch' => $shopBranch, 'customer' => $customer, 'orderGrandTotal' => $total, 'maxPreparationTime' => $maxPreparationTime, 'currencyId' => $restaurant->currency_id]);

$__key = str()->random(50);

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3713676885-4', $__key);

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
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

        <?php
        $__scriptKey = '3713676885-0';
        ob_start();
    ?>

        <?php $__env->startPush('scripts'); ?>

        <script>
            document.addEventListener('requestGeolocation', () => {
                if (!('geolocation' in navigator)) {
                    Livewire.dispatch('alert', {
                        type: 'error',
                        message: <?php echo \Illuminate\Support\Js::from(__('app.geolocationNotSupported'))->toHtml() ?>
                    });
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    position => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('setCustomerLocation', lat, lng);
                    },
                    error => {
                        Livewire.dispatch('alert', {
                            type: 'error',
                            message: error.message || <?php echo \Illuminate\Support\Js::from(__('app.unableToFetchLocation'))->toHtml() ?>
                        });
                    },
                    { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
                );
            });
        </script>

        <?php $__env->stopPush(); ?>

        <script>

            $wire.on('paymentInitiated', (payment) => {
                payViaRazorpay(payment);
            });

            $wire.on('stripePaymentInitiated', (payment) => {
                document.getElementById('order_payment').value = payment.payment.id;
                document.getElementById('order-payment-form').submit();
            });

            $wire.on('epayPaymentInitiated', (payment) => {
                payViaEpay(payment);
            });

            function payViaEpay(payment) {
                console.log('Epay payment initiated:', payment);

                // Wait for halyk library to load
                if (typeof halyk === 'undefined') {
                    console.error('Epay library not loaded');
                    alert('Payment gateway failed to load. Please refresh and try again.');
                    return;
                }

                try {
                    var paymentData = payment.payment;
                    var orderNumber = paymentData.order?.formatted_order_number || paymentData.order?.id || '';
                    var descriptionText = "<?php echo e(__('messages.orderPayment', [], app()->getLocale())); ?> #" + orderNumber;

                    // Limit description to 125 bytes as per Epay documentation (UTF-8 byte counting)
                    function getByteLength(str) {
                        return new TextEncoder().encode(str).length;
                    }

                    function truncateToBytes(str, maxBytes) {
                        var encoder = new TextEncoder();
                        var decoder = new TextDecoder();
                        var bytes = encoder.encode(str);
                        if (bytes.length <= maxBytes) {
                            return str;
                        }
                        // Truncate and decode, ensuring we don't break multi-byte characters
                        var truncated = bytes.slice(0, maxBytes - 3); // Reserve 3 bytes for '...'
                        return decoder.decode(truncated) + '...';
                    }

                    if (getByteLength(descriptionText) > 125) {
                        descriptionText = truncateToBytes(descriptionText, 125);
                    }

                    // Map language codes according to documentation (eng/kaz/rus)
                    var locale = "<?php echo e(app()->getLocale()); ?>";
                    var language = 'eng'; // default
                    if (locale === 'kaz' || locale === 'kz') {
                        language = 'kaz';
                    } else if (locale === 'rus' || locale === 'ru') {
                        language = 'rus';
                    }

                    // Parse the auth token (stored as JSON string)
                    var authToken = null;
                    try {
                        if (typeof paymentData.epay_access_token === 'string') {
                            authToken = JSON.parse(paymentData.epay_access_token);
                        } else {
                            authToken = paymentData.epay_access_token;
                        }
                    } catch (e) {
                        console.error('Failed to parse auth token:', e);
                        alert('Payment token error. Please try again.');
                        return;
                    }

                    if (!authToken || !authToken.access_token) {
                        console.error('Invalid auth token:', authToken);
                        alert('Payment token is invalid. Please try again.');
                        return;
                    }

                    // Format amount to 2 decimal places to match token endpoint format
                    var amount = parseFloat(paymentData.amount);
                    var formattedAmount = parseFloat(amount.toFixed(2));

                    var paymentObject = {
                        invoiceId: paymentData.epay_invoice_id,
                        backLink: "<?php echo e(route('epay.success')); ?>",
                        failureBackLink: "<?php echo e(route('epay.cancel')); ?>",
                        postLink: "<?php echo e(route('epay.webhook', ['hash' => $restaurant->hash])); ?>",
                        failurePostLink: "<?php echo e(route('epay.webhook', ['hash' => $restaurant->hash])); ?>",
                        language: language,
                        description: descriptionText,
                        terminal: "<?php echo e($paymentGateway->epay_mode === 'sandbox' ? $paymentGateway->test_epay_terminal_id : $paymentGateway->epay_terminal_id); ?>",
                        amount: formattedAmount, // Ensure 2 decimal places to match token request
                        currency: "<?php echo e(strtoupper($restaurant->currency->currency_code)); ?>",
                        auth: authToken, // Pass complete token object as per documentation
                    };

                    // Add customer data if available (optional fields)
                    if (paymentData.order?.customer) {
                        var customer = paymentData.order.customer;
                        if (customer.phone) paymentObject.phone = customer.phone;
                        if (customer.name) paymentObject.name = customer.name;
                        if (customer.email) paymentObject.email = customer.email;
                    } else if (paymentData.order?.customer_id) {
                        // Try to get from global customer if available
                        <?php if($customer): ?>
                        <?php if($customer->phone): ?>
                        paymentObject.phone = "<?php echo e($customer->phone); ?>";
                        <?php endif; ?>
                        <?php if($customer->name): ?>
                        paymentObject.name = "<?php echo e($customer->name); ?>";
                        <?php endif; ?>
                        <?php if($customer->email): ?>
                        paymentObject.email = "<?php echo e($customer->email); ?>";
                        <?php endif; ?>
                        <?php endif; ?>
                    }

                    console.log('Calling halyk.pay() with:', paymentObject);

                    // Call halyk.pay() immediately
                    halyk.pay(paymentObject);
                } catch (error) {
                    console.error('Epay payment error:', error);
                    alert('Payment initialization failed: ' + error.message);
                }
            }

            function payViaRazorpay(payment) {

                var options = {
                    "key": "<?php echo e($restaurant->paymentGateways->razorpay_key); ?>", // Enter the Key ID generated from the Dashboard
                    "amount": (parseFloat(payment.payment.amount) * 100),
                    "currency": "<?php echo e($restaurant->currency->currency_code); ?>",
                    "description": "Order Payment",
                    "image": "<?php echo e($restaurant->logoUrl); ?>",
                    "order_id": payment.payment.razorpay_order_id,
                    "handler": function(response) {
                        Livewire.dispatch('razorpayPaymentCompleted', [response.razorpay_payment_id, response
                            .razorpay_order_id,
                            response.razorpay_signature
                        ]);
                    },
                    "modal": {
                        "ondismiss": function() {
                            if (confirm("Are you sure, you want to close the form?")) {
                                txt = "You pressed OK!";
                                console.log("Checkout form closed by the user");
                            } else {
                                txt = "You pressed Cancel!";
                                console.log("Complete the Payment")
                            }
                        }
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {
                    console.log(response);
                });
                rzp1.open();
            }
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

        <?php
        $__scriptKey = '3713676885-1';
        ob_start();
    ?>
        <script>
            // Prevent closing order type modal by ESC or clicking outside
            document.addEventListener('livewire:init', () => {
                Livewire.on('showOrderTypeModal', (show) => {
                    if (show) {
                        // Disable closing modal
                        const modal = document.querySelector('[x-data*="show"]');
                        if (modal) {
                            modal.addEventListener('click', function(e) {
                                // Prevent click outside from closing
                                e.stopPropagation();
                            });
                        }
                    }
                });
            });
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

    <!-- Loyalty Points Redemption Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(function_exists('module_enabled') && module_enabled('Loyalty') && function_exists('restaurant_modules') && in_array('Loyalty', restaurant_modules())): ?>
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showLoyaltyRedemptionModal','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showLoyaltyRedemptionModal','maxWidth' => 'md']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <?php echo e(__('loyalty::app.redeemLoyaltyPoints')); ?>

            </div>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer && ($availableLoyaltyPoints ?? 0) > 0): ?>
                <div class="space-y-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                        <p class="text-sm font-medium text-blue-900 dark:text-blue-200 mb-2">
                            <?php echo e($customer->name); ?> <?php echo e(__('loyalty::app.hasAvailablePoints')); ?>: <?php echo e(number_format($availableLoyaltyPoints)); ?> <?php echo app('translator')->get('loyalty::app.points'); ?>
                        </p>
                        <p class="text-xs text-blue-700 dark:text-blue-300">
                            <?php echo e(__('loyalty::app.pointsValue')); ?>: <?php echo e(currency_format($loyaltyPointsValue, $restaurant->currency_id)); ?>

                        </p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($maxLoyaltyDiscount > 0): ?>
                            <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">
                                <?php echo e(__('loyalty::app.maxDiscountToday')); ?>: <?php echo e(currency_format($maxLoyaltyDiscount, $restaurant->currency_id)); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <?php echo e(__('loyalty::app.pointsToRedeem')); ?>

                            </label>
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','wire:model.defer' => 'pointsToRedeem','min' => ''.e($minRedeemPoints).'','max' => ''.e($maxRedeemablePoints).'','step' => ''.e($minRedeemPoints).'','class' => 'block w-full','placeholder' => ''.e(__('loyalty::app.enterPoints')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','wire:model.defer' => 'pointsToRedeem','min' => ''.e($minRedeemPoints).'','max' => ''.e($maxRedeemablePoints).'','step' => ''.e($minRedeemPoints).'','class' => 'block w-full','placeholder' => ''.e(__('loyalty::app.enterPoints')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($minRedeemPoints > 0): ?>
                                    <?php echo e(__('Minimum')); ?>: <?php echo e(number_format($minRedeemPoints)); ?> <?php echo app('translator')->get('loyalty::app.points'); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($maxRedeemablePoints > 0): ?>
                                        | <?php echo e(__('Maximum')); ?>: <?php echo e(number_format($maxRedeemablePoints)); ?> <?php echo app('translator')->get('loyalty::app.points'); ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <?php echo e(__('loyalty::app.maxPoints')); ?>: <?php echo e(number_format($availableLoyaltyPoints)); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($minRedeemPoints > 0 && $maxRedeemablePoints > 0): ?>
                                <p class="mt-1 text-xs text-blue-600 dark:text-blue-400">
                                    <?php echo e(__('Points must be in multiples of :min', ['min' => number_format($minRedeemPoints)])); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('loyalty::app.noPointsAvailable')); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex justify-end gap-2 w-full">
                <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'closeLoyaltyRedemptionModal','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('app.cancel')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $attributes = $__attributesOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__attributesOriginala6eb8d48d97827815852966e89cf193a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6eb8d48d97827815852966e89cf193a)): ?>
<?php $component = $__componentOriginala6eb8d48d97827815852966e89cf193a; ?>
<?php unset($__componentOriginala6eb8d48d97827815852966e89cf193a); ?>
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
<?php $component->withAttributes(['wire:click' => 'redeemLoyaltyPoints()','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('loyalty::app.applyDiscount')); ?>

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
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/shop/cart.blade.php ENDPATH**/ ?>