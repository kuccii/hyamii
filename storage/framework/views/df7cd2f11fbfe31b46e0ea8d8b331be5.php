<?php
    $version = \Illuminate\Support\Facades\File::get($module->getPath() . '/version.txt');
    $latestVersion = $plugins->where('envato_id', $envatoId)->pluck('version')->first();
?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($plugins->where('envato_id', $envatoId)->first()): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($latestVersion > $version): ?>

        <span class="bg-red-200 uppercase text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 cursor-help"
              x-data="{ tooltip: false }"
              x-on:mouseenter="tooltip = true"
              x-on:mouseleave="tooltip = false"
              x-on:focus="tooltip = true"
              x-on:blur="tooltip = false">
            <?php echo e($version); ?>


            <div x-show="tooltip"
                 class="absolute z-50 p-2 mt-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg whitespace-normal min-w-[200px] max-w-[300px] break-words"
                 x-cloak
                 role="tooltip">
                <?php echo app('translator')->get('app.moduleUpdateMessage', [
                    'name' => $module->getName(),
                    'version' => $latestVersion,
                ]); ?>
            </div>
        </span>
    <?php else: ?>
        <span class="bg-green-100 uppercase text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
            <?php echo e($version); ?>

        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php else: ?>
    <span class="bg-green-100 uppercase text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
        <?php echo e($version); ?>

    </span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/custom-modules/sections/version.blade.php ENDPATH**/ ?>