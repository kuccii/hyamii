<table <?php echo e($attributes->merge(['class' => 'min-w-full divide-y divide-gray-200', 'id' => 'example' ])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($thead)): ?>
        <thead class="<?php echo e($headType ?? 'bg-gray-50'); ?>">
            <tr>
                <?php echo $thead; ?>

            </tr>
        </thead>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php echo e($slot); ?>

    </tbody>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($tfoot)): ?>
        <tfoot class="bg-gray-50">
            <?php echo e($tfoot); ?>

        </tfoot>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</table>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/components/table.blade.php ENDPATH**/ ?>