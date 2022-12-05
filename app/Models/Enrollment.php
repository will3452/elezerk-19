<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'section_id',
        'status',
        'level',
        'academic_year_id',
        'attachments',
    ];

    public function student () {
        return $this->belongsTo(Student::class);
    }

    public function section () {
        return $this->belongsTo(Section::class);
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class);
    }
}
