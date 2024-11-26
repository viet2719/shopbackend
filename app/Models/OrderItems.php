<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = [
        'quantity',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
