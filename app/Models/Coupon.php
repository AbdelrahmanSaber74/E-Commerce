<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'type', 'value', 'expiry_date', 'usage_limit', 'used_count', 'is_active'
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function isValid()
    {
        if (!$this->is_active) return false;
        if ($this->expiry_date->isPast()) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        return true;
    }

    public function calculateDiscount($total)
    {
        if ($this->type === 'percent') {
            return ($this->value / 100) * $total;
        }
        return min($this->value, $total);
    }
}
