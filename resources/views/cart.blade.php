<x-layout>

<x-header></x-header>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="active">Cart Page </li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#" class="row">
                    <div class="table-content table-responsive cart-table-content col-lg-8 col-md-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\CartItem::latest()->get() as $item)
                                    <tr x-data="{
                                        quantity: {{$item->quantity}}
                                    }">
                                        <td class="product-thumbnail">
                                            <a href=""><img src="/storage/{{$item->product->image}}" alt="" width="100"></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->product->name}}</a></td>
                                        <td class="product-price-cart"><span class="amount">
                                            PHP {{number_format($item->product->selling_price, 2)}}</span></td>
                                        <td class="product-quantity">
                                           <input type="number" x-model:value="quantity" min="1">
                                        </td>
                                        <td class="product-subtotal">
                                            PHP {{number_format($item->product->selling_price * $item->quantity, 2)}}
                                        </td>
                                        <td class="product-remove">
                                            <a x-bind:href="'/update-cart/{{$item->id}}?quantity=' + quantity"><i class="fa fa-check"></i></a>
                                            <a href="/remove-to-cart/{{$item->id}}"><i class="fa fa-times"></i></a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>PHP {{number_format(auth()->user()->total_product, 2)}}</span></h5>
                            <h4 class="grand-totall-title">Grand Total  <span>PHP {{ number_format(auth()->user()->grand_total, 2) }}</span></h4>
                            @if (auth()->user()->cartItems()->count())
                                <a href="/checkout">Proceed to Checkout</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="/">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <a href="{{route('clear.cart')}}">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
</x-layout>
