<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Notifications\NovaNotification;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Request $request) {
        try {
            $reference = "OR-" . Str::random(8);

            // create order
            $cartItems = auth()->user()->cartItems;
            if (count($cartItems)) {
                $barangay = auth()->user()->barangay->name;
                $order = Order::create([
                    'mop' => $request->mop,
                    'reference' => $reference,
                    'user_id' => auth()->id(),
                    'status' => Order::STATUS_PENDING,
                    'address' => $barangay,
                    'total' => auth()->user()->grand_total,
                    'shipping_cost' => auth()->user()->shipping_fee,
                ]);

                foreach (auth()->user()->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'user_id' => auth()->id(),
                        'quantity' => $item->quantity,
                        'product_id' => $item->product_id,
                        'price' => $item->product->selling_price,
                    ]);

                    // delete cart item
                     $item->delete();
                }
                alert()->success('Your order has been placed!');

                // notify the admins
                $users = User::whereType(User::TYPE_ADMIN)->get();
                foreach ($users as $user) {
                    $user->notify(NovaNotification::make()->message('New Order has been placed!')->icon('shopping-cart'));
                }
                return redirect('/');
            }

        } catch (Exception $e) {
            return $e;
            alert()->success("Something went wrong!");
            return back();
        }
    }

    public function index (Request $request) {
        return view('orders');
    }

    public function cancel(Request $request, Order $order) {
        $order->update(['status' => Order::STATUS_CANCELLED]);
        // notify the admins
        $users = User::whereType(User::TYPE_ADMIN)->get();
        foreach ($users as $user) {
            $user->notify(NovaNotification::make()->message("Order with ref: $order->reference has been canceled!")->icon('x-circle'));
        }
        alert()->success('Order Cancelled');
        return back();
    }

}
