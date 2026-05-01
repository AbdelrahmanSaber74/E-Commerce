<?php

namespace App\Actions\Products;

use App\DTOs\ProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\File;

class UpdateProductAction
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the product update logic
     */
    public function execute(int|string $id, ProductDTO $productDTO): bool
    {
        $product = $this->productRepository->find($id);
        $data = $productDTO->toArray();

        if ($productDTO->image) {
            // Delete old image
            if ($product->image && File::exists(public_path('dashboard/Images/' . $product->image))) {
                File::delete(public_path('dashboard/Images/' . $product->image));
            }
            
            $data['image'] = $this->uploadFile($productDTO->image, 'Images');
        }

        return $this->productRepository->update($data, $id);
    }

    private function uploadFile($file, $folder)
    {
        $imageName = time() . '.' . $file->extension();
        $file->move(public_path('dashboard/Images'), $imageName);
        return $imageName;
    }
}
