<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'owner_id',
        'car_id',
        'from_date',
        'to_date',
        'status',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    const STATUS_DONE = 'Done';
    const STATUS_PENDING = 'Pending';
    const STATUS_TO_PAY = 'To Pay';
    const STATUS_PAID = 'Paid';
    const STATUS_CANCELLED = 'Cancelled';


    public function car () {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function customer () {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function owner () {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
