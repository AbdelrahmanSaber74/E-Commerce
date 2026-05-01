<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsService
{
    /**
     * Get sales revenue data for the last 30 days
     */
    public function getSalesRevenueData(int $days = 30): array
    {
        $data = Order::where('created_at', '>=', Carbon::now()->subDays($days))
            ->where('status', 'delivered')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $data->pluck('date')->toArray(),
            'values' => $data->pluck('total')->toArray(),
        ];
    }

    /**
     * Get order status distribution
     */
    public function getOrderStatusDistribution(): array
    {
        $data = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return [
            'labels' => $data->pluck('status')->toArray(),
            'values' => $data->pluck('count')->toArray(),
        ];
    }

    /**
     * Get top selling products
     */
    public function getTopSellingProducts(int $limit = 5): mixed
    {
        return Product::withCount('orderItems') // Assuming relation exists
            ->orderBy('order_items_count', 'desc')
            ->limit($limit)
            ->get();
    }
}
