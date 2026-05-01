<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class CategoryDTO
{
    public function __construct(
        public string $name,
        public ?int $parent_id,
        public ?UploadedFile $image,
        public bool $is_active = true
    ) {}

    /**
     * Map request data to DTO
     */
    public static function fromRequest(array $validatedData, ?UploadedFile $image = null): self
    {
        return new self(
            name: $validatedData['name'],
            parent_id: isset($validatedData['parent_id']) ? (int) $validatedData['parent_id'] : null,
            image: $image,
            is_active: (bool) ($validatedData['is_active'] ?? true)
        );
    }

    /**
     * Convert DTO to array for Repository
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'image' => $this->image ? $this->image->getClientOriginalName() : null, // Or handle accordingly
            'is_active' => $this->is_active,
        ];
    }
}
