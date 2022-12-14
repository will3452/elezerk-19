<?php

namespace App\Observers;

use App\Models\Booking;
use Laravel\Nova\Notifications\NovaNotification;

class BookingObserver
{
    public function created(Booking $booking) {
        $booking->room->user->notify(NovaNotification::make()->message('There is a new booking for you')
            ->action('View', '/resources/bookings')
            ->icon('paper-airplane'),
        );
    }
}
