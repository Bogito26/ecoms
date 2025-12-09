@extends('layouts.customer')

@section('content')

<h1 class="text-3xl font-extrabold mb-8 text-center text-[#2ECCB0]">Our Products</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-[#DFF9F3] rounded-3xl p-4 shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1">
        
        <!-- Product Image -->
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover rounded-2xl mb-4">
        @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-2xl mb-4">
            No Image
        </div>
        @endif

        <!-- Product Info -->
        <h2 class="text-xl font-bold text-[#2E2E2E] mb-1">{{ $product->name }}</h2>
        <p class="text-[#2E2E2E] text-sm mb-2">{{ $product->description }}</p>
        <p class="text-lg font-bold text-[#2ECCB0] mb-3">${{ number_format($product->price, 2) }}</p>

        <!-- Add to Cart Button -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" 
                class="w-full bg-[#2ECCB0] hover:bg-[#27b79e] text-white py-2 rounded-2xl font-semibold flex items-center justify-center gap-2 shadow-md transition">
                <!-- Shopping Cart Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                </svg>
                Add to Cart
            </button>
        </form>

    </div>
    @endforeach
</div>

@endsection
