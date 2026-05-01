@extends('layouts.frontend')

@section('content')
    <div class="relative pt-24 pb-40 min-h-screen overflow-hidden">
        <!-- Background Orbs -->
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-indigo-600/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-600/5 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-16">
                <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">{{ __('messages.order_summary') }}</span>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter mt-2 italic">YOUR <span class="text-gradient">SELECTION</span></h1>
                <div class="h-1.5 w-24 bg-gradient-premium rounded-full mt-4"></div>
            </div>

            @if(count($cartItems) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-8">
                        @foreach($cartItems as $id => $details)
                            <div class="glass p-8 rounded-[2.5rem] border-white/5 group hover:border-indigo-600/30 transition duration-500">
                                <div class="flex flex-col sm:flex-row items-center gap-8">
                                    <div class="w-32 h-32 glass p-2 rounded-3xl border-white/10 overflow-hidden shrink-0">
                                        <img src="{{ str_starts_with($details['image'], 'http') ? $details['image'] : asset('dashboard/Images/' . $details['image']) }}" 
                                             class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition duration-700" 
                                             alt="{{ $details['name'] }}">
                                    </div>
                                    
                                    <div class="flex-1 space-y-2 text-center sm:text-left">
                                        <h3 class="text-2xl font-black tracking-tight">{{ $details['name'] }}</h3>
                                        <p class="text-xs text-slate-500 font-medium uppercase tracking-widest">{{ $details['category_name'] ?? 'Premium Item' }}</p>
                                        <div class="flex items-center justify-center sm:justify-start space-x-4 pt-2">
                                            <span class="text-indigo-400 font-bold text-lg">@money($details['price'])</span>
                                            <span class="text-slate-600 text-xs">x {{ $details['quantity'] }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-6">
                                        <div class="inline-flex items-center glass px-4 py-2 rounded-2xl border-white/5 h-12">
                                            <button class="hover:text-indigo-400 transition"><i class="fas fa-minus text-xs"></i></button>
                                            <span class="w-10 text-center font-bold text-sm">{{ $details['quantity'] }}</span>
                                            <button class="hover:text-indigo-400 transition"><i class="fas fa-plus text-xs"></i></button>
                                        </div>
                                        
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-slate-500 hover:text-red-500 hover:bg-red-500/10 transition border-white/5">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Sidebar -->
                    <div class="space-y-8">
                        <div class="glass p-10 rounded-[3rem] border-white/10 sticky top-32">
                            <h4 class="text-xl font-black mb-8 tracking-tight italic">{{ __('messages.order_summary') }}</h4>
                            
                            <div class="space-y-6">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">{{ __('messages.subtotal') }}</span>
                                    <span class="font-bold">@money($subtotal)</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">{{ __('messages.shipping') }}</span>
                                    <span class="text-green-500 font-bold uppercase tracking-widest text-[10px]">{{ __('messages.free') }}</span>
                                </div>
                                
                                <div class="h-px bg-white/5 my-4"></div>
                                
                                <div class="flex justify-between items-end">
                                    <span class="text-lg font-black tracking-tight italic">{{ __('messages.total') }}</span>
                                    <div class="text-right">
                                        <span class="block text-3xl font-black text-gradient">@money($total)</span>
                                        <span class="text-[10px] text-slate-500 uppercase tracking-widest">Inclusive of taxes</span>
                                    </div>
                                </div>

                                <div class="pt-8 space-y-4">
                                    <a href="{{ route('checkout.index') }}" class="w-full bg-indigo-600 hover:bg-indigo-500 h-[72px] rounded-2xl flex items-center justify-center font-black transition-all duration-300 shadow-2xl shadow-indigo-600/30 group">
                                        <span>{{ __('messages.proceed_to_checkout') }}</span>
                                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition"></i>
                                    </a>
                                    <a href="/" class="w-full h-[72px] glass rounded-2xl flex items-center justify-center font-bold hover:bg-white/5 transition text-sm text-slate-400">
                                        {{ __('messages.continue_shopping') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Coupon Box -->
                        <div class="glass p-8 rounded-[2.5rem] border-white/5">
                            <h5 class="text-sm font-bold mb-4 uppercase tracking-widest text-slate-500">Apply Promo Code</h5>
                            <form action="{{ route('coupon.apply') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="text" name="code" placeholder="ENTER CODE" class="flex-1 !px-6 !py-4 text-xs font-bold uppercase tracking-widest">
                                <button type="submit" class="bg-white text-indigo-900 px-6 py-4 rounded-xl font-black text-xs hover:bg-indigo-50 transition">APPLY</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-40 glass rounded-[4rem] border-white/5">
                    <div class="w-32 h-32 bg-indigo-600/10 rounded-full flex items-center justify-center mx-auto mb-8 text-indigo-400 text-5xl">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h2 class="text-3xl font-black tracking-tight mb-4 italic">{{ __('messages.empty_cart') }}</h2>
                    <p class="text-slate-500 mb-12 max-w-sm mx-auto font-light leading-relaxed">Your selection is currently empty. Elevate your lifestyle with our premium collections.</p>
                    <a href="/" class="inline-flex items-center space-x-4 bg-indigo-600 hover:bg-indigo-500 px-12 py-5 rounded-2xl font-black transition shadow-2xl shadow-indigo-600/30">
                        <span>EXPLORE NOW</span>
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
