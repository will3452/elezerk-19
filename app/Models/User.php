<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    const TYPE_ADMIN = 'Administrator';
    const TYPE_BASIC = 'Basic';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function joinedBids () {
        return $this->belongsToMany(Bid::class, 'participants', 'user_id');
    }

    public function accessFiles () {
        return $this->belongsToMany(Document::class, 'accesses', 'user_id');
    }

    public function bids () {
        return $this->hasMany(Bid::class, 'user_id');
    }
}
