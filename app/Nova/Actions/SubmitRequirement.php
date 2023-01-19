<?php

namespace App\Nova\Actions;

use App\Models\SubmittedRequirement;
use App\Models\Trainee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;

class SubmitRequirement extends Action
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
        $traineeId = auth()->user()->trainee->id;
        $file = $fields['file']->store('public');
        $pathArr = explode('/', $file);

        $file = end($pathArr);
        foreach ($models as $model) {
            if ($model->status != 'ON-GOING') {
                return Action::danger('Task is already finished, you\'re not able to submit requirements, please contact the coordinator!');
            }
            SubmittedRequirement::create([
                'trainee_id' => $traineeId,
                'task_id' => $model->id,
                'file' => $file,
            ]);

            $trainee = auth()->user()->trainee;

            $model->coordinator->user->notify(NovaNotification::make()->message("$trainee->first_name, a trainee, submitted his requirement to a task.")->icon('check'));
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
            File::make('File')
                ->rules(['max:5000'])
                ->acceptedTypes('.jpg,.png,.pdf,.gif,.jpeg'),
        ];
    }
}
