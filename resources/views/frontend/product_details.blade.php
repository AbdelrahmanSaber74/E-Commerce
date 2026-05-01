@extends('layouts.frontend')

@section('content')
    <div class="relative pt-20 pb-32 overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-indigo-600/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-purple-600/5 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex mb-12 text-sm text-slate-500 font-light tracking-wide uppercase">
                <a href="/" class="hover:text-indigo-400 transition">Home</a>
                <span class="mx-3">/</span>
                <a href="#" class="hover:text-indigo-400 transition">{{ $product->category->name }}</a>
                <span class="mx-3">/</span>
                <span class="text-slate-300 font-medium">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <!-- Image Gallery -->
                <div class="space-y-6">
                    <div class="glass rounded-[3rem] p-4 border-white/5 overflow-hidden group">
                        @php
                            $imageUrl = str_starts_with($product->image, 'http') ? $product->image : asset('dashboard/Images/' . $product->image);
                        @endphp
                        <img src="{{ $imageUrl }}" class="w-full h-auto rounded-[2.5rem] shadow-2xl transition duration-700 group-hover:scale-105" alt="{{ $product->name }}">
                    </div>
                    
                    <!-- Thumbnails (Placeholder) -->
                    <div class="grid grid-cols-4 gap-4">
                        <div class="glass p-2 rounded-2xl border-white/10 cursor-pointer hover:border-indigo-500 transition">
                            <img src="{{ $imageUrl }}" class="w-full h-20 object-cover rounded-xl" alt="Thumb">
                        </div>
                        <!-- More thumbs can go here if the model supports it -->
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-10">
                    <div class="space-y-4">
                        <div class="inline-flex items-center space-x-3 glass px-4 py-2 rounded-full border-white/10">
                            <span class="text-xs font-black text-indigo-400 uppercase tracking-widest">{{ $product->category->name }}</span>
                            <span class="h-1 w-1 bg-slate-600 rounded-full"></span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">In Stock</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-tight">{{ $product->name }}</h1>
                        
                        <div class="flex items-center space-x-4">
                            <div class="flex text-yellow-500 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-xs text-slate-500 font-medium">(128 Verified Reviews)</span>
                        </div>
                    </div>

                    <div class="flex items-end space-x-6">
                        <span class="text-5xl font-black text-gradient">@money($product->discount_price ?? $product->price)</span>
                        @if($product->discount_price)
                            <span class="text-xl text-slate-600 line-through mb-1 font-light italic">@money($product->price)</span>
                            <span class="bg-red-500/10 text-red-500 text-xs font-black px-3 py-1 rounded-lg border border-red-500/20 mb-2">
                                SAVE {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                            </span>
                        @endif
                    </div>

                    <p class="text-slate-400 text-lg leading-relaxed font-light">
                        {{ $product->description }}
                    </p>

                    <!-- Selection Options (Variants) -->
                    <div class="space-y-8 pt-8 border-t border-white/5">
                        @if($product->variants->count() > 0)
                            <!-- Variants would go here with premium styling -->
                        @endif

                        <div class="flex flex-col sm:flex-row gap-6">
                            <div class="inline-flex items-center glass p-2 rounded-2xl border-white/10 h-[72px]">
                                <button class="w-12 h-full flex items-center justify-center hover:text-indigo-400 transition"><i class="fas fa-minus"></i></button>
                                <input type="number" value="1" class="w-16 text-center !bg-transparent border-none !shadow-none font-black text-xl" min="1">
                                <button class="w-12 h-full flex items-center justify-center hover:text-indigo-400 transition"><i class="fas fa-plus"></i></button>
                            </div>
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full h-[72px] bg-indigo-600 hover:bg-indigo-500 rounded-2xl flex items-center justify-center space-x-4 font-black transition-all duration-300 shadow-2xl shadow-indigo-600/30 group">
                                    <i class="fas fa-shopping-cart group-hover:-translate-y-1 transition duration-300"></i>
                                    <span>ADD TO EXPERIENCE</span>
                                </button>
                            </form>
                            
                            <button class="w-[72px] h-[72px] glass rounded-2xl flex items-center justify-center hover:bg-red-500/20 transition border-white/10 group">
                                <i class="far fa-heart group-hover:scale-125 transition duration-300"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-2 gap-4 pt-12">
                        <div class="glass p-4 rounded-2xl border-white/5 flex items-center space-x-4">
                            <div class="w-10 h-10 bg-indigo-600/10 rounded-xl flex items-center justify-center text-indigo-400">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-300 uppercase tracking-tight">Express Delivery</span>
                        </div>
                        <div class="glass p-4 rounded-2xl border-white/5 flex items-center space-x-4">
                            <div class="w-10 h-10 bg-purple-600/10 rounded-xl flex items-center justify-center text-purple-400">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-300 uppercase tracking-tight">Lifetime Warranty</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recommendations Section -->
            @include('frontend.partials.recommendations', ['product' => $product])
        </div>
    </div>
@endsection
