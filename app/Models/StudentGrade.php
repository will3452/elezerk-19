<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'grade',
        'remarks',
        'academic_year_id',
        'section_id',
        'student_id',
        'enrollment_id',
    ];

    public function subject () {
        return $this->belongsTo(Subject::class);
    }
    public function section () {
        return $this->belongsTo(Section::class);
    }
    public function student () {
        return $this->belongsTo(Student::class);
    }

}
