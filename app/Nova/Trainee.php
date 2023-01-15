<?php

namespace App\Nova;

use App\Nova\Actions\ImportCSV;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Trainee extends Resource
{
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $sy = \App\Models\SchoolYear::where('default', 1)->latest()->first();
        $syStr = "$sy->from - $sy->to";
        return $query->whereSchoolYear($syStr);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Trainee>
     */
    public static $model = \App\Models\Trainee::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

     public function title () {
        return "$this->last_name, $this->first_name $this->middle_name[0].";
     }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'first_name',
        'last_name',
        'middle_name',
        'student_no',
        'school_year',
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
            Text::make('Student No.', 'student_no')
                ->rules(['required', 'unique:trainees,student_no,{{resourceId}}'])
                ->sortable(),
            Text::make('First Name')
                ->sortable()
                ->rules(['required']),
            Text::make('Last Name')
                ->sortable()
                ->rules(['required']),
            Text::make('Middle Name')
                ->sortable()
                ->rules(['required']),
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
            Text::make('SY', 'school_year')
                ->exceptOnForms(),
            Email::make('Email')->rules(['required', 'unique:trainees,email,{{resourceId}}']),
            BelongsTo::make('User', 'user', User::class)
                ->exceptOnForms()
                ->showCreateRelationButton(),
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
            ExportAsCsv::make(),
            ImportCSV::make()->standalone(),
        ];
    }
}
