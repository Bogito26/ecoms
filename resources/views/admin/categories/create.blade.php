@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-6 bg-[#FFFFFF] p-6 rounded-3xl shadow-lg">

    <h1 class="text-2xl font-bold mb-6 text-[#2E2E2E]">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-[#2E2E2E]">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   class="w-full p-3 rounded-xl bg-[#DFF9F3] border border-[#2ECCB0] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
            @error('name') <div class="text-red-500 mt-1">{{ $message }}</div> @enderror
        </div>

        <button type="submit" 
                class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] font-semibold px-6 py-2 rounded-2xl shadow-md transition">
            Save Category
        </button>
    </form>
</div>
@endsection
