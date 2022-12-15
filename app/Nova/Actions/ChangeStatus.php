<?php

namespace App\Nova\Actions;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatus extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->update([
                'status' => $fields['new_status'],
            ]);

            // deduct product quantity
            $deductStatus = ['Done'];

            if (in_array($fields['new_status'], $deductStatus)) {
                foreach ($model->orderItems as $item) {
                    $product = $item->product;
                    $item->product()->update([
                        'quantity' => $product->quantity - $item->quantity,
                    ]);

                    // create sales
                    Sale::create([
                        'product_id' => $product->id,
                        'user_id' => $product->user_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'total' => $item->price * $item->quantity,
                    ]);
                }
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('New Status')
                ->options([
                    'Cancelled' => 'Cancelled',
                    'Delivery' => 'Delivery',
                    'Done' => 'Done',
                ])->rules(['required']),
        ];
    }
}
