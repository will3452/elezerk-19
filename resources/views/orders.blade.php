<x-layout>
<x-header></x-header>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">Orders</li>
            </ul>
        </div>
    </div>
</div>
<div class="text-center p-4 ">
    No longer can cancel an order when the status is no longer "pending".
</div>
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your Order</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Mode Of Payment</th>
                                    <th>Grand Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->orders()->latest()->get() as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">{{$item->reference}}</a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->created_at->format('Y-m-d')}}</a></td>
                                        <td class="product-price-cart"><span class="amount">{{$item->status}}</span></td>
                                        <td class="product-quantity">
                                            {{$item->mop}}
                                        </td>
                                        <td class="product-subtotal">PHP {{number_format($item->total, 2)}}</td>

                                        <td class="product-wishlist-cart">
                                            @if (! $item->done)
                                                <a href="/order-received/{{$item->id}}" style="display: inline-block;margin-bottom: 1em;">ORDER RECEIVED</a>
                                            @endif

                                            <a href="/invoice/{{$item->id}}" style="display: inline-block;margin-bottom: 1em;">VIEW INVOICE</a>

                                            @if ($item->status == \App\Models\Order::STATUS_PENDING)
                                                <a href="{{route('orders.cancel', ['order' => $item->id])}}" style="display: inline-eblock;" >CANCEL ORDER</a>
                                            @else
                                                <p style="color: #ddd;">CANCEL ORDER</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
</x-layout>
