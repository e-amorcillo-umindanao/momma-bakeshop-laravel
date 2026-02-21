<!-- Mobile backdrop -->
<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 bg-stone-900/80 z-40 md:hidden"
    x-cloak></div>

<aside
    class="bg-stone-900 border-r border-stone-800 flex flex-col transition-all duration-150 ease-in-out shrink-0 fixed h-full z-50 shadow-2xl md:shadow-xl"
    :class="sidebarOpen ? 'transtone-x-0 w-64' : '-transtone-x-full md:transtone-x-0 w-64 md:w-20'"
    @mouseenter="if(window.innerWidth >= 768) sidebarOpen = true"
    @mouseleave="if(window.innerWidth >= 768) sidebarOpen = false">

    <!-- Branding Header -->
    <div class="h-16 flex items-center justify-center border-b border-white/10 px-4 shrink-0 overflow-hidden relative">
        <div
            class="bg-orange-600 rounded-lg p-1.5 shrink-0 flex items-center justify-center shadow-lg shadow-orange-600/20">
            <!-- Icon placeholder for a smartphone/warehouse -->
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
        </div>
        <span
            class="ml-3 font-bold text-lg text-white tracking-tight whitespace-nowrap overflow-hidden transition-all duration-150"
            :class="sidebarOpen ? 'w-auto opacity-100' : 'w-0 opacity-0 ml-0 overflow-hidden absolute pointer-events-none'">
            IMS Connect
        </span>
    </div>

    <!-- Navigation Scroll Area -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden scrollbar-hide py-4 space-y-6">

        <!-- Dashboard Section -->
        <div>
            <div class="px-4 text-xs font-semibold text-stone-500 uppercase tracking-widest mb-3 whitespace-nowrap transition-all duration-150"
                :class="sidebarOpen ? 'opacity-100' : 'opacity-0 h-0 my-0 overflow-hidden pointer-events-none'">
                Overview
            </div>
            <nav class="space-y-1.5 px-3">
                <?php if(in_array(auth()->user()->Role, ['Owner/Admin', 'Inventory Clerk'])): ?>
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="<?php echo e(request()->routeIs('dashboard') ? 'bg-orange-600/10 text-orange-400' : 'text-stone-300 hover:text-white hover:bg-stone-800/80'); ?> group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all relative overflow-hidden"
                        title="<?php echo e(auth()->user()->Role === 'Owner/Admin' ? 'Manager Dashboard' : 'Clerk Dashboard'); ?>">
                        <svg class="w-5 h-5 shrink-0 <?php echo e(request()->routeIs('dashboard') ? 'text-orange-400' : 'opacity-70 group-hover:opacity-100 group-hover:text-orange-400 transition-colors'); ?>"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-150"
                            :class="sidebarOpen ? 'opacity-100 truncate' : 'opacity-0 w-0 ml-0 pointer-events-none absolute'"><?php echo e(auth()->user()->Role === 'Owner/Admin' ? 'Manager Dashboard' : 'Clerk Dashboard'); ?></span>
                    </a>
                <?php endif; ?>

                <?php if(in_array(auth()->user()->Role, ['Owner/Admin', 'Cashier'])): ?>
                    <a href="<?php echo e(route('pos.index')); ?>"
                        class="<?php echo e(request()->routeIs('pos.*') ? 'bg-orange-600/10 text-orange-400' : 'text-stone-300 hover:text-white hover:bg-stone-800/80'); ?> group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all relative overflow-hidden"
                        title="Employee Dashboard">
                        <svg class="w-5 h-5 shrink-0 <?php echo e(request()->routeIs('pos.*') ? 'text-orange-400' : 'opacity-70 group-hover:opacity-100 group-hover:text-orange-400 transition-colors'); ?>"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-150"
                            :class="sidebarOpen ? 'opacity-100 truncate' : 'opacity-0 w-0 ml-0 pointer-events-none absolute'">Employee
                            Dashboard</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>

        <?php if(in_array(auth()->user()->Role, ['Owner/Admin', 'Inventory Clerk'])): ?>
            <!-- Operations Section -->
            <div>
                <div class="px-4 text-xs font-semibold text-stone-500 uppercase tracking-widest mb-3 whitespace-nowrap transition-all duration-150"
                    :class="sidebarOpen ? 'opacity-100' : 'opacity-0 h-0 my-0 overflow-hidden pointer-events-none'">
                    Operations
                </div>
                <nav class="space-y-1.5 px-3">
                    <a href="<?php echo e(route('inventory.index')); ?>"
                        class="<?php echo e(request()->routeIs('inventory.*') ? 'bg-orange-600/10 text-orange-400' : 'text-stone-300 hover:text-white hover:bg-stone-800/80'); ?> group flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all relative overflow-hidden"
                        title="Smartphone Inventory">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 shrink-0 <?php echo e(request()->routeIs('inventory.*') ? 'text-orange-400' : 'opacity-70 group-hover:opacity-100 group-hover:text-orange-400 transition-colors'); ?>"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="ml-3 whitespace-nowrap transition-all duration-150"
                                :class="sidebarOpen ? 'opacity-100 truncate' : 'opacity-0 w-0 ml-0 pointer-events-none absolute'">IMS
                                Inventory</span>
                        </div>
                    </a>

                    <?php if(auth()->user()->Role === 'Owner/Admin'): ?>
                        <a href="<?php echo e(route('reports.index')); ?>"
                            class="<?php echo e(request()->routeIs('reports.*') ? 'bg-orange-600/10 text-orange-400' : 'text-stone-300 hover:text-white hover:bg-stone-800/80'); ?> group flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all relative overflow-hidden"
                            title="Reports">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 shrink-0 <?php echo e(request()->routeIs('reports.*') ? 'text-orange-400' : 'opacity-70 group-hover:opacity-100 group-hover:text-orange-400 transition-colors'); ?>"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-150"
                                    :class="sidebarOpen ? 'opacity-100 truncate' : 'opacity-0 w-0 ml-0 pointer-events-none absolute'">Reports</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>

        <?php if(auth()->user()->Role === 'Owner/Admin'): ?>
            <!-- Administration Section -->
            <div>
                <div class="px-4 text-xs font-semibold text-stone-500 uppercase tracking-widest mb-3 whitespace-nowrap transition-all duration-150"
                    :class="sidebarOpen ? 'opacity-100' : 'opacity-0 h-0 my-0 overflow-hidden pointer-events-none'">
                    Administration
                </div>
                <nav class="space-y-1.5 px-3">
                    <a href="<?php echo e(route('users.index')); ?>"
                        class="<?php echo e(request()->routeIs('users.*') ? 'bg-orange-600/10 text-orange-400' : 'text-stone-300 hover:text-white hover:bg-stone-800/80'); ?> group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all relative overflow-hidden"
                        title="User Accounts">
                        <svg class="w-5 h-5 shrink-0 <?php echo e(request()->routeIs('users.*') ? 'text-orange-400' : 'opacity-70 group-hover:opacity-100 group-hover:text-orange-400 transition-colors'); ?>"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-150"
                            :class="sidebarOpen ? 'opacity-100 truncate' : 'opacity-0 w-0 ml-0 pointer-events-none absolute'">User
                            Accounts</span>
                    </a>
                </nav>
            </div>
        <?php endif; ?>
    </div>

    <!-- User Footer Snippet (Optional context menu point) -->
    <div class="p-4 border-t border-white/5 flex items-center shrink-0">
        <div class="h-8 w-8 rounded-md bg-orange-500 flex items-center justify-center shrink-0 shadow-sm">
            <span
                class="text-white text-xs font-bold"><?php echo e(substr(auth()->check() ? auth()->user()->FullName : 'A', 0, 1)); ?></span>
        </div>
        <div class="ml-3 transition-all duration-150 overflow-hidden"
            :class="sidebarOpen ? 'w-auto opacity-100' : 'w-0 opacity-0 absolute pointer-events-none'">
            <p class="text-xs font-medium text-white truncate max-w-[130px]">
                <?php echo e(auth()->check() ? auth()->user()->FullName : 'Admin User'); ?>

            </p>
            <p class="text-[10px] text-stone-400 truncate"><?php echo e(auth()->check() ? auth()->user()->Role : 'System Admin'); ?>

            </p>
        </div>
    </div>
</aside><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/components/sidebar.blade.php ENDPATH**/ ?>