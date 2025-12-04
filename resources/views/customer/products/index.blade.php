@extends('layouts.customer')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-center">Our Products</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-white shadow rounded-lg p-4">
        
        <img src="{{ asset('storage/' . $product->image) }}"
             class="w-full h-48 object-cover rounded">

        <h2 class="text-xl font-bold mt-3">{{ $product->name }}</h2>
        <p class="text-gray-600">{{ $product->description }}</p>

        <p class="text-lg font-bold mt-2 text-blue-700">₱{{ number_format($product->price, 2) }}</p>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button class="w-full bg-blue-600 text-white py-2 rounded mt-3 hover:bg-blue-700">
                Add to Cart
            </button>
        </form>

    </div>
    @endforeach
</div>

@endsection
