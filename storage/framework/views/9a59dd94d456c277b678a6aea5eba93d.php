

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">User Management</h1>
                <p class="mt-1 text-sm text-slate-500">Manage system access, roles, and employee accounts.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('users.create')); ?>"
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New User
                </a>
            </div>
        </div>

        <!-- Users Data Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h2 class="text-base font-bold text-slate-800">System Users</h2>
                <span
                    class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded-full"><?php echo e($users->count()); ?>

                    Total</span>
            </div>

            <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['headers' => ['User Information', 'System Role', 'Status', 'Actions'],'search' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['User Information', 'System Role', 'Status', 'Actions']),'search' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr
                        class="hover:bg-slate-50 transition-colors <?php echo e($user->Status === 'Inactive' ? 'bg-slate-50 opacity-75' : ''); ?>">

                        <!-- User Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover border border-slate-200"
                                        src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->FullName)); ?>&background=e2e8f0&color=475569"
                                        alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900"><?php echo e($user->FullName); ?></div>
                                    <div class="text-xs text-slate-500 font-medium">@<span><?php echo e($user->Username); ?></span></div>
                                </div>
                            </div>
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-slate-700"><?php echo e($user->Role); ?></div>
                            <div class="text-xs text-slate-500">Since
                                <?php echo e(\Carbon\Carbon::parse($user->DateAdded)->format('M Y')); ?></div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($user->Status === 'Active'): ?>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Active
                                </span>
                            <?php else: ?>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800 border border-rose-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                    Inactive
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                <a href="<?php echo e(route('users.edit', $user->ID)); ?>"
                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition-colors"
                                    title="Edit User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                <form action="<?php echo e(route('users.deactivate', $user->ID)); ?>" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to change this user\'s access?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <?php if($user->Status === 'Active'): ?>
                                        <button type="submit"
                                            class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 p-2 rounded-lg transition-colors shadow-sm"
                                            title="Deactivate Access">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                </path>
                                            </svg>
                                        </button>
                                    <?php else: ?>
                                        <button type="submit"
                                            class="text-emerald-600 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 p-2 rounded-lg transition-colors shadow-sm"
                                            title="Restore Access">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    <?php endif; ?>
                                </form>
                            </div>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/users/index.blade.php ENDPATH**/ ?>