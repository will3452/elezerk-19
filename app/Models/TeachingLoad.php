<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'subject_id',
        'teacher_id',
        'academic_year_id',
    ];

    public function section () {
        return $this->belongsTo(Section::class);
    }


    public function subject () {
        return $this->belongsTo(Subject::class);
    }

    public function teacher () {
        return $this->belongsTo(Employee::class);
    }

    public function academicYear () {
        return $this->belongsTo(AcademicYear::class);
    }
}
