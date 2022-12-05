<?php

namespace App\Nova;

use App\Models\Enrollment;
use App\Nova\Actions\SubmitGrade;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApprovedEnrollment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ApprovedEnrollment>
     */
    public static $model = \App\Models\ApprovedEnrollment::class;

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
    ];

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public static function availableForNavigation(Request $request)
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Date enrolled', 'created_at')
                ->sortable(),
            BelongsTo::make('Student', 'student', Student::class)
                ->withoutTrashed()
                ->showCreateRelationButton(),
            BelongsTo::make('Section', 'section', Section::class),

            HasMany::make('Grades', 'studentGrades', StudentGrade::class),
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
        $sectionId = $request->viaResourceId;

        $section = null;

        if ($sectionId)  {
            $section = \App\Models\Section::find($sectionId);
        } else {
            $section = Enrollment::find($request->resourceId)->section;
        }

        return [
            (new SubmitGrade($section))->showInline()
        ];
    }
}
