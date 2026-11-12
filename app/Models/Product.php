<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id', 
        'qty',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
