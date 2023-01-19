<x-layout>
    <x-header></x-header>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="active">Shop Details </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details">
                    <div class="product-details-img">
                        <div class="tab-content jump">
                            <div id="shop-details-2" class="tab-pane active large-img-style">
                                <img src="/storage/{{$product->image}}" alt="">
                                <div class="img-popup-wrap">
                                    <a class="img-popup" href="/storage/{{$product->image}}"><i class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" x-data="{
                sellingPrice: {{$product->selling_price}},
                qty: 1
            }">
                <div class="product-details-content ml-70">
                    <h2>{{$product->name}}</h2>
                    <div class="product-details-price">
                        <span>PHP <span x-text="sellingPrice"></span></span>
                    </div>
                    {{-- <div class="pro-details-rating-wrap">
                        <div class="pro-details-rating">
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <span><a href="#">3 Reviews</a></span>
                    </div> --}}
                    <p>
                        {{$product->description}}
                    </p>

                    <form  id="form" class="pro-details-quality" method="POST" action="{{route('products.store', ['product' => $product->id])}}">
                        @csrf
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" name="quantity" min="1" type="number" name="qtybutton" x-model="qty">
                        </div>
                        <div class="pro-details-cart btn-hover">
                            <a href="#" onclick="document.getElementById('form').submit()">Add To Cart</a>
                        </div>
                        <div class="pro-details-wishlist">
                            <a href="/add-to-wishlist/{{$product->id}}"><i class="fa fa-heart-o"></i></a>
                        </div>
                    </form>
                    <div class="pro-details-meta">
                        <span>Category :</span>
                        <ul>
                            <li><a href="#">{{$product->category}}</a></li>
                        </ul>


                    </div>
                    <div class="pro-details-meta">
                        <span>Stock on Hand :</span>
                        <ul>
                            <li><a href="#">{{$product->quantity}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-area pb-90">
    <h1 class="text-center">
        Reviews
    </h1>

    <div id="des-details3" class="container">
        <div class="row">
            <div class="col-lg-7">
                @foreach ($product->reviews as $item)
                <div class="review-wrapper">
                    <div class="single-review">
                        <div class="review-content">
                            <div class="review-top-wrap">
                                <div class="review-left">
                                    <div class="review-name">
                                        <h4>{{ $item->user->name }}</h4>
                                    </div>
                                    <div class="review-rating">
                                        @for ($i = 0; $i < $item->star; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="review-bottom">
                                <p>{{$item->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @auth
            <div class="col-lg-5">
                <div class="ratting-form-wrapper pl-50">
                    <h3>Add a Review</h3>
                    <div class="ratting-form">
                        <form action="{{route('add.review', ['product' => $product->id])}}" method="POST">
                            @csrf
                            <div class="star-box">
                                <span>Your rating:</span>
                                <div class="rating-star">
                                    <select required name="star" id="" class="form-select form-select-sm">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rating-form-style form-submit">
                                        <textarea name="message" required placeholder="Message"></textarea>
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
<x-footer></x-footer>
</x-layout>
