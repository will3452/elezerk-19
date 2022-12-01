<?php

namespace App\Nova\Metrics;

use App\Models\Household;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class _4PS extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Household::class, 'four_ps')
            ->colors([ 'yellow', '#18b69b',])
            ->label(fn ($value) => $value ? 'Beneficiary': 'Non-Beneficiary');
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return '4-p-s';
    }

    public function name () {
        return "4p's beneficiaries";
    }
}
