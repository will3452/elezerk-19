<x-layout>
    <h2 class="text-center">Your Bookings</h2>
    <div class="cart-main-area pt-90 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Car (Name/Brand)</th>
                                        <th>Price / Hour</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img style="max-width: 100px" src="/storage/{{$item->car->image}}" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#">{{ $item->car->name }} / {{$item->car->brand}}</a></td>
                                            <td class="product-price-cart"><span class="amount">PHP {{number_format($item->car->price_per_hour, 2)}}</span></td>
                                            <td class="product-quantity">
                                            <small>{{$item->from_date->format('m/d/y')}} - {{$item->to_date->format('m/d/y')}}</small>
                                            </td>
                                            <td class="product-subtotal">{{( $item->from_date->diffInDays($item->to_date) * $item->car->price_per_hour)}}</td>
                                            <td class="product-subtotal">{{$item->status}}</td>
                                            <td class="product-remove">
                                                @if (! in_array($item->status, [\App\Models\Booking::STATUS_CANCELLED, \App\Models\Booking::STATUS_TO_PAY, \App\Models\Booking::STATUS_DONE, \App\Models\Booking::STATUS_TO_PAY, \App\Models\Booking::STATUS_PAID]))
                                                    <a class="btn" href="/book-cancel/{{$item->id}}">CANCEL</a>
                                                @endif

                                                @if ($item->status == \App\Models\Booking::STATUS_TO_PAY)
                                                    <a class="btn" href="/book-pay/{{$item->id}}">PAY NOW</a>
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
</x-layout>
