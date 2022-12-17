<?php

namespace App\Nova\Actions;

use App\Models\User;
use App\Models\Access;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;

class CreateAccess extends Action
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
            Access::create([
                'document_id' => $model->id,
                'user_id' => $fields['user'],
            ]);

            $user = User::find($fields['user']);

            $user->notify(NovaNotification::make()->message($fields['message']));
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
            Select::make('User')
                ->options(User::where('id', '!=', auth()->id())->get()->pluck('name', 'id'))
                ->rules(['required']),
            Textarea::make('Message')
                ->rules(['required', 'max:200']),
        ];
    }
}
