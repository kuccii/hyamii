<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register("<?php echo e(asset('service-worker.js')); ?>")
                .then(registration => {
                    console.log('Service Worker registered:', registration);
                })
                .catch(error => {
                    console.log('Service Worker registration failed:', error);
                });
        });
    }
    <?php if((restaurant() && restaurant()->is_pwa_install_alert_show == 1) || (!restaurant() && global_setting()->is_pwa_install_alert_show == 1)): ?>
        var isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);
        var isAndroid = /Android/i.test(navigator.userAgent);
        var isInStandaloneMode = ('standalone' in window.navigator) && window.navigator.standalone;

        window.addEventListener('beforeinstallprompt', (event) => {
            event.preventDefault();
            deferredPrompt = event;

            // Prevent repeated prompts in the same session
            if (!sessionStorage.getItem("pwaDismissed")) {
                setTimeout(() => {
                    if (isAndroid) {
                        showInstallPrompt();
                    }
                }, 1000);
            }
        });
        function showInstallPrompt() {
            if (deferredPrompt) {
                deferredPrompt.prompt();

                deferredPrompt.userChoice.then(({ outcome }) => {
                    console.log(`User ${outcome === 'accepted' ? 'accepted' : 'dismissed'} the PWA install`);

                    if (outcome === 'dismissed') {
                        sessionStorage.setItem("pwaDismissed", "true");
                    }

                    deferredPrompt = null;
                });
            }
        }

        if (isIOS && !isInStandaloneMode) {
            // Show instruction only once, on scroll or click
            const showInstructionsOnce = () => {
                showIOSInstallInstructions();
                window.removeEventListener('scroll', showInstructionsOnce);
                window.removeEventListener('click', showInstructionsOnce);
            };

            window.addEventListener('scroll', showInstructionsOnce, { once: true });
            window.addEventListener('click', showInstructionsOnce, { once: true });
        }
        // ---------------------- Function to Show iOS Instructions ----------------------

        function showIOSInstallInstructions() {
            if (document.getElementById('iosInstallInstructions')) return;
            localStorage.setItem('iosPromptLastShown', new Date().getTime());

            const instructions = document.createElement('div');
            instructions.id = 'iosInstallInstructions';
            instructions.innerHTML = `
                <div style="position: fixed; bottom: 10px; left: 10px; right: 10px; background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 5px; text-align: center; z-index: 1000;">
                    <p class="flex items-center justify-center gap-2 m-0">
                        <?php echo app('translator')->get('messages.installAppInstruction'); ?>
                        <img class="ml-2" src="<?php echo e(asset('img/share-ios.svg')); ?>" alt="Share Icon" style="width: 20px; vertical-align: middle;">
                    </p>
                    <?php echo app('translator')->get('messages.addToHomeScreen'); ?>.
                    <button id="closeInstructions" class="block text-center mx-auto" style="margin-top: 10px; padding: 5px 10px;"><?php echo app('translator')->get('app.close'); ?></button>
                </div>
            `;
            document.body.appendChild(instructions);

            document.getElementById('closeInstructions').addEventListener('click', function () {
                document.getElementById('iosInstallInstructions').remove();
            });
        }
    <?php endif; ?>
</script>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/layouts/service-worker-js.blade.php ENDPATH**/ ?>