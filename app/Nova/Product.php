<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\Order as OrderAction;
use App\Nova\Filters\Category;
use App\Nova\Traits\LibraryTraits;

class Product extends Resource
{
    use LibraryTraits;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return $query;
        }
        return $query->whereUserId(auth()->id());
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public function authorizedToUpdate(Request $request)
    {
        return $this->user_id == auth()->id();
    }

    public function authorizedToDelete(Request $request)
    {
        return $this->user_id == auth()->id();
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'productId',
        'category'
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
            Text::make('Name')
                ->rules(['required']),
            Boolean::make('TBM', 'raw'),
            Text::make('ID', 'productId')
                ->rules(['required']),
            Select::make('Category')
                ->rules(['required'])
                ->options([
                    'NON-FOOD' => 'NON-FOOD',
                    'FOOD' => 'FOOD',
                ]),
            Textarea::make('Description')
                ->rules(['required']),
            BelongsTo::make('Brand', 'brand', Brand::class),
            Image::make('Image')->rules(['required', 'max:2000']),
            Text::make('UoM')
                ->rules(['required']),
            Number::make('SOH', 'quantity')->rules(['required']),
            Currency::make('Product Cost')->rules(['required']),
            Currency::make('Unit Cost')->rules(['required']),
            Currency::make('Selling Price')->rules(['required']),
            Hidden::make('company_id')
                ->default(fn () => optional(optional(\App\Models\Company::whereUserId(auth()->id()))->first())->id),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
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
        return [
            Category::make(),
            \App\Nova\Filters\Brand::make(),
        ];
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
            OrderAction::make()
                ->canRun(fn () => $this->user_id != auth()->id()),
        ];
    }
}
