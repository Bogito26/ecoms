@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4">
    <div class="w-full max-w-sm bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-semibold text-center mb-5">Verify Your OTP</h2>

        @if(session('success'))
            <p class="text-green-500 text-center mb-4">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="text-red-500 text-center mb-4">{{ session('error') }}</p>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') ?? '' }}">
            <input type="text" name="otp" placeholder="Enter OTP"
                   class="w-full p-3 border rounded-lg" required />
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg">Verify OTP</button>
        </form>

        <p class="text-xs text-gray-500 mt-4 text-center">
            Didn't receive OTP? <a href="{{ route('otp.resend') }}" class="text-blue-600">Resend</a>
        </p>
    </div>
</div>
@endsection
