@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <h1 class="text-3xl font-bold text-[#2ECCB0] mb-2 sm:mb-0">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] px-4 py-2 rounded-2xl font-semibold transition">
            Add Category
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-[#DFF9F3] text-[#2E2E2E] p-3 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Categories Table -->
    <div class="mt-4 overflow-x-auto rounded-2xl shadow bg-[#FFFFFF]">
        <table class="w-full table-auto text-[#2E2E2E] rounded-2xl">
            <thead class="bg-[#2ECCB0]/20">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Name</th>
                    <th class="px-4 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
           <tbody>
    @foreach($categories as $category)
    <tr class="border-b border-[#2ECCB0]/30 hover:bg-[#DFF9F3] transition">
        <td class="px-4 py-2">{{ $category->name }}</td>
        <td class="px-4 py-2 flex space-x-2">
            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] px-4 py-1 rounded-2xl transition font-medium whitespace-nowrap">
                Edit
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-2xl transition font-medium whitespace-nowrap" onclick="return confirm('Delete this category?')">
                    Delete
                </button>
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
