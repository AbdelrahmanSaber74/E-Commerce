<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function with(array $relations): self
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int|string $id): bool
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete(int|string $id): bool
    {
        return (bool)$this->model->destroy($id);
    }

    public function find(int|string $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function findBy(string $column, mixed $value): ?Model
    {
        return $this->model->where($column, $value)->first();
    }

    public function getWhere(array $criteria): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->where($criteria)->get();
    }
}
