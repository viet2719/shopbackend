<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'name',
        'description',
        'price',
        'origin',
        'size',
        'quantity',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
