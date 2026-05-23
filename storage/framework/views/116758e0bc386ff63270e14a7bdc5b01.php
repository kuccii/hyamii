<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['disabled' => false]));

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

foreach (array_filter((['disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!isset($append)): ?>
<select <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'border-gray-300 focus:border-gray-300
  focus:ring-gray-300 rounded-md shadow-sm bg-white  dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-gray-600 dark:focus:ring-gray-600 text-xs']); ?>>
  <?php echo e($slot); ?>

</select>
<?php else: ?>
<div class="flex">
  <select <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'border-gray-300 focus:border-gray-300
    focus:ring-gray-300 rounded-l-md shadow-sm bg-white  dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-gray-600 dark:focus:ring-gray-600 text-xs']); ?>>
    <?php echo e($slot); ?>

  </select>

  <span
    class="inline-flex items-center px-3 text-gray-900 bg-gray-100 border border-l-0 border-gray-300 rounded-r-md mt-1 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
    <?php echo e($append); ?>

  </span>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/components/select.blade.php ENDPATH**/ ?>