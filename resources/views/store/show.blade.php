@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-[#DFF9F3]">

    <div data-aos="fade-up" data-aos-duration="800"
         class="bg-white border border-[#2ECCB0]/40 rounded-3xl p-6 sm:p-10
                shadow-[0_0_18px_rgba(46,204,176,0.25)]">

        <!-- PRODUCT NAME -->
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#2E2E2E] mb-6 sm:mb-8 tracking-wide drop-shadow-sm">
            {{ $product->name }}
        </h2>

        <!-- GRID LAYOUT -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-12">

            <!-- PRODUCT IMAGE -->
            <div class="bg-white border border-[#2ECCB0] rounded-3xl p-4 sm:p-5
                        flex justify-center items-center shadow-[0_0_12px_rgba(46,204,176,0.15)]">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="object-cover h-64 sm:h-80 md:h-96 w-full rounded-2xl shadow-lg
                                hover:scale-105 hover:shadow-[0_0_25px_rgba(46,204,176,0.4)]
                                transition-all duration-300">
                @else
                    <span class="text-[#2ECCB0] text-lg">No Image Available</span>
                @endif
            </div>

            <!-- PRODUCT DETAILS -->
            <div class="text-[#2E2E2E] space-y-4 sm:space-y-6">

                <!-- CATEGORY -->
                <p class="text-sm sm:text-base uppercase tracking-widest">
                    Category:
                    <span class="text-[#2ECCB0] font-semibold">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </p>

                <!-- PRICE -->
                <p class="text-3xl sm:text-4xl font-black flex items-center gap-2">
                    <!-- Dollar Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 1v2m0 18v2m4-20a4 4 0 00-8 0m8 20a4 4 0 00-8 0M8 7h8M8 17h8"/>
                    </svg>
                    ${{ number_format($product->price, 2) }}
                </p>

                <!-- DESCRIPTION -->
                <p class="text-sm sm:text-base leading-relaxed">
                    {{ $product->description ?? 'No description available.' }}
                </p>

                <!-- Add to Cart -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4 mt-4 sm:mt-6">
                    @csrf

                    <label class="block font-semibold uppercase tracking-wider flex items-center gap-2">
                        <!-- Quantity Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                        </svg>
                        Quantity
                    </label>

                    <input type="number" name="quantity" value="1" min="1"
                        class="w-24 sm:w-28 px-3 sm:px-4 py-2 sm:py-3 rounded-xl border border-[#2ECCB0] bg-white 
                               text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0]
                               shadow-[0_0_8px_rgba(46,204,176,0.3)] outline-none">

                    <!-- ADD TO CART BUTTON -->
                    <button type="submit"
                        class="w-full bg-[#2ECCB0] hover:bg-[#27b79e] text-white font-extrabold 
                               py-3 sm:py-4 rounded-2xl text-lg sm:text-xl tracking-wide
                               shadow-[0_0_15px_rgba(46,204,176,0.7)]
                               hover:shadow-[0_0_30px_rgba(46,204,176,0.9)]
                               hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">

                        <!-- Cart Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                        </svg>
                        ADD TO CART
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

@endsection
