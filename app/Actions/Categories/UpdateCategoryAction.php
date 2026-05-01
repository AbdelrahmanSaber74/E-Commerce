<?php

namespace App\Actions\Categories;

use App\DTOs\CategoryDTO;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;

class UpdateCategoryAction
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(int|string $id, CategoryDTO $categoryDTO): bool
    {
        $category = $this->categoryRepository->find($id);
        $data = $categoryDTO->toArray();

        if ($categoryDTO->image) {
            if ($category->image && File::exists(public_path('dashboard/Images/' . $category->image))) {
                File::delete(public_path('dashboard/Images/' . $category->image));
            }
            $data['image'] = $this->uploadFile($categoryDTO->image);
        }

        return $this->categoryRepository->update($data, $id);
    }

    private function uploadFile($file)
    {
        $imageName = time() . '.' . $file->extension();
        $file->move(public_path('dashboard/Images'), $imageName);
        return $imageName;
    }
}
