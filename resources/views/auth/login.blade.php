<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased" x-data="{ darkMode: false }"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Momma's Bakeshop - Login</title>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Tailwind CSS (with arbitrary value support and dark mode override for CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-white dark:bg-stone-950 transition-colors duration-300 flex text-stone-800 dark:text-stone-100">

    <!-- Left side: Image Placeholder -->
    <div class="hidden md:block w-1/2 lg:w-[45%] h-full relative">
        <!-- Rounded container matching the image style -->
        <div class="w-full h-full overflow-hidden relative shadow-lg bg-stone-100 dark:bg-stone-900">
            <!-- Placeholder Image (You will replace this later) -->
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="Bakery Placeholder" class="absolute inset-0 w-full h-full object-cover">
            <!-- Subtle overlay for blending -->
            <div class="absolute inset-0 bg-stone-900/10 mix-blend-multiply"></div>
        </div>
    </div>

    <!-- Right side: Login Form -->
    <div class="w-full md:w-1/2 lg:w-[55%] h-full flex flex-col justify-center relative">

        <!-- Dark Mode Toggle (Moon Icon at top right) -->
        <div class="absolute top-6 right-6 lg:top-8 lg:right-8">
            <button @click="darkMode = !darkMode"
                class="p-3 rounded-2xl bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-stone-200 dark:hover:bg-stone-700 transition-colors focus:outline-none">
                <!-- Moon icon (light mode) -->
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <!-- Sun icon (dark mode) -->
                <svg x-cloak x-show="darkMode" class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </div>

        <!-- Form Container -->
        <div class="w-full max-w-sm mx-auto px-6 sm:px-0">

            <!-- Header section: Momma's Bakeshop -->
            <div class="text-center mb-10">
                <h1
                    class="text-5xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-400 dark:from-orange-400 dark:to-amber-500 leading-tight">
                    Momma's<br>Bakeshop
                </h1>
            </div>

            <!-- Global Errors -->
            @if ($errors->any())
                <div
                    class="mb-6 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-4 py-3 rounded-2xl flex items-center text-sm font-medium border border-red-100 dark:border-red-900/50">
                    <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span><strong>Login Failed:</strong> Invalid credentials.</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Username/Email Field -->
                <div class="relative group">
                    <div
                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-400 dark:text-stone-500 group-focus-within:text-orange-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="Username" value="{{ old('Username') }}" required autofocus
                        class="block w-full pl-12 pr-4 py-3.5 bg-stone-100 dark:bg-stone-800/50 border-none rounded-2xl text-stone-800 dark:text-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:bg-stone-50 dark:focus:bg-stone-800 transition-all placeholder-stone-400 dark:placeholder-stone-500 font-medium text-[15px]"
                        placeholder="Username">
                </div>

                <!-- Password Field with Toggle -->
                <div class="relative group" x-data="{ show: false }">
                    <div
                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-400 dark:text-stone-500 group-focus-within:text-orange-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                    </div>

                    <input :type="show ? 'text' : 'password'" name="Password" required
                        class="block w-full pl-12 pr-14 py-3.5 bg-stone-100 dark:bg-stone-800/50 border-none rounded-2xl text-stone-800 dark:text-stone-100 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:bg-stone-50 dark:focus:bg-stone-800 transition-all placeholder-stone-400 dark:placeholder-stone-500 font-medium text-[15px]"
                        placeholder="Enter Password...">

                    <!-- Show/Hide Password Toggle -->
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-orange-400 hover:text-orange-500 focus:outline-none transition-colors"
                        title="Toggle Password Visibility">
                        <svg x-show="!show" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <!-- Solid eye -->
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg x-cloak x-show="show" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <!-- Solid eye-off -->
                            <path fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd" />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-2xl shadow-lg shadow-orange-500/20 text-[15px] font-bold text-white bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 dark:focus:ring-offset-stone-900 transition-all transform hover:-translate-y-0.5">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>