@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <h1 class="text-3xl font-bold text-[#D85C20] mb-2 sm:mb-0">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-4 py-2 rounded transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Product
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
    <div class="bg-[#D85C20] text-white p-3 rounded shadow flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Products List (Inline / Text-box style) -->
    <div class="space-y-2 mt-4">
        @foreach($products as $product)
        <div class="flex items-center justify-between bg-white border border-[#D85C20] rounded-lg shadow px-3 py-2 text-sm hover:shadow-lg transition">
            
            <!-- Product Info -->
            <div class="flex items-center space-x-3 flex-1">
                <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="h-full w-full object-cover">
                    @else
                        <span class="text-gray-400 text-xs flex items-center justify-center h-full">No Img</span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-gray-800">{{ $product->name }}</span>
                    <span class="text-gray-500 text-xs">{{ $product->category->name ?? 'Uncategorized' }}</span>
                </div>
            </div>

            <!-- Price & Stock -->
            <div class="flex flex-col items-end mr-4 flex-shrink-0">
                <span class="text-[#D85C20] font-bold">${{ number_format($product->price, 2) }}</span>
                <span class="text-gray-600 text-xs">Stock: {{ $product->stock }}</span>
            </div>

            <!-- Actions -->
            <div class="flex space-x-1 flex-shrink-0">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-[#FFA94D] hover:bg-[#e68a30] text-white px-2 py-1 rounded text-xs transition">
                    Edit
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs transition" onclick="return confirm('Delete this product?')">
                        Delete
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
