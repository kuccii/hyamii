<div>
    <div
        class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px">

            <li class="me-2">
                <a href="#" wire:click.prevent="$set('activeReport', 'outstandingPaymentReport')"
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full',
                        'border-transparent' => $activeReport != 'outstandingPaymentReport',
                        'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' =>
                            $activeReport == 'outstandingPaymentReport',
                    ]); ?>">
                    <?php echo app('translator')->get('modules.expenses.reports.outstandingPaymentReport'); ?>
                </a>
            </li>

            <li class="me-2">
                <a href="#" wire:click.prevent="$set('activeReport', 'expenseSummaryReport')"
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300. text-xs w-full',
                        'border-transparent' => $activeReport != 'expenseSummaryReport',
                        'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' =>
                            $activeReport == 'expenseSummaryReport',
                    ]); ?>">
                    <?php echo app('translator')->get('modules.expenses.reports.expenseSummaryReport'); ?>
                </a>
            </li>

        </ul>
    </div>

    <div class="grid grid-cols-1 pt-6 dark:bg-gray-900">
        <div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($activeReport):
                case ('outstandingPaymentReport'): ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reports.outstanding-payment-report', ['reports' => $reports]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-280211539-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php break; ?>

                <?php case ('expenseSummaryReport'): ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reports.expense-summary-report', ['reports' => $reports]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-280211539-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php break; ?>

                <?php default: ?>
                    <p class="text-center text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.reports.selectReport'); ?></p>
            <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/reports/expense-reports.blade.php ENDPATH**/ ?>