<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Coordinator extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        if (! auth()->check() ) {
            return false;
        }

        if ( auth()->user()->type == \App\Models\User::TYPE_COORDINATOR || auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return false;
        }
        return true;
    }

    public static function authorizedToCreate(Request $request)
    {
        if (! auth()->check() ) {
            return false;
        }

        if (auth()->user()->type == \App\Models\User::TYPE_COORDINATOR || auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return false;
        }
        return true;
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }

    public function authorizedToDelete (Request $request)
    {
        return auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Coordinator>
     */
    public static $model = \App\Models\Coordinator::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'employee_no';

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
        'employee_no',
        'phone',
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
            Text::make('Employee No.', 'employee_no')
                ->rules(['required', 'unique:coordinators,employee_no,{{resourceId}}'])
                ->sortable(),
            Text::make('First Name')
                ->rules(['required']),
            Text::make('Last Name')
                ->rules(['required']),
            Text::make('Middle Name')
                ->rules(['required']),
            Text::make('Phone')
                ->rules(['required', 'max:11']),
            Email::make('Email')
                ->rules(['required', 'email']),
            BelongsTo::make('User', 'user', User::class)
                ->exceptOnForms(),
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
