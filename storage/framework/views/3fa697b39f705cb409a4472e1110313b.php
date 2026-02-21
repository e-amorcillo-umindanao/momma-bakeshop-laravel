

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Inventory Management</h1>
                <p class="mt-1 text-sm text-slate-500">Track raw materials and manage finished product stock levels.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('inventory.stock_out')); ?>"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4M12 4l-8 8 8 8">
                        </path>
                    </svg>
                    Stock-Out
                </a>
                <a href="<?php echo e(route('inventory.stock_in')); ?>"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M12 4l8 8-8 8">
                        </path>
                    </svg>
                    Stock-In
                </a>
                <a href="<?php echo e(route('production.create')); ?>"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                        </path>
                    </svg>
                    Record Batch
                </a>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <?php if($lowStockRawMaterials->count() > 0 || $lowStockProducts->count() > 0): ?>
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 flex items-start shadow-sm">
                <div class="shrink-0">
                    <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-bold text-rose-800">Critical Low Stock Alerts</h3>
                    <div class="mt-2 text-sm text-rose-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <?php $__currentLoopData = $lowStockRawMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><strong><?php echo e($item->ItemName); ?></strong> is at <?php echo e($item->Quantity); ?> <?php echo e($item->Measurement); ?>

                                    (Threshold: <?php echo e($item->LowStockThreshold); ?>)</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><strong><?php echo e($product->ProductName); ?></strong> is at <?php echo e($product->Quantity); ?> units (Threshold:
                                    <?php echo e($product->LowStockThreshold); ?>)</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Raw Materials Section -->
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-800">Raw Materials</h2>
                    <span
                        class="bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-0.5 rounded-full"><?php echo e($rawMaterials->count()); ?>

                        Items</span>
                </div>

                <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['headers' => ['Ingredient', 'Quantity', 'Status'],'search' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Ingredient', 'Quantity', 'Status']),'search' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    <?php $__currentLoopData = $rawMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-slate-900"><?php echo e($item->ItemName); ?></div>
                                <div class="text-xs text-slate-500">Threshold: <?php echo e($item->LowStockThreshold); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-700"><?php echo e($item->Quantity); ?> <span
                                        class="text-xs font-normal text-slate-500"><?php echo e($item->Measurement); ?></span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($item->Quantity <= $item->LowStockThreshold): ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        Low Stock
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        In Stock
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
            </div>

            <!-- Finished Goods Section -->
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-800">Finished Goods</h2>
                    <span
                        class="bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-0.5 rounded-full"><?php echo e($finishedGoods->count()); ?>

                        Products</span>
                </div>

                <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['headers' => ['Product Name', 'Quantity', 'Status'],'search' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Product Name', 'Quantity', 'Status']),'search' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    <?php $__currentLoopData = $finishedGoods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-slate-900"><?php echo e($product->ProductName); ?></div>
                                <div class="text-xs text-slate-500">₱<?php echo e(number_format($product->Price, 2)); ?> / unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-700"><?php echo e($product->Quantity); ?> <span
                                        class="text-xs font-normal text-slate-500">units</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($product->Quantity <= $product->LowStockThreshold): ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        Low Stock
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        In Stock
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/inventory/index.blade.php ENDPATH**/ ?>