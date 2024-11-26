<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $fillable =['title','description','order','status'];
    public function file()
    {
            return $this->morphMany(File::class, 'fileable');
    }
}
