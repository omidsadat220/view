<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponser extends Model
{
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
