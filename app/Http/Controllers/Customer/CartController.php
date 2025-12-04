<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function view()
    {
        $cart = session()->get('cart', []);
        return view('store.cart', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => ($cart[$product->id]['quantity'] ?? 0) + 1,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $cart[$product->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
