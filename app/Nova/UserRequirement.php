<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserRequirement extends Resource
{
    public static function availableForNavigation(Request $request) {
        return false;
    }

    public static function createButtonLabel()
    {
        return __('Upload :resource', ['resource' => static::singularLabel()]);
    }

    public static function label () {
        return 'Requirements';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\UserRequirement>
     */
    public static $model = \App\Models\UserRequirement::class;

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
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $type = $request->viaResource == 'students' ? 'Student': 'Teacher';
        $options  = \App\Models\Requirement::where(['type' => $type])->get()->pluck('name', 'name');
        return [
            Select::make('Name')
                ->rules(['required'])
                ->options(fn () => $options),
            Image::make('File')
                ->rules(['required', 'image', 'max:5000'])
                ->acceptedTypes('image/*')
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
