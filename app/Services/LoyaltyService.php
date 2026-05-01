<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\LoyaltyTier;
use App\Repositories\Interfaces\UserRepositoryInterface;

class LoyaltyService
{
    /**
     * Check and update user's loyalty tier based on total spent
     */
    public function updateTier(User $user): void
    {
        $newTier = LoyaltyTier::where('min_spent', '<=', $user->total_spent)
                             ->orderBy('min_spent', 'desc')
                             ->first();

        if ($newTier && $user->loyalty_tier_id !== $newTier->id) {
            $user->update(['loyalty_tier_id' => $newTier->id]);
            // Logic to notify user about tier upgrade can go here
        }
    }

    /**
     * Calculate points based on user's current tier multiplier
     */
    public function calculatePoints(User $user, float $amount): int
    {
        $multiplier = $user->loyaltyTier?->points_multiplier ?? 1.0;
        return (int) ($amount * $multiplier);
    }
}
