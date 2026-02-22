

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto mt-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-stone-800 tracking-tight">Record Production Batch</h2>
            <p class="text-sm text-stone-500 mt-1">Add newly produced finished goods to the inventory system.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
            <form action="<?php echo e(route('production.store')); ?>" method="POST" class="p-6 md:p-8">
                <?php echo csrf_field(); ?>

                <div class="space-y-6">
                    <!-- Product Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Finished Product Produced</label>
                        <select name="ProductID" required
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700">
                            <option value="">Select Product...</option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->ID); ?>"><?php echo e($product->ProductName); ?> - Current Stock:
                                    <?php echo e($product->Quantity); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Quantity Produced</label>
                        <input type="number" name="QuantityProduced" min="1" required
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700"
                            placeholder="e.g. 50">
                    </div>

                    <!-- Date & Time -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Date & Time of Production</label>
                        <input type="datetime-local" name="ProductionDate" required value="<?php echo e(date('Y-m-d\TH:i')); ?>"
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700">
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-8 pt-6 border-t border-stone-100 flex items-center justify-end gap-4">
                    <a href="<?php echo e(route('inventory.index')); ?>"
                        class="px-5 py-2.5 text-sm font-medium text-stone-600 hover:text-stone-900 bg-white border border-stone-200 rounded-xl shadow-sm hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-stone-200 transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-orange-600 border border-transparent rounded-xl shadow-sm hover:bg-orange-500 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Record Batch
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views\production\create.blade.php ENDPATH**/ ?>