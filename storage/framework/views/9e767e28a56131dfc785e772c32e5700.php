

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900 tracking-tight">Profile Settings</h1>
            <p class="mt-1 text-sm text-stone-500">Manage your account details and preferences.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">

            <div class="px-6 py-8 sm:p-10 border-b border-stone-100 flex items-center gap-6">
                <div class="relative">
                    <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-md"
                        src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->FullName)); ?>&background=ea580c&color=fff&size=150"
                        alt="Avatar">
                    <button type="button"
                        class="absolute bottom-0 right-0 bg-white rounded-full p-1.5 shadow-sm border border-stone-200 text-stone-500 hover:text-orange-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-stone-900"><?php echo e(auth()->user()->FullName); ?></h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <?php echo e(auth()->user()->Status); ?>

                        </span>
                        <span
                            class="text-sm text-stone-500 font-medium px-2 border-l border-stone-300"><?php echo e(auth()->user()->Role); ?></span>
                    </div>
                </div>
            </div>

            <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="px-6 py-8 sm:p-10">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">

                    <div class="sm:col-span-2">
                        <h3 class="text-base font-semibold text-stone-900">Personal Information</h3>
                        <p class="text-sm text-stone-500 mb-4 pb-4 border-b border-stone-100">Update your full name and
                            display name.</p>
                    </div>

                    <div>
                        <label for="FullName" class="block text-sm font-medium text-stone-700">Full Name</label>
                        <div class="mt-1">
                            <input type="text" name="FullName" id="FullName"
                                value="<?php echo e(old('FullName', auth()->user()->FullName)); ?>" required
                                class="block w-full rounded-lg border-stone-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm bg-stone-50 py-2.5 px-3 border transition-colors hover:bg-white focus:bg-white text-stone-800">
                        </div>
                    </div>

                    <div>
                        <label for="Username" class="block text-sm font-medium text-stone-700">System Username</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-stone-400 sm:text-sm">@</span>
                            </div>
                            <input type="text" name="Username" id="Username"
                                value="<?php echo e(old('Username', auth()->user()->Username)); ?>" required
                                class="block w-full pl-8 rounded-lg border-stone-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm bg-stone-50 py-2.5 px-3 border transition-colors hover:bg-white focus:bg-white text-stone-800">
                        </div>
                    </div>

                    <div class="sm:col-span-2 mt-4">
                        <h3 class="text-base font-semibold text-stone-900 border-t border-stone-100 pt-6">Security &
                            Authentication</h3>
                        <p class="text-sm text-stone-500 mb-4 pb-4 border-b border-stone-100">Update your password to stay
                            secure. Leave blank to keep current password.</p>
                    </div>

                    <div>
                        <label for="Password" class="block text-sm font-medium text-stone-700">New Password</label>
                        <div class="mt-1">
                            <input type="password" name="Password" id="Password"
                                class="block w-full rounded-lg border-stone-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm bg-stone-50 py-2.5 px-3 border transition-colors hover:bg-white focus:bg-white text-stone-800 placeholder-stone-400"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="Password_confirmation" class="block text-sm font-medium text-stone-700">Confirm New
                            Password</label>
                        <div class="mt-1">
                            <input type="password" name="Password_confirmation" id="Password_confirmation"
                                class="block w-full rounded-lg border-stone-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm bg-stone-50 py-2.5 px-3 border transition-colors hover:bg-white focus:bg-white text-stone-800 placeholder-stone-400"
                                placeholder="••••••••">
                        </div>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="mt-10 pt-6 border-t border-stone-100 flex items-center justify-end gap-x-4">
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="text-sm font-semibold leading-6 text-stone-600 hover:text-stone-900 transition-colors">Cancel</a>
                    <button type="submit"
                        class="rounded-lg bg-orange-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views\profile.blade.php ENDPATH**/ ?>