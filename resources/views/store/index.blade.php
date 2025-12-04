@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

   <!-- Search & Filter -->
<form method="GET" action="{{ route('store.index') }}" class="flex flex-wrap gap-4 mb-6">
    <input type="text" name="search" placeholder="Search products..."
        value="{{ request('search') }}"
        class="p-2 rounded border w-full md:w-1/3 bg-gray-700 text-white placeholder-gray-400">

    <select name="category" class="p-2 rounded border bg-gray-700 text-white">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select name="sort" class="p-2 rounded border bg-gray-700 text-white">
        <option value="">Sort By</option>
        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
    </select>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Apply
    </button>
</form>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
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
            <p class="text--300 col-span-4">No products found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
