@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-6 space-y-4">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2">
        <h1 class="text-2xl font-bold text-[#D85C20] mb-2 sm:mb-0">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-3 py-1 rounded-lg font-semibold text-sm transition">
            Add Category
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-[#FFF4EB] text-[#D85C20] p-2 rounded shadow text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Categories Table -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="w-full text-sm text-[#2E2E2E]">
            <thead class="bg-[#D85C20]/20">
                <tr>
                    <th class="px-3 py-2 text-left font-medium">Name</th>
                    <th class="px-3 py-2 text-left font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border-b border-[#D85C20]/30 hover:bg-[#FFF4EB] transition">
                    <td class="px-3 py-2">{{ $category->name }}</td>
                    <td class="px-3 py-2 flex space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-3 py-1 rounded-lg text-xs font-medium transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition"
                                    onclick="return confirm('Delete this category?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
