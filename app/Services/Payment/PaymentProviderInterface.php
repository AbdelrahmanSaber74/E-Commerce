<?php

namespace App\Services\Payment;

interface PaymentProviderInterface
{
    public function pay(float $amount, array $details): array;
    public function verify(string $paymentId): bool;
}
