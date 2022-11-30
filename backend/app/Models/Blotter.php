<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'title',
        'description',
        'schedule',
    ];

    protected $casts = [
        'schedule' => 'date'
    ];
}
