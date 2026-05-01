<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => [
                'original' => (float) $this->price,
                'discount' => $this->discount_price ? (float) $this->discount_price : null,
                'formatted' => number_format($this->discount_price ?? $this->price, 2) . ' EGP',
            ],
            'inventory' => [
                'quantity' => (int) $this->quantity,
                'in_stock' => $this->quantity > 0,
            ],
            'image_url' => asset('dashboard/Images/' . $this->image),
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name ?? null,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
