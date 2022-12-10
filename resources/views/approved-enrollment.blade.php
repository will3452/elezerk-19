@component('mail::message')
# Enrollment status
Hello Mr/Mrs {{$student->last_name}},
Your child {{$student->first_name}} enrollment application has been approved!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
