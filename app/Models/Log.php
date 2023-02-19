<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'user_id',
        'for_all',
        'bid_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function bid() {
        return $this->belongsTo(Bid::class);
    }

    public static function userCreate($item) {
        $item['user_id'] = auth()->id();

        return self::create($item);
    }
}
