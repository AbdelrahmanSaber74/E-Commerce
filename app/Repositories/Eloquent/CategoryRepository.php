<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\MainCategories;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getMainCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return \Illuminate\Support\Facades\Cache::rememberForever('main_categories', function () {
            return MainCategories::with('Category')->get();
        });
    }

    public function create(array $data): \Illuminate\Database\Eloquent\Model
    {
        $category = parent::create($data);
        \Illuminate\Support\Facades\Cache::forget('main_categories');
        return $category;
    }

    public function update(array $data, int|string $id): bool
    {
        $updated = parent::update($data, $id);
        if ($updated) {
            \Illuminate\Support\Facades\Cache::forget('main_categories');
        }
        return $updated;
    }

    public function delete(int|string $id): bool
    {
        $deleted = parent::delete($id);
        if ($deleted) {
            \Illuminate\Support\Facades\Cache::forget('main_categories');
        }
        return $deleted;
    }
}
