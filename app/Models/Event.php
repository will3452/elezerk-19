<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
       'name',
       'description',
       'datetime',
       'user_id',
       'attachments',
       'category',
    ];

    protected $casts = ['datetime' => 'datetime'];
}
