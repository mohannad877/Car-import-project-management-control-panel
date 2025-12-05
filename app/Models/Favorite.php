<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'car_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }
}
