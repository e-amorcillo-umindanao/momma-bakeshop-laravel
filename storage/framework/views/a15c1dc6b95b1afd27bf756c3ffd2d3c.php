

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-stone-900 tracking-tight">Reports & Analytics</h1>
            <p class="mt-1 text-sm text-stone-500">Monitor daily sales performance and inventory movement.</p>
        </div>

        <!-- Widget Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Sales Widget -->
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-32 h-32 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-stone-600 uppercase tracking-widest">Today's Revenue</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span
                            class="text-4xl font-black text-stone-900 tracking-tighter">₱<?php echo e(number_format($todaySales, 2)); ?></span>
                    </div>
                </div>

                <div class="relative z-10 mt-8">
                    <a href="<?php echo e(route('reports.sales')); ?>"
                        class="inline-flex w-full justify-center items-center px-4 py-2.5 text-sm font-semibold text-white bg-orange-600 border border-transparent rounded-xl shadow-sm hover:bg-orange-500 hover:shadow-md transition-all">
                        View Comprehensive Sales Report
                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Inventory Alerts Widget -->
            <?php
                $lowStockCount = $lowStockProducts instanceof \Illuminate\Support\Collection ? $lowStockProducts->count() : (int) $lowStockProducts;
            ?>
            <div
                class="bg-gradient-to-br from-white to-rose-50/30 rounded-2xl p-6 shadow-sm border <?php echo e($lowStockCount > 0 ? 'border-rose-200' : 'border-stone-200'); ?> relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-32 h-32 <?php echo e($lowStockCount > 0 ? 'text-rose-600' : 'text-stone-400'); ?>" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="p-2 <?php echo e($lowStockCount > 0 ? 'bg-rose-100 text-rose-600' : 'bg-stone-100 text-stone-500'); ?> rounded-lg">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-stone-600 uppercase tracking-widest">Low Stock Items</h3>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span
                            class="text-4xl font-black tracking-tighter <?php echo e($lowStockCount > 0 ? 'text-rose-600' : 'text-stone-700'); ?>"><?php echo e($lowStockCount); ?></span>
                        <span class="text-sm font-medium text-stone-500">products require attention</span>
                    </div>
                </div>

                <div class="relative z-10 mt-8">
                    <a href="<?php echo e(route('reports.inventory')); ?>"
                        class="inline-flex w-full justify-center items-center px-4 py-2.5 text-sm font-semibold <?php echo e($lowStockCount > 0 ? 'text-rose-700 bg-rose-100 border-rose-200 hover:bg-rose-200' : 'text-stone-700 bg-white border-stone-300 hover:bg-stone-50'); ?> border rounded-xl shadow-sm transition-all">
                        View Activity Log & Stock Details
                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/reports/index.blade.php ENDPATH**/ ?>