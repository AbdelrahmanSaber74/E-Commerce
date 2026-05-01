<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return view('dashboard.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->orderService->updateStatus($id, $request->status);
        return redirect()->back()->with('success', __('admin.order_updated'));
    }
}
