<?php

namespace App\Nova\Actions;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;

class CreateTransactionCharge extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $amount = $model->room->monthly;
            $date = Carbon::parse($fields['date']);
            $model->user->transactions()->create([
                'month' =>  $date->format('m'),
                'year' => $date->format('Y'),
                'monthly' => $amount,
                'amount_payable' => $amount,
                'room_id' => $model->room->id,
            ]);

            $model->user->notify(NovaNotification::make()->message($fields['notif'] ?? 'Please settle your monthly payment.')->icon('exclamation-circle'));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Notification Message', 'notif'),
            Date::make('Date')->help('The month and year will come from here.'),
        ];
    }
}
