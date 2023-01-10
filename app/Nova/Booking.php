<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use App\Nova\Actions\MarkAsDone;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Traits\LandlordTraits;
use App\Nova\Traits\QueryByRoomTraits;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    use LandlordTraits;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return $query;
        }


        if (auth()->user()->type == \App\Models\User::TYPE_STUDENT) {
            return $query->where(['email' => auth()->user()->email]);
        }

        $rooms = auth()->user()->rooms->pluck('id')->all();
        return $query->whereIn('room_id', $rooms);
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
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
            Badge::make('Status')
                ->map([
                    'Pending' => 'warning',
                    'Done' => 'success'
                ]),
            Hidden::make('name')
                ->default(fn () => auth()->user()->name),
            Text::make('Name')
                ->exceptOnForms()
                ->rules(['required']),
            Text::make('Phone')->rules(['required']),
            Text::make('Email')->rules(['email'])
                ->exceptOnForms(),
            Hidden::make('email')
                ->default(fn () => auth()->user()->email),
            DateTime::make('Book Date')
                ->rules(['required']),
            BelongsTo::make('Room', 'room', Room::class),
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
            MarkAsDone::make(),
        ];
    }
}
