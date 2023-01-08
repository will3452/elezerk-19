<?php

namespace App\Observers;

use App\Models\Subject;
use App\Models\Attendance;
use App\Models\StudentGrade;
use App\Models\TeachingLoad;

class SubjectObserver
{
    public function deleting(Subject $subject) {
        $sId = $subject->id;

        // delete all related details
        Attendance::whereSubjectId($sId)->delete();
        StudentGrade::whereSubjectId($sId)->delete();
        TeachingLoad::whereSubjectId($sId)->delete();
    }
}
