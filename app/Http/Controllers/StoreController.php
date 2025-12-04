<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('store.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('store.show', compact('product'));
    }
}
