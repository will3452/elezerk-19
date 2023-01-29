<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Laravel\Nova\Notifications\NovaNotification;

class BookingController extends Controller
{
    public function book (Car $car) {
        if (auth()->user()->email_verified_at == null) {
            alert()->warning('Please verify your email first!');
            return back();
        }
        return view('book', compact('car'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'customer_id' => ['required'],
            'car_id' => ['required'],
            'owner_id' => ['required'],
            'from_date' => ['required'],
            'to_date' => ['required'],
       ]);

       User::find($data['owner_id'])->notify(
        NovaNotification::make()->message('New Booking has been created!')
        ->icon('calendar')
       );

      Booking::create($data);
      alert()->success('Your Request has been sent.');
      return back();
    }

    public function index () {
        $bookings = Booking::whereCustomerId(auth()->id())->latest()->get();
        return view('view-bookings', compact('bookings'));
    }

    public function bookCancel(Booking $booking) {
        User::find($booking->owner_id)->notify(
            NovaNotification::make()->message('Booking has been cancelled!')
            ->icon('calendar')
           );
        $booking->update(['status' => Booking::STATUS_CANCELLED]);
        alert()->success('Cancelled Successfully!');
        return back();
    }

    public function bookPay(Booking $booking) {

        $amount = ( $booking->from_date->diffInDays($booking->to_date) * $booking->car->price_per_hour);

        if ($amount > auth()->user()->balance) {
            alert()->warning("Insufficient Balance, please cash-in.");

            return back();
        }
        $booking->update(['status' => Booking::STATUS_PAID]);
        $owner = User::find($booking->owner_id);
        $owner->notify(
            NovaNotification::make()->message('Booking has been paid!')
            ->icon('calendar')
           );
           $newBalance = $owner->balance + $amount;
           $userBalance = auth()->user()->balance - $amount;
        $owner->update(['balance' => $newBalance]);
        auth()->user()->update(['balance' => $userBalance]);
        alert()->success('Success!');
        return back();
    }

}
