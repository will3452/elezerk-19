<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'adviser_id',
        'room',
    ];

    public function adviser () {
        return $this->belongsTo(Employee::class, 'adviser_id');
    }

    public function students () {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function enrolledStudents () {
        return $this->hasMany(ApprovedEnrollment::class);
    }

    public static function available() {
        $sections = Section::get();

        $a = [];

        foreach ($sections as $section) {
            if ($section->no_of_students > $section->enrolledStudents()->count()) {
                $a[] = $section;
            }
        }

        return collect($a);
    }
}
