<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CustomerProductController extends Controller
{
    /**
     * Display all products with search, filter, and sort
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Category filter
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Search by name
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Sort
        if ($request->sort) {
            switch ($request->sort) {
                case 'newest':
                    $query->latest('created_at');
                    break;
                case 'popular':
                    // NOTE: Make sure you have a column like `sold_count` in products
                    $query->orderBy('sold_count', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('store.index', compact('products', 'categories'));
    }

    /**
     * Display a single product
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('store.show', compact('product'));
    }
}
