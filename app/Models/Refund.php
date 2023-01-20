<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'user_id',
        'phone',
        'status',
        'image',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_DONE = 'Done';

    public function user () {
        return $this->belongsTo(User::class);
    }
}
