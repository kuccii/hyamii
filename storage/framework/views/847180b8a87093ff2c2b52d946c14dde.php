<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/trix/trix.css')); ?>">
<script type="text/javascript" src="<?php echo e(asset('vendor/trix/trix.umd.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('settings.master');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1557891991-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function form() {
        var element = document.querySelector("trix-editor");

        return {
            save() {
                let that = this;
                let myPromise = new Promise(function(myResolve, myReject) {

                    Livewire.dispatch('alpine-save', {description: that.$refs.description.value});

                    setTimeout(() => {
                        myResolve(); // when successful
                    }, 100);

                });

                // "Consuming Code" (Must wait for a fulfilled Promise)
                myPromise.then(
                    function (value) {
                        that.$wire.call('submitForm');
                    }
                );
            }
        }
    }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/settings/index.blade.php ENDPATH**/ ?>