@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white rounded-2xl shadow-xl p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#D85C20]">Edit Product</h1>
        <p class="text-gray-600 text-sm">Update product details below.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data" 
          class="space-y-4 text-sm">

        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-3">
            <label class="w-32 font-semibold text-gray-700">Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="flex-1 p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">
            @error('name') <span class="text-red-500 text-xs mt-1 md:mt-0">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-3">
            <label class="w-32 font-semibold text-gray-700">Category:</label>
            <select name="category_id" class="flex-1 p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-xs mt-1 md:mt-0">{{ $message }}</span> @enderror
        </div>

        <!-- Price and Stock -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-3">
            <label class="w-32 font-semibold text-gray-700">Price:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                   class="flex-1 p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">
            @error('price') <span class="text-red-500 text-xs mt-1 md:mt-0">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:space-x-3">
            <label class="w-32 font-semibold text-gray-700">Stock:</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                   class="flex-1 p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">
            @error('stock') <span class="text-red-500 text-xs mt-1 md:mt-0">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">Description:</label>
            <textarea name="description" rows="3"
                      class="w-full p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Product Image -->
        <div class="flex flex-col md:flex-row md:items-center md:space-x-3">
            <label class="w-32 font-semibold text-gray-700">Image:</label>
            <input type="file" name="image" 
                   class="flex-1 p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-1 focus:ring-[#D85C20] outline-none transition">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" 
                     class="w-24 h-24 mt-2 md:mt-0 object-cover rounded-lg border border-[#D85C20]">
            @endif
            @error('image') <span class="text-red-500 text-xs mt-1 md:mt-0">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-6 py-2 rounded-lg font-semibold transition">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
