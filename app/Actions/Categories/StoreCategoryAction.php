<?php

namespace App\Actions\Categories;

use App\DTOs\CategoryDTO;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class StoreCategoryAction
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(CategoryDTO $categoryDTO): mixed
    {
        $data = $categoryDTO->toArray();

        if ($categoryDTO->image) {
            $data['image'] = $this->uploadFile($categoryDTO->image);
        }

        return $this->categoryRepository->create($data);
    }

    private function uploadFile($file)
    {
        $imageName = time() . '.' . $file->extension();
        $file->move(public_path('dashboard/Images'), $imageName);
        return $imageName;
    }
}
