<?php

namespace App\Nova;

use App\Nova\Actions\ChangeTaskStatus;
use App\Nova\Actions\SubmitRequirement;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Task extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return auth()->check() && auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }

    public function authorizedToDelete(Request $request)
    {
        return  auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }

    public function authorizedToUpdate(Request $request)
    {
        return  auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }
     /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            $trainee = auth()->user()->trainee;
            return $query->whereSection($trainee->section)->whereSchoolYear($trainee->school_year);
        }
        return $query;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Task>
     */
    public static $model = \App\Models\Task::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "$this->title";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'description',
        'deadline',
        'status',
        'section',
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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Text::make('Title')
                ->rules(['required'])
                ->sortable(),
            Textarea::make('Description')
                ->alwaysShow()
                ->rules(['required']),
            DateTime::make('Deadline')->sortable(),
            Select::make('Status')
                ->options([
                    'ON-GOING' => 'ON-GOING',
                    'DONE' => 'DONE'
                ]),
            Select::make('Section')
                ->options([
                    '4A' => '4A',
                    '4B' => '4B',
                    '4C' => '4C',
                    '4D' => '4D',
                ]),
            Hidden::make('school_year')
                ->default(function () {
                    $sy = \App\Models\SchoolYear::where('default', 1)->latest()->first();

                    return "$sy->from - $sy->to";
                }),
            Text::make('School Year')
                ->exceptOnForms(),
            Hidden::make('coordinator_id')
                ->default(fn () => optional(\App\Models\Coordinator::whereUserId(auth()->id())->first())->id ?? 1),
            BelongsTo::make('Coordinator', 'coordinator', Coordinator::class)
                ->exceptOnForms(),

            Text::make('Submitted', function () {
                if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
                    return \App\Models\SubmittedRequirement::whereTraineeId(auth()->user()->trainee->id)->whereTaskId($this->id)->exists() ? 'SUBMITTED' : 'NOT YET';
                }

                $submitted = \App\Models\SubmittedRequirement::whereTaskId($this->id)->distinct('trainee_id')->count();
                $total = \App\Models\Trainee::whereSection($this->section)->whereSchoolYear($this->school_year)->count();


                return "$submitted / $total";
            }),
            HasMany::make('Submission', 'submittedRequirements', SubmittedRequirement::class),
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
            SubmitRequirement::make()
                ->canRun(fn () => auth()->user()->type == \App\Models\User::TYPE_TRAINEE),
            ChangeTaskStatus::make()
                ->canSee(fn () => auth()->user()->type != \App\Models\User::TYPE_TRAINEE),
        ];
    }
}
