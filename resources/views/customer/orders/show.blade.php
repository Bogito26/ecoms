@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6 bg-white rounded-lg shadow-sm">

    <!-- Order Title -->
    <h2 class="text-3xl font-bold text-[#2ECCB0] mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#2ECCB0" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        Order #{{ $order->id }}
    </h2>

    <!-- Order Info -->
    <div class="bg-[#DFF9F3] p-6 rounded-xl shadow space-y-3 text-[#2E2E2E]">
        <p class="flex items-center gap-2"><strong>Status:</strong>
            <span class="px-2 py-1 rounded-full text-sm font-semibold
                {{ $order->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                {{ $order->status === 'Completed' ? 'bg-green-200 text-green-800' : '' }}
                {{ $order->status === 'Cancelled' ? 'bg-red-200 text-red-800' : '' }}">
                {{ $order->status }}
            </span>
        </p>
        <p class="flex items-center gap-2"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
        <p class="flex items-center gap-2"><strong>Placed on:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>

        <!-- Cancel Button (only if Pending) -->
        @if($order->status === 'Pending')
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel Order
                </button>
            </form>
        @endif
    </div>

    <!-- Order Items -->
    <div class="mt-6">
        <h3 class="text-2xl font-semibold text-[#2E2E2E] mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="#2ECCB0" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z" />
            </svg>
            Order Items
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-[#DFF9F3] text-[#2E2E2E] rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-[#2ECCB0] text-white">
                        <th class="px-4 py-3 text-left">Product</th>
                        <th class="px-4 py-3 text-left">Quantity</th>
                        <th class="px-4 py-3 text-left">Price</th>
                        <th class="px-4 py-3 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-[#E0F7F1] transition-colors">
                            <td class="px-4 py-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z" />
                                </svg>
                                {{ $item->product->name ?? 'Product removed' }}
                            </td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-3">${{ number_format($item->quantity * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
