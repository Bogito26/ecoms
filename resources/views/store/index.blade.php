@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-12 bg-[#DFF9F3] text-[#2E2E2E]">

    <!-- SEARCH / FILTER BAR -->
    <div data-aos="fade-up" data-aos-duration="800"
         class=" rounded-3xl p-6 sm:p-8 shadow-[0_0_20px_rgba(46,204,176,0.15)]">

        <form method="GET" action="{{ route('store.index') }}"
              class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5">

            <!-- SEARCH -->
            <div class="relative">
                <input type="text" name="search" placeholder="Search products..."
                       value="{{ request('search') }}"
                       class="w-full p-3 sm:p-4 rounded-2xl bg-white border border-[#2ECCB0] text-[#2E2E2E]
                              placeholder-[#6B6B6B] focus:ring-2 focus:ring-[#2ECCB0] outline-none
                              shadow-[0_0_6px_rgba(46,204,176,0.3)] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.65 16.65a7.5 7.5 0 10-10.6-10.6 7.5 7.5 0 0010.6 10.6z"/>
                </svg>
            </div>

            <!-- CATEGORY -->
            <select name="category" class="w-full p-3 sm:p-4 rounded-2xl bg-white border border-[#2ECCB0] text-[#2E2E2E]
                           shadow-[0_0_6px_rgba(46,204,176,0.3)]">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- SORT -->
            <select name="sort" class="w-full p-3 sm:p-4 rounded-2xl bg-white border border-[#2ECCB0] text-[#2E2E2E]
                           shadow-[0_0_6px_rgba(46,204,176,0.3)]">
                <option value="">Sort By</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
            </select>

            <!-- APPLY BTN -->
            <button type="submit"
                    class="w-full bg-[#2ECCB0] hover:bg-[#27b79e] text-white font-bold py-3 sm:py-4 rounded-2xl
                           shadow-[0_0_12px_rgba(46,204,176,0.8)] hover:shadow-[0_0_24px_rgba(46,204,176,1)]
                           transition-all duration-300 flex items-center justify-center gap-2">
   
                Apply
            </button>
        </form>
    </div>

    <!-- PRODUCTS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-10">
        @forelse($products as $product)
            <div data-aos="fade-up" data-aos-duration="800"
                 class="bg-white border border-[#2ECCB0] rounded-3xl overflow-hidden shadow-xl
                        hover:shadow-[0_0_25px_rgba(46,204,176,0.6)] hover:scale-[1.03]
                        transition-all duration-300">

                <!-- IMAGE -->
                <div class="h-48 sm:h-56 md:h-64 lg:h-72 w-full bg-white flex items-center justify-center overflow-hidden relative group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="object-cover h-full w-full hover:scale-110 transition-all duration-500 rounded-2xl">
                    @else
                        <span class="text-[#2ECCB0] font-bold">No Image</span>
                    @endif

                    <!-- HOVER BUTTONS -->
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-opacity rounded-2xl">
                        <a href="{{ route('store.show', $product->id) }}"
                           class="bg-[#2ECCB0] text-white px-3 py-2 rounded-2xl font-semibold flex items-center gap-2 hover:bg-[#27b79e] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m12 0l-4-4m4 4l-4 4m6-9V5a2 2 0 00-2-2h-7"/>
                            </svg>
                            View
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="bg-[#2ECCB0] text-white px-3 py-2 rounded-2xl font-semibold flex items-center gap-2 hover:bg-[#27b79e] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                                </svg>
                                Add
                            </button>
                        </form>
                    </div>
                </div>

                <!-- INFO -->
                <div class="p-4 sm:p-5 space-y-3">
                    <h3 class="text-lg sm:text-xl font-extrabold text-[#1F1F1F] tracking-wide">
                        {{ $product->name }}
                    </h3>
                    <p class="text-[#6B6B6B] text-sm flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M3 12h18M3 21h18"/>
                        </svg>
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </p>
                    <p class="text-2xl sm:text-3xl font-black text-[#1F1F1F] drop-shadow">
                        ₱{{ number_format($product->price, 2) }}
                    </p>
                    <a href="{{ route('store.show', $product->id) }}"
                       class="block bg-[#2ECCB0] hover:bg-[#27b79e] text-white text-center
                              font-semibold py-3 sm:py-3.5 rounded-2xl transition-all duration-300
                              shadow-[0_0_12px_rgba(46,204,176,0.7)] hover:shadow-[0_0_22px_rgba(46,204,176,1)] flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m12 0l-4-4m4 4l-4 4m6-9V5a2 2 0 00-2-2h-7"/>
                        </svg>
                        View Product
                    </a>
                </div>
            </div>
        @empty
            <p class="text-[#6B6B6B] col-span-4 text-center text-lg">No products found.</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-8 sm:mt-10" data-aos="fade-up" data-aos-duration="800">
        <div class="text-[#1F1F1F]">
            {{ $products->links() }}
        </div>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection
