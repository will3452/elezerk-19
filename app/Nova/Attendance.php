<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Actions\ExportAsCsv;
use App\Nova\Actions\AddNewAttendance;
use App\Nova\Filters\CustomDateFilter;
use App\Nova\Filters\SectionFilter;
use App\Nova\Filters\SubjectFilter;
use App\Nova\Traits\RecordAndReportTrait;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Attendance extends Resource
{
    use RecordAndReportTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Attendance>
     */
    public static $model = \App\Models\Attendance::class;

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
        'created_at',
    ];

    // public static function authorizedToCreate(Request $request)
    // {
    //     return false;
    // }

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
            BelongsTo::make('Student', 'student', Student::class)
                ->withoutTrashed(),
            BelongsTo::make('Subject', 'subject', subject::class),
            BelongsTo::make('Section', 'section', section::class),
            Text::make('Remarks'),
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
            SubjectFilter::make(),
            CustomDateFilter::make(),
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
                        'LRN' => $model->student->studentId,
                        'Name' => $model->student->last_name . ", " . $model->student->first_name,
                        'Subject' => $model->subject->name,
                        'Section' => $model->section->name,
                        'Remarks' => $model->remarks,
                    ];
                })
                ->nameable(),
        ];
    }
}
