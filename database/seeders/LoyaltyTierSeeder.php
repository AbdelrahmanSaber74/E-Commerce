<?php

namespace Database\Seeders;

use App\Models\LoyaltyTier;
use Illuminate\Database\Seeder;

class LoyaltyTierSeeder extends Seeder
{
    public function run(): void
    {
        LoyaltyTier::create([
            'name' => 'Bronze',
            'min_spent' => 0,
            'points_multiplier' => 1.0,
            'color_code' => '#cd7f32'
        ]);

        LoyaltyTier::create([
            'name' => 'Silver',
            'min_spent' => 5000,
            'points_multiplier' => 1.2,
            'color_code' => '#c0c0c0'
        ]);

        LoyaltyTier::create([
            'name' => 'Gold',
            'min_spent' => 15000,
            'points_multiplier' => 1.5,
            'color_code' => '#ffd700'
        ]);
    }
}
