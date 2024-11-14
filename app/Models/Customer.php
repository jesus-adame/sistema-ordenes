<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'description',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
