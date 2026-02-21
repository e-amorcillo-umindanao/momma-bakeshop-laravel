

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">
        <!-- Header & Filters -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Sales Report</h2>
                <p class="text-sm text-slate-500 mt-1">Comprehensive overview of revenue and top products.</p>
            </div>

            <form method="GET" action="<?php echo e(route('reports.sales')); ?>"
                class="flex items-end gap-3 bg-white p-3 rounded-xl shadow-sm border border-slate-200">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Start
                        Date</label>
                    <input type="date" name="start_date" value="<?php echo e($startDate); ?>" required
                        class="block w-full text-sm border-slate-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">End Date</label>
                    <input type="date" name="end_date" value="<?php echo e($endDate); ?>" required
                        class="block w-full text-sm border-slate-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50">
                </div>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors h-[38px] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daily Revenue Table -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-base font-semibold text-slate-800">Daily Revenue Array</h3>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            <?php $__empty_1 = true; $__currentLoopData = $dailySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        <?php echo e(\Carbon\Carbon::parse($sale->date)->format('M d, Y')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600 text-right">
                                        ₱<?php echo e(number_format($sale->total, 2)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="2" class="px-6 py-12 text-center text-sm text-slate-500 bg-slate-50/50">
                                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        No sales records found for this period.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <?php if($dailySales->isNotEmpty()): ?>
                            <tfoot class="bg-slate-50 border-t border-slate-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-slate-700 text-right">Grand Total:</td>
                                    <td class="px-6 py-4 text-base font-black text-indigo-700 text-right">
                                        ₱<?php echo e(number_format($dailySales->sum('total'), 2)); ?>

                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <!-- Top Products List -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col h-full">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-slate-800">Top 5 Products</h3>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-0.5 rounded-full">By Volume</span>
                </div>
                <div class="p-4 flex-1">
                    <?php if($topProducts->isEmpty()): ?>
                        <div class="h-full flex flex-col items-center justify-center text-slate-400 py-8 text-sm">
                            No products sold.
                        </div>
                    <?php else: ?>
                        <ul class="space-y-3">
                            <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li
                                    class="flex items-center p-3 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:shadow-sm transition-all group">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold
                                                        <?php if($index == 0): ?> bg-amber-100 text-amber-700 border border-amber-200
                                                        <?php elseif($index == 1): ?> bg-slate-200 text-slate-600 border border-slate-300
                                                        <?php elseif($index == 2): ?> bg-amber-50 text-amber-800 border border-amber-100
                                                        <?php else: ?> bg-slate-100 text-slate-500 border border-slate-200
                                                        <?php endif; ?>">
                                            #<?php echo e($index + 1); ?>

                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate"><?php echo e($item->ProductName); ?></p>
                                        <p class="text-xs text-slate-500 font-medium mt-0.5 uppercase tracking-wider">Unit Sales</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-black text-indigo-600"><?php echo e($item->total_sold); ?></div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/reports/sales.blade.php ENDPATH**/ ?>