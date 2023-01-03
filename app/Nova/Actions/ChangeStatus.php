<?php

namespace App\Nova\Actions;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use function PHPUnit\Framework\isNull;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Queue\ShouldQueue;
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
            if ( $model->supplier_id && auth()->user()->type == \App\Models\User::TYPE_ADMIN) {
                return Action::danger('Invalid Action. Please wait for supplier/company to change the status');
            }
            $model->update([
                'status' => $fields['new_status'],
            ]);

            // deduct product quantity
            $deductStatus = ['Done'];

            if (in_array($fields['new_status'], $deductStatus)) {



                foreach ($model->orderItems as $item) {



                    $product = $item->product;

                    if ($fields['new_status'] == 'Done' && $model->supplier_id) {
                        Product::create([
                            'user_id' => $model->user_id,
                            'raw' => $product->raw,
                            'name' => $product->name,
                            'category' => $product->category,
                            'productId' => $product->productId,
                            'description' => $product->description,
                            'brand_id' => $product->brand_id,
                            'image' => $product->image,
                            'uom' => $product->uom,
                            'quantity' => $item->quantity,
                            'unit_cost' => $product->unit_cost,
                            'product_cost' => $product->product_cost,
                            'selling_price' => $product->selling_price,
                        ]);
                    }
                    // $item->product()->update([
                    //     'quantity' => $product->quantity - $item->quantity,
                    // ]);

                    $item->product()->decrement('quantity', $item->quantity);

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
