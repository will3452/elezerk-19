<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
       'topic',
       'description',
       'attachment',
       'price',
       'meeting_link',
       'scheduled_date',
       'status',
       'user_id',
    ];

    const STATUS_ACTIVE = 'Active';
    const STATUS_DONE = 'Done';

    protected $casts = [ 'scheduled_date' => 'datetime'];

    // public function participants () {
    //     return $this->belongsToMany(User::class, 'participants', 'bid_id');
    // }

    public function participants () {
        return $this->hasMany(Participant::class, 'bid_id');
    }
}
