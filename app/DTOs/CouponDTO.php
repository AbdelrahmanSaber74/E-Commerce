<?php

declare(strict_types=1);

namespace App\DTOs;

class CouponDTO
{
    public function __construct(
        public string $code,
        public string $type,
        public float $value,
        public string $expiry_date,
        public ?int $usage_limit = null,
        public bool $is_active = true
    ) {}

    public static function fromRequest(array $validatedData): self
    {
        return new self(
            code: $validatedData['code'],
            type: $validatedData['type'],
            value: (float) $validatedData['value'],
            expiry_date: $validatedData['expiry_date'],
            usage_limit: isset($validatedData['usage_limit']) ? (int) $validatedData['usage_limit'] : null,
            is_active: (bool) ($validatedData['is_active'] ?? true)
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'expiry_date' => $this->expiry_date,
            'usage_limit' => $this->usage_limit,
            'is_active' => $this->is_active,
        ];
    }
}
