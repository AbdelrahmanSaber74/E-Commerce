@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-10">{{ __('messages.my_orders') }}</h1>

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="glass p-8 rounded-3xl card-hover">
                    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                        <div class="flex items-center space-x-6">
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('messages.order_id') }}</p>
                                <p class="font-bold">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('messages.date') }}</p>
                                <p class="font-bold">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('messages.total') }}</p>
                                <p class="font-bold text-indigo-400">${{ number_format($order->total_price, 2) }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="px-4 py-1 rounded-full text-xs font-bold uppercase 
                                @if($order->status == 'delivered') bg-green-500/20 text-green-400 
                                @elseif($order->status == 'pending') bg-yellow-500/20 text-yellow-400 
                                @else bg-indigo-500/20 text-indigo-400 @endif">
                                {{ $order->status }}
                            </span>
                            <a href="#" class="glass px-4 py-2 rounded-xl text-sm font-bold hover:bg-white/10 transition">Order Details</a>
                        </div>
                    </div>

                    <div class="flex space-x-4 overflow-x-auto pb-2">
                        @foreach($order->orderItems as $item)
                            <div class="flex-shrink-0 w-16 h-16 bg-slate-800 rounded-xl overflow-hidden border border-slate-700" title="{{ $item->product->name }}">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover" alt="{{ $item->product->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-600">Img</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="glass p-20 rounded-3xl text-center">
                    <h2 class="text-2xl font-bold mb-4 text-slate-500">You haven't placed any orders yet.</h2>
                    <a href="/home" class="bg-indigo-600 px-8 py-3 rounded-xl hover:bg-indigo-500 transition font-bold">Start Shopping</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
