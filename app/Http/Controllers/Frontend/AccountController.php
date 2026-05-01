<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;

class AccountController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function orders()
    {
        $orders = $this->orderService->getUserOrders();
        return view('frontend.account.orders', compact('orders'));
    }
}
