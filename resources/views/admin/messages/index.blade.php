@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto bg-[#FFF4EB] rounded-3xl shadow-xl p-6">
    <h2 class="text-3xl font-bold text-[#D85C20] mb-6 text-center">Customer Messages</h2>

    @if(session('success'))
        <div class="bg-[#FFE3D9] text-[#D85C20] px-4 py-2 rounded mb-6 text-center font-medium animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @foreach($messages as $message)
            <div class="border border-[#D85C20]/40 rounded-2xl p-4 shadow-sm hover:shadow-md transition duration-200 bg-white">
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <p class="font-semibold text-[#2E2E2E]">{{ $message->senderName() }}</p>
                        <p class="text-[#2E2E2E]/70 text-sm">{{ $message->senderEmail() }}</p>
                        <p class="text-gray-400 text-xs">{{ $message->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <p class="mt-2 text-[#2E2E2E] text-sm">{{ $message->message }}</p>

                @if($message->reply)
                    <div class="mt-3 p-3 bg-[#FFF4EB] rounded-xl text-[#2E2E2E] border-l-4 border-[#D85C20] text-sm">
                        <strong>Reply:</strong> {{ $message->reply }}
                    </div>
                @else
                    <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" class="mt-3 flex flex-col sm:flex-row gap-2">
                        @csrf
                        <input type="text" name="reply" placeholder="Type your reply..."
                               class="flex-1 border border-[#D85C20] rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#D85C20] transition text-sm" required>
                        <button type="submit"
                                class="bg-[#D85C20] hover:bg-[#b14a1a] text-white font-semibold px-4 py-2 rounded-xl shadow-lg transition transform hover:scale-105 text-sm">
                            Send
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
