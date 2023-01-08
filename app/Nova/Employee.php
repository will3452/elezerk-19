<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Actions\ExportAsCsv;
use App\Nova\Traits\AdministratorTrait;
use App\Nova\Traits\RecordAndReportTrait;
use Laravel\Nova\Http\Requests\NovaRequest;

class Employee extends Resource
{
    use RecordAndReportTrait, AdministratorTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Employee>
     */
    public static $model = \App\Models\Employee::class;

    // public static function label () {
    //     return "Teachers";
    // }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function title () {
        return "$this->employeeId - $this->last_name, $this->first_name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'employeeId'
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
                ->exceptOnForms()
                ->sortable(),

            Text::make('First Name')
                ->rules(['required']),

            Text::make('Last Name')
                ->rules(['required']),

            Text::make('Employee ID', 'employeeId')
                ->rules(['required', 'unique:employees,employeeId,{{resourceId}}']),

            Image::make('Image')
                ->rules(['image', 'max:2000']),


            Select::make('Tag')
                ->rules(['required'])
                ->options([
                    \App\Models\Employee::TAG_PRINCIPAL => \App\Models\Employee::TAG_PRINCIPAL,
                    \App\Models\Employee::TAG_GUIDANCE => \App\Models\Employee::TAG_GUIDANCE,
                    \App\Models\Employee::TAG_REGISTRAR => \App\Models\Employee::TAG_REGISTRAR,
                    \App\Models\Employee::TAG_TEACHER => \App\Models\Employee::TAG_TEACHER,
                ])
                ->hideWhenUpdating(fn () => auth()->user()->type == \App\Models\User::TYPE_EMPLOYEE),

            BelongsTo::make('User', 'user', User::class)
                ->showCreateRelationButton(),

            HasMany::make('Class List', 'teachingLoads', TeachingLoad::class),

            MorphMany::make('Requirements', 'requirements',  UserRequirement::class),
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
            ExportAsCsv::make()
                ->withFormat(function ($model) {
                    return [
                        'Employee Id' => $model->employeeId,
                        'Name' => $model->last_name . ", " . $model->first_name,
                        'Date' => $model->created_at,
                    ];
                })
                ->nameable(),
        ];
    }
}
