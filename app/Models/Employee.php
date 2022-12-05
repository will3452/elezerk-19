<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'employeeId',
        'image',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function teachingLoads () {
        return $this->hasMany(TeachingLoad::class, 'teacher_id');
    }
}
