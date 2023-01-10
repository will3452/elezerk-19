<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
       'room_id',
       'status',
       'name',
       'phone',
       'email',
       'book_date',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_DONE = 'Done';

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }

    protected $casts = [
        'book_date' => 'datetime',
    ];
}
