<?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['maxWidth' => 'md','wire:model.live' => 'showUpgradeModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['maxWidth' => 'md','wire:model.live' => 'showUpgradeModal']); ?>
     <?php $__env->slot('title', null, []); ?> 
        <h2 class="text-lg font-medium"><?php echo app('translator')->get('modules.settings.upgradeLicense'); ?></h2>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('content', null, []); ?> 
        <div class="px-4 py-6 mx-auto">
            <!-- Upgrade Message -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-rocket-takeoff w-10 h-10" viewBox="0 0 16 16">
                        <path d="M9.752 6.193c.599.6 1.73.437 2.528-.362s.96-1.932.362-2.531c-.599-.6-1.73-.438-2.528.361-.798.8-.96 1.933-.362 2.532"/>
                        <path d="M15.811 3.312c-.363 1.534-1.334 3.626-3.64 6.218l-.24 2.408a2.56 2.56 0 0 1-.732 1.526L8.817 15.85a.51.51 0 0 1-.867-.434l.27-1.899c.04-.28-.013-.593-.131-.956a9 9 0 0 0-.249-.657l-.082-.202c-.815-.197-1.578-.662-2.191-1.277-.614-.615-1.079-1.379-1.275-2.195l-.203-.083a10 10 0 0 0-.655-.248c-.363-.119-.675-.172-.955-.132l-1.896.27A.51.51 0 0 1 .15 7.17l2.382-2.386c.41-.41.947-.67 1.524-.734h.006l2.4-.238C9.005 1.55 11.087.582 12.623.208c.89-.217 1.59-.232 2.08-.188.244.023.435.06.57.093q.1.026.16.045c.184.06.279.13.351.295l.029.073a3.5 3.5 0 0 1 .157.721c.055.485.051 1.178-.159 2.065m-4.828 7.475.04-.04-.107 1.081a1.54 1.54 0 0 1-.44.913l-1.298 1.3.054-.38c.072-.506-.034-.993-.172-1.418a9 9 0 0 0-.164-.45c.738-.065 1.462-.38 2.087-1.006M5.205 5c-.625.626-.94 1.351-1.004 2.09a9 9 0 0 0-.45-.164c-.424-.138-.91-.244-1.416-.172l-.38.054 1.3-1.3c.245-.246.566-.401.91-.44l1.08-.107zm9.406-3.961c-.38-.034-.967-.027-1.746.163-1.558.38-3.917 1.496-6.937 4.521-.62.62-.799 1.34-.687 2.051.107.676.483 1.362 1.048 1.928.564.565 1.25.941 1.924 1.049.71.112 1.429-.067 2.048-.688 3.079-3.083 4.192-5.444 4.556-6.987.183-.771.18-1.345.138-1.713a3 3 0 0 0-.045-.283 3 3 0 0 0-.3-.041Z"/>
                        <path d="M7.009 12.139a7.6 7.6 0 0 1-1.804-1.352A7.6 7.6 0 0 1 3.794 8.86c-1.102.992-1.965 5.054-1.839 5.18.125.126 3.936-.896 5.054-1.902Z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">
                    <?php echo app('translator')->get('messages.upgradeRequired'); ?>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8">
                    <?php echo app('translator')->get('messages.welcomeToUpgrade'); ?>
                </p>

                <!-- Payment Section -->
                <div class="space-y-4">

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">

                        <button wire:click="$set('showUpgradeModal', false)" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <?php echo app('translator')->get('app.cancel'); ?>
                        </button>

                        <?php if (isset($component)) { $__componentOriginalecbfaf65020c31547e71f42b3a8afb5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-link','data' => ['href' => ''.e(route('pricing.plan')).'','wire:navigate' => true,'class' => 'inline-flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('pricing.plan')).'','wire:navigate' => true,'class' => 'inline-flex items-center']); ?>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <?php echo app('translator')->get('modules.settings.upgradeLicense'); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f)): ?>
<?php $attributes = $__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f; ?>
<?php unset($__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecbfaf65020c31547e71f42b3a8afb5f)): ?>
<?php $component = $__componentOriginalecbfaf65020c31547e71f42b3a8afb5f; ?>
<?php unset($__componentOriginalecbfaf65020c31547e71f42b3a8afb5f); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    <?php
        $__scriptKey = '163299234-0';
        ob_start();
    ?>
<script>
    $wire.on('paymentInitiated', (payment) => {
        payViaRazorpay(payment);
    });

    $wire.on('stripeLicensePaymentInitiated', (payment) => {
        document.getElementById('license_payment').value = payment.payment.id;
        document.getElementById('license-payment-form').submit();
    });

    <?php if($credential): ?>
        function payViaRazorpay(payment) {
            var options = {
                "key": "<?php echo e($credential->razorpay_key); ?>",
                "amount": (parseFloat(payment.payment.amount) * 100),
                "currency": "<?php echo e(package()->currency->currency_code); ?>",
                "description": "License Payment",
                "image": "<?php echo e(global_setting()->logoUrl); ?>",
                "order_id": payment.payment.razorpay_order_id,
                "handler": function(response) {
                    Livewire.dispatch('razorpayPaymentCompleted', [
                        response.razorpay_payment_id,
                        response.razorpay_order_id,
                        response.razorpay_signature
                    ]);
                },
                "modal": {
                    "ondismiss": function() {
                        if (confirm("Are you sure, you want to close the form?")) {
                            console.log("Checkout form closed by the user");
                        } else {
                            console.log("Complete the Payment")
                        }
                    }
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function(response) {
                console.log(response);
            });
            rzp1.open();
        }
    <?php endif; ?>
</script>
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/settings/upgrade-license.blade.php ENDPATH**/ ?>