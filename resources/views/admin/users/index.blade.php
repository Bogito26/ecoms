@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Users Management</h1>

@if(session('success'))
<div class="bg-green-600 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-600 text-white p-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif

<div class="overflow-x-auto">
    <table class="w-full bg-gray-800 rounded text-gray-100">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr class="border-b border-gray-700">
                <td class="px-4 py-2">{{ $user->id }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2 capitalize">{{ $user->role }}</td>

                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="bg-yellow-500 px-3 py-1 rounded hover:bg-yellow-600">Edit</a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-700"
                            onclick="return confirm('Delete this user?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
