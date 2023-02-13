<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{

    public static function availableForNavigation(Request $request)
    {
        return auth()->check() && auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->check() && auth()->user()->type != \App\Models\User::TYPE_TRAINEE;
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return false;
        }

        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return true;
        }

        if (auth()->id() != $this->id) {
            return false;
        }


        return true;
    }

    public function authorizedToDelete(Request $request)
    {
        if (auth()->id() == $this->id) {
            return false;
        }
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            return false;
        }

        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return true;
        }

        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
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

            Select::make('Type')
                ->options([
                    \App\Models\User::TYPE_ADMIN => \App\Models\User::TYPE_ADMIN,
                    \App\Models\User::TYPE_COORDINATOR => \App\Models\User::TYPE_COORDINATOR,
                    \App\Models\User::TYPE_TRAINEE => \App\Models\User::TYPE_TRAINEE,
                ]),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),
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
