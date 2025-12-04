@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-4">Products</h1>
<a href="{{ route('admin.products.create') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 text-white">Add Product</a>

@if(session('success'))
<div class="bg-green-600 text-white p-3 rounded mt-2">{{ session('success') }}</div>
@endif

<div class="mt-4 overflow-x-auto">
    <table class="w-full table-auto bg-gray-800 text-gray-100 rounded">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b border-gray-700">
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                <td class="px-4 py-2">${{ $product->price }}</td>
                <td class="px-4 py-2">{{ $product->stock }}</td>
                <td class="px-4 py-2">
                    @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-16 h-16 object-cover rounded">
                    @else
                    -
                    @endif
                </td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
