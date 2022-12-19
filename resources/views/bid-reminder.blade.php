@component('mail::message')
# Reminder

Note you are participating in a bid and will take place on the date {{$item->schedule_date}}.

@component('mail::button', ['url' => url('/app/resources/bids/'.$item->id)])
VIEW TO APP
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
