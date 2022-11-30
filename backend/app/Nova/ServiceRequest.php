<?php

namespace App\Nova;

use App\Models\ServiceRequest as ModelsServiceRequest;
use App\Nova\Traits\ManagementTrait;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ServiceRequest extends Resource
{
    use ManagementTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ServiceRequest>
     */
    public static $model = \App\Models\ServiceRequest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference',
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
            Date::make('Date Requested', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Text::make('reference')
                ->exceptOnForms(),
            Hidden::make('reference')
                ->default(fn () => "SVR-" . now()->timestamp),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Badge::make('Status')
                ->map([
                    ModelsServiceRequest::STATUS_APPROVED => 'success',
                    ModelsServiceRequest::STATUS_DECLINED => 'danger',
                    ModelsServiceRequest::STATUS_PENDING => 'warning',
                ]),
            BelongsTo::make('Request Type', 'requestType', RequestType::class),
            BelongsTo::make('Requestor', 'user', User::class)
                ->exceptOnForms(),
            Textarea::make('Description')->rules(['required', 'max:500']),
           File::make('attachment', 'attachments'),
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
