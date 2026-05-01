@extends('layouts.frontend')

@section('content')
    <div class="relative pt-24 pb-40 min-h-screen overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-indigo-600/5 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-600/5 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-16 text-center lg:text-left">
                <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">{{ __('messages.secure_payment') }}</span>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter mt-2 italic">SECURE <span class="text-gradient">CHECKOUT</span></h1>
                <div class="h-1.5 w-24 bg-gradient-premium rounded-full mt-4 mx-auto lg:mx-0"></div>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                    <!-- Shipping Form -->
                    <div class="lg:col-span-2 space-y-12">
                        <section class="glass p-12 rounded-[3.5rem] border-white/5 space-y-10">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white">
                                    <i class="fas fa-truck-fast"></i>
                                </div>
                                <h3 class="text-2xl font-black tracking-tight italic">{{ __('messages.shipping_details') }}</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">{{ __('messages.full_name') }}</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" class="w-full !px-8 !py-5" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="w-full !px-8 !py-5" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">{{ __('messages.phone') }}</label>
                                    <input type="text" name="phone" class="w-full !px-8 !py-5" required placeholder="+20 123 456 7890">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">{{ __('messages.city') }}</label>
                                    <input type="text" name="city" class="w-full !px-8 !py-5" required>
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">{{ __('messages.address') }}</label>
                                    <textarea name="address" rows="3" class="w-full !px-8 !py-5" required placeholder="Apartment, Street, Landmark..."></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="glass p-12 rounded-[3.5rem] border-white/5 space-y-10">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h3 class="text-2xl font-black tracking-tight italic">{{ __('messages.payment_method') }}</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <label class="relative group cursor-pointer">
                                    <input type="radio" name="payment_method" value="cod" class="peer hidden" checked>
                                    <div class="glass p-8 rounded-3xl border-white/5 peer-checked:border-indigo-500 peer-checked:bg-indigo-600/10 transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <div class="space-y-1">
                                                <span class="block font-black text-sm uppercase tracking-tight">{{ __('messages.cash_on_delivery') }}</span>
                                                <span class="text-[10px] text-slate-500 font-medium">Pay when your order arrives</span>
                                            </div>
                                            <i class="fas fa-money-bill-wave text-2xl text-slate-600 group-hover:text-indigo-400 transition"></i>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative group cursor-not-allowed opacity-50">
                                    <input type="radio" name="payment_method" value="online" class="peer hidden" disabled>
                                    <div class="glass p-8 rounded-3xl border-white/5 transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <div class="space-y-1">
                                                <span class="block font-black text-sm uppercase tracking-tight">{{ __('messages.online_payment') }}</span>
                                                <span class="text-[10px] text-slate-500 font-medium">Secure credit card checkout</span>
                                            </div>
                                            <i class="fas fa-lock text-2xl text-slate-600"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </section>
                    </div>

                    <!-- Sidebar Summary -->
                    <div class="space-y-8">
                        <div class="glass p-10 rounded-[3rem] border-white/10 sticky top-32">
                            <h4 class="text-xl font-black mb-10 tracking-tight italic">{{ __('messages.order_summary') }}</h4>
                            
                            <div class="space-y-6">
                                @foreach($cartItems as $item)
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 glass p-1 rounded-xl border-white/5 shrink-0">
                                            <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('dashboard/Images/' . $item['image']) }}" 
                                                 class="w-full h-full object-cover rounded-lg" alt="{{ $item['name'] }}">
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="text-xs font-bold truncate tracking-tight">{{ $item['name'] }}</h5>
                                            <p class="text-[10px] text-slate-500 mt-0.5">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                        <span class="text-sm font-black italic">@money($item['price'] * $item['quantity'])</span>
                                    </div>
                                @endforeach

                                <div class="h-px bg-white/5 my-6"></div>

                                <div class="space-y-3">
                                    <div class="flex justify-between text-xs text-slate-400 font-medium">
                                        <span>Subtotal</span>
                                        <span class="text-white">@money($subtotal)</span>
                                    </div>
                                    <div class="flex justify-between text-xs text-slate-400 font-medium">
                                        <span>Shipping</span>
                                        <span class="text-green-500 font-bold italic tracking-widest text-[9px]">FREE DELIVERY</span>
                                    </div>
                                    @if(session('coupon'))
                                        <div class="flex justify-between text-xs text-red-400 font-medium">
                                            <span>Discount ({{ session('coupon')['code'] }})</span>
                                            <span>-@money(session('coupon')['discount'])</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-8 space-y-8">
                                    <div class="flex justify-between items-end">
                                        <span class="text-lg font-black tracking-tight italic">{{ __('messages.total') }}</span>
                                        <div class="text-right">
                                            <span class="block text-3xl font-black text-gradient">@money($total)</span>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full h-[72px] bg-indigo-600 hover:bg-indigo-500 rounded-2xl flex items-center justify-center font-black transition-all duration-300 shadow-2xl shadow-indigo-600/30 group">
                                        <span>{{ __('messages.complete_order') }}</span>
                                        <i class="fas fa-check-circle ml-3 group-hover:scale-110 transition"></i>
                                    </button>

                                    <div class="flex items-center justify-center space-x-2 text-[9px] text-slate-500 font-black uppercase tracking-[0.2em]">
                                        <i class="fas fa-lock"></i>
                                        <span>End-to-end encrypted checkout</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
