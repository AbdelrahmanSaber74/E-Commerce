<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function with(array $relations): self;

    public function all(): \Illuminate\Database\Eloquent\Collection;
    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function create(array $data): \Illuminate\Database\Eloquent\Model;
    public function update(array $data, int|string $id): bool;
    public function delete(int|string $id): bool;
    public function find(int|string $id): ?\Illuminate\Database\Eloquent\Model;
    public function findBy(string $column, mixed $value): ?\Illuminate\Database\Eloquent\Model;
    public function getWhere(array $criteria): \Illuminate\Database\Eloquent\Collection;
}
