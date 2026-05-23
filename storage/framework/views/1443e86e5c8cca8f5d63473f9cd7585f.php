<?php $__env->startSection('hide-footer', true); ?>

<?php $__env->startSection('content'); ?>




<div class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-tr from-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/10 to-transparent blur-3xl opacity-40 dark:opacity-20 pointer-events-none rounded-full"></div>
<div class="absolute top-[800px] right-10 w-[500px] h-[500px] bg-gradient-to-br from-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/5 to-transparent blur-3xl opacity-30 pointer-events-none rounded-full"></div>




<section class="relative overflow-hidden pt-12 pb-20 sm:pt-16 sm:pb-24 lg:pt-24 lg:pb-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            
            <div class="flex-1 text-center lg:text-left relative z-10">
                
                
                <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-white/70 dark:bg-gray-900/60 backdrop-blur-md rounded-full shadow-sm border border-gray-150 dark:border-gray-800 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-8 transition-transform hover:scale-[1.02] font-label tracking-wider uppercase">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color: rgb(<?php echo e($restaurant->theme_rgb); ?>)"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2" style="background-color: rgb(<?php echo e($restaurant->theme_rgb); ?>)"></span>
                    </span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->short_description): ?>
                        <?php echo e($restaurant->short_description); ?>

                    <?php else: ?>
                        <?php echo app('translator')->get('messages.experienceOurService'); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white leading-[1.12] tracking-tight">
                    Welcome to <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r font-black" style="background-image: linear-gradient(to right, rgb(<?php echo e($restaurant->theme_rgb); ?>), rgb(<?php echo e($restaurant->theme_rgb); ?>/0.7))">
                        <?php echo e($restaurant->name); ?>

                    </span>
                </h1>

                
                <p class="mt-6 text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                    <?php echo app('translator')->get('messages.experienceOurService'); ?> Savor exceptional culinary creations prepared by masters of flavor, utilizing the freshest local ingredients.
                </p>

                
                <div class="mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($shopBranch) && $shopBranch->address): ?>
                        <div class="flex items-center gap-2.5 px-4 py-2.5 bg-white/80 dark:bg-gray-900/50 backdrop-blur-md rounded-2xl border border-gray-150 dark:border-gray-800/85 text-xs sm:text-sm text-gray-600 dark:text-gray-400 shadow-sm transition-all hover:border-gray-300 dark:hover:border-gray-750 font-label">
                            <span class="material-symbols-outlined text-lg" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)">location_on</span>
                            <span class="truncate max-w-[220px] font-medium"><?php echo e($shopBranch->address); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($shopBranch) && $shopBranch->opening_time && $shopBranch->closing_time): ?>
                        <div class="flex items-center gap-2.5 px-4 py-2.5 bg-white/80 dark:bg-gray-900/50 backdrop-blur-md rounded-2xl border border-gray-150 dark:border-gray-800/85 text-xs sm:text-sm text-gray-600 dark:text-gray-400 shadow-sm transition-all hover:border-gray-300 dark:hover:border-gray-750 font-label">
                            <span class="material-symbols-outlined text-lg" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)">schedule</span>
                            <span class="font-medium"><?php echo e($shopBranch->opening_time); ?> - <?php echo e($shopBranch->closing_time); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->phone_number): ?>
                        <a href="tel:<?php echo e($restaurant->phone_number); ?>"
                           class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl text-sm font-semibold text-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0"
                           style="background-color: rgb(<?php echo e($restaurant->theme_rgb); ?>); box-shadow: 0 10px 25px -5px rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.3);">
                            <span class="material-symbols-outlined text-lg">call</span>
                            <?php echo e($restaurant->phone_number); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <a href="#order-section" 
                       class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-semibold bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-300">
                        Explore Menu
                        <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </a>
                </div>
            </div>

            
            <div class="flex-1 w-full max-w-md lg:max-w-none relative">
                
                
                <div class="absolute -top-6 -left-6 z-20 bg-white dark:bg-gray-950 p-4 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-850 flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500">
                        <span class="material-symbols-outlined text-xl">workspace_premium</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">High Quality</p>
                        <p class="text-xs sm:text-sm font-bold text-gray-800 dark:text-gray-200">100% Fresh Food</p>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-4 z-20 bg-white dark:bg-gray-950 p-4 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-850 flex items-center gap-3 animate-bounce" style="animation-duration: 5s;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.1)">
                        <span class="material-symbols-outlined text-xl" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)">local_shipping</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Speed Delivery</p>
                        <p class="text-xs sm:text-sm font-bold text-gray-800 dark:text-gray-200">Express Service</p>
                    </div>
                </div>

                
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-tr from-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/30 to-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/10 rounded-3xl blur-2xl opacity-40 group-hover:opacity-60 transition duration-1000 group-hover:duration-200"></div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroImageUrl): ?>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/20">
                            <img src="<?php echo e($heroImageUrl); ?>" alt="<?php echo e($restaurant->name); ?>" class="w-full h-auto object-cover aspect-[4/3] transform transition duration-700 group-hover:scale-105" />
                        </div>
                    <?php else: ?>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br" style="background: linear-gradient(135deg, rgb(<?php echo e($restaurant->theme_rgb); ?>/0.15), rgb(<?php echo e($restaurant->theme_rgb); ?>/0.03)); padding: 2.5rem; border: 1px solid rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.15);">
                            <div class="aspect-[4/3] flex items-center justify-center">
                                <img src="<?php echo e($restaurant->logoUrl); ?>" alt="<?php echo e($restaurant->name); ?>" class="max-w-[55%] max-h-[55%] object-contain opacity-50 dark:opacity-40 filter drop-shadow-md transform transition duration-500 group-hover:scale-105" />
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="h-[1px] bg-gradient-to-r from-transparent via-gray-250/70 dark:via-gray-800/60 to-transparent"></div>
</div>




