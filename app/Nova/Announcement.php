<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Announcement extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        $allowed = [\App\Models\User::TYPE_COORDINATOR, \App\Models\User::TYPE_ADMIN];
        return in_array(auth()->user()->type, $allowed);
    }

    public function authorizedToUpdate(Request $request)
    {
        $allowed = [\App\Models\User::TYPE_COORDINATOR, \App\Models\User::TYPE_ADMIN];
        return in_array(auth()->user()->type, $allowed);
    }

    public function authorizedToDelete(Request $request)
    {
        $allowed = [\App\Models\User::TYPE_COORDINATOR, \App\Models\User::TYPE_ADMIN];
        return in_array(auth()->user()->type, $allowed);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Announcement>
     */
    public static $model = \App\Models\Announcement::class;

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
        'description',
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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Textarea::make('Description')
                ->sortable()
                ->alwaysShow(),
            Hidden::make('user_id')
                ->default(fn () => auth()->id())
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
