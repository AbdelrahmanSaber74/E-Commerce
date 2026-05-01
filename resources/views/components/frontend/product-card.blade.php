<div class="glass rounded-3xl overflow-hidden card-hover group">
    <div class="relative h-64 bg-slate-800">
        <a href="{{ route('product.show', $product->id) }}">
            @if($product->image)
                @php
                    $imageUrl = str_starts_with($product->image, 'http') ? $product->image : asset('dashboard/Images/' . $product->image);
                @endphp
                <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $product->name }}">
            @else
                <div class="w-full h-full flex items-center justify-center text-slate-600">No Image</div>
            @endif
        </a>
        <div class="absolute top-4 right-4 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition duration-300">
            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="p-2 bg-white/10 backdrop-blur-md rounded-full hover:bg-indigo-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </form>
        </div>
        @if($product->discount_price)
            <div class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                SALE
            </div>
            @if($product->variants->count() > 0)
                <div class="absolute top-12 left-4 bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                    VARIANTS
                </div>
            @endif
        @endif
    </div>
    
    <div class="p-6">
        <span class="text-xs text-indigo-400 font-medium uppercase tracking-tighter">{{ $product->category->name ?? 'Gadgets' }}</span>
        <a href="{{ route('product.show', $product->id) }}">
            <h3 class="text-lg font-bold mt-1 hover:text-indigo-400 transition truncate">{{ $product->name }}</h3>
        </a>
        <div class="flex items-center mt-3 justify-between">
            <div class="flex flex-col">
                <span class="text-xl font-bold text-indigo-400">{{ number_format($product->discount_price ?? $product->price, 2) }} <small class="text-xs">EGP</small></span>
                @if($product->discount_price)
                    <span class="text-xs text-slate-500 line-through">{{ number_format($product->price, 2) }}</span>
                @endif
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="p-3 bg-indigo-600 rounded-2xl hover:bg-indigo-500 transition shadow-lg shadow-indigo-600/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>