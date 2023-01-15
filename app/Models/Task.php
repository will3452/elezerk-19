<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'section',
        'school_year',
        'coordinator_id',
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    public function coordinator () {
        return $this->belongsTo(Coordinator::class, 'coordinator_id');
    }
}
