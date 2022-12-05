<?php

namespace App\Nova;

use App\Nova\Filters\AcademicYearFilter;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Traits\TransactionTrait;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Http\Requests\NovaRequest;

class Enrollment extends Resource
{
    use TransactionTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Enrollment>
     */
    public static $model = \App\Models\Enrollment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function title () {
        $student = \App\Models\Student::find($this->student_id);
        $section = \App\Models\Section::find($this->section_id);
        $academicYear = \App\Models\AcademicYear::find($this->academic_year_id);

        return "$student->studentId - $section->name , $academicYear->from - $academicYear->to";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'created_at',
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
            Hidden::make('academic_year_id')
                ->default(fn () => \App\Models\AcademicYear::whereActive(true)->latest()->first()->id),
            BelongsTo::make('Academic Year', 'academicYear', AcademicYear::class)
                ->exceptOnForms(),
            BelongsTo::make('Student', 'student', Student::class)
                ->withoutTrashed()
                ->showCreateRelationButton(),
            BelongsTo::make('Section', 'section', Section::class),
            Select::make('Status')
                ->rules(['required'])
                ->options([
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                ]),
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
           File::make('Attachments')
                ->rules(['max:5000']),
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
            AcademicYearFilter::make(),
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
                        'Section' => $model->section->name,
                        'Status' => $model->status,
                        'Level' => $model->level,
                    ];
                })
                ->nameable(),
        ];
    }
}
