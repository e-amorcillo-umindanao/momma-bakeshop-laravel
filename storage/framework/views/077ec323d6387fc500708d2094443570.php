<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-amber-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Momma's Bakeshop System</title>

    <!-- Tailwind CSS (via CDN for local dev/prototype) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="h-full flex items-center justify-center bg-gradient-to-br from-amber-50 to-orange-100 antialiased p-6">

    <div
        class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-amber-100/50 overflow-hidden transform transition-all">

        <!-- Header Section -->
        <div class="px-8 pt-10 pb-6 text-center">
            <div
                class="mx-auto w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-6 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <!-- Placeholder Bakeshop/Bread icon -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01">
                    </path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Momma's Bakeshop</h1>
            <p class="text-sm text-slate-500 mt-2 font-medium">Sign in to manage your Point of Sale</p>
        </div>

        <!-- Form Section -->
        <div class="px-8 pb-10">

            <!-- Global Errors -->
            <?php if($errors->any()): ?>
                <div
                    class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl flex items-start text-sm">
                    <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span><strong>Login Failed:</strong> Please check your username and password.</span>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Username Input -->
                <div>
                    <label for="Username" class="block text-sm font-semibold text-slate-700 mb-1.5">Username</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" name="Username" id="Username" value="<?php echo e(old('Username')); ?>" required
                            autofocus
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-slate-400 text-sm"
                            placeholder="Enter your username">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="Password" class="block text-sm font-semibold text-slate-700">Password</label>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" name="Password" id="Password" required
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-slate-400 text-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                        Sign In
                    </button>
                </div>
            </form>

        </div>

    </div>

</body>

</html><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/auth/login.blade.php ENDPATH**/ ?>