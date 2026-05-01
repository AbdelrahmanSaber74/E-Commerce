<?php

namespace App\Services;

use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Collection;

class ProductVariantService
{
    /**
     * Get all attributes with their values
     */
    public function getAttributesWithValues(): Collection
    {
        return Attribute::with('values')->get();
    }

    /**
     * Create a variant for a product
     */
    public function createVariant(int $productId, array $data, array $attributeValueIds): ProductVariant
    {
        $variant = ProductVariant::create([
            'product_id' => $productId,
            'sku' => $data['sku'] ?? null,
            'price' => $data['price'] ?? null,
            'quantity' => $data['quantity'] ?? 0,
        ]);

        $variant->attributeValues()->sync($attributeValueIds);

        return $variant;
    }

    /**
     * Bulk create variants for a product
     */
    public function syncVariants(int $productId, array $variants): void
    {
        // This would be a more complex implementation for production
        // For now, let's keep it simple
    }
}
