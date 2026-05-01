<?php

declare(strict_types=1);

namespace App\Enums;

class PaymentStatus
{
    public const PENDING = 'pending';
    public const PAID = 'paid';
    public const FAILED = 'failed';
    public const REFUNDED = 'refunded';

    public static function all(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::FAILED,
            self::REFUNDED,
        ];
    }

    public static function label(string $status): string
    {
        return match($status) {
            self::PENDING => __('messages.pending'),
            self::PAID => __('messages.paid'),
            self::FAILED => __('messages.failed'),
            self::REFUNDED => __('messages.refunded'),
            default => $status
        };
    }
}
