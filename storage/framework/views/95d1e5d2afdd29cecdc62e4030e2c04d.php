<?php $__env->startSection('title', 'Welcome To The Installer'); ?>
<?php $__env->startSection('container'); ?>
    <p class="paragraph" style="text-align: center;">Welcome to the setup wizard.</p>
    <div class="buttons">
        <a href="<?php echo e(route('LaravelInstaller::environment')); ?>" class="button">Next Step</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('installer/js/jQuery-2.2.0.min.js')); ?>"></script>

    <script>
        $('.button').click(function () {
            const button = $('.button');

            const text = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Moving to next step.';

            $(button).addClass('disabled');
            $('#messageWait').show()
            button.html(text);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/vendor/installer/welcome.blade.php ENDPATH**/ ?>