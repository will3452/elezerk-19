<?php

namespace App\Observers;

use App\Mail\ApprovedEnrollment;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

class EnrollmentObserver
{
    public function created(Enrollment $enrollment) {
        if ($enrollment->status == 'Approved') {
            $enrollment->student()->update(['section_id' => $enrollment->section_id]);
            Mail::to($enrollment->student->parent_email)->send(new ApprovedEnrollment($enrollment->student));
        } else {
            $enrollment->student()->update(['section_id' => null]);
        }
    }

    public function updated(Enrollment $enrollment) {
        if ($enrollment->status == 'Approved') {
            $enrollment->student()->update(['section_id' => $enrollment->section_id]);
            Mail::to($enrollment->student->parent_email)->send(new ApprovedEnrollment($enrollment->student));
        } else {
            $enrollment->student()->update(['section_id' => null]);
        }
    }
}
