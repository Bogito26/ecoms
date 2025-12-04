@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-8 bg-gray-900 text-gray-100">

    <!-- TITLE -->
    <h2 class="text-3xl font-bold text-center text-white mb-8">
        Welcome, {{ auth()->user()->name }}
    </h2>

    <!-- GRID CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Orders -->
        <div class="bg-gray-800 p-6 rounded-xl shadow hover:bg-gray-700 transition">
            <h3 class="text-xl font-semibold mb-2 text-white">Your Orders</h3>
            <p class="text-gray-300">View and manage your orders.</p>
            <a href="{{ route('customer.orders.index') }}"
               class="text-blue-400 hover:underline mt-3 inline-block">
               Go to Orders →
            </a>
        </div>

        <!-- Profile -->
        <div class="bg-gray-800 p-6 rounded-xl shadow hover:bg-gray-700 transition">
            <h3 class="text-xl font-semibold mb-2 text-white">Your Profile</h3>
            <p class="text-gray-300">Update your profile information.</p>
            <a href="{{ route('profile.edit') }}"
               class="text-blue-400 hover:underline mt-3 inline-block">
               Edit Profile →
            </a>
        </div>

        <!-- Shop -->
        <div class="bg-gray-800 p-6 rounded-xl shadow hover:bg-gray-700 transition">
            <h3 class="text-xl font-semibold mb-2 text-white">Shop</h3>
            <p class="text-gray-300">Browse products and add to your cart.</p>
            <a href="{{ route('store.index') }}"
               class="text-blue-400 hover:underline mt-3 inline-block">
               Go Shopping →
            </a>
        </div>

    </div>

    <!-- PRODUCTS LIST -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-white">Available Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse(\App\Models\Product::latest()->get() as $product)
                <div class="bg-gray-800 rounded-xl shadow hover:bg-gray-700 transition overflow-hidden">
                    <div class="h-48 w-full overflow-hidden flex items-center justify-center bg-gray-900">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="object-cover h-full w-full">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-white">{{ $product->name }}</h3>
                        <p class="text-gray-300 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <p class="text-blue-400 font-bold mb-3">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('store.show', $product->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded inline-block">
                           View Product
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-300 col-span-4">No products available at the moment.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
