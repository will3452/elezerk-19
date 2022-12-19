<?php

namespace App\Nova;

use App\Nova\Traits\ManagementTrait;
use Exception;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Announcement extends Resource
{
    use ManagementTrait;
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
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'schedule'
    ];

    public static function availableForNavigation(Request $request)
    {
        return true;
    }


    public static function  authorizedToCreate(Request $request) {
        try {
            $allowed = [\App\Models\User::TYPE_ADMIN, \App\Models\User::TYPE_CLERK];
            return in_array(auth()->user()->type, $allowed);
        } catch (Exception $e) {
            return true;
        }
    }

    public function authorizedToDelete(Request $request)
    {
        try {
            $allowed = [\App\Models\User::TYPE_ADMIN, \App\Models\User::TYPE_CLERK];
            return in_array(auth()->user()->type, $allowed);
        } catch (Exception $e) {
            return true;
        }
    }

    public function authorizedToUpdate(Request $request)
    {
        try {
            $allowed = [\App\Models\User::TYPE_ADMIN, \App\Models\User::TYPE_CLERK];
            return in_array(auth()->user()->type, $allowed);
        } catch (Exception $e) {
            return true;
        }
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
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Text::make('Title')
                ->rules(['required']),
            Textarea::make('Body')
                ->alwaysShow()
                ->rules(['required']),
            Date::make('Schedule'),

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
