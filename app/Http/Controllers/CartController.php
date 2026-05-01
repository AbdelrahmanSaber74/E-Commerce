<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('frontend.cart.index', compact('cart', 'total'));
    }

    public function add($id, Request $request)
    {
        $this->cartService->add($id, $request->quantity ?? 1);
        return redirect()->back()->with('success', __('messages.add_to_cart_success'));
    }

    public function update(Request $request, $id)
    {
        $this->cartService->update($id, $request->quantity);
        return redirect()->back()->with('success', __('messages.cart_update_success'));
    }

    public function remove($id)
    {
        $this->cartService->remove($id);
        return redirect()->back()->with('success', __('messages.cart_remove_success'));
    }

    public function clear()
    {
        $this->cartService->clear();
        return redirect()->back()->with('success', __('messages.cart_clear_success'));
    }

    public function applyCoupon(Request $request)
    {
        try {
            $this->cartService->applyCoupon($request->code);
            return redirect()->back()->with('success', __('messages.coupon_applied'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
