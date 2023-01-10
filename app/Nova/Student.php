<?php

namespace App\Nova;

use App\Nova\Actions\CreateTransactionCharge;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class Student extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Student>
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        $name = $this->user->name;
        return "student : $name";
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
            return $query;
        }
        $rooms = auth()->user()->rooms->pluck('id')->all();
        return $query->whereIn('room_id', $rooms);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'created_at',
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
            BelongsTo::make('User', 'user', User::class)->showCreateRelationButton(),
            BelongsTo::make('Room', 'room', Room::class),
            // Currency::make('Balance')
            //     ->rules(['required']),
            Currency::make('Account Arrears', function () {
                $user = \App\Models\User::find($this->user_id);

                if (! $user) return 0;
                $transactions = $user->transactions()->whereNull('paid_at')->get();

                $totalTransactions = 0;
                foreach ($transactions as $t) {
                    $totalTransactions += $t->amount_payable;
                }
                return $totalTransactions;
            })
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
            CreateTransactionCharge::make(),
        ];
    }
}
