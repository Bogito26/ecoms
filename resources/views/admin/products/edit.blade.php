@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-[#FFFFFF] rounded-3xl shadow-xl overflow-hidden">

    <!-- Header -->
    <div class="bg-[#2ECCB0] p-6 rounded-t-3xl">
        <h1 class="text-3xl font-bold text-[#2E2E2E]">
            Edit Product
        </h1>
        <p class="text-[#2E2E2E]/80 mt-1">
            Update your product details below.
        </p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data" 
          class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

        @csrf
        @method('PUT')

        <!-- Left Column -->
        <div class="space-y-6">

            <!-- Product Name -->
            <div class="flex flex-col">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                @error('name') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div class="flex flex-col">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Category</label>
                <select name="category_id"
                        class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Description (span 2 columns) -->
            <div class="flex flex-col md:col-span-2">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Description</label>
                <textarea name="description" rows="4"
                          class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">{{ old('description', $product->description) }}</textarea>
            </div>

        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Price -->
            <div class="flex flex-col">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Price (USD)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                @error('price') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Stock -->
            <div class="flex flex-col">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                       class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                @error('stock') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Product Image -->
            <div class="flex flex-col">
                <label class="mb-2 font-semibold text-[#2E2E2E]">Product Image</label>
                <input type="file" name="image"
                       class="p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         class="w-40 h-40 mt-3 object-cover rounded-xl border border-[#2ECCB0] shadow-lg">
                @endif
                @error('image') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

        </div>

        <!-- Submit Button (full width) -->
        <div class="md:col-span-2 flex justify-end">
            <button type="submit"
                    class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] font-bold px-8 py-3 rounded-2xl shadow-lg transition">
                Update Product
            </button>
        </div>

    </form>
</div>
@endsection
