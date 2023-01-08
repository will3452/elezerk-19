<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Nova\Filters\LevelFilter;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Filters\SectionFilter;
use App\Nova\Lenses\ActiveStudents;
use App\Nova\Lenses\DroppedStudents;
use App\Nova\Lenses\PendingStudents;
use App\Nova\Traits\TransactionTrait;
use Laravel\Nova\Actions\ExportAsCsv;
use App\Nova\Traits\RecordAndReportTrait;
use Laravel\Nova\Http\Requests\NovaRequest;

class Student extends Resource
{
    use RecordAndReportTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Student>
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function title () {
        return "$this->studentId - $this->last_name, $this->first_name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'studentId',
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
            Text::make('First Name')
                ->sortable()
                ->rules(['required']),
            Text::make('Last Name')
                ->sortable()
                ->rules(['required']),
            Text::make('Middle Name')
                ->sortable(),
            Text::make('Student LRN', 'studentId')
                ->rules(['required', 'unique:students,studentId,{{resourceId}}']),
            Select::make('Status')
                ->rules(['required'])
                ->options([
                    'Active' => 'Active',
                    'Dropped' => 'Dropped',
                    'Graduated' => 'Graduated',
                ]),
            Text::make('Parrent Name', 'parent_name'),
            Date::make('Birthday'),
            Text::make('Birthplace'),
            Text::make('Address'),
            Text::make('Parent Email')
                ->rules(['required', 'email']),
            Select::make('Level')
                ->rules(['required'])
                ->options([
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                    6 => 6,
                ]),
            Text::make('School ID', 'school_id')
                ->rules(['required']),
            MorphMany::make('Requirements', 'requirements', UserRequirement::class),
            Text::make('Requirements', fn () => $this->requirements()->count() . "/" . \App\Models\Requirement::whereType('Student')->count())
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
        return [
            SectionFilter::make(),
            LevelFilter::make(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
            ActiveStudents::make(),
            PendingStudents::make(),
            DroppedStudents::make(),
        ];
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
                        'LRN' => $model->studentId,
                        'Name' => $model->last_name . ", " . $model->first_name,
                        'Date' => $model->created_at,
                    ];
                })
                ->nameable(),
        ];
    }
}
