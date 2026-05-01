<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\User;
use App\Models\Order;

interface NotificationServiceInterface
{
    public function sendOrderStatusNotification(User $user, Order $order): void;
    public function sendWelcomeNotification(User $user): void;
}
