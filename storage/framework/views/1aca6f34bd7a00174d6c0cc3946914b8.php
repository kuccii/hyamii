<div>

    <?php if (isset($component)) { $__componentOriginal0e4b24c116b964318a7a82044afec8cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0e4b24c116b964318a7a82044afec8cf = $attributes; } ?>
<?php $component = App\View\Components\Kot\KotCard::resolve(['kot' => $kot,'kotSettings' => $kotSettings,'cancelReasons' => $cancelReasons,'showAllKitchens' => $showAllKitchens,'showStatusModal' => $showStatusModal,'selectedItemId' => $selectedItemId,'selectedItemStatus' => $selectedItemStatus] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kot.kot-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Kot\KotCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'kot-'.e($kot->id . microtime()).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0e4b24c116b964318a7a82044afec8cf)): ?>
<?php $attributes = $__attributesOriginal0e4b24c116b964318a7a82044afec8cf; ?>
<?php unset($__attributesOriginal0e4b24c116b964318a7a82044afec8cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0e4b24c116b964318a7a82044afec8cf)): ?>
<?php $component = $__componentOriginal0e4b24c116b964318a7a82044afec8cf; ?>
<?php unset($__componentOriginal0e4b24c116b964318a7a82044afec8cf); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/kot/kot-card.blade.php ENDPATH**/ ?>