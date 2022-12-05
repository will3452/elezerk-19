<?php

namespace App\Nova;

use App\Nova\Traits\TransactionTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class MyClass extends Section
{
    use TransactionTrait;

    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_EMPLOYEE;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return $query;
        }
        $loads = auth()->user()->employee->teachingLoads()->select('section_id')->get();
        $sectionIds = $loads->map(fn ($e) => $e->section_id)->all();
        return $query->whereIn('id', $sectionIds);
    }
}
