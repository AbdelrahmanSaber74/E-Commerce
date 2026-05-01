<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Categories\StoreCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\DTOs\CategoryDTO;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected StoreCategoryAction $storeCategoryAction,
        protected UpdateCategoryAction $updateCategoryAction
    ) {}

    /**
     * Get all categories with pagination and grouped by main/child
     */
    public function getAllCategories(int $perPage = 10): array
    {
        $categories = $this->categoryRepository->paginate($perPage);
        $mainCategories = $this->categoryRepository->getWhere(['parent_id' => null]);

        return [
            'categories' => $categories,
            'mainCategories' => $mainCategories
        ];
    }

    /**
     * Get only main categories
     */
    public function getMainCategories(): Collection
    {
        return $this->categoryRepository->getWhere(['parent_id' => null]);
    }

    /**
     * Store category using Action
     */
    public function storeCategory(CategoryDTO $categoryDTO): mixed
    {
        return $this->storeCategoryAction->execute($categoryDTO);
    }

    /**
     * Update category using Action
     */
    public function updateCategory(int|string $id, CategoryDTO $categoryDTO): bool
    {
        return $this->updateCategoryAction->execute($id, $categoryDTO);
    }

    /**
     * Delete category
     */
    public function deleteCategory(int|string $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
