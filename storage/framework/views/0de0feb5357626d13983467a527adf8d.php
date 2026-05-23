<?php $__env->startSection('title', 'Database Configuration'); ?>
<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('installer/froiden-helper/helper.css')); ?>" rel="stylesheet"/>
    <style>
        .has-error {
            color: red;
        }

        .help-block {
            font-size: 12px;
        }

        .has-error input {
            color: black;
            border: 1px solid red;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<p class="text-center mb-2">Please enter your database connection details</p>

    <form method="post" action="<?php echo e(route('LaravelInstaller::environmentSave')); ?>" id="env-form">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">Hostname</label>
                    <input type="text" name="hostname" class="form-control" value="localhost">
                </div>

                <div class="form-group">
                    <label class="control-label">Database username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Database password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Database name</label>
                    <div class="col-sm-12">
                        <input type="text" name="database" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="buttons">
                        <a class="button" onclick="checkEnv();return false">
                            Next Step
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <script>
        function checkEnv() {
            $.easyAjax({
                url: "<?php echo route('LaravelInstaller::environmentSave'); ?>",
                type: "GET",
                data: $("#env-form").serialize(),
                container: "#env-form",
                disableButton: true,
                blockUI: true,
                buttonSelector: ".button",
                messagePosition: "inline"
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('installer/js/jQuery-2.2.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('installer/froiden-helper/helper.js')); ?>"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/vendor/installer/environment.blade.php ENDPATH**/ ?>