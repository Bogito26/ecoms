@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto shadow-md rounded-xl p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Product</h2>

    <!-- PRODUCT IMAGE ON TOP (CENTERED) -->
    <div class="flex justify-center mb-6">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-40 h-40 object-cover rounded-xl shadow-lg">
        @else
            <div class="w-40 h-40 flex items-center justify-center bg-gray-100 rounded-xl shadow-lg">
                <p class="text-gray-500 text-sm">No Image</p>
            </div>
        @endif
    </div>

    <!-- UPLOAD NEW IMAGE -->
    <div>
        <label class="flex justify-center mb-1 font-semibold">Upload New Image</label>
        <input type="file" 
               name="image"
               class="w-full text-sm text-gray-900">
    </div>

    <form 
        action="{{ route('admin.products.update', $product->id) }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="space-y-5">

        @csrf
        @method('PUT')

        <!-- NAME -->
        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ $product->name }}" 
                   required
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 text-gray-900">
        </div>

        <!-- CATEGORY -->
        <div>
            <label class="block mb-1 font-semibold">Category</label>
            <select name="category_id"
                    required
                    class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 text-gray-900">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PRICE -->
        <div>
            <label class="block mb-1 font-semibold">Price</label>
            <input type="number" 
                   name="price" 
                   step="0.01"
                   value="{{ $product->price }}" 
                   required
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 text-gray-900">
        </div>

        <!-- STOCK -->
        <div>
            <label class="block mb-1 font-semibold">Stock</label>
            <input type="number" 
                   name="stock" 
                   value="{{ $product->stock }}" 
                   required
                   class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 text-gray-900">
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="pt-3 text-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                Update Product
            </button>
        </div>

    </form>

</div>
@endsection
