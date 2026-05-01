@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-40 text-center">
        <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl shadow-green-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="text-5xl font-bold mb-4">{{ __('messages.order_placed_success') }}</h1>
        <p class="text-xl text-slate-400 mb-12">
            {{ __('messages.thank_you_purchase') ?? 'Thank you for your purchase.' }} 
            {{ __('messages.order_id') }}: <span class="text-white font-bold">#{{ $id }}</span>
        </p>
        
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
            <a href="{{ route('front.index') }}" class="bg-indigo-600 px-10 py-4 rounded-2xl font-bold hover:bg-indigo-500 transition shadow-lg shadow-indigo-600/30">
                {{ __('messages.continue_shopping') }}
            </a>
            <a href="{{ route('myorders') }}" class="glass px-10 py-4 rounded-2xl font-bold hover:bg-white/10 transition mx-2">
                {{ __('messages.my_orders') }}
            </a>
        </div>
    </div>
@endsection
