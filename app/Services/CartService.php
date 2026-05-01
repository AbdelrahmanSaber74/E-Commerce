<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Exceptions\Business\CouponInvalidException;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $cartName = 'cart';

    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    /**
     * Add product to cart with strict typing
     */
    public function add(int|string $id, int $quantity = 1): array
    {
        $cart = $this->getCart();
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new \Exception(__('messages.product_not_found'));
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float)$product->price,
                'discount_price' => (float)$product->discount_price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        $this->saveCart($cart);
        return $cart;
    }

    /**
     * Remove item from cart
     */
    public function remove(int|string $id): array
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }
        return $cart;
    }

    /**
     * Update quantity
     */
    public function update(int|string $id, int $quantity): array
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity);
            $this->saveCart($cart);
        }
        return $cart;
    }

    /**
     * Get items
     */
    public function getCart(): array
    {
        return Session::get($this->cartName, []);
    }

    /**
     * Calculate total with discounts
     */
    public function getTotal(): float
    {
        $cart = $this->getCart();
        $total = 0.0;
        
        foreach ($cart as $item) {
            $price = $item['discount_price'] > 0 ? $item['discount_price'] : $item['price'];
            $total += $price * $item['quantity'];
        }

        $coupon = Session::get('coupon');
        if ($coupon) {
            $total -= (float)$coupon['discount_amount'];
        }

        return (float)max(0.0, $total);
    }

    /**
     * Apply coupon with custom exception
     */
    public function applyCoupon(string $code): bool
    {
        $coupon = Coupon::where('code', $code)->first();
        
        if (!$coupon || !$coupon->isValid()) {
            throw new CouponInvalidException(__('messages.invalid_coupon'));
        }

        $total = $this->getTotal();
        $discount = $coupon->calculateDiscount($total);
        
        Session::put('coupon', [
            'code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        return true;
    }

    public function removeCoupon(): void
    {
        Session::forget('coupon');
    }

    public function clear(): void
    {
        Session::forget($this->cartName);
        Session::forget('coupon');
    }

    private function saveCart(array $cart): void
    {
        Session::put($this->cartName, $cart);
    }
}
