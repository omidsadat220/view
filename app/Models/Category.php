<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function product()
{
    return $this->hasMany(Product::class);
}


}
