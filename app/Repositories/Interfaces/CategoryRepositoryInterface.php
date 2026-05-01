<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getMainCategories(): \Illuminate\Database\Eloquent\Collection;
}
