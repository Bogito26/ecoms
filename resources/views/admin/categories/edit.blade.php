@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-6 bg-gray-800 p-6 rounded text-gray-100">
    <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @error('name') <div class="text-red-400">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-yellow-600 px-4 py-2 rounded hover:bg-yellow-700">Update Category</button>
    </form>
</div>
@endsection
