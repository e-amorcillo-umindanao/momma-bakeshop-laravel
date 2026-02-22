

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto mt-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-stone-800 tracking-tight">Create New User</h2>
            <p class="text-sm text-stone-500 mt-1">Register a new employee and assign their system access role.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
            <?php if($errors->any()): ?>
                <div class="bg-red-50 border-b border-red-100 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('users.store')); ?>" method="POST" class="p-6 md:p-8">
                <?php echo csrf_field(); ?>

                <div class="space-y-6">
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Full Name</label>
                        <input type="text" name="FullName" value="<?php echo e(old('FullName')); ?>" required
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700"
                            placeholder="e.g. John Doe">
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Username</label>
                        <input type="text" name="Username" value="<?php echo e(old('Username')); ?>" required
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700"
                            placeholder="jdoe">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Password</label>
                        <input type="password" name="Password" required autocomplete="new-password"
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700"
                            placeholder="••••••••">
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">System Role</label>
                        <select name="Role" required
                            class="block w-full rounded-xl border-stone-300 py-3 px-4 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700">
                            <option value="">Select a role...</option>
                            <option value="Cashier" <?php echo e(old('Role') == 'Cashier' ? 'selected' : ''); ?>>Cashier (POS Access)
                            </option>
                            <option value="Inventory Clerk" <?php echo e(old('Role') == 'Inventory Clerk' ? 'selected' : ''); ?>>Inventory
                                Clerk (Warehouse Access)</option>
                            <option value="Owner/Admin" <?php echo e(old('Role') == 'Owner/Admin' ? 'selected' : ''); ?>>Owner/Admin (Full
                                Access)</option>
                        </select>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-8 pt-6 border-t border-stone-100 flex items-center justify-end gap-4">
                    <a href="<?php echo e(route('users.index')); ?>"
                        class="px-5 py-2.5 text-sm font-medium text-stone-600 hover:text-stone-900 bg-white border border-stone-200 rounded-xl shadow-sm hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-stone-200 transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-orange-600 border border-transparent rounded-xl shadow-sm hover:bg-orange-500 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views\users\create.blade.php ENDPATH**/ ?>