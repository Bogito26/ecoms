@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-3xl shadow-xl border border-[#FF5722]">

    <h2 class="text-3xl font-bold text-[#FF5722] mb-6 text-center">Contact Us</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-[#FFCCBC] text-[#BF360C] px-4 py-3 rounded-lg mb-5 text-center font-semibold shadow-md animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <!-- Contact Form -->
    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-[#FF5722] font-semibold mb-2">Name</label>
            <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}"
                   class="w-full border border-[#FF5722] rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:border-transparent shadow-sm transition" required>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-[#FF5722] font-semibold mb-2">Email</label>
            <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}"
                   class="w-full border border-[#FF5722] rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:border-transparent shadow-sm transition" required>
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message -->
        <div>
            <label class="block text-[#FF5722] font-semibold mb-2">Message / Concern</label>
            <textarea name="message" rows="5" placeholder="Type your message here..." 
                      class="w-full border border-[#FF5722] rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:border-transparent shadow-sm transition" required>{{ old('message') }}</textarea>
            @error('message')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit"
                    class="bg-[#FF5722] hover:bg-[#e64a19]  font-bold px-6 py-3 rounded-2xl shadow-lg transition duration-300 transform hover:scale-105 w-full sm:w-auto">
                Send Message
            </button>
        </div>
    </form>

    <!-- Admin Reply -->
    @if(session('adminReply') || $adminReply)
    <div class="mt-6 p-4 bg-[#FFF3E0] border-l-4 border-[#FF5722] rounded-xl text-gray-900 shadow-sm">
        <strong>Admin Reply:</strong>
        <p class="mt-2">{{ session('adminReply') ?? $adminReply }}</p>
    </div>
    @endif

    <!-- Footer Note -->
    <p class="mt-6 text-center text-gray-500 text-sm">We will get back to you within 24-48 hours.</p>
</div>
@endsection
