<?php

namespace App\Nova;

use App\Nova\Actions\AddRemarks;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class SubmittedRequirement extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SubmittedRequirement>
     */
    public static $model = \App\Models\SubmittedRequirement::class;

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type != \App\Models\User::TYPE_TRAINEE) {
            return $query;
        }
        $traineeId = auth()->user()->trainee->id;
        return $query->whereTraineeId($traineeId);
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'trainee_id',
        'task_id',
        'created_at',
        'trainee.first_name',
        'trainee.last_name',
        'trainee.middle_name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('ON TIME', function () {
                if ($this->created_at > $this->task->deadline) {
                    return 'LATE';
                }

                return 'ON-TIME';
            })
                ->exceptOnForms(),
            Date::make('Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('Task', 'task', Task::class),
            BelongsTo::make('Trainee', 'trainee', Trainee::class)
                ->exceptOnForms(),
            File::make('File')
                ->rules(['max:5000'])
                ->acceptedTypes('.jpg,.png,.pdf,.gif,.jpeg'),
            Text::make('Remarks')
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            AddRemarks::make()
                ->canRun(fn () => auth()->user()->type == \App\Models\User::TYPE_COORDINATOR)
                ->onlyOnTableRow(),
        ];
    }
}
