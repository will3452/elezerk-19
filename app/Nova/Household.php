<?php

namespace App\Nova;

use App\Nova\Traits\ManagementTrait;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Household extends Resource
{
    use ManagementTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Household>
     */
    public static $model = \App\Models\Household::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            Date::make('Registered Date', 'created_at')
                ->exceptOnForms()
                ->sortable(),
            Text::make('Name')
                ->rules(['required']),
            Select::make("4p's Beneficiary", 'four_ps')
                ->rules(['required'])
                ->options([
                    true => 'Yes',
                    false => 'No',
                ]),
            Select::make('NHTS', 'nhts')
                ->rules(['required'])
                ->options([
                    true => 'Yes',
                    false => 'No',
                ]),
            Text::make('Dialec')->rules(['required']),
            Text::make('Type of Dwelling')
                ->rules(['required']),
            Text::make('Type of Electricity')
                ->rules(['required']),
            Text::make('Source of water')
                ->rules(['required']),
            Text::make('Sanitation Facilities')
                ->rules(['required']),
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
        return [];
    }
}