<section class="py-20 sm:py-24" id="order-section">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        
        <div class="text-center mb-12 reveal">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-150/80 dark:bg-gray-900/50 backdrop-blur-md rounded-full text-xs font-semibold text-gray-600 dark:text-gray-400 mb-4 border border-gray-200/40 dark:border-gray-800/40">
                <span class="material-symbols-outlined text-sm">restaurant_menu</span>
                <?php echo app('translator')->get('menu.orderOnline'); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                <?php echo app('translator')->get('menu.orderOnline'); ?>
            </h2>
            <p class="mt-3 text-gray-500 dark:text-gray-400 max-w-md mx-auto font-light">
                Choose from our delicious options and build your custom order in real-time.
            </p>
        </div>

        
        <div>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('shop.cart', [
                'tableID' => $tableHash ?? null,
                'restaurant' => $restaurant ?? null,
                'shopBranch' => $shopBranch ?? null,
                'getTable' => $getTable ?? false,
                'canCreateOrder' => $canCreateOrder,
            ]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-834226574-0', $__key);

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
</section>




<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="h-[1px] bg-gradient-to-r from-transparent via-gray-250/70 dark:via-gray-800/60 to-transparent"></div>
</div>




<section class="py-20 sm:py-24 bg-gray-50/30 dark:bg-gray-950/10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        
        <div class="text-center mb-16 reveal">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-150/80 dark:bg-gray-900/50 backdrop-blur-md rounded-full text-xs font-semibold text-gray-600 dark:text-gray-400 mb-4 border border-gray-200/40 dark:border-gray-800/40">
                <span class="material-symbols-outlined text-sm">help</span>
                <?php echo app('translator')->get('menu.howItWorks'); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight"><?php echo app('translator')->get('messages.elevateEveryTouchpoint'); ?></h2>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
                $steps = [
                    ['icon' => 'qr_code_scanner', 'title' => __('messages.scan'), 'desc' => __('messages.scanDescription'), 'num' => '01'],
                    ['icon' => 'touch_app', 'title' => __('messages.order'), 'desc' => __('messages.orderDescription'), 'num' => '02'],
                    ['icon' => 'wallet', 'title' => __('messages.pay'), 'desc' => __('messages.payDescription'), 'num' => '03'],
                ];
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-white dark:bg-gray-900 rounded-3xl p-8 border border-gray-150 dark:border-gray-850 hover:border-gray-300 dark:hover:border-gray-700 hover:shadow-xl transition-all duration-300 reveal flex flex-col justify-between">
                    
                    
                    <div class="absolute top-6 right-8 text-5xl font-black text-gray-105 dark:text-gray-800/30 select-none font-hanken group-hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/15 transition duration-300">
                        <?php echo e($step['num']); ?>

                    </div>

                    <div>
                        
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3 shadow-sm"
                             style="background-color: rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.08)">
                            <span class="material-symbols-outlined text-2xl transition duration-350 group-hover:scale-110" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)"><?php echo e($step['icon']); ?></span>
                        </div>
                        
                        
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200"><?php echo e($step['title']); ?></h3>
                        
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed font-light"><?php echo e($step['desc']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>




