<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::create([
            'name' => 'Egyptian Pound',
            'code' => 'EGP',
            'symbol' => 'EGP',
            'exchange_rate' => 1.0,
            'is_default' => true
        ]);

        Currency::create([
            'name' => 'US Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'exchange_rate' => 0.021, // Sample rate
            'is_active' => true
        ]);

        Currency::create([
            'name' => 'Saudi Riyal',
            'code' => 'SAR',
            'symbol' => 'SAR',
            'exchange_rate' => 0.078, // Sample rate
            'is_active' => true
        ]);
    }
}
