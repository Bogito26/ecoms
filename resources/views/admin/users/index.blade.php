@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h1 class="text-3xl font-bold text-[#2ECCB0] mb-6">Users Management</h1>

    @if(session('success'))
    <div class="bg-green-600 text-white p-3 rounded shadow">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-600 text-white p-3 rounded shadow">
        {{ session('error') }}
    </div>
    @endif

    <div class="overflow-x-auto bg-[#DFF9F3] rounded-2xl shadow p-4">
        <table class="min-w-full divide-y divide-[#2ECCB0]">
            <thead class="bg-[#2ECCB0] text-[#2E2E2E] uppercase text-sm rounded-t-2xl">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#2ECCB0]">
                @foreach ($users as $user)
                <tr class="bg-white hover:bg-[#E0F7F2] transition rounded-lg">
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2 font-medium text-[#2E2E2E]">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-[#2E2E2E]/80">{{ $user->email }}</td>
                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] font-semibold px-4 py-1 rounded shadow transition">
                           Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded shadow transition"
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
    