<?php

namespace App\Nova\Actions;

use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use App\Models\Order as ModelsOrder;
use App\Models\User;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;

class Order extends Action
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
            // create order
            $reference = "OR-" . Str::random(8);
            $shippingFee = auth()->user()->shipping_fee;
            $total =  $shippingFee + ( $model->selling_price * $fields['quantity'] );

            $order = ModelsOrder::create([
                'user_id' => auth()->id(),
                'reference' => $reference,
                'total' => $total,
                'shipping_cost' => $shippingFee,
                'supplier_id' => $model->user_id,
                'mop' => ModelsOrder::MOP_COD,
            ]);


            // create order item

            OrderItem::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'quantity' => $fields['quantity'],
                'product_id' => $model->id,
                'price' => $model->selling_price,
            ]);

            $user = User::find($model->user_id);

            $user->notify(NovaNotification::make()->message('New Order has been placed!')->icon('shopping-cart'));

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
            Number::make('Quantity')
                ->rules(['required']),
        ];
    }
}
