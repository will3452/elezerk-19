<?php

namespace App\Nova;

use App\Nova\Actions\CreateAccess;
use App\Nova\Traits\AdministratorTraits;
use App\Nova\Traits\RecordTraits;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Document extends Resource
{
    use AdministratorTraits, RecordTraits;

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->type == \App\Models\User::TYPE_ADMIN) {
            return $query;
        }

        $accesses = auth()->user()->accessFiles->pluck('id')->all();
        return $query->whereIn('id', $accesses);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Document>
     */
    public static $model = \App\Models\Document::class;

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
        'description',
        'category',
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
            Select::make('Type')
                ->options([
                    'Control' => 'Control',
                    'Record' => 'Record',
                    'Communication' => 'Communication',
                ]),
            Select::make('Category')
                ->options(\App\Models\Category::get()->pluck('name', 'name')),
            Text::make('Title')
                ->rules(['required']),
            Trix::make('Description')
                ->alwaysShow()
                ->rules(['required']),
            File::make('Attachment', 'attachments')
                ->hideFromDetail()
                ->rules(['required', 'max:5000']),
            Text::make('Attachment', function () {
                return "<a style='text-decoration: underline;' href='/verify/$this->attachments' title='view or download attachment '>
                    $this->attachments
                 </a>";
            })
                ->exceptOnForms()
                ->asHtml(),
            HasMany::make('Accesses', 'accesses', Access::class)
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
            CreateAccess::make()->canRun(fn () => auth()->user()->type == \App\Models\User::TYPE_ADMIN),
        ];
    }
}
