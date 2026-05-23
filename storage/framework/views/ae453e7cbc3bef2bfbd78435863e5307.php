<?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showRaiseSupportTicketModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showRaiseSupportTicketModal']); ?>
     <?php $__env->slot('title', null, []); ?> 
        <h2 class="text-lg"><?php echo app('translator')->get('superadmin.raiseSupportTicket'); ?></h2>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('content', null, []); ?> 
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">Choose Your Support Option</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Select the support service that best fits your needs</p>
            </div>
            
            <!-- Support Options -->
            <div class="space-y-6">
                <!-- Envato Support Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn.worldvectorlogo.com/logos/envato.svg" alt="Envato" class="h-8 w-8 object-contain mr-3">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Envato Regular Support</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Included with your purchase</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">Response time: 24-48 working hours</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">Email & forum support</span>
                            </div>
                       
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">General documentation and guides</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">Community forum access</span>
                            </div>
                           
                        </div>
                    </div>
                    
                    <div class="flex">
                        <a href="https://froiden.freshdesk.com/support/tickets/new" target="_blank" 
                           class="inline-flex items-center px-6 py-2 bg-zinc-600 hover:bg-zinc-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Raise Ticket
                        </a>
                    </div>
                </div>

                <!-- Priority Support Card -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-700 relative">
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            Recommended
                        </span>
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <img src="https://envato.froid.works/logo-froiden.png" alt="Froiden" class="h-8 w-8 object-contain mr-3">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Priority Support</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Premium enhancement service</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">Response time: 4 working hours</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">WhatsApp support</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">One-on-one Zoom consultations</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">Code discussion with developer</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">Dedicated support team</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="h-4 w-4 text-skin-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-skin-base dark:text-skin-base font-medium">Priority queue access</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex">
                        <a href="https://envato.froid.works/priority-support?purchase_code=<?php echo e(global_setting()->purchase_code); ?>&utm_source=tabletrack_app&utm_campaign=priority_support" target="_blank" 
                                class="inline-flex items-center px-6 py-2 bg-skin-base hover:bg-skin-base/[.8] text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Know More
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex w-full pb-4 space-x-4 rtl:space-x-reverse mt-6 justify-end">
                <?php if (isset($component)) { $__componentOriginala6eb8d48d97827815852966e89cf193a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6eb8d48d97827815852966e89cf193a = $attributes; } ?>
<?php $component = App\View\Components\ButtonCancel::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-cancel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonCancel::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => '$set(\'showRaiseSupportTicketModal\', false)']); ?><?php echo app('translator')->get('app.close'); ?> <?php echo $__env->renderComponent(); ?>
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
<?php endif; ?> <?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/raise-support-ticket.blade.php ENDPATH**/ ?>