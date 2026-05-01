<?php

namespace App\Services;

use App\Repositories\Interfaces\WishlistRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class WishlistService
{
    public function __construct(
        protected WishlistRepositoryInterface $wishlistRepository
    ) {}

    /**
     * Toggle product in wishlist
     */
    public function toggle(int|string $productId): array
    {
        return $this->wishlistRepository->toggle(Auth::id(), $productId);
    }

    /**
     * Get user wishlist
     */
    public function getWishlist(): Collection
    {
        return $this->wishlistRepository->getForUser(Auth::id());
    }
}