<section class="py-20 sm:py-24 relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="rounded-3xl p-8 sm:p-14 lg:p-20 text-center relative overflow-hidden reveal shadow-xl border"
             style="background: radial-gradient(circle at top right, rgb(<?php echo e($restaurant->theme_rgb); ?>/0.15), transparent 60%), linear-gradient(135deg, rgb(<?php echo e($restaurant->theme_rgb); ?>/0.05), rgb(<?php echo e($restaurant->theme_rgb); ?>/0.01)); border-color: rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.15);">
            
            
            <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)]/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/60 dark:bg-gray-900/60 backdrop-blur-md rounded-full text-xs font-semibold text-gray-600 dark:text-gray-400 mb-6 border border-gray-100 dark:border-gray-800">
                    <span class="material-symbols-outlined text-xs">store</span>
                    <?php echo app('translator')->get('messages.visitUsToday'); ?>
                </span>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-tight max-w-2xl mx-auto">
                    Ready to taste excellence? <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r font-black" style="background-image: linear-gradient(to right, rgb(<?php echo e($restaurant->theme_rgb); ?>), rgb(<?php echo e($restaurant->theme_rgb); ?>/0.7))">Visit us or place your order online!</span>
                </h2>
                
                <p class="mt-4 text-gray-500 dark:text-gray-400 max-w-md mx-auto font-light">
                    <?php echo app('translator')->get('messages.experienceOurService'); ?> Experience our high quality dishes in a gorgeous premium atmosphere.
                </p>
                
                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($shopBranch) && $shopBranch->address): ?>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($shopBranch->address)); ?>" target="_blank"
                           class="inline-flex items-center gap-2.5 px-6 py-4 rounded-2xl text-sm font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5"
                           style="background-color: rgb(<?php echo e($restaurant->theme_rgb); ?>); color: white; box-shadow: 0 10px 25px -5px rgba(<?php echo e($restaurant->theme_rgb); ?>, 0.35);">
                            <span class="material-symbols-outlined text-lg">explore</span>
                            <?php echo app('translator')->get('landing.openInGoogleMaps'); ?>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->phone_number): ?>
                        <a href="tel:<?php echo e($restaurant->phone_number); ?>"
                           class="inline-flex items-center gap-2.5 px-6 py-4 rounded-2xl text-sm font-semibold bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5">
                            <span class="material-symbols-outlined text-lg text-gray-500">call</span>
                            <?php echo e($restaurant->phone_number); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>




