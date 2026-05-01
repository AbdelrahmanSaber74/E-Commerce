<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\App;

class CurrencyHelper
{
    /**
     * Format price based on current currency
     */
    public static function format(float $amount): string
    {
        $service = App::make(CurrencyService::class);
        return $service->convert($amount)['formatted'];
    }
}
