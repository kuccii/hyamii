<?php $__env->startSection('content'); ?>

<div>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('modules.settings.customModules'); ?></h1>
        </div>
    </div>

    <div class="flex w-full flex-col p-4">
        <?php echo $__env->make($view, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>
    <script>
        /* manage menu active class */
        $('.nav-item').removeClass('active');
        const activeTab = "<?php echo e($activeTab); ?>";
        $('.' + activeTab).addClass('active');

        showBtn(activeTab);

        function showBtn(activeTab) {
            $('.actionBtn').addClass('d-none');
            $('.' + activeTab + '-btn').removeClass('d-none');
        }

        $("body").on("click", "#editSettings .nav a", function(event) {
            event.preventDefault();

            $('.nav-item').removeClass('active');
            $(this).addClass('active');

            const requestUrl = this.href;

            $.easyAjax({
                url: requestUrl,
                blockUI: true,
                container: "#nav-tabContent",
                historyPush: true,
                success: function(response) {
                    if (response.status == "success") {
                        showBtn(response.activeTab);

                        $('#nav-tabContent').html(response.html);
                        init('#nav-tabContent');
                    }
                }
            });
        });


        /* change module setting */
        $('body').on('change', '.change-module-setting', function() {

            var id = $(this).data('setting-id');
            var name = $(this).data('module-name');

            if(name == 'settings') {
                Swal.fire({
                    icon: 'error',
                    text: '<?php echo app('translator')->get("messages.settingModuleCannotBeDisabled"); ?>',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                })

                $(this).prop('checked', true);
                return false;
            }

        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/module-settings/index.blade.php ENDPATH**/ ?>