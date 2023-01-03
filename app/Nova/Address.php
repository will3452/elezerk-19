<?php

namespace App\Nova;

use App\Nova\Filters\Province;
use Laravel\Nova\Fields\ID;
use App\Nova\Filters\Region;
use App\Nova\Traits\AdministratorTraits;
use App\Nova\Traits\LibraryTraits;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;

class Address extends Resource
{
    use LibraryTraits, AdministratorTraits;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Address>
     */
    public static $model = \App\Models\Address::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'municipality';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'municipality',
        'region',
        'province',
        'municipality',
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
            Text::make('Country')
                ->rules(['required']),
            Select::make('Region')
                ->displayUsingLabels()
                ->rules(['required'])
                ->options(['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region V', 'CAR', 'NCR', 'Mimaropa', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'BARMM']),
            Text::make('Province')
                ->rules(['required']),
            Text::make('Municipality')
                ->rules(['required']),
            Text::make('Postal Code')
                ->rules(['required']),
            Currency::make('Shipping Cost')
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
        return [
            Region::make(),
            Province::make(),
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
