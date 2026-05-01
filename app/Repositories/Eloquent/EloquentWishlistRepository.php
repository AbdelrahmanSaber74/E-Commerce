<?php

namespace App\Repositories\Eloquent;

use App\Models\Wishlist;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentWishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{
    public function __construct(Wishlist $model)
    {
        parent::__construct($model);
    }

    public function toggle(int|string $userId, int|string $productId): array
    {
        $item = $this->model->where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($item) {
            $item->delete();
            return ['status' => 'removed', 'message' => __('messages.wishlist_removed')];
        }

        $this->model->create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return ['status' => 'added', 'message' => __('messages.wishlist_added')];
    }

    public function getForUser(int|string $userId): Collection
    {
        return $this->model->where('user_id', $userId)->with('product')->get();
    }
}
