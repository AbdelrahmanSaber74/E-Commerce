<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function search(array $filters): LengthAwarePaginator;
    public function getFeatured(int $limit = 8): Collection;
    public function getRecent(int $limit = 8): Collection;
}
