<?php

declare(strict_types=1);

namespace App\DTOs;

class OrderDTO
{
    public function __construct(
        public string $customer_name,
        public string $email,
        public string $phone,
        public string $address,
        public string $city,
        public ?string $notes = null,
        public string $payment_method = 'cod'
    ) {}

    public static function fromRequest(array $validatedData): self
    {
        return new self(
            customer_name: $validatedData['name'],
            email: $validatedData['email'],
            phone: $validatedData['phone'],
            address: $validatedData['address'],
            city: $validatedData['city'],
            notes: $validatedData['notes'] ?? null,
            payment_method: $validatedData['payment_method'] ?? 'cod'
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->customer_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'notes' => $this->notes,
            'payment_method' => $this->payment_method,
        ];
    }
}
