@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <h1 class="text-3xl font-bold text-[#2ECCB0] mb-2 sm:mb-0">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            Add Product
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
    <div class="bg-green-600 text-white p-3 rounded shadow">
        {{ session('success') }}
    </div>
    @endif

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
        @foreach($products as $product)
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden text-sm">
            
            <!-- Image -->
            <div class="h-36 w-full bg-gray-100 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="h-full w-full object-cover transition-transform hover:scale-105">
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </div>

            <!-- Info -->
            <div class="p-3 space-y-1">
                <h2 class="text-md font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
                <p class="text-lg font-bold text-[#2ECCB0]">${{ number_format($product->price, 2) }}</p>
                <p class="text-gray-600 text-sm">Stock: {{ $product->stock }}</p>

                <!-- Actions -->
                <div class="flex space-x-1 mt-2 text-xs">
                    <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center py-1 rounded transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-1 rounded transition" onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
