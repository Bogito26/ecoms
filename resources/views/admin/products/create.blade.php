@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-6 bg-gray-800 p-6 rounded text-gray-100">
    <h1 class="text-2xl font-bold mb-4">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h1>

    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if(isset($product))
            @method('PATCH')
        @endif

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @error('name') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Category</label>
            <select name="category_id" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" class="w-full p-2 rounded bg-gray-700 border border-gray-600">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div>
            <label>Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @error('price') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @error('stock') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Image</label>
            <input type="file" name="image" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @if(isset($product) && $product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="w-32 h-32 mt-2 object-cover rounded">
            @endif
            @error('image') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">{{ isset($product) ? 'Update Product' : 'Add Product' }}</button>
    </form>
</div>
@endsection
