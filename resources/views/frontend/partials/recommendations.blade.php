@php
    $recommendations = app(App\Services\RecommendationService::class)->getFrequentlyBoughtTogether($product->id);
@endphp

@if($recommendations->count() > 0)
    <div class="mt-40">
        <div class="text-center mb-20 space-y-4">
            <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Smart Suggestions</span>
            <h2 class="text-4xl md:text-5xl font-black tracking-tighter">FREQUENTLY BOUGHT TOGETHER</h2>
            <div class="h-1.5 w-24 bg-gradient-premium mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            @foreach($recommendations as $rec)
                <x-frontend.product-card :product="$rec" />
            @endforeach
        </div>
    </div>
@endif
