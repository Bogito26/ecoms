@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Edit User</h2>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ $user->name }}" required
            class="w-full px-3 py-2 border rounded-lg bg-gray-900 text-white focus:ring">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required
            class="w-full px-3 py-2 border rounded-lg bg-gray-900 text-white focus:ring">
    </div>

    <div>
        <label class="block mb-1 font-semibold">Role</label>
        <select name="role" class="w-full px-3 py-2 border rounded-lg bg-gray-900 text-white focus:ring">
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="customer" {{ $user->role=='customer' ? 'selected' : '' }}>Customer</option>
        </select>
    </div>

    <button class="bg-blue-600 px-5 py-2 text-white rounded hover:bg-blue-700 transition">
        Update User
    </button>
</form>

@endsection
