@php
    $currencies = app(App\Services\CurrencyService::class)->getActiveCurrencies();
    $currentCurrency = session('currency', 'EGP');
@endphp

<div class="relative group">
    <button class="flex items-center space-x-2 glass px-4 py-2 rounded-xl hover:bg-white/10 transition border-white/5">
        <i class="fas fa-globe text-indigo-400 text-xs"></i>
        <span class="text-xs font-bold uppercase tracking-widest">{{ $currentCurrency }}</span>
        <i class="fas fa-chevron-down text-[10px] text-slate-500"></i>
    </button>
    
    <div class="absolute right-0 mt-2 w-40 glass rounded-2xl border-white/10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[60] overflow-hidden">
        <div class="py-2">
            @foreach($currencies as $currency)
                <form action="{{ route('currency.switch') }}" method="POST">
                    @csrf
                    <input type="hidden" name="currency" value="{{ $currency->code }}">
                    <button type="submit" class="w-full text-left px-6 py-3 text-xs font-bold hover:bg-indigo-600 transition flex items-center justify-between">
                        <span>{{ $currency->code }}</span>
                        @if($currentCurrency === $currency->code)
                            <i class="fas fa-check text-indigo-400"></i>
                        @endif
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</div>
