<?php $__env->startSection('content'); ?>
<div class="p-4 bg-white block dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-between mb-4">
        <h1 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('modules.dashboard.onboarding'); ?></h1>
    </div>

    <div class="mb-4">
        <p class="text-gray-700 dark:text-gray-300">
            <?php echo app('translator')->get('modules.dashboard.onboardingDescription'); ?>
        </p>
    </div>

    <div class="space-y-4">
        <?php
            // Use $urlHasPublic from controller, or calculate if not provided (fallback for other routes)
            if (!isset($urlHasPublic)) {
                $currentUrl = request()->url();
                $urlPath = parse_url($currentUrl, PHP_URL_PATH);
                $urlHasPublic = str_contains($urlPath, '/public/') || str_ends_with($urlPath, '/public') || str_starts_with($urlPath, '/public');
            }
        ?>

        <!-- Step 1: Installation -->
        <div class="p-4 border rounded-lg dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <span class="flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">1. <?php echo app('translator')->get('modules.dashboard.installation'); ?></h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        <?php echo app('translator')->get('modules.dashboard.installationCompleted'); ?>
                    </p>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($urlHasPublic): ?>
        <!-- Step 2: Remove Public from URL -->
        <div class="p-4 border rounded-lg dark:border-gray-700 border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/10">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <span class="flex items-center justify-center w-8 h-8 text-white bg-red-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">2. Remove "public" from URL</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Your application URL contains "public" which is not recommended for production. Removing "public" from the URL is very important to run the application smoothly and securely.
                    </p>
                    <div class="mt-3">
                        <a href="https://community.froiden.com/d/14-how-to-remove-public-from-url" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            View Documentation
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Step <?php echo e($urlHasPublic ? '3' : '2'); ?>: SMTP Configuration -->
        <div class="p-4 border rounded-lg dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <span class="flex items-center justify-center w-8 h-8 text-white <?php echo e(!$smtpConfigured ? 'bg-red-500' : 'bg-green-500'); ?> rounded-full">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$smtpConfigured): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white"><?php echo e($urlHasPublic ? '3' : '2'); ?>. <?php echo app('translator')->get('modules.dashboard.smtpConfiguration'); ?></h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        <?php echo app('translator')->get('modules.dashboard.smtpConfigurationDescription'); ?>
                    </p>
                    <div class="mt-2">
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:navigate' => true,'href' => ''.e(route('superadmin.superadmin-settings.index').'?tab=email').'','class' => 'inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500']); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <?php echo app('translator')->get('modules.settings.emailSettings'); ?>
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
            </div>
        </div>

        <!-- Step <?php echo e($urlHasPublic ? '4' : '3'); ?>: CRON Job Configuration -->
        <div class="p-4 border rounded-lg dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 <?php echo e(!$cronConfigured ? 'bg-red-500' : 'bg-green-500'); ?> rounded-full">
                    <span class="flex items-center justify-center w-8 h-8 text-white rounded-full">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$cronConfigured): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>

                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white"><?php echo e($urlHasPublic ? '4' : '3'); ?>. <?php echo app('translator')->get('modules.dashboard.cronJobConfiguration'); ?></h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        <?php echo app('translator')->get('modules.dashboard.cronJobConfigurationDescription'); ?>
                    </p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$cronConfigured): ?>
                        <div class="mt-2">
                            <?php if (isset($component)) { $__componentOriginale691f3c66b4e7efe99161ec4ba911fdc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc = $attributes; } ?>
<?php $component = App\View\Components\CronMessage::resolve(['showModal' => true,'modal' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cron-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CronMessage::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['showModalOnboarding' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc)): ?>
<?php $attributes = $__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc; ?>
<?php unset($__attributesOriginale691f3c66b4e7efe99161ec4ba911fdc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale691f3c66b4e7efe99161ec4ba911fdc)): ?>
<?php $component = $__componentOriginale691f3c66b4e7efe99161ec4ba911fdc; ?>
<?php unset($__componentOriginale691f3c66b4e7efe99161ec4ba911fdc); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Step <?php echo e($urlHasPublic ? '5' : '4'); ?>: Application Name Change -->
        <div class="p-4 border rounded-lg dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 <?php echo e(!$appNameChanged ? 'bg-red-500' : 'bg-green-500'); ?> rounded-full">
                    <span class="flex items-center justify-center w-8 h-8 text-white rounded-full">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$appNameChanged): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white"><?php echo e($urlHasPublic ? '5' : '4'); ?>. <?php echo app('translator')->get('modules.dashboard.applicationNameChange'); ?></h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        <?php echo app('translator')->get('modules.dashboard.applicationNameChangeDescription'); ?>
                    </p>
                    <div class="mt-2">
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','wire:navigate' => true,'href' => ''.e(route('superadmin.superadmin-settings.index')).'','class' => 'inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500']); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <?php echo app('translator')->get('modules.settings.appSettings'); ?> <?php echo $__env->renderComponent(); ?>
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
            </div>
        </div>

         <!-- Additional Help Section -->
         <div class="p-4 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <span class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Need Additional Help?</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        If you encounter any issues during the setup process or have questions about any of the configuration steps, our support team is here to help.
                    </p>
                    <div class="mt-3">
                        <a href="javascript:void(0)" onclick="window.Livewire.dispatch('showRaiseSupportTicket')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-skin-base rounded-md hover:bg-skin-base/[.8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-skin-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Contact Support
                        </a>
                        <a href="https://froiden.freshdesk.com/en/support/solutions/categories/43000374162" target="_blank" class="ml-2 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            View Documentation
                        </a>

                        <a href="https://codecanyon.net/downloads" target="_blank" class="ml-2 inline-flex items-center px-4 py-2 text-sm font-medium text-skin-base bg-white border border-skin-base rounded-md hover:bg-skin-base/[.1] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-skin-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Rate the product on codecanyon
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/dashboard/onboarding.blade.php ENDPATH**/ ?>