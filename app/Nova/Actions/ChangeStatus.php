<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatus extends Action
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
            $model->update(['status' => $fields['status']]);
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
            Select::make('New Status', 'status')
                ->options([
                    Booking::STATUS_CANCELLED => Booking::STATUS_CANCELLED,
                    Booking::STATUS_DONE => Booking::STATUS_DONE,
                    Booking::STATUS_PENDING => Booking::STATUS_PENDING,
                    Booking::STATUS_PAID => Booking::STATUS_PAID,
                    Booking::STATUS_TO_PAY => Booking::STATUS_TO_PAY,
                ]),
        ];
    }
}
