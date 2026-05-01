<?php

declare(strict_types=1);

namespace App\Actions\Orders;

use App\DTOs\OrderDTO;
use App\Models\Order;
use App\Services\CartService;
use App\Services\WalletService;
use App\Services\LoyaltyService;
use App\Services\Payment\PaymentService;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Exceptions\Business\CartEmptyException;
use App\Exceptions\Business\BusinessException;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlaceOrderAction
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductRepositoryInterface $productRepository,
        protected CartService $cartService,
        protected WalletService $walletService,
        protected LoyaltyService $loyaltyService,
        protected PaymentService $paymentService
    ) {}

    public function execute(OrderDTO $orderDTO): Order
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            throw new CartEmptyException(__('messages.cart_is_empty'));
        }

        $totalPrice = $this->cartService->getTotal();
        $user = Auth::user();

        // 1. Validate Wallet if selected
        if ($orderDTO->payment_method === 'wallet' && $user->wallet_balance < $totalPrice) {
            throw new BusinessException(__('messages.insufficient_wallet_balance'));
        }

        return DB::transaction(function () use ($orderDTO, $cart, $totalPrice, $user) {
            // 2. Create Order
            $order = $this->orderRepository->create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => OrderStatus::PENDING,
                'payment_status' => PaymentStatus::PENDING,
                'payment_method' => $orderDTO->payment_method,
                'shipping_address' => $orderDTO->address,
                'phone' => $orderDTO->phone,
                'notes' => $orderDTO->notes,
            ]);

            // 3. Process Wallet Payment if applicable
            if ($orderDTO->payment_method === 'wallet') {
                $this->walletService->withdraw($user, $totalPrice);
                $order->update(['payment_status' => PaymentStatus::PAID]);
            }

            // 4. Create Order Items & Update Stock
            foreach ($cart as $productId => $item) {
                $product = $this->productRepository->find($productId);
                
                if ($product->quantity < $item['quantity']) {
                    throw new BusinessException("Product {$product->name} is out of stock.");
                }

                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product->decrement('quantity', $item['quantity']);
            }

            // 5. Update Loyalty Stats & Tiers
            $user->increment('total_spent', $totalPrice);
            $this->loyaltyService->updateTier($user);

            // 6. Add Reward Points (Based on Tier Multiplier)
            $points = $this->loyaltyService->calculatePoints($user, $totalPrice / 10);
            $this->walletService->addPoints($user, $points);

            // 7. Clear Cart
            $this->cartService->clear();

            return $order;
        });
    }
}
