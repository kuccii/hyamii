<?php
    $now = \Carbon\Carbon::now(timezone());
    $color = 'text-gray-500';
    $isToday = false;

    $date = $date->setTimezone(timezone());

    if ($date->isToday()) {
        $color = 'text-green-600';
        $isToday = true;
    } elseif ($date->isYesterday()) {
        $color = 'text-blue-800';
    }

    // Get restaurant date format
    $restaurantDateFormat = restaurant()->date_format ?? dateFormat();
    $time = $date->format(timeFormat());

    // Format date using restaurant format
    $formattedDate = $date->translatedFormat($restaurantDateFormat);
    $dateFormat = "{$formattedDate} {$time}";
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isToday): ?>
        <span class="<?php echo e($color); ?> text-xs"><?php echo $dateFormat; ?> </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isToday): ?>
        <span class="<?php echo e($color); ?> text-xs"><?php echo e($time); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <p class="text-[11px] text-gray-400"><?php echo e($date?->diffForHumans(short:true)); ?></p>
<?php else: ?>
    -
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/common/date-time-display.blade.php ENDPATH**/ ?>