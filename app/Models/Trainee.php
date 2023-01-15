<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'section',
        'school_year',
        'student_no',
        'email',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }
}
