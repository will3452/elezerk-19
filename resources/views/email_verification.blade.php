@component('mail::message')
# Email Verification

Hello,
    You're about to verify your email.

@component('mail::button', ['url' => route('verify-email', ['email' => $email])])
VERIFY NOW
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
