@extends('layouts.customer')

@section('content')
<div class="max-w-2xl mx-auto mt-10 space-y-6">

    <!-- Title -->
    <h2 class="text-3xl font-bold text-white mb-4">Your Profile</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-700 text-white p-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <form method="POST" action="{{ route('profile.update') }}"
          class="space-y-5 bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">

        @csrf
        @method('PATCH')

        <!-- Name -->
        <div>
            <label class="block text-gray-300 font-semibold mb-1">Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}" required
                   class="w-full bg-gray-900 text-white border border-gray-700 p-2 rounded-lg focus:ring focus:ring-blue-600">
            @error('name')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-300 font-semibold mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}" required
                   class="w-full bg-gray-900 text-white border border-gray-700 p-2 rounded-lg focus:ring focus:ring-blue-600">
            @error('email')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-gray-300 font-semibold mb-1">
                Password <span class="text-gray-400 text-sm">(Leave blank to keep current)</span>
            </label>

            <input type="password" name="password"
                   class="w-full bg-gray-900 text-white border border-gray-700 p-2 rounded-lg mb-2 focus:ring focus:ring-blue-600">

            <input type="password" name="password_confirmation"
                   class="w-full bg-gray-900 text-white border border-gray-700 p-2 rounded-lg focus:ring focus:ring-blue-600">
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
            Update Profile
        </button>

    </form>
</div>
@endsection
