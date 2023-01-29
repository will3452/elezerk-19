<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Car extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_OWNER;
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereUserId(auth()->id());
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Car>
     */
    public static $model = \App\Models\Car::class;

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
        'id',
        'name',
        'specs',
        'brand',
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
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Select::make('Category')
                ->sortable()
                ->options(fn () => \App\Models\Category::get()->pluck('name', 'name')),
            Text::make('Name')
                ->sortable()
                ->rules(['required']),
            Text::make('Brand')
                ->sortable()
                ->rules(['required']),
            Trix::make('Specs')
                ->rules(['required']),
            Image::make('Image')
                ->rules(['required']),
            Number::make('Number Of Seats')
                ->sortable()
                ->rules(['required']),
            Currency::make('Price Per Hour')
                ->sortable()
                ->rules(['required']),
            HasMany::make('Bookings', 'bookings', Booking::class),
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
