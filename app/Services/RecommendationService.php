<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RecommendationService
{
    /**
     * Get frequently bought together products
     */
    public function getFrequentlyBoughtTogether(int $productId, int $limit = 4): Collection
    {
        return Cache::remember("frequently_bought_with_{$productId}", 3600, function () use ($productId, $limit) {
            // Find orders containing this product
            $orderIds = OrderItem::where('product_id', $productId)->pluck('order_id');

            // Find other products in those orders
            $relatedProductIds = OrderItem::whereIn('order_id', $orderIds)
                ->where('product_id', '!=', $productId)
                ->select('product_id', \DB::raw('count(*) as count'))
                ->groupBy('product_id')
                ->orderBy('count', 'desc')
                ->limit($limit)
                ->pluck('product_id');

            return Product::whereIn('id', $relatedProductIds)->get();
        });
    }

    /**
     * Get similar products based on category
     */
    public function getSimilarProducts(Product $product, int $limit = 4): Collection
    {
        return Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit($limit)
            ->get();
    }
}
