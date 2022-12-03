<?php

namespace App\Nova;

use App\Nova\Traits\ManagementTrait;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Citizen extends Resource
{
    use ManagementTrait;
    public static function label () {
        return "Residents";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Citizen>
     */
    public static $model = \App\Models\Citizen::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "$this->last_name, $this->first_name";
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
            Text::make('First Name')
                ->rules(['required']),
            Text::make('Last Name')
                ->rules(['required']),
            Text::make('Middle Name')
                ->rules(['required']),
            Select::make('Gender')
                ->rules(['required'])
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]),
            Date::make('Birthday', 'dob')
                ->rules(['required']),
            Image::make('Valid ID', 'valid_id')
                ->rules(['required', 'image', 'max:2000']),
            Text::make('Mobile')
                ->rules(['required', 'max:12']),
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
