<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
            <?php echo e(__('whatsapp::app.whatsappNotificationSettings')); ?>

        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            <?php echo e(__('whatsapp::app.configureWhatsappNotifications')); ?>

        </p>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $notificationSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="mb-8">
        <h4 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            <?php echo e($section['title']); ?>

        </h4>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <?php echo e($section['description']); ?>

        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(collect($section['templates'])->count() > 0): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $section['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $key = $template->notification_type . '_' . $section['recipient'];
                ?>
                <div wire:key="pref-<?php echo e($key); ?>" class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700" wire:ignore>
                    <div class="flex-1">
                        <h5 class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            <?php echo e($template->template_name); ?>

                        </h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <?php echo e($template->description); ?>

                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer ml-4">
                        <input type="checkbox"
                            wire:model.live="notificationPreferences.<?php echo e($key); ?>"
                            wire:loading.attr="disabled"
                            class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-skin-base/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-skin-base peer-disabled:opacity-50"></div>
                    </label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
            <div class="col-span-2 text-center py-8">
                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('whatsapp::app.noTemplatesFound')); ?></p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Automated Message Schedules -->
    <div class="mb-8">
        <h4 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            <?php echo e(__('whatsapp::app.automatedMessageSchedules')); ?>

        </h4>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <?php echo e(__('whatsapp::app.configureAutomatedMessages')); ?>

        </p>

        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($templates && collect($templates)->count() > 0): ?>
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lowStockTemplate): ?>
            <?php
                $key = 'low_inventory_alert';
                $schedule = $this->automatedSchedules[$key] ?? [
                    'is_enabled' => false,
                    'schedule_type' => 'every_5_minutes',
                    'scheduled_time' => null,
                    'scheduled_day' => '',
                    'roles' => [],
                ];
            ?>
            <div wire:key="automated-schedule-<?php echo e($key); ?>" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            <?php echo e(__('whatsapp::app.lowStockAlert')); ?>

                        </h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <?php echo e(__('whatsapp::app.lowStockAlertDescription')); ?>

                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                            wire:click="toggleAutomatedSchedule('<?php echo e($key); ?>')"
                            <?php echo e($schedule['is_enabled'] ? 'checked' : ''); ?>

                            class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-skin-base/20 dark:peer-focus:ring-skin-base/20 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-skin-base"></div>
                    </label>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($schedule['is_enabled']): ?>
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Check Frequency
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="text" value="<?php echo e(__('whatsapp::app.checksEvery5Minutes')); ?>" readonly
                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white pe-10">
                            </div>
                            <p class="mt-1 text-xs text-green-600 dark:text-green-400 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Automatic inventory monitoring - no specific time needed
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.selectRoles')); ?>

                            </label>
                            <div x-data="{
                                isOpen: false,
                                selectedRoles: $wire.entangle('automatedSchedules.<?php echo e($key); ?>.roles').live,
                                init() {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                },
                                toggleRole(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                    const normalizedSelected = this.selectedRoles.map(id => Number(id));
                                    if (normalizedSelected.includes(normalizedRoleId)) {
                                        this.selectedRoles = this.selectedRoles.filter(id => Number(id) !== normalizedRoleId);
                                    } else {
                                        this.selectedRoles = [...this.selectedRoles, normalizedRoleId];
                                    }
                                    $wire.updateAutomatedScheduleField('<?php echo e($key); ?>', 'roles', this.selectedRoles);
                                },
                                isSelected(roleId) {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        return false;
                                    }
                                    const normalizedRoleId = Number(roleId);
                                    return this.selectedRoles.map(id => Number(id)).includes(normalizedRoleId);
                                },
                                getRoleName(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    const roles = <?php echo \Illuminate\Support\Js::from($availableRoles)->toHtml() ?>;
                                    return roles.find(r => Number(r.id) === normalizedRoleId)?.name || '';
                                }
                            }" class="relative">
                                <button type="button" @click="isOpen = !isOpen"
                                    class="w-full text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white px-3 py-2 text-left flex items-center justify-between min-h-[38px] bg-white dark:bg-gray-700">
                                    <span class="flex-1 flex flex-wrap gap-1 items-center">
                                        <template x-if="selectedRoles.length === 0">
                                            <span class="text-gray-400 dark:text-gray-500"><?php echo e(__('whatsapp::app.selectRoles')); ?></span>
                                        </template>
                                        <template x-for="roleId in selectedRoles" :key="roleId">
                                            <span class="px-2 py-0.5 text-xs bg-skin-base/10 text-skin-base rounded flex items-center gap-1">
                                                <span x-text="getRoleName(roleId)"></span>
                                                <button type="button" @click.stop="toggleRole(roleId)" class="text-skin-base hover:text-red-500 ml-1">×</button>
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <ul x-show="isOpen"
                                    @click.away="isOpen = false"
                                    x-transition
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li @click="toggleRole(<?php echo e($role['id']); ?>)"
                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 flex justify-between items-center text-sm"
                                        :class="{ 'bg-gray-50 dark:bg-gray-800': isSelected(<?php echo e($role['id']); ?>) }">
                                        <span><?php echo e($role['name']); ?></span>
                                        <span class="text-green-500 font-bold" x-show="isSelected(<?php echo e($role['id']); ?>)">✓</span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableRoles) === 0): ?>
                                    <li class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <?php echo e(__('whatsapp::app.noRolesAvailable')); ?>

                                    </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $automatedTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $key = $template->notification_type;
                // Skip low_inventory_alert as it's handled separately above
                if ($key === 'low_inventory_alert') {
                    continue;
                }
                // Ensure schedule exists with defaults
                $schedule = $this->automatedSchedules[$key] ?? [
                    'is_enabled' => false,
                    'schedule_type' => 'daily',
                    'scheduled_time' => '09:00',
                    'scheduled_day' => '',
                    'roles' => [],
                ];
                $schedule['is_enabled'] = $schedule['is_enabled'] ?? false;
                $schedule['schedule_type'] = $schedule['schedule_type'] ?? 'daily';
                $schedule['scheduled_time'] = $schedule['scheduled_time'] ?? '09:00';
                $schedule['scheduled_day'] = $schedule['scheduled_day'] ?? '';
                $schedule['roles'] = $schedule['roles'] ?? [];
            ?>
            
            <div wire:key="automated-schedule-<?php echo e($key); ?>" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            <?php echo e($template->template_name); ?>

                        </h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <?php echo e($template->description); ?>

                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                            wire:click="toggleAutomatedSchedule('<?php echo e($key); ?>')"
                            <?php echo e(($schedule['is_enabled'] ?? false) ? 'checked' : ''); ?>

                            class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-skin-base/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-skin-base"></div>
                    </label>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schedule['is_enabled'] ?? false)): ?>
                <div class="space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key === 'low_inventory_alert'): ?>
                    <!-- Low Stock Alert - Every 5 Minutes -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Check Frequency
                            </label>
                            <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-green-700 dark:text-green-300 font-medium">
                                        Checks Every 5 Minutes
                                    </span>
                                </div>
                                <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                                    Automatic inventory monitoring - no specific time needed
                                </p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.selectRoles')); ?>

                            </label>
                            <div x-data="{ 
                                isOpen: false,
                                selectedRoles: $wire.entangle('automatedSchedules.<?php echo e($key); ?>.roles').live,
                                init() {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                },
                                toggleRole(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                    const normalizedSelected = this.selectedRoles.map(id => Number(id));
                                    if (normalizedSelected.includes(normalizedRoleId)) {
                                        this.selectedRoles = this.selectedRoles.filter(id => Number(id) !== normalizedRoleId);
                                    } else {
                                        this.selectedRoles = [...this.selectedRoles, normalizedRoleId];
                                    }
                                    $wire.updateAutomatedScheduleField('<?php echo e($key); ?>', 'roles', this.selectedRoles);
                                },
                                isSelected(roleId) {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        return false;
                                    }
                                    const normalizedRoleId = Number(roleId);
                                    return this.selectedRoles.map(id => Number(id)).includes(normalizedRoleId);
                                },
                                getRoleName(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    const roles = <?php echo \Illuminate\Support\Js::from($availableRoles)->toHtml() ?>;
                                    return roles.find(r => Number(r.id) === normalizedRoleId)?.name || '';
                                }
                            }" class="relative">
                                <!-- Dropdown Trigger -->
                                <button type="button" @click="isOpen = !isOpen" 
                                    class="w-full text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white px-3 py-2 text-left flex items-center justify-between min-h-[38px] bg-white dark:bg-gray-700">
                                    <span class="flex-1 flex flex-wrap gap-1 items-center">
                                        <template x-if="selectedRoles.length === 0">
                                            <span class="text-gray-400 dark:text-gray-500"><?php echo e(__('whatsapp::app.selectRoles')); ?></span>
                                        </template>
                                        <template x-for="roleId in selectedRoles" :key="roleId">
                                            <span class="px-2 py-0.5 text-xs bg-skin-base/10 text-skin-base rounded flex items-center gap-1">
                                                <span x-text="getRoleName(roleId)"></span>
                                                <button type="button" @click.stop="toggleRole(roleId)" class="text-skin-base hover:text-red-500 ml-1">×</button>
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Options -->
                                <ul x-show="isOpen" 
                                    @click.away="isOpen = false" 
                                    x-transition
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li @click="toggleRole(<?php echo e($role['id']); ?>)" 
                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 flex justify-between items-center text-sm"
                                        :class="{ 'bg-gray-50 dark:bg-gray-800': isSelected(<?php echo e($role['id']); ?>) }">
                                        <span><?php echo e($role['name']); ?></span>
                                        <span class="text-green-500 font-bold" x-show="isSelected(<?php echo e($role['id']); ?>)">✓</span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableRoles) === 0): ?>
                                    <li class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <?php echo e(__('whatsapp::app.noRolesAvailable')); ?>

                                    </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php elseif($key !== 'operations_summary'): ?>
                    <!-- Other Automated Schedules -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.scheduleType')); ?>

                            </label>
                            <select wire:change="updateAutomatedScheduleField('<?php echo e($key); ?>', 'schedule_type', $event.target.value)"
                                class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                                <option value="daily" <?php echo e(($schedule['schedule_type'] ?? 'daily') === 'daily' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.daily')); ?></option>
                                <option value="weekly" <?php echo e(($schedule['schedule_type'] ?? 'daily') === 'weekly' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.weekly')); ?></option>
                                <option value="monthly" <?php echo e(($schedule['schedule_type'] ?? 'daily') === 'monthly' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.monthly')); ?></option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.scheduledTime')); ?>

                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" 
                                    wire:change="updateAutomatedScheduleField('<?php echo e($key); ?>', 'scheduled_time', $event.target.value)"
                                    value="<?php echo e($schedule['scheduled_time'] ?? '09:00'); ?>"
                                    onclick="this.showPicker()"
                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white pe-10">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <?php echo e(__('whatsapp::app.selectRoles')); ?>

                        </label>
                        <div x-data="{ 
                            isOpen: false,
                            selectedRoles: $wire.entangle('automatedSchedules.<?php echo e($key); ?>.roles').live,
                            init() {
                                if (!Array.isArray(this.selectedRoles)) {
                                    this.selectedRoles = [];
                                }
                            },
                            toggleRole(roleId) {
                                const normalizedRoleId = Number(roleId);
                                if (!Array.isArray(this.selectedRoles)) {
                                    this.selectedRoles = [];
                                }
                                const normalizedSelected = this.selectedRoles.map(id => Number(id));
                                if (normalizedSelected.includes(normalizedRoleId)) {
                                    this.selectedRoles = this.selectedRoles.filter(id => Number(id) !== normalizedRoleId);
                                } else {
                                    this.selectedRoles = [...this.selectedRoles, normalizedRoleId];
                                }
                                $wire.updateAutomatedScheduleField('<?php echo e($key); ?>', 'roles', this.selectedRoles);
                            },
                            isSelected(roleId) {
                                if (!Array.isArray(this.selectedRoles)) {
                                    return false;
                                }
                                const normalizedRoleId = Number(roleId);
                                return this.selectedRoles.map(id => Number(id)).includes(normalizedRoleId);
                            },
                            getRoleName(roleId) {
                                const normalizedRoleId = Number(roleId);
                                const roles = <?php echo \Illuminate\Support\Js::from($availableRoles)->toHtml() ?>;
                                return roles.find(r => Number(r.id) === normalizedRoleId)?.name || '';
                            }
                        }" class="relative">
                            <!-- Dropdown Trigger -->
                            <button type="button" @click="isOpen = !isOpen" 
                                class="w-full text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white px-3 py-2 text-left flex items-center justify-between min-h-[38px] bg-white dark:bg-gray-700">
                                <span class="flex-1 flex flex-wrap gap-1 items-center">
                                    <template x-if="selectedRoles.length === 0">
                                        <span class="text-gray-400 dark:text-gray-500"><?php echo e(__('whatsapp::app.selectRoles')); ?></span>
                                    </template>
                                    <template x-for="roleId in selectedRoles" :key="roleId">
                                        <span class="px-2 py-0.5 text-xs bg-skin-base/10 text-skin-base rounded flex items-center gap-1">
                                            <span x-text="getRoleName(roleId)"></span>
                                            <button type="button" @click.stop="toggleRole(roleId)" class="text-skin-base hover:text-red-500 ml-1">×</button>
                                        </span>
                                    </template>
                                </span>
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Options -->
                            <ul x-show="isOpen" 
                                @click.away="isOpen = false" 
                                x-transition
                                class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li @click="toggleRole(<?php echo e($role['id']); ?>)" 
                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 flex justify-between items-center text-sm"
                                    :class="{ 'bg-gray-50 dark:bg-gray-800': isSelected(<?php echo e($role['id']); ?>) }">
                                    <span><?php echo e($role['name']); ?></span>
                                    <span class="text-green-500 font-bold" x-show="isSelected(<?php echo e($role['id']); ?>)">✓</span>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableRoles) === 0): ?>
                                <li class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                    <?php echo e(__('whatsapp::app.noRolesAvailable')); ?>

                                </li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Operations Summary -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.scheduledTime')); ?>

                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" 
                                    wire:change="updateAutomatedScheduleField('<?php echo e($key); ?>', 'scheduled_time', $event.target.value)"
                                    value="<?php echo e($schedule['scheduled_time'] ?? '09:00'); ?>"
                                    onclick="this.showPicker()"
                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white pe-10">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.selectRoles')); ?>

                            </label>
                            <div x-data="{ 
                                isOpen: false,
                                selectedRoles: $wire.entangle('automatedSchedules.<?php echo e($key); ?>.roles').live,
                                init() {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                },
                                toggleRole(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                    const normalizedSelected = this.selectedRoles.map(id => Number(id));
                                    if (normalizedSelected.includes(normalizedRoleId)) {
                                        this.selectedRoles = this.selectedRoles.filter(id => Number(id) !== normalizedRoleId);
                                    } else {
                                        this.selectedRoles = [...this.selectedRoles, normalizedRoleId];
                                    }
                                    $wire.updateAutomatedScheduleField('<?php echo e($key); ?>', 'roles', this.selectedRoles);
                                },
                                isSelected(roleId) {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        return false;
                                    }
                                    const normalizedRoleId = Number(roleId);
                                    return this.selectedRoles.map(id => Number(id)).includes(normalizedRoleId);
                                },
                                getRoleName(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    const roles = <?php echo \Illuminate\Support\Js::from($availableRoles)->toHtml() ?>;
                                    return roles.find(r => Number(r.id) === normalizedRoleId)?.name || '';
                                }
                            }" class="relative">
                                <!-- Dropdown Trigger -->
                                <button type="button" @click="isOpen = !isOpen" 
                                    class="w-full text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white px-3 py-2 text-left flex items-center justify-between min-h-[38px] bg-white dark:bg-gray-700">
                                    <span class="flex-1 flex flex-wrap gap-1 items-center">
                                        <template x-if="selectedRoles.length === 0">
                                            <span class="text-gray-400 dark:text-gray-500"><?php echo e(__('whatsapp::app.selectRoles')); ?></span>
                                        </template>
                                        <template x-for="roleId in selectedRoles" :key="roleId">
                                            <span class="px-2 py-0.5 text-xs bg-skin-base/10 text-skin-base rounded flex items-center gap-1">
                                                <span x-text="getRoleName(roleId)"></span>
                                                <button type="button" @click.stop="toggleRole(roleId)" class="text-skin-base hover:text-red-500 ml-1">×</button>
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Options -->
                                <ul x-show="isOpen" 
                                    @click.away="isOpen = false" 
                                    x-transition
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li @click="toggleRole(<?php echo e($role['id']); ?>)" 
                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 flex justify-between items-center text-sm"
                                        :class="{ 'bg-gray-50 dark:bg-gray-800': isSelected(<?php echo e($role['id']); ?>) }">
                                        <span><?php echo e($role['name']); ?></span>
                                        <span class="text-green-500 font-bold" x-show="isSelected(<?php echo e($role['id']); ?>)">✓</span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableRoles) === 0): ?>
                                    <li class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <?php echo e(__('whatsapp::app.noRolesAvailable')); ?>

                                    </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schedule['schedule_type'] ?? 'daily') === 'weekly'): ?>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <?php echo e(__('whatsapp::app.dayOfWeek')); ?>

                        </label>
                        <select wire:change="updateAutomatedScheduleField('<?php echo e($key); ?>', 'scheduled_day', $event.target.value)"
                            class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                            <option value="monday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'monday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.monday')); ?></option>
                            <option value="tuesday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'tuesday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.tuesday')); ?></option>
                            <option value="wednesday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'wednesday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.wednesday')); ?></option>
                            <option value="thursday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'thursday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.thursday')); ?></option>
                            <option value="friday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'friday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.friday')); ?></option>
                            <option value="saturday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'saturday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.saturday')); ?></option>
                            <option value="sunday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'sunday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.sunday')); ?></option>
                        </select>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schedule['schedule_type'] ?? 'daily') === 'monthly'): ?>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <?php echo e(__('whatsapp::app.dayOfMonth')); ?> (1-31)
                        </label>
                        <select wire:change="updateAutomatedScheduleField('<?php echo e($key); ?>', 'scheduled_day', $event.target.value)"
                            class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                            <option value=""><?php echo e(__('whatsapp::app.selectDay')); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(($schedule['scheduled_day'] ?? '') == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
            <div class="text-center py-8">
                <p class="text-gray-500 dark:text-gray-400">No automated templates found</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Report Schedules -->
    <div class="mb-8">
        <h4 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            <?php echo e(__('whatsapp::app.reportSchedules')); ?>

        </h4>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <?php echo e(__('whatsapp::app.configureReportSchedules')); ?>

        </p>

        <?php
            $reportTypes = [
                'daily_sales' => __('whatsapp::app.dailySalesReport'),
                'weekly_sales' => __('whatsapp::app.weeklySalesReport'),
                'monthly_sales' => __('whatsapp::app.monthlySalesReport'),
            ];
        ?>

        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $reportTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportType => $reportName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $schedule = $reportSchedules[$reportType] ?? [
                    'is_enabled' => false,
                    'frequency' => str_replace('_sales', '', $reportType),
                    'scheduled_time' => '09:00',
                    'scheduled_day' => '',
                    'recipients' => [],
                ];
            ?>
            
            <div wire:key="report-<?php echo e($reportType); ?>" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            <?php echo e($reportName); ?>

                        </h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <?php echo e(__('whatsapp::app.automaticReportDelivery')); ?>

                        </p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                            wire:click="toggleReportSchedule('<?php echo e($reportType); ?>')"
                            <?php echo e(($schedule['is_enabled'] ?? false) ? 'checked' : ''); ?>

                            class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-skin-base/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-skin-base"></div>
                    </label>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($schedule['is_enabled'] ?? false): ?>
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.frequency')); ?>

                            </label>
                            <select wire:change="updateReportScheduleField('<?php echo e($reportType); ?>', 'frequency', $event.target.value)"
                                class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                                <option value="daily" <?php echo e(($schedule['frequency'] ?? 'daily') === 'daily' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.daily')); ?></option>
                                <option value="weekly" <?php echo e(($schedule['frequency'] ?? 'daily') === 'weekly' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.weekly')); ?></option>
                                <option value="monthly" <?php echo e(($schedule['frequency'] ?? 'daily') === 'monthly' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.monthly')); ?></option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.scheduledTime')); ?>

                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" 
                                    value="<?php echo e($schedule['scheduled_time'] ?? '09:00'); ?>"
                                    wire:change="updateReportScheduleField('<?php echo e($reportType); ?>', 'scheduled_time', $event.target.value)"
                                    onclick="this.showPicker()"
                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white pe-10">
                            </div>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schedule['frequency'] ?? 'daily') === 'weekly'): ?>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <?php echo e(__('whatsapp::app.dayOfWeek')); ?>

                        </label>
                        <select wire:change="updateReportScheduleField('<?php echo e($reportType); ?>', 'scheduled_day', $event.target.value)"
                            class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                            <option value="monday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'monday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.monday')); ?></option>
                            <option value="tuesday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'tuesday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.tuesday')); ?></option>
                            <option value="wednesday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'wednesday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.wednesday')); ?></option>
                            <option value="thursday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'thursday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.thursday')); ?></option>
                            <option value="friday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'friday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.friday')); ?></option>
                            <option value="saturday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'saturday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.saturday')); ?></option>
                            <option value="sunday" <?php echo e(($schedule['scheduled_day'] ?? '') === 'sunday' ? 'selected' : ''); ?>><?php echo e(__('whatsapp::app.sunday')); ?></option>
                        </select>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schedule['frequency'] ?? 'daily') === 'monthly'): ?>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <?php echo e(__('whatsapp::app.dayOfMonth')); ?> (1-31)
                        </label>
                        <select wire:change="updateReportScheduleField('<?php echo e($reportType); ?>', 'scheduled_day', $event.target.value)"
                            class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white">
                            <option value=""><?php echo e(__('whatsapp::app.selectDay')); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(($schedule['scheduled_day'] ?? '') == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <?php echo e(__('whatsapp::app.selectRoles')); ?>

                            </label>
                            <div x-data="{ 
                                isOpen: false,
                                selectedRoles: $wire.entangle('reportSchedules.<?php echo e($reportType); ?>.recipients').live,
                                init() {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                },
                                toggleRole(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    if (!Array.isArray(this.selectedRoles)) {
                                        this.selectedRoles = [];
                                    }
                                    const normalizedSelected = this.selectedRoles.map(id => Number(id));
                                    if (normalizedSelected.includes(normalizedRoleId)) {
                                        this.selectedRoles = this.selectedRoles.filter(id => Number(id) !== normalizedRoleId);
                                    } else {
                                        this.selectedRoles = [...this.selectedRoles, normalizedRoleId];
                                    }
                                    $wire.updateReportScheduleField('<?php echo e($reportType); ?>', 'recipients', this.selectedRoles);
                                },
                                isSelected(roleId) {
                                    if (!Array.isArray(this.selectedRoles)) {
                                        return false;
                                    }
                                    const normalizedRoleId = Number(roleId);
                                    return this.selectedRoles.map(id => Number(id)).includes(normalizedRoleId);
                                },
                                getRoleName(roleId) {
                                    const normalizedRoleId = Number(roleId);
                                    const roles = <?php echo \Illuminate\Support\Js::from($availableRoles)->toHtml() ?>;
                                    return roles.find(r => Number(r.id) === normalizedRoleId)?.name || '';
                                }
                            }" class="relative">
                                <button type="button" @click="isOpen = !isOpen"
                                    class="w-full text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-skin-base focus:border-skin-base dark:bg-gray-700 dark:text-white px-3 py-2 text-left flex items-center justify-between min-h-[38px] bg-white dark:bg-gray-700">
                                    <span class="flex-1 flex flex-wrap gap-1 items-center">
                                        <template x-if="selectedRoles.length === 0">
                                            <span class="text-gray-400 dark:text-gray-500"><?php echo e(__('whatsapp::app.selectRoles')); ?></span>
                                        </template>
                                        <template x-for="roleId in selectedRoles" :key="roleId">
                                            <span class="px-2 py-0.5 text-xs bg-skin-base/10 text-skin-base rounded flex items-center gap-1">
                                                <span x-text="getRoleName(roleId)"></span>
                                                <button type="button" @click.stop="toggleRole(roleId)" class="text-skin-base hover:text-red-500 ml-1">×</button>
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <ul x-show="isOpen"
                                    @click.away="isOpen = false"
                                    x-transition
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $availableRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li @click="toggleRole(<?php echo e($role['id']); ?>)"
                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-200 flex justify-between items-center text-sm"
                                        :class="{ 'bg-gray-50 dark:bg-gray-800': isSelected(<?php echo e($role['id']); ?>) }">
                                        <span><?php echo e($role['name']); ?></span>
                                        <span class="text-green-500 font-bold" x-show="isSelected(<?php echo e($role['id']); ?>)">✓</span>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableRoles) === 0): ?>
                                    <li class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                        <?php echo e(__('whatsapp::app.noRolesAvailable')); ?>

                                    </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\Modules/Whatsapp\Resources/views/livewire/restaurant/whatsapp-notification-settings.blade.php ENDPATH**/ ?>