<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ModernStore') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4f46e5">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        window.userId = {{ auth()->id() ?? 'null' }};
    </script>
</head>
<body class="antialiased">
    <!-- Navbar -->
    <nav class="glass-header sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition duration-300 shadow-lg shadow-indigo-600/30">
                    <i class="fas fa-shopping-bag text-white text-xl"></i>
                </div>
                <span class="text-2xl font-black tracking-tighter uppercase italic group-hover:text-indigo-400 transition">Modern<span class="text-indigo-500">Store</span></span>
            </a>

            <div class="hidden md:flex items-center space-x-10 text-sm font-medium">
                <a href="/" class="hover:text-indigo-400 transition">{{ __('messages.home') }}</a>
                <a href="#" class="hover:text-indigo-400 transition">Collections</a>
                <a href="#" class="hover:text-indigo-400 transition">Special Offers</a>
                <a href="#" class="hover:text-indigo-400 transition">New Arrivals</a>
            </div>

            <div class="flex items-center space-x-6">
                <!-- Currency Switcher -->
                <div class="hidden sm:block">
                    @include('frontend.partials.currency-switcher')
                </div>

                <div class="flex items-center space-x-4">
                    <button class="hover:text-indigo-400 transition">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    
                    <a href="{{ route('cart.index') }}" class="relative group">
                        <i class="fas fa-shopping-cart text-xl group-hover:text-indigo-400 transition"></i>
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-[10px] w-5 h-5 flex items-center justify-center rounded-full cart-badge border-2 border-[#0f172a]">0</span>
                    </a>

                    @auth
                        <div class="h-8 w-px bg-white/10 mx-2"></div>
                        @php
                            $dashboardRoute = auth()->user()->role === 'admin' ? route('admin') : route('dashboard');
                        @endphp
                        <a href="{{ $dashboardRoute }}" class="flex items-center space-x-2 glass px-4 py-2 rounded-xl hover:bg-white/10 transition">
                            <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center text-[10px]">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="text-xs font-bold">{{ auth()->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-500 px-6 py-2.5 rounded-xl text-sm font-bold transition shadow-lg shadow-indigo-600/20">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="glass border-t border-white/5 py-20 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-6">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase italic">Modern<span class="text-indigo-500">Store</span></span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Elevating your lifestyle with premium curated collections. Experience the future of e-commerce today.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:bg-indigo-600 transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div>
                <h4 class="font-bold mb-8 text-indigo-400 uppercase tracking-widest text-xs">Explore</h4>
                <ul class="space-y-4 text-slate-400 text-sm">
                    <li><a href="#" class="hover:text-white transition">All Products</a></li>
                    <li><a href="#" class="hover:text-white transition">Featured Collections</a></li>
                    <li><a href="#" class="hover:text-white transition">New Arrivals</a></li>
                    <li><a href="#" class="hover:text-white transition">Limited Edition</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-8 text-indigo-400 uppercase tracking-widest text-xs">Customer Service</h4>
                <ul class="space-y-4 text-slate-400 text-sm">
                    <li><a href="#" class="hover:text-white transition">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Returns & Exchanges</a></li>
                    <li><a href="#" class="hover:text-white transition">Track Your Order</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-8 text-indigo-400 uppercase tracking-widest text-xs">Newsletter</h4>
                <p class="text-slate-400 text-sm mb-6">Join our elite circle and get exclusive early access.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Enter your email" class="w-full px-4 py-3 text-sm">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-500 py-3 rounded-xl font-bold transition">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 mt-20 pt-8 border-t border-white/5 text-center text-slate-500 text-xs">
            &copy; {{ date('Y') }} ModernStore Enterprise Platform. All rights reserved. Built for excellence.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    @stack('scripts')
</body>
</html>
