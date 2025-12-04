@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-white mb-4">{{ $product->name }}</h2>

    <div class="flex flex-col md:flex-row gap-6">
        <!-- Product Image -->
        <div class="md:w-1/2 flex items-center justify-center bg-gray-900 rounded-xl p-4">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="object-cover h-64 w-full rounded">
            @else
                <span class="text-gray-500">No Image Available</span>
            @endif
        </div>

        <!-- Product Details -->
        <div class="md:w-1/2 text-white">
            <p class="text-gray-300 mb-2">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-green-400 font-bold text-xl mb-4">${{ number_format($product->price, 2) }}</p>
            <p class="text-gray-300 mb-4">{{ $product->description ?? 'No description available.' }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-3">
                @csrf
                <label class="block text-gray-300">Quantity:</label>
                <input type="number" name="quantity" value="1" min="1"
                       class="w-20 px-2 py-1 rounded border border-gray-600 bg-gray-700 text-white">

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white font-semibold">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
