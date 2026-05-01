<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
        protected OrderRepositoryInterface $orderRepository
    ) {}

    public function index(): View
    {
        $stats = $this->dashboardService->getStats();
        $salesData = $this->dashboardService->getMonthlySalesData();
        $statusData = $this->dashboardService->getOrderStatusDistribution();
        
        $latestOrders = $this->orderRepository->with(['user'])->paginate(10);

        return view('dashboard.index', array_merge($stats, [
            'salesData' => $salesData,
            'statusData' => $statusData,
            'orders' => $latestOrders
        ]));
    }
}
