@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-[700px] flex items-center overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-indigo-600/20 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] bg-purple-600/10 blur-[100px] rounded-full"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center space-x-2 glass px-4 py-2 rounded-full border-white/10">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-ping"></span>
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">{{ __('messages.new_arrival') }}</span>
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black leading-tight tracking-tighter">
                    <span class="block">PREMIUM</span>
                    <span class="text-gradient">COLLECTION</span>
                    <span class="block text-4xl md:text-5xl font-light text-slate-400 mt-2 italic">Define Your Style</span>
                </h1>
                
                <p class="text-lg text-slate-400 max-w-lg leading-relaxed font-light">
                    {{ __('messages.hero_subtitle') }}
                </p>
                
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#" class="bg-indigo-600 hover:bg-indigo-500 px-10 py-5 rounded-2xl font-black transition-all duration-300 shadow-2xl shadow-indigo-600/40 flex items-center group">
                        {{ __('messages.shop_collection') }}
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition"></i>
                    </a>
                    <a href="#" class="glass px-10 py-5 rounded-2xl font-bold hover:bg-white/10 transition border-white/5">
                        {{ __('messages.learn_more') }}
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 pt-12 border-t border-white/5">
                    <div>
                        <span class="block text-2xl font-black">24k+</span>
                        <span class="text-xs text-slate-500 uppercase tracking-widest">Happy Clients</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black">150+</span>
                        <span class="text-xs text-slate-500 uppercase tracking-widest">Premium Brands</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black">4.9/5</span>
                        <span class="text-xs text-slate-500 uppercase tracking-widest">Global Rating</span>
                    </div>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="relative z-10 glass rounded-[4rem] p-4 border-white/5 rotate-3 hover:rotate-0 transition duration-700">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800" class="rounded-[3.5rem] shadow-2xl shadow-black/50" alt="Premium Product">
                    <!-- Floating Elements -->
                    <div class="absolute -bottom-10 -left-10 glass p-6 rounded-3xl border-white/10 animate-bounce">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-2xl flex items-center justify-center text-green-500">
                                <i class="fas fa-shield-alt text-2xl"></i>
                            </div>
                            <div>
                                <span class="block font-bold">100% Secure</span>
                                <span class="text-[10px] text-slate-400">Verified Payment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <section class="max-w-7xl mx-auto px-6 py-32">
        <div class="text-center mb-20 space-y-4">
            <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Curated Selection</span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tighter">{{ __('messages.categories') }}</h2>
            <div class="h-1.5 w-24 bg-gradient-premium mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <div class="group relative h-80 rounded-[2.5rem] overflow-hidden cursor-pointer">
                    <img src="{{ str_starts_with($category->image, 'http') ? $category->image : asset('dashboard/Images/' . $category->image) }}" 
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700" 
                         alt="{{ $category->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8 flex justify-between items-end">
                        <div>
                            <h3 class="text-2xl font-black tracking-tight mb-1">{{ $category->name }}</h3>
                            <p class="text-xs text-slate-300 font-light opacity-0 group-hover:opacity-100 transition duration-500">Explore Collection <i class="fas fa-chevron-right ml-1"></i></p>
                        </div>
                        <div class="w-12 h-12 glass rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 transition border-white/10">
                            <i class="fas fa-arrow-up-right-from-square text-sm"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Global Features -->
    <section class="glass border-y border-white/5 py-16 mb-32">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="flex items-center space-x-6">
                <div class="w-16 h-16 bg-indigo-600/10 rounded-2xl flex items-center justify-center text-indigo-500 text-3xl">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-tight">Express Shipping</h5>
                    <p class="text-xs text-slate-500 mt-1">Global delivery in 3 days</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="w-16 h-16 bg-purple-600/10 rounded-2xl flex items-center justify-center text-purple-500 text-3xl">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-tight">Secure Payment</h5>
                    <p class="text-xs text-slate-500 mt-1">Encrypted transactions</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="w-16 h-16 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-500 text-3xl">
                    <i class="fas fa-headset"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-tight">24/7 Support</h5>
                    <p class="text-xs text-slate-500 mt-1">Expert assistance anytime</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="w-16 h-16 bg-green-600/10 rounded-2xl flex items-center justify-center text-green-500 text-3xl">
                    <i class="fas fa-undo"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-tight">Easy Returns</h5>
                    <p class="text-xs text-slate-500 mt-1">30 days hassle-free return</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="max-w-7xl mx-auto px-6 mb-40">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div class="space-y-4">
                <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Trending Now</span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter">{{ __('messages.featured_products') }}</h2>
                <div class="h-1.5 w-24 bg-gradient-premium rounded-full"></div>
            </div>
            <div class="flex space-x-4">
                <button class="px-6 py-3 glass rounded-2xl hover:bg-white/10 transition text-sm font-bold active-tab">All</button>
                <button class="px-6 py-3 glass rounded-2xl hover:bg-white/10 transition text-sm font-bold text-slate-500">Trending</button>
                <button class="px-6 py-3 glass rounded-2xl hover:bg-white/10 transition text-sm font-bold text-slate-500">Popular</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($products as $product)
                <x-frontend.product-card :product="$product" />
            @endforeach
        </div>
        
        <div class="mt-24 text-center">
            <a href="#" class="inline-flex items-center space-x-4 glass px-12 py-5 rounded-2xl font-black hover:bg-indigo-600 transition group border-white/10">
                <span>View All Masterpieces</span>
                <i class="fas fa-chevron-right text-xs group-hover:translate-x-2 transition"></i>
            </a>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="relative rounded-[4rem] overflow-hidden p-12 md:p-24 text-center">
            <img src="https://images.unsplash.com/photo-1557683316-973673baf926?w=1600" class="absolute inset-0 w-full h-full object-cover" alt="Newsletter BG">
            <div class="absolute inset-0 bg-indigo-900/60 backdrop-blur-sm"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto space-y-8">
                <h2 class="text-4xl md:text-6xl font-black tracking-tighter">JOIN THE ELITE CIRCLE</h2>
                <p class="text-lg text-indigo-100 font-light leading-relaxed">
                    Subscribe to our exclusive newsletter and be the first to experience our premium drops and hidden collections.
                </p>
                <form class="flex flex-col md:flex-row gap-4">
                    <input type="email" placeholder="Your premium email" class="flex-1 px-8 py-5 rounded-2xl !bg-white/10 backdrop-blur-xl border-white/20 !text-white placeholder:text-indigo-200">
                    <button class="bg-white text-indigo-900 px-12 py-5 rounded-2xl font-black hover:bg-indigo-50 transition shadow-2xl">SUBSCRIBE NOW</button>
                </form>
            </div>
        </div>
    </section>
@endsection
