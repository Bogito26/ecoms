@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto mt-6 bg-white p-5 rounded-2xl shadow-lg">

    <h1 class="text-xl font-bold mb-4 text-[#D85C20]">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-3">
        @csrf

        <!-- Category Name -->
        <div class="flex flex-col">
            <label class="mb-1 text-sm font-medium text-[#2E2E2E]">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   class="w-full p-2 rounded-lg bg-[#FFF4EB] border border-[#D85C20] focus:ring-2 focus:ring-[#D85C20] outline-none text-sm transition">
            @error('name') 
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-[#D85C20] hover:bg-[#b14a1a] text-white font-semibold text-sm py-2 rounded-lg shadow-sm transition">
            Save Category
        </button>
    </form>
</div>
@endsection
