<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function search(array $filters): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->paginate($filters['per_page'] ?? 10);
    }

    public function getFeatured(int $limit = 8): Collection
    {
        return $this->model->where('is_featured', 1)->latest()->limit($limit)->get();
    }

    public function getRecent(int $limit = 8): Collection
    {
        return $this->model->latest()->limit($limit)->get();
    }
}
