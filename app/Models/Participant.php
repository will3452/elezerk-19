<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'bid_id',
       'has_won',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function bid () {
        return $this->belongsTo(Bid::class);
    }
}
