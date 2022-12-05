<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovedEnrollment extends Enrollment
{
    use HasFactory;

    protected $table = 'enrollments';

    protected static function booted() {
        $ay = AcademicYear::whereActive(true)->latest()->first();
        static::addGlobalScope('approved_enrollments', function (Builder $builder) use ($ay) {
            $builder->whereStatus('approved')->whereAcademicYearId($ay->id);
        });
    }

    public function studentGrades() {
        return $this->hasMany(StudentGrade::class, 'enrollment_id');
    }
}
