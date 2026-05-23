<div class="bg-white rounded-xl border border-gray-100 p-4 dark:bg-gray-800 dark:border-gray-700">
    <p class="text-xs text-gray-400 mb-1.5"><?php echo app('translator')->get('modules.dashboard.averageDailyEarning'); ?> (<?php echo e(now()->translatedFormat('M')); ?>)</p>
    <p class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(currency_format(round($orderCount, 2), restaurant()->currency_id)); ?></p>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($percentChange != 0): ?>
    <p class="text-xs text-amber-600 mt-1 flex items-center gap-1">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($percentChange > 0): ?>
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
            </path>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($percentChange < 0): ?> 
            <path clip-rule="evenodd" fill-rule="evenodd"
            d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
            </path>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </svg>
        <?php echo e(round($percentChange, 2), restaurant()->currency_id); ?>%
        <?php echo app('translator')->get('modules.dashboard.sincePreviousMonth'); ?>
    </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/dashboard/average-daily-earning.blade.php ENDPATH**/ ?>