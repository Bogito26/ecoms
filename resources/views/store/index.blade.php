@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />


<!-- NAVBAR -->
<nav class="bg-white shadow-md rounded-b-3xl mb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT EMPTY (logo removed) -->
            <div></div>

            <!-- LINKS -->
            <div class="hidden md:flex space-x-6 font-semibold text-gray-700">
                <a href="{{ route('store.index') }}" class="hover:text-orange-600 transition">Home</a>
                <a href="{{ route('contact.show') }}" class="hover:text-orange-600 transition">Contact</a>
                <a href="{{ route('about') }}" class="hover:text-orange-600 transition">About</a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="focus:outline-none text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="md:hidden hidden bg-white px-4 pt-2 pb-4 space-y-1 font-semibold text-gray-700">
        <a href="{{ route('store.index') }}" class="block py-2 hover:text-orange-600 transition">Home</a>
        <a href="{{ route('contact.show') }}" class="block py-2 hover:text-orange-600 transition">Contact</a>
        <a href="{{ route('about') }}" class="block py-2 hover:text-orange-600 transition">About</a>
    </div>
</nav>
<script>
    document.getElementById('mobile-menu-btn')
        .addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
</script>

<!-- SEARCH / FILTER BAR -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-orange-50 text-gray-900 rounded-3xl shadow-inner">

    <form method="GET" action="{{ route('store.index') }}"
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

        <!-- SEARCH -->
        <input type="text" name="search"
               placeholder="Search products..."
               value="{{ request('search') }}"
               class="w-full p-3 rounded-xl bg-white border border-orange-500 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm">

        <!-- CATEGORY -->
        <select name="category"
                class="w-full p-3 rounded-xl bg-white border border-orange-500 focus:ring-2 focus:ring-orange-500 shadow-sm">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- SORT -->
        <select name="sort"
                class="w-full p-3 rounded-xl bg-white border border-orange-500 focus:ring-2 focus:ring-orange-500 shadow-sm">
            <option value="">Sort By</option>
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
        </select>

        <!-- APPLY BUTTON -->
        <button type="submit"
                class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-md transition">
            Apply
        </button>

    </form>
</div>

<!-- PRODUCTS GRID -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($products as $product)

            <!-- PRODUCT CARD -->
            <div class="bg-white border border-orange-200 rounded-2xl shadow-sm hover:shadow-md transition">

                <!-- IMAGE -->
                <div class="h-44 w-full overflow-hidden rounded-t-2xl">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-orange-600 font-bold">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- BODY -->
                <div class="p-3 space-y-1">
                    <h3 class="text-lg font-bold text-gray-800 leading-tight">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </p>

                    <p class="text-xl font-bold text-orange-600">
                        ₱{{ number_format($product->price, 2) }}
                    </p>

                    <a href="{{ route('store.show', $product->id) }}"
                       class="block bg-orange-600 hover:bg-orange-700 text-white text-center py-2 rounded-xl mt-2 transition">
                        View
                    </a>
                </div>

            </div>

        @empty
            <p class="col-span-4 text-center text-gray-500">No products found.</p>
        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

@endsection
