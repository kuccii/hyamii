<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('message', __('Page Not Found')); ?>
<?php $__env->startSection('description', __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.')); ?>

<?php $__env->startSection('help_title', __("Here's what you can try:")); ?>
<?php $__env->startSection('help_item_1', __('Double check the URL')); ?>
<?php $__env->startSection('help_item_2', __('Return to homepage')); ?>
<?php $__env->startSection('help_item_3', __('Go back to previous page')); ?>

<?php $__env->startSection('help_icon_1'); ?>
<svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
</svg>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('help_icon_2'); ?>
<svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
</svg>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('help_icon_3'); ?>
<svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('home_icon'); ?>
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
</svg>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('back_icon'); ?>
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
</svg>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_text', __('Need assistance?')); ?>
<?php $__env->startSection('footer_link', __('Contact Support')); ?>

<?php echo $__env->make('errors::minimal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/errors/404.blade.php ENDPATH**/ ?>