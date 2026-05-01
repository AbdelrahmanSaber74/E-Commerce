@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-20">
        <h1 class="text-4xl font-bold mb-10">Saved for <span class="gradient-text">Later</span></h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @forelse($wishlist as $item)
                <x-frontend.product-card :product="$item->product" />
            @empty
                <div class="col-span-4 glass p-20 rounded-3xl text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-slate-700 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h2 class="text-2xl font-bold mb-4">{{ __('messages.empty_wishlist') }}</h2>
                    <a href="{{ route('front.index') }}" class="bg-indigo-600 px-8 py-3 rounded-xl hover:bg-indigo-500 transition font-bold">{{ __('messages.continue_shopping') }}</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
