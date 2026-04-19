<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

     public function categories() {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function sponsers(){
        return $this->hasMany(Sponser::class);
    }
}
