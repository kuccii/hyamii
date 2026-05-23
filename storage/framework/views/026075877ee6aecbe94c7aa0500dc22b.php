<!DOCTYPE html>
<html lang="<?php echo e(session('customer_locale') ?? global_setting()->locale); ?>" dir="<?php echo e(session('customer_is_rtl') ? 'rtl' : 'ltr'); ?>">

<head>
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>" crossorigin="use-credentials">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(global_setting()->upload_fav_icon_apple_touch_icon_url); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(global_setting()->upload_fav_icon_android_chrome_192_url); ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo e(global_setting()->upload_fav_icon_android_chrome_512_url); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(global_setting()->upload_fav_icon_16_url); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(global_setting()->upload_fav_icon_32_url); ?>">
    <link rel="shortcut icon" href="<?php echo e(global_setting()->favicon_url); ?>">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(global_setting()->logoUrl); ?>">

    
    <meta name="keywords" content="<?php echo e(global_setting()->meta_keyword ?? global_setting()->name); ?>">
    <meta name="description" content="<?php echo e(global_setting()->meta_description ?? global_setting()->name); ?>">

    <title><?php echo e(global_setting()->meta_title ?? global_setting()->name); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <?php echo $__env->make('sections.theme_style', [
        'baseColor' => global_setting()->theme_rgb,
        'baseColorHex' => global_setting()->theme_hex,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(File::exists(public_path() . '/css/app-custom.css')): ?>
    <link href="<?php echo e(asset('css/app-custom.css')); ?>" rel="stylesheet">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if ($__env->exists('sections.custom_script_landing')) echo $__env->make('sections.custom_script_landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-950">
    <div class="min-h-svh">
        <header class="fixed top-0 inset-x-0 z-50 transition-all duration-300" id="site-header">
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 app-logo shrink-0">
                        <img src="<?php echo e(global_setting()->logoUrl); ?>" class="h-8 w-auto lg:h-9" alt="App Logo" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->show_logo_text): ?>
                            <span class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e(global_setting()->name); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>

                    <div class="hidden lg:flex lg:items-center lg:gap-8">
                        <a href="<?php echo e(url('/')); ?>" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors"><?php echo app('translator')->get('landing.navHome'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#features" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors"><?php echo app('translator')->get('landing.navFeatures'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#pricing" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors"><?php echo app('translator')->get('landing.navPricing'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#faq" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors"><?php echo app('translator')->get('landing.navFaq'); ?></a>
                        <?php
                            $customMenu = App\Models\CustomMenu::orderBy('sort_order')->get();
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menu->is_active && $menu->position == 'header'): ?>
                                <a href="<?php echo e(route('customMenu', ['slug' => $menu->menu_slug])); ?>" class="text-sm font-medium text-gray-700 hover:text-skin-base dark:text-gray-300 dark:hover:text-skin-base transition-colors"><?php echo e($menu->menu_name); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="theme-toggle" type="button" class="rounded-lg p-2.5 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700" aria-label="Toggle dark mode">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586"/></svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                        </button>

                        <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()): ?>
                                <?php echo app('translator')->get('menu.dashboard'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('landing.navLogin'); ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!user()): ?>
                            <a href="<?php echo e(route('restaurant_signup')); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-skin-base hover:bg-skin-base/90 shadow-sm transition-all">
                                <?php echo app('translator')->get('landing.getStarted'); ?>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <button type="button" id="mobile-menu-toggle" class="lg:hidden rounded-lg p-2.5 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none" aria-label="Open menu">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="hidden lg:hidden pb-4">
                    <div class="flex flex-col gap-2 px-2 py-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                        <a href="<?php echo e(url('/')); ?>" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo app('translator')->get('landing.navHome'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#features" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo app('translator')->get('landing.navFeatures'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#pricing" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo app('translator')->get('landing.navPricing'); ?></a>
                        <a href="<?php echo e(url('/')); ?>#faq" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo app('translator')->get('landing.navFaq'); ?></a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menu->is_active && $menu->position == 'header'): ?>
                                <a href="<?php echo e(route('customMenu', ['slug' => $menu->menu_slug])); ?>" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo e($menu->menu_name); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <hr class="border-gray-200 dark:border-gray-700 my-1">
                        <a href="<?php echo e(route('login')); ?>" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800"><?php echo app('translator')->get('landing.navLogin'); ?></a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!user()): ?>
                            <a href="<?php echo e(route('restaurant_signup')); ?>" class="px-3 py-2 text-sm font-medium text-white rounded-lg bg-skin-base text-center"><?php echo app('translator')->get('landing.getStarted'); ?></a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo e($slot ?? ''); ?>

        </main>

        <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
                    <div class="col-span-2 md:col-span-1">
                        <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 app-logo mb-4">
                            <img src="<?php echo e(global_setting()->logoUrl); ?>" class="h-8 w-auto" alt="App Logo" />
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->show_logo_text): ?>
                                <span class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e(global_setting()->name); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4"><?php echo app('translator')->get('landing.heroSearchEngine'); ?></p>
                        <div class="flex gap-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->facebook_link): ?>
                                <a href="<?php echo e(global_setting()->facebook_link); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->twitter_link): ?>
                                <a href="<?php echo e(global_setting()->twitter_link); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->instagram_link): ?>
                                <a href="<?php echo e(global_setting()->instagram_link); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(global_setting()->google_business_link): ?>
                                <a href="<?php echo e(global_setting()->google_business_link); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21.35 11.1h-9.3v2.95h5.43c-.235 1.34-1.22 3.925-5.43 3.925-3.27 0-5.94-2.705-5.94-6.05s2.67-6.05 5.94-6.05c1.87 0 3.12.8 3.84 1.48l2.62-2.52C17.65 2.3 15.84 1.4 13.5 1.4 7.68 1.4 3 5.92 3 11.4s4.68 10 10.5 10c5.97 0 9.9-4.22 9.9-10 0-.67-.08-1.33-.05-1.7z"/></svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4"><?php echo app('translator')->get('landing.footerProduct'); ?></h3>
                        <ul class="space-y-3">
                            <li><a href="<?php echo e(url('/')); ?>#features" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.features'); ?></a></li>
                            <li><a href="<?php echo e(url('/')); ?>#pricing" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.pricing'); ?></a></li>
                            <li><a href="<?php echo e(route('restaurant_signup')); ?>" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.getStarted'); ?></a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4"><?php echo app('translator')->get('landing.footerCompany'); ?></h3>
                        <ul class="space-y-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menu->is_active && $menu->position == 'footer'): ?>
                                    <li><a href="<?php echo e(route('customMenu', ['slug' => $menu->menu_slug])); ?>" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo e($menu->menu_name); ?></a></li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li><a href="<?php echo e(url('/')); ?>#contact" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.footerContact'); ?></a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4"><?php echo app('translator')->get('landing.footerSupport'); ?></h3>
                        <ul class="space-y-3">
                            <li><a href="<?php echo e(url('/')); ?>#faq" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.faq'); ?></a></li>
                            <li><a href="mailto:<?php echo e(__('landing.contactEmail')); ?>" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"><?php echo app('translator')->get('landing.emailTitle'); ?></a></li>
                        </ul>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(languages()->count() > 1): ?>
                            <div class="mt-6">
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('shop.languageSwitcher');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1196356278-0', $__key);

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
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-800">
                    <p class="text-sm text-gray-400 dark:text-gray-500 text-center">© <?php echo e(now()->year); ?> <a href="<?php echo e(url('/')); ?>" class="hover:underline"><?php echo e(global_setting()->name); ?></a>. <?php echo app('translator')->get('landing.rightsReserved'); ?></p>
                </div>
            </div>
        </footer>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->make('layouts.update-uri', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.service-worker-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.pusher-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if (isset($component)) { $__componentOriginald2d87b894a350bded0052b294742bbb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald2d87b894a350bded0052b294742bbb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-alert::components.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('livewire-alert::flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald2d87b894a350bded0052b294742bbb9)): ?>
<?php $attributes = $__attributesOriginald2d87b894a350bded0052b294742bbb9; ?>
<?php unset($__attributesOriginald2d87b894a350bded0052b294742bbb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald2d87b894a350bded0052b294742bbb9)): ?>
<?php $component = $__componentOriginald2d87b894a350bded0052b294742bbb9; ?>
<?php unset($__componentOriginald2d87b894a350bded0052b294742bbb9); ?>
<?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <style>
        .btn-primary {
            @apply inline-flex items-center gap-2 px-8 py-3.5 text-base font-semibold text-white rounded-xl bg-skin-base hover:bg-skin-base/90 shadow-lg shadow-skin-base/25 hover:shadow-xl hover:shadow-skin-base/30 transition-all duration-200;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .btn-secondary {
            @apply inline-flex items-center gap-2 px-8 py-3.5 text-base font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-750 shadow-sm transition-all duration-200;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            border-color: rgba(var(--color-base), 0.3);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('site-header');
            if (header) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        header.classList.add('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-xl', 'shadow-sm');
                        header.classList.remove('bg-transparent');
                    } else {
                        header.classList.remove('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-xl', 'shadow-sm');
                        header.classList.add('bg-transparent');
                    }
                });
            }

            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });

            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            if (revealElements.length && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
                revealElements.forEach(function(el) { observer.observe(el); });
            }
    </script>
</body>

</html><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/layouts/landing.blade.php ENDPATH**/ ?>