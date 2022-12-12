<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index () {
        return view('wishlist');
    }

    public function isInList($productId) {
        return Wishlist::whereProductId($productId)->whereUserId(auth()->id())->exists();
    }

    public function addItem(Product $product) {
        if ($this->isInList($product->id)) {
            alert()->warning('Item is already in your wishlist');
            return back();
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        alert()->success('Item has been added to wishlist');

        return back();
    }
}
