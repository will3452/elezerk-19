<?php

namespace App\Nova\Filters;

use Illuminate\Support\Collection;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Region extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        $regions = ['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region V', 'CAR', 'NCR', 'Mimaropa', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'BARMM'];

        return $query->whereRegion($regions[$value]);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        $regions = ['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region V', 'CAR', 'NCR', 'Mimaropa', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'BARMM'];

        return collect($regions)->flatMap(fn ($e, $i) => ([$e => $i]))->toArray();
    }
}
