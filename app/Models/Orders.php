<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
 protected $table = 'orders';
 protected $fillable = ['user_id', 'total_price', 'status'];
 public function order_items()
 {
  return $this->hasMany(OrderItems::class);
 }
}
