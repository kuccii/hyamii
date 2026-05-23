<div
    class="hidden"
    aria-hidden="true"
    wire:key="kot-pusher-listener-root"
    <?php if(!pusherSettings()->is_enabled_pusher_broadcast): ?>
        wire:init="pollKotStatusFeed"
        wire:poll.10s="pollKotStatusFeed"
    <?php endif; ?>
></div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/kot/kot-pusher-listener.blade.php ENDPATH**/ ?>