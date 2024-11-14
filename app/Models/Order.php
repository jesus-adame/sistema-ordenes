<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'folio',
        'order_date',
        'status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
