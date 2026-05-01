<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyService
{
    /**
     * Get active currencies
     */
    public function getActiveCurrencies()
    {
        return Cache::remember('active_currencies', 3600, function () {
            return Currency::where('is_active', true)->get();
        });
    }

    /**
     * Get current currency from session or default
     */
    public function getCurrentCurrency(): Currency
    {
        $code = Session::get('currency', config('app.currency', 'EGP'));
        return Currency::where('code', $code)->first() ?? $this->getDefaultCurrency();
    }

    /**
     * Get default currency
     */
    public function getDefaultCurrency(): Currency
    {
        return Currency::where('is_default', true)->first() ?? Currency::first();
    }

    /**
     * Convert amount to current currency
     */
    public function convert(float $amount): array
    {
        $currency = $this->getCurrentCurrency();
        $convertedAmount = $amount * $currency->exchange_rate;

        return [
            'amount' => $convertedAmount,
            'formatted' => number_format($convertedAmount, 2) . ' ' . $currency->symbol,
            'currency' => $currency->code
        ];
    }

    /**
     * Switch current currency
     */
    public function switchCurrency(string $code): void
    {
        if (Currency::where('code', $code)->where('is_active', true)->exists()) {
            Session::put('currency', $code);
        }
    }
}
