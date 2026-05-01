<?php

namespace App\Services\Payment;

class PaymentService
{
    public function __construct(
        protected PaymentProviderInterface $provider
    ) {}

    public function processPayment(float $amount, array $details): array
    {
        return $this->provider->pay($amount, $details);
    }
}
