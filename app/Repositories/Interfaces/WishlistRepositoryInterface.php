<?php

namespace App\Repositories\Interfaces;

interface WishlistRepositoryInterface extends RepositoryInterface
{
    public function toggle(int|string $userId, int|string $productId): array;
    public function getForUser(int|string $userId): \Illuminate\Database\Eloquent\Collection;
}
