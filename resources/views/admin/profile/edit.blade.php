@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-10 space-y-6">

    <!-- Title -->
    <h2 class="text-3xl font-bold text-[#D85C20] mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#D85C20" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
        </svg>
        Admin Profile
    </h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-[#D85C20] text-white p-3 rounded-lg shadow flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <form method="POST" action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="space-y-5 bg-white p-6 rounded-xl shadow-lg border border-[#D85C20]">

        @csrf
        @method('PATCH')

        <!-- Profile Picture -->
        <div>
            <label class="block text-gray-800 font-semibold mb-1">Profile Picture</label>
            
        </div>

        <!-- Name -->

         <img src="{{ asset('profile/profile.jpg') }}"
     alt="Profile Picture"
     class="w-24 h-24 mx-auto rounded-full object-cover">
        <div>
            <label class="block text-gray-800 font-semibold mb-1">Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}" required
                   class="w-full bg-white text-gray-800 border border-[#D85C20] p-2 rounded-lg focus:ring focus:ring-[#D85C20]">
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-800 font-semibold mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}" required
                   class="w-full bg-white text-gray-800 border border-[#D85C20] p-2 rounded-lg focus:ring focus:ring-[#D85C20]">
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-gray-800 font-semibold mb-1">Password <span class="text-gray-400 text-sm">(Leave blank to keep current)</span></label>
            <input type="password" name="password"
                   class="w-full bg-white text-gray-800 border border-[#D85C20] p-2 rounded-lg mb-2 focus:ring focus:ring-[#D85C20]">
            <input type="password" name="password_confirmation"
                   class="w-full bg-white text-gray-800 border border-[#D85C20] p-2 rounded-lg focus:ring focus:ring-[#D85C20]">
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-[#D85C20] hover:bg-[#b14a1a] text-white py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            Update Profile
        </button>

    </form>
</div>
@endsection
