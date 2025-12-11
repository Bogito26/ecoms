@extends('layouts.customer')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6 bg-[#FFF5F0]">

    <h2 class="text-2xl sm:text-3xl font-bold text-[#f05a28] mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#f05a28" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        Your Orders
    </h2>

    @if($orders->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-2xl shadow-md border border-[#f05a28]/30 p-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-semibold text-[#2E2E2E]">Order #{{ $order->id }}</span>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $order->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                        {{ $order->status === 'Completed' ? 'bg-green-200 text-green-800' : '' }}
                        {{ $order->status === 'Cancelled' ? 'bg-red-200 text-red-800' : '' }}">
                        {{ $order->status }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-2">Placed on: {{ $order->created_at->format('M d, Y') }}</p>
                <p class="text-sm text-gray-800 font-semibold mb-2">Total: ${{ number_format($order->total, 2) }}</p>
                <div class="flex justify-between mt-3">
                    <a href="{{ route('customer.orders.show', $order->id) }}"
                       class="inline-flex items-center gap-1 bg-[#f05a28] text-white px-3 py-1.5 rounded-xl shadow hover:bg-[#e0491b] transition text-sm">
                        View
                    </a>
                    @if($order->status === 'Pending')
                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-xl shadow hover:bg-red-600 transition text-sm">
                            Cancel
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-[#2E2E2E] text-center py-6 text-sm sm:text-base">You have no orders yet.</p>
    @endif

</div>
@endsection
