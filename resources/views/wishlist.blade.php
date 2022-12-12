<x-layout>
    <x-header></x-header>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">Wishlist </li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your Wishlist Items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>View Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Wishlist::latest()->get() as $item)
                                    <tr >
                                        <td class="product-thumbnail">
                                            <a href="#"><img width="100" src="/storage/{{$item->product->image}}" alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->product->name}}</a></td>
                                        <td class="product-wishlist-cart">
                                                <a href="/products/{{$item->product_id}}">View Product</a>
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
