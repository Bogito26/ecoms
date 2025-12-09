@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-[#DFF9F3] rounded-3xl shadow-lg p-6 mt-6">

    <h2 class="text-2xl font-bold text-[#2ECCB0] mb-6 text-center">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="flex flex-col">
            <label class="mb-1 font-semibold text-[#2E2E2E]">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" required
                   class="px-3 py-2 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
        </div>

        <!-- EMAIL -->
        <div class="flex flex-col">
            <label class="mb-1 font-semibold text-[#2E2E2E]">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required
                   class="px-3 py-2 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
        </div>

        <!-- ROLE -->
        <div class="flex flex-col">
            <label class="mb-1 font-semibold text-[#2E2E2E]">Role</label>
            <select name="role" 
                    class="px-3 py-2 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none transition">
                <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ $user->role=='customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="text-center">
            <button type="submit"
                    class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] font-semibold px-6 py-2 rounded-2xl shadow-md transition">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
