<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function sponsers(){
        return $this->hasMany(Sponser::class);
    }
}
