<?php

namespace App\Nova;

use App\Models\User;
use App\Nova\Traits\SettingTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AuditLog extends Resource
{
    use SettingTrait;
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AuditLog>
     */
    public static $model = \App\Models\AuditLog::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'endpoint';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'created_at',
        'method',
        'endpoint'
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
            Badge::make('Action', 'method')
                ->map([
                    'DELETE' => 'danger',
                    'POST' => 'success',
                    'PUT' => 'warning',
                ])->labels([
                    'DELETE' => 'Delete',
                    'POST' => 'Create',
                    'PUT' => 'Update'
                ]),
            Text::make('Endpoint'),
            BelongsTo::make('User', 'user', \App\Nova\User::class),
        ];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
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
            ExportAsCsv::make()
                ->withFormat(fn ($record) => [
                    'Date' => $record->created_at->format('m-d-Y'),
                    'Action' => $record->method,
                    'Endpoint' => $record->endpoint,
                    'User' => $record->user->name,
                ])
                ->nameable(),
        ];
    }
}