<footer class="py-16 sm:py-20 border-t border-gray-150 dark:border-gray-850 bg-white dark:bg-gray-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3.5 mb-6">
                    <img src="<?php echo e($restaurant->logoUrl); ?>" class="h-10 w-10 rounded-xl object-cover shadow-sm border border-gray-100 dark:border-gray-800" alt="" />
                    <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight"><?php echo e($restaurant->name); ?></span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed font-light max-w-xs">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->short_description): ?>
                        <?php echo e($restaurant->short_description); ?>

                    <?php else: ?>
                        <?php echo app('translator')->get('messages.experienceOurService'); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
            </div>

            
            <div>
                <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6"><?php echo app('translator')->get('messages.quickLinks'); ?></h4>
                <ul class="space-y-4 text-sm text-gray-500 dark:text-gray-400">
                    <li><a href="<?php echo e(route('shop_restaurant', [$restaurant->hash])); ?>" class="hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200"><?php echo app('translator')->get('menu.home'); ?></a></li>
                    <li><a href="<?php echo e(route('shop_about', [$restaurant->hash])); ?>" class="hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200"><?php echo app('translator')->get('menu.about'); ?></a></li>
                    <li><a href="<?php echo e(route('shop_contact', [$restaurant->hash])); ?>" class="hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200"><?php echo app('translator')->get('menu.contact'); ?></a></li>
                </ul>
            </div>

            
            <div>
                <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6"><?php echo app('translator')->get('app.contact'); ?></h4>
                <ul class="space-y-4 text-sm text-gray-500 dark:text-gray-400">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->email): ?>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)">mail</span>
                            <a href="mailto:<?php echo e($restaurant->email); ?>" class="hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200 truncate"><?php echo e($restaurant->email); ?></a>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->phone_number): ?>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base" style="color: rgb(<?php echo e($restaurant->theme_rgb); ?>)">call</span>
                            <a href="tel:<?php echo e($restaurant->phone_number); ?>" class="hover:text-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition duration-200"><?php echo e($restaurant->phone_number); ?></a>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            
            <div>
                <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6"><?php echo app('translator')->get('messages.followUs'); ?></h4>
                <div class="flex flex-wrap gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->facebook_link): ?>
                        <a href="<?php echo e($restaurant->facebook_link); ?>" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:text-white dark:text-gray-400 hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] dark:hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition-all duration-300 border border-gray-150 dark:border-gray-850 shadow-sm" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->instagram_link): ?>
                        <a href="<?php echo e($restaurant->instagram_link); ?>" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:text-white dark:text-gray-400 hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] dark:hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition-all duration-300 border border-gray-150 dark:border-gray-850 shadow-sm" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($restaurant->twitter_link): ?>
                        <a href="<?php echo e($restaurant->twitter_link); ?>" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 hover:text-white dark:text-gray-400 hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] dark:hover:bg-[rgb(<?php echo e($restaurant->theme_rgb); ?>)] transition-all duration-300 border border-gray-150 dark:border-gray-850 shadow-sm" aria-label="Twitter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="pt-8 border-t border-gray-150 dark:border-gray-850 text-center text-xs text-gray-400 dark:text-gray-600 font-light">
            <p>&copy; <?php echo e(now()->year); ?> <?php echo e($restaurant->name); ?>. <?php echo app('translator')->get('app.allRightsReserved'); ?></p>
        </div>
    </div>
</footer>




<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const gsap = window.gsap;
    if (!gsap) return;

    // Hero entrance
    const heroContent = document.querySelector('.flex-1.text-center');
    if (heroContent) {
        gsap.from(heroContent.children, {
            opacity: 0,
            y: 30,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
        });
    }

    // Scroll Reveal for .reveal elements
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    gsap.to(entry.target, {
                        opacity: 1,
                        y: 0,
                        duration: 0.7,
                        ease: 'power3.out',
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => {
            observer.observe(el);
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('customer.signup', ['restaurant' => $restaurant]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-834226574-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/shop/index.blade.php ENDPATH**/ ?>