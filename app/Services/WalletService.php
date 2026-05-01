<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class WalletService
{
    /**
     * Add balance to user wallet
     */
    public function deposit(User $user, float $amount): void
    {
        $user->increment('wallet_balance', $amount);
    }

    /**
     * Withdraw from user wallet
     */
    public function withdraw(User $user, float $amount): bool
    {
        if ($user->wallet_balance < $amount) {
            return false;
        }

        $user->decrement('wallet_balance', $amount);
        return true;
    }

    /**
     * Add reward points
     */
    public function addPoints(User $user, int $points): void
    {
        $user->increment('reward_points', $points);
    }

    /**
     * Convert points to wallet balance
     */
    public function convertPointsToBalance(User $user, int $points, float $conversionRate = 0.01): bool
    {
        if ($user->reward_points < $points) {
            return false;
        }

        return DB::transaction(function () use ($user, $points, $conversionRate) {
            $amount = $points * $conversionRate;
            $user->decrement('reward_points', $points);
            $user->increment('wallet_balance', $amount);
            return true;
        });
    }
}
