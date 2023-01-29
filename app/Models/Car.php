<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'specs',
        'image',
        'number_of_seats',
        'category',
        'price_per_hour',
    ];

    public function owner () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings () {
        return $this->hasMany(Booking::class);
    }
}
