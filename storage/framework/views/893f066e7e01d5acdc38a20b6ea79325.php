<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Warehouse Management System')); ?></title>

    <!-- Tailwind CSS (via CDN for prototype, compile via Vite in production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full antialiased font-sans text-slate-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden bg-slate-50">
        
        <!-- Sidebar Component -->
        <?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            
            <!-- Global Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200 shadow-sm z-10 shrink-0">
                
                <div class="flex items-center gap-4">
                    <!-- Sidebar Toggle Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-slate-700 focus:outline-none transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <!-- Global Search -->
                    <div class="relative hidden sm:block">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" 
                               class="w-72 pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-400" 
                               placeholder="Search IMS Data (IMEI, Users)...">
                    </div>
                </div>

                <!-- User Profile & Notifications -->
                <div class="flex items-center gap-5">
                    
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500 shadow-sm shadow-red-500/50"></span>
                        </span>
                    </button>
                    
                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover border border-slate-200 shadow-sm" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->check() ? auth()->user()->FullName : 'Admin User')); ?>&background=4f46e5&color=fff" alt="User Avatar">
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-sm font-semibold text-slate-700 leading-tight"><?php echo e(auth()->check() ? auth()->user()->FullName : 'Admin User'); ?></span>
                                <span class="text-xs text-slate-500 font-medium"><?php echo e(auth()->check() ? auth()->user()->Role : 'System Admin'); ?></span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="profileOpen ? 'rotate-180':''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             x-cloak 
                             class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg border border-slate-100 z-50 overflow-hidden ring-1 ring-black ring-opacity-5">
                            <div class="px-4 py-3 border-b border-slate-100 md:hidden">
                                <p class="text-sm font-medium text-slate-900 truncate"><?php echo e(auth()->check() ? auth()->user()->FullName : 'Admin User'); ?></p>
                                <p class="text-xs text-slate-500 truncate"><?php echo e(auth()->check() ? auth()->user()->Role : 'System Admin'); ?></p>
                            </div>
                            <a href="<?php echo e(route('profile')); ?>" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors">Profile Settings</a>
                            
                            <div class="border-t border-slate-100"></div>
                            
                            <?php if(auth()->check()): ?>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">Sign Out</button>
                            </form>
                            <?php else: ?>
                            <a href="/login" class="block px-4 py-2.5 text-sm font-medium text-indigo-600 hover:bg-slate-50 transition-colors">Sign In</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Page Content / Container -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6 sm:p-8">
                
                <!-- Global Alerts / Session Flashes -->
                <?php if(session('success')): ?>
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 p-4 rounded-lg flex items-start shadow-sm" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-3 w-full flex justify-between">
                            <p class="text-sm font-medium text-emerald-800"><?php echo e(session('success')); ?></p>
                            <button @click="show = false" class="ml-4 text-emerald-500 hover:text-emerald-700 focus:outline-none"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="mb-6 bg-rose-50 border border-rose-200 p-4 rounded-lg flex items-start shadow-sm" x-data="{ show: true }" x-show="show" x-transition>
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="h-5 w-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-3 w-full flex justify-between">
                            <p class="text-sm font-medium text-rose-800"><?php echo e(session('error')); ?></p>
                            <button @click="show = false" class="ml-4 text-rose-500 hover:text-rose-700 focus:outline-none"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Injected View Output -->
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/layouts/app.blade.php ENDPATH**/ ?>