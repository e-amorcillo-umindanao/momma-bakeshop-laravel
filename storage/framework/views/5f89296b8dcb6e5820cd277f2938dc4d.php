

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-stone-900 tracking-tight">Overview Dashboard</h1>
                <p class="mt-1 text-sm text-stone-500">
                    Welcome back, <span class="font-semibold text-stone-700"><?php echo e(auth()->user()->FullName); ?></span>. Here's
                    what's happening today.
                </p>
            </div>
            <?php if(auth()->user()->Role === 'Owner/Admin'): ?>
                <div class="flex items-center gap-3">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                        <svg class="mr-1.5 h-3.5 w-3.5" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Administrator Access
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Quick Action Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php if(in_array(auth()->user()->Role, ['Owner/Admin', 'Cashier'])): ?>
                <!-- POS Card -->
                <a href="<?php echo e(route('pos.index')); ?>"
                    class="group relative bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-lg hover:border-orange-300 transition-all duration-300 flex flex-col h-full transform hover:-transtone-y-1">
                    <div
                        class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-1 group-hover:text-orange-700 transition-colors">Point of
                        Sale</h3>
                    <p class="text-sm text-stone-500 flex-1">Process customer transactions, manage the cart, and handle
                        checkout.</p>
                    <div class="mt-4 flex items-center text-sm font-semibold text-emerald-600">
                        <span>Open Terminal</span>
                        <svg class="ml-1 w-4 h-4 transform group-hover:transtone-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            <?php endif; ?>

            <?php if(in_array(auth()->user()->Role, ['Owner/Admin', 'Inventory Clerk'])): ?>
                <!-- Inventory Card -->
                <a href="<?php echo e(route('inventory.index')); ?>"
                    class="group relative bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-lg hover:border-orange-300 transition-all duration-300 flex flex-col h-full transform hover:-transtone-y-1">
                    <div
                        class="w-12 h-12 bg-sky-100 text-sky-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-1 group-hover:text-orange-700 transition-colors">Inventory
                    </h3>
                    <p class="text-sm text-stone-500 flex-1">Track stock levels, record incoming items, and manage production
                        batches.</p>
                    <div class="mt-4 flex items-center text-sm font-semibold text-sky-600">
                        <span>Manage Stock</span>
                        <svg class="ml-1 w-4 h-4 transform group-hover:transtone-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            <?php endif; ?>

            <?php if(auth()->user()->Role === 'Owner/Admin'): ?>
                <!-- Reports Card -->
                <a href="<?php echo e(route('reports.index')); ?>"
                    class="group relative bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-lg hover:border-orange-300 transition-all duration-300 flex flex-col h-full transform hover:-transtone-y-1">
                    <div
                        class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-1 group-hover:text-orange-700 transition-colors">Analytics &
                        Reports</h3>
                    <p class="text-sm text-stone-500 flex-1">View daily sales totals, identify top products, and analyze
                        movement history.</p>
                    <div class="mt-4 flex items-center text-sm font-semibold text-amber-600">
                        <span>View Insights</span>
                        <svg class="ml-1 w-4 h-4 transform group-hover:transtone-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <!-- User Accounts Card -->
                <a href="<?php echo e(route('users.index')); ?>"
                    class="group relative bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-lg hover:border-orange-300 transition-all duration-300 flex flex-col h-full transform hover:-transtone-y-1">
                    <div
                        class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-1 group-hover:text-orange-700 transition-colors">User Access
                    </h3>
                    <p class="text-sm text-stone-500 flex-1">Manage employee accounts, assign branch roles, and handle
                        deactivations.</p>
                    <div class="mt-4 flex items-center text-sm font-semibold text-orange-600">
                        <span>Manage Team</span>
                        <svg class="ml-1 w-4 h-4 transform group-hover:transtone-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            <?php endif; ?>

        </div>

        <!-- Additional Dashboard Content Area (e.g. Recent activity feed) -->
        <?php if(auth()->user()->Role === 'Owner/Admin'): ?>
            <div class="mt-8 bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-stone-100 bg-stone-50/50 flex justify-between items-center">
                    <h3 class="text-base font-semibold text-stone-800">Recent System Activity</h3>
                    <a href="<?php echo e(route('reports.sales')); ?>"
                        class="text-sm font-medium text-orange-600 hover:text-orange-700">View All Logs &rarr;</a>
                </div>
                <div class="max-h-96 overflow-y-auto divide-y divide-stone-100">
                    <?php if(isset($recentAudits) && $recentAudits->count() > 0): ?>
                        <?php $__currentLoopData = $recentAudits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $audit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="px-6 py-3 flex items-start gap-3 hover:bg-stone-50/50 transition-colors">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                                                                    <?php if($audit->Action === 'INSERT'): ?> bg-emerald-50 text-emerald-600 border border-emerald-200
                                                                    <?php elseif($audit->Action === 'UPDATE'): ?> bg-sky-50 text-sky-600 border border-sky-200
                                                                    <?php elseif($audit->Action === 'DELETE'): ?> bg-rose-50 text-rose-600 border border-rose-200
                                                                    <?php elseif($audit->Action === 'LOGIN'): ?> bg-indigo-50 text-indigo-600 border border-indigo-200
                                                                    <?php elseif($audit->Action === 'LOGOUT'): ?> bg-amber-50 text-amber-600 border border-amber-200
                                                                    <?php else: ?> bg-stone-50 text-stone-600 border border-stone-200
                                                                    <?php endif; ?>">
                                        <?php echo e(strtoupper(substr($audit->Action, 0, 1))); ?>

                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-stone-800">
                                        <span class="font-semibold"><?php echo e($audit->user->FullName ?? 'System'); ?></span>
                                        <span class="text-stone-500">performed</span>
                                        <span class="font-medium text-stone-700"><?php echo e($audit->Action); ?></span>
                                        <span class="text-stone-500">on</span>
                                        <span class="font-medium text-stone-700"><?php echo e($audit->TableEdited); ?></span>
                                    </p>
                                    <p class="text-xs text-stone-400 mt-0.5">
                                        <?php echo e(\Carbon\Carbon::parse($audit->DateAdded)->diffForHumans()); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="px-6 py-12 text-center text-sm text-stone-500 flex flex-col items-center">
                            <div class="h-10 w-10 bg-stone-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            No recent activity to show.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views\dashboard.blade.php ENDPATH**/ ?>