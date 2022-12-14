<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
       'month',
       'year',
       'user_id',
       'amount_payable',
       'paid_at',
       'room_id',
    ];

    public function user () {
        return $this->belongsTo(User::class); // student
    }

    public function room () {
        return $this->belongsTo(Room::class);
    }

    protected $casts = [
        'paid_at' => 'date',
    ];
}
