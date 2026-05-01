<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'order_number' => '#' . $this->id,
            'customer' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'financials' => [
                'total_amount' => (float) $this->total_price,
                'formatted_total' => number_format($this->total_price, 2) . ' EGP',
            ],
            'logistics' => [
                'status' => [
                    'key' => $this->status->value,
                    'label' => $this->status->label(),
                ],
                'payment_status' => [
                    'key' => $this->payment_status->value,
                    'label' => $this->payment_status->label(),
                ],
                'shipping_address' => $this->shipping_address,
                'phone' => $this->phone,
            ],
            'items' => $this->items->map(fn($item) => [
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'unit_price' => (float) $item->price,
                'subtotal' => (float) ($item->price * $item->quantity),
            ]),
            'date' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
