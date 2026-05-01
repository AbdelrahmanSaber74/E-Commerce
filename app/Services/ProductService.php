<?php

namespace App\Services;

use App\Actions\Products\StoreProductAction;
use App\Actions\Products\UpdateProductAction;
use App\DTOs\ProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected StoreProductAction $storeProductAction,
        protected UpdateProductAction $updateProductAction
    ) {}

    /**
     * Get all products with pagination
     */
    public function getAllProducts(int $perPage = 10): LengthAwarePaginator
    {
        return $this->productRepository->with(['category'])->paginate($perPage);
    }

    /**
     * Search products
     */
    public function searchProducts(array $filters): mixed
    {
        return $this->productRepository->search($filters);
    }

    /**
     * Store a new product using DTO and Action
     */
    public function storeProduct(ProductDTO $productDTO): mixed
    {
        return $this->storeProductAction->execute($productDTO);
    }

    /**
     * Update an existing product using DTO and Action
     */
    public function updateProduct(int|string $id, ProductDTO $productDTO): bool
    {
        return $this->updateProductAction->execute($id, $productDTO);
    }

    /**
     * Get product by ID
     */
    public function getProductById(int|string $id): ?object
    {
        return $this->productRepository->find($id);
    }

    /**
     * Delete product
     */
    public function deleteProduct(int|string $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
