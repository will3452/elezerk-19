<?php

namespace App\Nova\Actions;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;

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
            $model->update(['status' => $fields->status]);

            $model->user
                ->notify(NovaNotification::make()->message("Your service request with reference # $model->reference has been $fields->status")
                ->icon('lightning-bolt')
                ->type($fields->status == 'Approved' ? 'success' : 'error'));
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
            Select::make('Status')
                ->options([
                    ServiceRequest::STATUS_APPROVED => ServiceRequest::STATUS_APPROVED,
                    ServiceRequest::STATUS_DECLINED => ServiceRequest::STATUS_DECLINED,
                ]),
        ];
    }
}
