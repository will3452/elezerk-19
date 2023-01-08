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
        'tag',
    ];


    const TAG_PRINCIPAL = 'Principal';
    const TAG_GUIDANCE = 'Guidance';
    const TAG_REGISTRAR = 'Registrar';
    const TAG_TEACHER = 'Teacher';

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function teachingLoads () {
        return $this->hasMany(TeachingLoad::class, 'teacher_id');
    }

    public function requirements () {
        return $this->morphMany(UserRequirement::class, 'model');
    }
}
