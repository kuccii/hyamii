<div
    class="mx-4 p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!in_array('Theme Setting', restaurant_modules())): ?>
        <?php if (isset($component)) { $__componentOriginaldf75c4825bb48e77d5e4d435ccad7b3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf75c4825bb48e77d5e4d435ccad7b3e = $attributes; } ?>
<?php $component = App\View\Components\UpgradeBox::resolve(['title' => __('modules.settings.themeUpgradeHeading'),'text' => __('modules.settings.themeUpgradeInfo')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('upgrade-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\UpgradeBox::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf75c4825bb48e77d5e4d435ccad7b3e)): ?>
<?php $attributes = $__attributesOriginaldf75c4825bb48e77d5e4d435ccad7b3e; ?>
<?php unset($__attributesOriginaldf75c4825bb48e77d5e4d435ccad7b3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf75c4825bb48e77d5e4d435ccad7b3e)): ?>
<?php $component = $__componentOriginaldf75c4825bb48e77d5e4d435ccad7b3e; ?>
<?php unset($__componentOriginaldf75c4825bb48e77d5e4d435ccad7b3e); ?>
<?php endif; ?>
    <?php else: ?>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold dark:text-white"><?php echo app('translator')->get('modules.settings.themeSettings'); ?></h3>
        </div>

        <form wire:submit.prevent="submitForm" x-data="{ photoName: null, photoPreview: null }">
            <div class="space-y-6">
                
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-base font-medium text-gray-900 dark:text-white"><?php echo e(__('app.logo')); ?></h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                <?php echo e(__('modules.settings.logoDescription')); ?></p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <div class="flex items-center space-x-6">
                        
                        <div class="flex-shrink-0">
                            <div class="relative h-24 w-24">
                                
                                <div x-show="!photoPreview"
                                    class="h-24 w-24 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                                    <img src="<?php echo e(restaurant()->logo_url); ?>" alt="<?php echo e(restaurant()->name); ?>"
                                        class="h-24 w-24 object-contain">
                                </div>

                                
                                <div x-show="photoPreview" style="display: none;">
                                    <span class="block h-24 w-24 rounded-lg bg-cover bg-center bg-no-repeat"
                                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                
                                <div wire:loading wire:target="photo"
                                    class="absolute inset-0 bg-gray-900/60 rounded-lg flex items-center justify-center">
                                    <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        
                        <div class="flex-grow space-y-3">
                            <input type="file" id="photo" class="hidden"
                                accept="image/png, image/gif, image/jpeg, image/webp, image/svg+xml" wire:model.defer="photo"
                                x-ref="photo"
                                x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                            " />

                            <div class="flex flex-wrap gap-3">
                                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['type' => 'button','xOn:click.prevent' => '$refs.photo.click()','class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-on:click.prevent' => '$refs.photo.click()','class' => 'flex items-center']); ?>
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <?php echo e(__('modules.settings.uploadLogo')); ?>

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

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(restaurant()->logo): ?>
                                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['type' => 'button','wire:click' => 'deleteLogo','class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:click' => 'deleteLogo','class' => 'flex items-center']); ?>
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <?php echo e(__('modules.settings.removeLogo')); ?>

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

                            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'photo','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'photo','class' => 'mt-2']); ?>
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

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <?php echo app('translator')->get('modules.settings.logoUploadHelp'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <?php if (isset($component)) { $__componentOriginal74b62b190a03153f11871f645315f4de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74b62b190a03153f11871f645315f4de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.checkbox','data' => ['name' => 'showLogoText','id' => 'showLogoText','wire:model.defer' => 'showLogoText']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'showLogoText','id' => 'showLogoText','wire:model.defer' => 'showLogoText']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $attributes = $__attributesOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__attributesOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $component = $__componentOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__componentOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>

                            <div>
                                <label for="showLogoText" class="font-medium text-gray-900 dark:text-white">
                                    <?php echo app('translator')->get('modules.settings.showLogoText'); ?>
                                </label>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo app('translator')->get('modules.settings.showLogoTextDescription'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="p-5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                <?php echo e(__('modules.settings.favicons')); ?>

                            </h4>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <?php echo e(__('modules.settings.faviconsDescription')); ?>

                                <a href="https://favicon.io/favicon-converter/" target="_blank" class="text-xs underline">
                                    <?php echo e(__('modules.settings.generateFavicon')); ?> →
                                </a>
                            </p>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['upload_fav_icon_android_chrome_192', 'upload_fav_icon_android_chrome_512', 'upload_fav_icon_apple_touch_icon', 'upload_favicon_16', 'upload_favicon_32', 'favicon']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col items-center space-y-2">
                                    <div id="filePreview<?php echo e($name); ?>"
                                        class="h-10 w-10 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center overflow-hidden"
                                        style="background-image: url('<?php echo e(${$name} ? ${$name}->temporaryUrl() :  restaurant()->{$name."_url"}); ?>'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                                    </div>

                                    <div class="text-center w-full">
                                        <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1 line-clamp-2 h-8" title="<?php echo e(__('modules.settings.' . $name)); ?>">
                                            <?php echo e(__('modules.settings.' . $name)); ?>

                                        </p>

                                        <input type="file" id="<?php echo e($name); ?>" class="hidden"
                                            accept="image/png, image/gif, image/jpeg, image/webp, image/svg+xml, image/x-icon"
                                            wire:model.defer="<?php echo e($name); ?>" x-ref="<?php echo e($name); ?>"
                                            x-on:change="
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    document.getElementById('filePreview<?php echo e($name); ?>').style.backgroundImage = 'url(' + e.target.result + ')';
                                                };
                                                reader.readAsDataURL($refs.<?php echo e($name); ?>.files[0]);
                                            " />

                                        <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['type' => 'button','xOn:click.prevent' => '$refs.'.e($name).'.click()','class' => 'w-full flex items-center justify-center text-xs py-1 px-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-on:click.prevent' => '$refs.'.e($name).'.click()','class' => 'w-full flex items-center justify-center text-xs py-1 px-1']); ?>
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            <?php echo e(__('app.upload')); ?>

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

                                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => ''.e($name).'','class' => 'mt-1 text-xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => ''.e($name).'','class' => 'mt-1 text-xs']); ?>
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
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>


                
                <div
                    class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-base font-medium text-gray-900 dark:text-white">
                                <?php echo e(__('modules.settings.themeColor')); ?></h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                <?php echo e(__('modules.settings.themeColorDescription')); ?></p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($themeColor); ?></span>
                            <input type="color"
                                class="p-1 h-8 w-12 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700"
                                id="themeColor" title="Choose your color" wire:model='themeColor'>
                        </div>
                    </div>
                    <div class="mt-4 space-y-6">
                        
                        <div class="space-y-2">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.professional'); ?></span>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['#2563EB', '#059669', '#7C3AED', '#0891B2', '#EA580C', '#4F46E5', '#0D9488', '#9333EA']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" wire:click="$set('themeColor', '<?php echo e($color); ?>')"
                                        class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 hover:scale-110 transition-transform"
                                        style="background-color: <?php echo e($color); ?>" title="<?php echo e($color); ?>">
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        
                        <div class="space-y-2">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.pastel'); ?></span>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['#93C5FD', '#86EFAC', '#FDE68A', '#FDBA74', '#DDD6FE', '#99F6E4', '#FCA5A5', '#A5B4FC']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" wire:click="$set('themeColor', '<?php echo e($color); ?>')"
                                        class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 hover:scale-110 transition-transform"
                                        style="background-color: <?php echo e($color); ?>" title="<?php echo e($color); ?>">
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        
                        <div class="space-y-2">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.warm'); ?></span>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['#F97316', '#DC2626', '#D946EF', '#EC4899', '#F43F5E', '#FB923C', '#E11D48', '#F59E0B']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" wire:click="$set('themeColor', '<?php echo e($color); ?>')"
                                        class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-800 hover:scale-110 transition-transform"
                                        style="background-color: <?php echo e($color); ?>" title="<?php echo e($color); ?>">
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'themeColor','class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'themeColor','class' => 'mt-2']); ?>
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

                
                <div class="flex items-center justify-end space-x-3">
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->any()),'wire:loading.attr' => 'disabled','wire:target' => 'photo','class' => 'min-w-[100px]']); ?>
                        <?php echo app('translator')->get('app.save'); ?>
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
            </div>
        </form>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/settings/theme-settings.blade.php ENDPATH**/ ?>