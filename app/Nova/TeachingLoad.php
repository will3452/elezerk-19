<?php

namespace App\Nova;

use App\Nova\Filters\AcademicYearFilter;
use App\Nova\Traits\MaintenanceTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class TeachingLoad extends Resource
{
    use MaintenanceTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TeachingLoad>
     */
    public static $model = \App\Models\TeachingLoad::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title () {
        $section = \App\Models\Section::find($this->section_id);

        return "$section->name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'date',
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
            BelongsTo::make('Section', 'section', Section::class),
            BelongsTo::make('Subject', 'subject', Subject::class),
            Hidden::make('academic_year_id')
                ->default(fn () => \App\Models\AcademicYear::whereActive(true)->latest()->first()->id),
            BelongsTo::make('Academic Year', 'academicYear', AcademicYear::class)
                ->exceptOnForms(),
            BelongsTo::make('Faculty', 'teacher', Employee::class),
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
        return [];
    }
}
