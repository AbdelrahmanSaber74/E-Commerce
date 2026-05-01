<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Get overall statistics for dashboard cards
     */
    public function getStats(): array
    {
        return [
            'total_sales' => Order::where('payment_status', 'paid')->sum('total_price'),
            'total_orders' => Order::count(),
            'total_customers' => User::count(),
            'total_products' => Product::count(),
        ];
    }

    /**
     * Get monthly sales chart data
     */
    public function getMonthlySalesData(): array
    {
        $sales = Order::select(
            DB::raw('SUM(total_price) as total'),
            DB::raw("DATE_FORMAT(created_at, '%M') as month")
        )
        ->where('payment_status', 'paid')
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('created_at')
        ->get();

        return [
            'labels' => $sales->pluck('month')->toArray(),
            'values' => $sales->pluck('total')->toArray(),
        ];
    }

    /**
     * Get order status distribution data
     */
    public function getOrderStatusDistribution(): array
    {
        $distribution = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return [
            'labels' => $distribution->pluck('status')->map(fn($s) => ucfirst($s))->toArray(),
            'values' => $distribution->pluck('count')->toArray(),
        ];
    }
}
