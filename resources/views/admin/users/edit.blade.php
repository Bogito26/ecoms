@extends('layouts.admin')

@section('content')
<div class="max-w-sm mx-auto bg-[#FFF4EB] rounded-2xl shadow-lg p-5 mt-6">

    <h2 class="text-xl font-bold text-[#D85C20] mb-5 text-center">User Details</h2>

    <!-- PROFILE PICTURE -->
    <div class="flex flex-col items-center mb-4">
        @if($user->profile_picture && file_exists(storage_path('app/public/profile_pictures/' . $user->profile_picture)))
            <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}"
                 alt="Profile Picture" class="w-20 h-20 object-cover rounded-full mb-2 border-2 border-[#D85C20]">
        @else
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-2 border-2 border-[#D85C20]">
                <span class="text-gray-400 text-sm">No Picture</span>
            </div>
        @endif
    </div>

    <!-- USER INFO -->
    <div class="space-y-2">
        <div>
            <label class="text-sm font-semibold text-[#2E2E2E]">Name</label>
            <p class="px-3 py-2 rounded-lg border border-[#D85C20] bg-white text-[#2E2E2E] text-sm">
                {{ $user->name }}
            </p>
        </div>

        <div>
            <label class="text-sm font-semibold text-[#2E2E2E]">Email</label>
            <p class="px-3 py-2 rounded-lg border border-[#D85C20] bg-white text-[#2E2E2E] text-sm">
                {{ $user->email }}
            </p>
        </div>

        <div>
            <label class="text-sm font-semibold text-[#2E2E2E]">Role</label>
            <p class="px-3 py-2 rounded-lg border border-[#D85C20] bg-white text-[#2E2E2E] text-sm">
                {{ ucfirst($user->role) }}
            </p>
        </div>
    </div>

    <!-- BACK BUTTON -->
    <div class="text-center mt-5">
        <a href="{{ route('admin.users.index') }}"
           class="bg-[#D85C20] hover:bg-[#b14a1a] text-white font-semibold px-5 py-2 rounded-xl shadow transition text-sm">
            Back to Users
        </a>
    </div>
</div>
@endsection
