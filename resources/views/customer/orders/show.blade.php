@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6 bg-[#FFF5F0] rounded-2xl">

    <!-- Order Title -->
    <h2 class="text-2xl sm:text-3xl font-bold text-[#f05a28] mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#f05a28" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        Order #{{ $order->id }}
    </h2>

    <!-- Order Info Card -->
    <div class="bg-white rounded-2xl shadow-md p-4 sm:p-6 border border-[#f05a28]/30">
        <p class="text-sm sm:text-base flex justify-between">
            <span>Status:</span>
            <span class="px-2 py-1 rounded-full text-xs font-semibold
                {{ $order->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                {{ $order->status === 'Completed' ? 'bg-green-200 text-green-800' : '' }}
                {{ $order->status === 'Cancelled' ? 'bg-red-200 text-red-800' : '' }}">
                {{ $order->status }}
            </span>
        </p>
        <p class="text-sm sm:text-base flex justify-between mt-1">
            <span>Total:</span>
            <span class="font-semibold">${{ number_format($order->total, 2) }}</span>
        </p>
        <p class="text-sm sm:text-base flex justify-between mt-1">
            <span>Placed on:</span>
            <span>{{ $order->created_at->format('M d, Y H:i') }}</span>
        </p>

        @if($order->status === 'Pending')
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" class="mt-4 text-right">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-xl shadow hover:bg-red-600 transition text-sm inline-flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </button>
            </form>
        @endif
    </div>

    <!-- Order Items -->
    <div class="space-y-4">
        @foreach($order->orderItems as $item)
        <div class="bg-white rounded-2xl shadow-md p-4 flex justify-between items-center border border-[#f05a28]/20 hover:shadow-lg transition">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-[#2E2E2E]">{{ $item->product->name ?? 'Product removed' }}</span>
            </div>
            <div class="flex gap-4 items-center text-sm">
                <span>Qty: {{ $item->quantity }}</span>
                <span>Price: ${{ number_format($item->price, 2) }}</span>
                <span class="font-semibold">Subtotal: ${{ number_format($item->quantity * $item->price, 2) }}</span>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
