<?php

namespace App\Actions\Products;

use App\DTOs\ProductDTO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\UploadImageTrait;

class StoreProductAction
{
    use UploadImageTrait;

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the product creation logic
     */
    public function execute(ProductDTO $productDTO): mixed
    {
        $data = $productDTO->toArray();

        if ($productDTO->image) {
            // We pass a mock request-like object or refactor the trait
            // For now, let's assume the trait can handle the UploadedFile object directly if we tweak it
            // Or just use the logic here
            $data['image'] = $this->uploadFile($productDTO->image, 'Images');
        }

        return $this->productRepository->create($data);
    }

    /**
     * Internal helper to upload file (since trait might expect Request object)
     */
    private function uploadFile($file, $folder)
    {
        $imageName = time() . '.' . $file->extension();
        $file->move(public_path('dashboard/Images'), $imageName);
        return $imageName;
    }
}
