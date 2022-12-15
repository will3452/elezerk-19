
<x-layout>
    <x-header></x-header>
    <div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">Checkout </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="checkout-area pt-95 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach (\App\Models\CartItem::get() as $item)
                                            <li><span class="order-middle-left">{{$item->product->name}}  X  {{$item->quantity}}</span> <span class="order-price">PHP {{ number_format( $item->product->selling_price * $item->quantity, 2)}} </span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li>PHP {{number_format(auth()->user()->shippingFee, 2)}}</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>PHP {{number_format(auth()->user()->grand_total, 2)}}</li>
                                    </ul>
                                </div>
                            </div>
                            <form id="form" method="POST" action="{{route('orders.store')}}">
                                @csrf
                                <label for="">Payment Method</label>
                                <select name="mop" id="" class="form-select form-select-sm">
                                    <option value="COD"> CASH ON DELIVERY</option>
                                    <option value="GCASH"> GCASH</option>
                                </select>
                            </form>
                        </div>
                        <div class="Place-order mt-25">
                            <a class="btn-hover" href="#" onclick="document.getElementById('form').submit()">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
