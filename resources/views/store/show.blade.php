@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<div class="flex justify-center px-4 py-8 bg-[#FFF4E6]">
    <div data-aos="fade-up" data-aos-duration="700"
         class="w-full max-w-xs bg-white border border-orange-300 rounded-xl p-4 shadow-lg">

        <!-- PRODUCT NAME -->
        <h2 class="text-xl font-bold text-gray-800 mb-3 text-center">
            {{ $product->name }}
        </h2>

        <!-- IMAGE -->
        <div class="w-full rounded-lg overflow-hidden border border-orange-300 mb-3">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-full h-40 object-cover">
            @else
                <p class="text-center py-10 text-orange-500">No Image</p>
            @endif
        </div>

        <!-- CATEGORY -->
        <p class="text-sm text-gray-600 mb-1">
            <span class="font-bold text-orange-600">Category:</span>
            {{ $product->category->name ?? 'Uncategorized' }}
        </p>

        <!-- PRICE -->
        <p class="text-2xl font-bold text-gray-900 mb-3">
            ₱{{ number_format($product->price, 2) }}
        </p>

        <!-- DESCRIPTION -->
        <p class="text-xs text-gray-700 leading-relaxed mb-3">
            {{ $product->description ?? 'No description available.' }}
        </p>

        <!-- Add to Cart -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-3">
            @csrf

            <!-- LABEL ABOVE INPUT -->
            <label class="text-sm font-bold text-gray-700 block">
                Quantity
            </label>

            <!-- INPUT SMALL -->
            <input type="number" name="quantity" value="1" min="1"
                class="w-20 px-2 py-2 border border-orange-400 rounded-lg text-gray-900
                       focus:ring-2 focus:ring-orange-500 outline-none">

            <!-- BUTTON SMALL -->
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold
                       py-2 rounded-lg text-sm shadow-md transition">
                Add to Cart
            </button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true });
</script>
@endsection
