<?php

namespace App\Observers;

use App\Mail\ApprovedEnrollment;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

class EnrollmentObserver
{
    public function sendMessage($message, $phone) {
            $ch = curl_init();
            $parameters = array(
                'apikey' => env('SMS_KEY'), //Your API KEY
                'number' => $phone,
                'message' => $message,
                'sendername' => 'SEMAPHORE'
            );
            curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );

            //Send the parameters set above with the request
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

            // Receive response from server
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);

            //Show the server response
            echo $output;
    }
    public function created(Enrollment $enrollment) {
        if ($enrollment->status == 'Approved') {
            $enrollment->student()->update(['section_id' => $enrollment->section_id]);;
            $student = $enrollment->student->first_name;
            $this->sendMessage("Your child $student enrollment has been approved", $enrollment->contact);
            // Mail::to($enrollment->student->parent_email)->send(new ApprovedEnrollment($enrollment->student));
        } else {
            $enrollment->student()->update(['section_id' => null]);
        }
    }

    public function updated(Enrollment $enrollment) {
        if ($enrollment->status == 'Approved') {
            $enrollment->student()->update(['section_id' => $enrollment->section_id]);
            $student = $enrollment->student->first_name;
            $this->sendMessage("Your child $student enrollment has been approved", $enrollment->contact);
            // Mail::to($enrollment->student->parent_email)->send(new ApprovedEnrollment($enrollment->student));
        } else {
            $enrollment->student()->update(['section_id' => null]);
        }
    }
}
