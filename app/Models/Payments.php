<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'amount',
        'payment_method',
        'status'];
    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}
