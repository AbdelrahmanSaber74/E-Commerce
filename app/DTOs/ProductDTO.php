<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class ProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public ?float $discount_price,
        public int $category_id,
        public ?UploadedFile $image,
        public ?int $quantity = 0,
        public bool $is_active = true
    ) {}

    /**
     * Map request data to DTO
     */
    public static function fromRequest(array $validatedData, ?UploadedFile $image = null): self
    {
        return new self(
            name: $validatedData['name'],
            description: $validatedData['description'],
            price: (float) $validatedData['price'],
            discount_price: isset($validatedData['discount_price']) ? (float) $validatedData['discount_price'] : null,
            category_id: (int) $validatedData['category_id'],
            image: $image,
            quantity: (int) ($validatedData['quantity'] ?? 0),
            is_active: (bool) ($validatedData['is_active'] ?? true)
        );
    }
}
