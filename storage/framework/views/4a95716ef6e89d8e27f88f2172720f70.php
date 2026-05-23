<?php
    $allModules = Module::all();
    $activeModules = [];

    function moveUniversalToFront($array, $keyword = 'Universal') {
            $index = array_search(true, array_map(function ($item) use ($keyword) {
                return stripos($item['product_name'], $keyword) !== false;
            }, $array));

            if ($index !== false) {
                $item = $array[$index];
                unset($array[$index]);
                array_unshift($array, $item);
            }

            return $array;
    }

    $universal = false;

    foreach ($allModules as $module) {
        $config = require base_path() . '/Modules/' . $module . '/Config/config.php';

        if(isset($config['envato_item_id']) && $config['envato_item_id']!== ''){
            if(stripos($config['name'], 'universal') !== false){
                $universal = true;
                break;
            }
            $activeModules[] = $config['envato_item_id'];
        }
    }

    $notInstalledModules = [];

    if(!$universal){
        $plugins = \Froiden\Envato\Functions\EnvatoUpdate::plugins();

        if (empty($plugins)) {
            $plugins = [];
        }else{
            $plugins = moveUniversalToFront($plugins);
        }

        foreach ($plugins as $item) {

            if (!in_array($item['envato_id'], $activeModules)) {
                $notInstalledModules[] = $item;
            }
        }
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($notInstalledModules) && !$universal): ?>
    <div class="w-full px-4 py-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">
            <?php echo e(str(config('froiden_envato.envato_product_name'))->replace('new', '')->headline()); ?> Official Modules
        </h2>

        <div class="grid grid-cols-1 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $notInstalledModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white border rounded-lg p-4 <?php if(stripos($item['product_name'], 'universal') !== false): ?> border-skin-base <?php endif; ?> relative">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <a href="<?php echo e($item['product_link']); ?>" target="_blank">
                                <img src="<?php echo e($item['product_thumbnail']); ?>" class="w-20 h-20 object-cover rounded" alt="<?php echo e($item['product_name']); ?>">
                            </a>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900">
                                <a href="<?php echo e($item['product_link']); ?>" target="_blank" class="hover:text-skin-base">
                                    <?php echo e($item['product_name']); ?>

                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1"><?php echo e($item['summary']); ?></p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item['rating'])): ?>
                                <div class="flex items-center mt-2 text-sm">
                                    <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="ml-1"><?php echo e(number_format($item['rating'],1)??0); ?></span>
                                    <span class="text-gray-500 ml-2"><?php echo e($item['number_of_sales']??0); ?> sales</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="flex-shrink-0">
                            <a href="<?php echo e($item['product_link']); ?>"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-skin-base hover:bg-skin-base/[.8]">
                                View
                                <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <span class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow">
                        $<?php echo e(number_format($item['price'], 2)); ?>

                    </span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/vendor/froiden-envato/update/plugins.blade.php ENDPATH**/ ?>