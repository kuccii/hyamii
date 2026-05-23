<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['id', 'maxWidth', 'maxHeight']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['id', 'maxWidth', 'maxHeight']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
][$maxWidth ?? '2xl'];

$maxHeightKey = $maxHeight ?? '2xl';

$maxHeightClasses = [
    'sm' => 'sm:max-h-sm',
    'md' => 'sm:max-h-md',
    'lg' => 'sm:max-h-lg',
    'xl' => 'sm:max-h-xl',
    '2xl' => 'sm:max-h-2xl',
    '3xl' => 'sm:max-h-3xl',
    '4xl' => 'sm:max-h-4xl',
    '5xl' => 'sm:max-h-5xl',
    '6xl' => 'sm:max-h-6xl',
    'full' => 'sm:max-h-full',
    'none' => '',
    'auto' => '',
];

$resolvedMaxHeight = $maxHeightClasses[$maxHeightKey] ?? $maxHeightClasses['2xl'];

$modalPanelOverflow = in_array($maxHeightKey, ['none', 'auto'], true)
    ? 'overflow-visible'
    : 'overflow-hidden overflow-y-auto';

?>

<div
    x-data="{ show: <?php if ((object) ($attributes->wire('model')) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e($attributes->wire('model')->value()); ?>')<?php echo e($attributes->wire('model')->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e($attributes->wire('model')); ?>')<?php endif; ?> }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="<?php echo e($id); ?>"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div x-show="show" class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all sm:w-full <?php echo e($maxWidth); ?> <?php echo e($resolvedMaxHeight); ?> sm:mx-auto <?php echo e($modalPanelOverflow); ?> mt-16 sm:mt-20"
                    x-trap.inert.noscroll="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/components/modal.blade.php ENDPATH**/ ?>