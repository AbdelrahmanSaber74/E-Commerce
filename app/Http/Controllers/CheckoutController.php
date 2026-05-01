<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use App\DTOs\OrderDTO;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class CheckoutController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected CartService $cartService
    ) {}

    public function index(): View|RedirectResponse
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', __('messages.empty_cart'));
        }
        $total = $this->cartService->getTotal();
        return view('frontend.checkout.index', compact('cart', 'total'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        try {
            $orderDTO = OrderDTO::fromRequest($request->validated());
            $order = $this->orderService->placeOrder($orderDTO);

            return redirect()->route('orders.success', $order->id)
                ->with('success', __('messages.order_placed_success'));
        } catch (\App\Exceptions\Business\BusinessException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function success(int|string $id): View
    {
        return view('frontend.checkout.success', compact('id'));
    }
}
