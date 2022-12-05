<?php

namespace App\Nova;

use App\Models\ServiceRequest as ModelsServiceRequest;
use App\Models\RequestType as ModelsRequestType;
use App\Nova\Actions\ChangeStatus;
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

    public static function availableForNavigation(Request $request)
    {
        return true;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $ids = [auth()->id()];
        $types = ModelsRequestType::whereAssigneeId(auth()->id())->select('id')->get()->pluck('id')->all();
        $sr = ModelsServiceRequest::whereIn('request_type_id', $types)->select('user_id')->get()->pluck('user_id')->all();
        $ids = array_merge($ids, $sr);
        return $query->whereIn('user_id', $ids);
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
        $actions = [];
        $model = null;

        if ($request->has('resourceId')) {
            $model = ServiceRequest::with('requestType')->find($request->resourceId);
            if ($model->requestType->assignee_id == auth()->id()) {
                $actions[] = ChangeStatus::make();
            }
        }

        if ($request->has('action')) {
            $actions[] = ChangeStatus::make();
        }


        return $actions;
    }
}
