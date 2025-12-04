@extends('layouts.admin')

@section('content')
<div class="space-y-4">

    <h1 class="text-3xl font-bold mb-4">Categories</h1>

    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mt-2">{{ session('success') }}</div>
    @endif

    <div class="mt-4 overflow-x-auto">
        <table class="w-full table-auto bg-gray-800 text-gray-100 rounded">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border-b border-gray-700">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-500 px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
