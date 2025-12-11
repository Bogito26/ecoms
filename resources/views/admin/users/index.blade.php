@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto p-4 space-y-4">

    <h1 class="text-2xl font-bold text-[#D85C20] mb-4">Users Management</h1>

    @if(session('success'))
        <div class="bg-green-600 text-white p-2 rounded shadow text-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-600 text-white p-2 rounded shadow text-sm">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto bg-[#FFF4EB] rounded-xl shadow p-3">
        <table class="min-w-full text-sm divide-y divide-[#D85C20]/40">
            <thead class="bg-[#D85C20] text-white uppercase text-xs">
                <tr>
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">Role</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#D85C20]/30">
                @foreach ($users as $user)
                <tr class="bg-white hover:bg-[#FFE4D1] transition rounded-lg">
                    <td class="px-2 py-1">{{ $user->id }}</td>
                    <td class="px-2 py-1 font-medium text-[#2E2E2E]">{{ $user->name }}</td>
                    <td class="px-2 py-1 text-[#2E2E2E]/80">{{ $user->email }}</td>
                    <td class="px-2 py-1 capitalize">{{ $user->role }}</td>
                    <td class="px-2 py-1">
                        <span class="{{ $user->is_active ? 'text-green-600' : 'text-red-600' }} font-semibold text-xs">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-2 py-1 flex flex-wrap gap-1">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="bg-[#D85C20] hover:bg-[#b14a1a] text-white text-xs px-2 py-1 rounded shadow transition">
                           View
                        </a>
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="{{ $user->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }} 
                                       text-white text-xs px-2 py-1 rounded shadow transition"
                                onclick="return confirm('Are you sure you want to change this user status?')">
                                {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white text-xs px-2 py-1 rounded shadow transition"
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

</div>
@endsection
