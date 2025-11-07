<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EpStore - Find Your Sole Mate')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome (untuk icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="bg-white font-sans antialiased">
    
    <!-- Navbar -->
    <header class="py-1 sticky top-0 z-50 shadow-sm" style="background-color: #E8E8E8;">
        <nav class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <!-- Kiri: Logo + Menu -->
                <div class="flex items-center gap-20">
                    <!-- Logo Image -->
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Epoy Store Logo" class="h-16 w-auto">
                    </a>

                    <!-- Menu Desktop -->
                    <ul class="flex gap-10 text-base">
                        <li>
                            <a href="{{ route('home') }}" 
                               class="font-medium transition {{ request()->routeIs('home') ? 'text-black' : 'text-gray-600 hover:text-black' }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}" 
                               class="font-medium transition {{ request()->routeIs('shop') ? 'text-black' : 'text-gray-600 hover:text-black' }}">
                                Shop
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kanan: Icon -->
                <div class="flex gap-6 items-center">
                    <!-- Search Icon -->
                    <button class="text-black hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- User Icon dengan Dropdown -->
                    <div class="hidden md:flex items-center">
                        @auth
                            <!-- Dropdown untuk Authenticated User -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-black hover:text-gray-600 transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" 
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                            Dashboard
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Dropdown untuk Guest -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-black hover:text-gray-600 transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                    <a href="{{ route('login') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        Register
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-toggle" class="md:hidden text-black hover:text-gray-600 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>