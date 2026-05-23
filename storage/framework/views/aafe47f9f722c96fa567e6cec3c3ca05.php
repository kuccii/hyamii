<div>
    <div class="my-4 grid gap-6 grid-cols-3">
        <!-- Card Section -->
        <div class="space-y-8 col-span-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col gap-3 sm:gap-4 space-y-3" wire:key="area-<?php echo e($area->id); ?>">
                    <h3 class="f-15 font-medium inline-flex gap-2 items-center dark:text-neutral-200">
                        <?php echo e($area->area_name); ?>

                        <span class="px-2 py-1 text-sm rounded bg-slate-100 border-gray-300 border text-gray-800">
                            <?php echo e($area->tables->count()); ?> <?php echo app('translator')->get('modules.table.table'); ?>
                        </span>
                    </h3>

                    <div class="grid sm:grid-cols-3 gap-3 sm:gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $isLocked = $item->tableSession?->isLocked() ?? false;
                                $isLockedByCurrentUser = $isLocked && $item->tableSession?->locked_by_user_id === auth()->id();
                                $isLockedByOtherUser = $isLocked && $item->tableSession?->locked_by_user_id !== auth()->id();
                                $isActive = $item->status == 'active';
                                $isInactive = $item->status == 'inactive';
                            ?>

                            <a href="javascript:;" wire:click="setOrderTable(<?php echo e($item); ?>)" wire:key="table-<?php echo e($item->id); ?>"
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative w-full group flex items-center justify-center border shadow-sm rounded-lg hover:shadow-md transition-all duration-200',
                                    'dark:bg-gray-700 dark:border-gray-600',
                                    'bg-red-50' => $isInactive,
                                    'bg-white hover:bg-gray-50' => $isActive && !$isLocked,
                                    'bg-orange-50 border-orange-200' => $isLockedByOtherUser,
                                    'bg-blue-50 border-blue-200' => $isLockedByCurrentUser
                                ]); ?>">
                                <!-- Lock indicator for locked tables -->
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLocked): ?>
                                    <div class="absolute top-2 right-2 z-10 transition-transform hover:scale-110">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->hasRole('Admin_' . user()->restaurant_id)): ?>
                                            <!-- User can unlock their own tables or admin can unlock any table -->
                                            <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                    'relative group p-1 rounded-full shadow-sm hover:shadow-md transition-all duration-200 text-white',
                                                    'bg-blue-500 hover:bg-blue-600' => $isLockedByCurrentUser,
                                                    'bg-red-500 hover:bg-red-600' => !$isLockedByCurrentUser,
                                                ]); ?>"
                                                title="<?php echo e($isLockedByCurrentUser ? __('modules.table.lockedByYou') : __('modules.table.forceUnlock')); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">

                                                <!-- Locked icon (shows by default) -->
                                                <svg class="w-3.5 h-3.5 group-hover:opacity-0 group-hover:scale-0 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                </svg>

                                                <!-- Unlock icon (shows on hover) -->
                                                <svg class="w-3 h-3 absolute inset-0 m-auto opacity-0 scale-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                                                </svg>
                                            </button>
                                        <?php elseif($isLockedByCurrentUser): ?>
                                            <!-- User can unlock their own locked tables -->
                                            <button wire:click.stop="forceUnlockTable(<?php echo e($item->id); ?>)"
                                                class="bg-blue-500 text-white p-1 rounded-full shadow hover:shadow-md transition-all duration-200"
                                                title="<?php echo app('translator')->get('modules.table.lockedByYou'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
                                                </svg>
                                            </button>
                                        <?php else: ?>
                                            <!-- Other users can only see the lock status -->
                                            <div class="bg-orange-500 text-white p-1 rounded-full shadow cursor-help hover:shadow-md transition-all duration-200"
                                                title="<?php echo app('translator')->get('modules.table.locked'); ?> by <?php echo e($item->tableSession?->lockedByUser->name ?? 'Unknown'); ?> at <?php echo e($item->tableSession->locked_at->format('H:i')); ?>">
                                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <div class="p-3">
                                    <div class="flex flex-col space-y-2 items-center justify-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isInactive): ?>
                                            <div class="inline-flex text-xs gap-1 text-red-600 font-semibold">
                                                <?php echo app('translator')->get('app.inactive'); ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php
                                            $statusClasses = [
                                                'p-2 rounded-lg tracking-wide',
                                                'bg-green-100 text-green-600' => $item->available_status == 'available' && !$isLocked,
                                                'bg-red-100 text-red-600' => $item->available_status == 'reserved',
                                                'bg-blue-100 text-blue-600' => $item->available_status == 'running',
                                                'bg-orange-100 text-orange-600' => $isLockedByOtherUser,
                                                'bg-blue-100 text-blue-600' => $isLockedByCurrentUser
                                            ];
                                        ?>

                                        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses($statusClasses); ?>">
                                            <h3 wire:loading.class.delay="opacity-50" class="font-semibold">
                                                <?php echo e($item->table_code); ?>

                                            </h3>
                                        </div>
                                        <p class="text-xs font-medium dark:text-neutral-200 text-gray-500">
                                        <?php echo e($item->seating_capacity); ?> <?php echo app('translator')->get('modules.table.seats'); ?>
                                        </p>

                                    <div wire:loading.flex wire:target="setOrderTable(<?php echo e($item); ?>)"
                                        class="absolute inset-0 items-center justify-center bg-white/50 dark:bg-gray-800/50 rounded-lg">
                                        <svg class="animate-spin h-5 w-5 text-skin-base" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none"/>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                                        </svg>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <!-- End Card Section -->

        <div class="col-span-1 space-y-3 dark:text-gray-400">
            <h4 class="text-base font-medium"><?php echo app('translator')->get('modules.reservation.todayReservations'); ?></h4>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-2">
                    <div class="flex justify-between">
                        <div class="text-base font-semibold text-gray-800 dark:text-white">
                            <div class="p-2 rounded-md tracking-wide bg-skin-base/[0.2] text-skin-base">
                                <h3 wire:loading.class.delay="opacity-50" class="font-semibold">
                                    <?php echo e($item->table->table_code); ?>

                                </h3>
                            </div>
                        </div>
                        <div class="text-gray-700 dark:text-neutral-400 flex flex-col space-y-1">
                            <div class="inline-flex gap-2 items-center text-xs">
                                <?php echo e($item->party_size); ?> <?php echo app('translator')->get('modules.reservation.guests'); ?>
                            </div>
                            <div class="inline-flex gap-2 items-center text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                </svg>
                                <?php echo e($item->reservation_date_time->translatedFormat(timeFormat())); ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div><?php echo app('translator')->get('messages.noTableReserved'); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/pos/set-table.blade.php ENDPATH**/ ?>