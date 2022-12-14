<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
       'room_type_id',
       'description',
       'monthly',
       'image',
       'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class); // landlord
    }

    public function students () {
        return $this->hasMany(Student::class);
    }

    public function roomType() {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
