<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatus;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_OWNER;
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereOwnerId(auth()->id());
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

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

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('owner_id')
                ->default(fn () => auth()->id()),
            BelongsTo::make('Customer', 'customer', User::class),
            BelongsTo::make('Car', 'car', Car::class),
            Date::make('From Date')->sortable(),
            Date::make('To Date')->sortable(),
            Badge::make('Status')
                ->map([
                    \App\Models\Booking::STATUS_CANCELLED => 'danger',
                    \App\Models\Booking::STATUS_TO_PAY => 'warning',
                    \App\Models\Booking::STATUS_DONE => 'success',
                    \App\Models\Booking::STATUS_PAID => 'success',
                    \App\Models\Booking::STATUS_PENDING => 'info',
                ]),
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
            ChangeStatus::make(),
        ];
    }
}
