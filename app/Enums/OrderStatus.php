<?php

declare(strict_types=1);

namespace App\Enums;

class OrderStatus
{
    public const PENDING = 'pending';
    public const PROCESSING = 'processing';
    public const SHIPPED = 'shipped';
    public const DELIVERED = 'delivered';
    public const CANCELLED = 'cancelled';

    public static function all(): array
    {
        return [
            self::PENDING,
            self::PROCESSING,
            self::SHIPPED,
            self::DELIVERED,
            self::CANCELLED,
        ];
    }

    public static function label(string $status): string
    {
        return match($status) {
            self::PENDING => __('messages.pending'),
            self::PROCESSING => __('messages.processing'),
            self::SHIPPED => __('messages.shipped'),
            self::DELIVERED => __('messages.delivered'),
            self::CANCELLED => __('messages.cancelled'),
            default => $status
        };
    }
}
