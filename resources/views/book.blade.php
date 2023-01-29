<x-layout>

<div class="checkout-area pt-95 pb-100">
    <div class="container"  >
        <div class="row justify-content-center" >
            <div class="col-lg-5">
                <div class="your-order-area" x-data="{
                    total: 0,
                    to: null,
                    from: null,
                    pricePerHour: {{$car->price_per_hour}},
                      days () {
                        if (this.to == null || this.from == null) {
                            return 0;
                        }
                        return moment(this.to).diff(moment(this.from), 'day')
                    },
                    total () {
                        if (! this.days()) return 0;
                        return this.days() * ( this.pricePerHour * 24 )
                    }
                }">
                    <h3>BOOKING FORM</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">

                            <div class="your-order-top">
                                <ul>
                                    <li>CAR</li>
                                    <li>PRICE / HOUR</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <li><span class="order-middle-left">{{ $car->name }} - {{$car->brand}} </span> <span class="order-price">PHP {{number_format($car->price_per_hour, 2)}} </span></li>
                                </ul>
                            </div>
                            <h6>DETAILS</h6>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">FROM</li>
                                    <li><input type="date"  x-model="from" /></li>
                                </ul>
                            </div>
                            <div class="your-order-bottom mt-4">
                                <ul>
                                    <li class="your-order-shipping">TO</li>
                                    <li><input type="date" x-model="to"  /></li>
                                </ul>
                            </div>
                            <div class="your-order-bottom mt-4">
                                <ul>
                                    <li class="your-order-shipping">DAYS</li>
                                    <li>
                                        <span x-text="days"></span>
                                    </li>
                                </ul>
                            </div>
                            <form action="/book" method="POST" id="form">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="owner_id" value="{{$car->user_id}}">
                                <input type="hidden" name="from_date" x-model="from">
                                <input type="hidden" name="to_date" x-model="to">
                            </form>

                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li>PHP <span x-text="total"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25" x-show="days">
                        <a class="btn-hover" href="#" onclick="document.getElementById('form').submit()">SUBMIT FORM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
