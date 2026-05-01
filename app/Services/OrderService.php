<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Orders\PlaceOrderAction;
use App\DTOs\OrderDTO;
use App\Models\Order;
use App\Events\OrderUpdated;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected PlaceOrderAction $placeOrderAction
    ) {}

    /**
     * Place order using dedicated Action
     */
    public function placeOrder(OrderDTO $orderDTO): Order
    {
        return $this->placeOrderAction->execute($orderDTO);
    }

    /**
     * Get all orders with pagination
     */
    public function getAllOrders(int $perPage = 10): LengthAwarePaginator
    {
        return $this->orderRepository->with(['user'])->paginate($perPage);
    }

    /**
     * Get order by ID
     */
    public function getOrderById(int|string $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    /**
     * Update order status
     */
    public function updateStatus(int|string $id, string $status): bool
    {
        $updated = $this->orderRepository->update(['status' => $status], $id);
        
        if ($updated) {
            $order = $this->orderRepository->find($id);
            event(new OrderUpdated($order));
        }

        return $updated;
    }
}
