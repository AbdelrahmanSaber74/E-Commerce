<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'user_id', 'status', 'payment_method', 'payment_status', 'payment_id', 'total_price', 'address', 'phone', 'email', 'name', 'surname', 'city', 'postal_code', 'country', 'shipping_price', 'created_at', 'updated_at'];
    protected $table = 'orders';

    protected $casts = [
        'status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    

}
