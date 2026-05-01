<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Services\Interfaces\NotificationServiceInterface;
use Illuminate\Support\Facades\Notification;

class NotificationService implements NotificationServiceInterface
{
    /**
     * Send order status update notification
     */
    public function sendOrderStatusNotification(User $user, Order $order): void
    {
        // Notification logic using Laravel Notifications
        // Notification::send($user, new OrderStatusUpdated($order));
    }

    /**
     * Send welcome notification
     */
    public function sendWelcomeNotification(User $user): void
    {
        // Notification::send($user, new WelcomeNotification());
    }
}
