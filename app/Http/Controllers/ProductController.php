<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search (Request $request) {
        if (! $request->has('keyword')) back();

        $products = Product::where('name', "LIKE", "%$request->keyword%")->get();

        return view('search', compact('products'));
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show (Product $product) {
        return view('product', compact('product'));
    }

    public function isInList($productId) {
        return CartItem::whereProductId($productId)->whereUserId(auth()->id())->exists();
    }

    public function checkout(Request $request) {
        return view('checkout');
    }

    public function addToCart(Request $request, Product $product) {
        if ($this->isInList($product->id)) {
            alert()->warning('Item is already in your cart');
            return back();
        }

        CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity ?? 1,
        ]);

        alert()->success('Item has been added to cart');

        return back();
    }

    public function cartItems(Request $request) {
        return view('cart');
    }

    public function removeToCart(CartItem $item) {
        $item->delete();
        alert()->success('Item has been removed!');
        return back();
    }

    public function updateCart(Request $request, CartItem $item) {
        $item->update([
            'quantity' => $request->quantity,
        ]);
        alert()->success('Item has been updated!');
        return back();
    }

    public function clearCart(Request $request) {
        foreach (auth()->user()->cartItems as $item) {
            $item->delete();
        }
        alert()->success('Cleared successfully');
        return back();
    }

    public function addReview(Request $request, Product $product) {

        // check already has review
        $exists = Review::whereUserId(auth()->id())->whereProductId($product->id)->exists();

        if ($exists) {
            alert()->warning('Sorry, You already submitted review for this item.');
            return back();
        }

        Review::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'product_id' => $product->id,
            'star' => $request->star,
        ]);
        alert()->success("Submitted Successfully");
        return back();
    }
}
