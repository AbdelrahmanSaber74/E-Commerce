<?php

namespace App\Services\Payment;

class StripeProvider implements PaymentProviderInterface
{
    public function pay(float $amount, array $details): array
    {
        // Integration with Stripe SDK would go here
        return [
            'status' => 'success',
            'transaction_id' => 'stripe_' . uniqid(),
            'message' => 'Payment processed via Stripe'
        ];
    }

    public function verify(string $paymentId): bool
    {
        return true;
    }
}
