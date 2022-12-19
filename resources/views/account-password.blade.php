@component('mail::message')
# Hello {{$user->name}}

Your Account password is: {{$password}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
