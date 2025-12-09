@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6 bg-white rounded-lg shadow-sm">

    <!-- Page Title -->
    <h2 class="text-3xl font-bold text-[#2ECCB0] mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#2ECCB0" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        Your Orders
    </h2>

    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-[#DFF9F3] text-[#2E2E2E] rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-[#2ECCB0] text-white">
                        <th class="px-4 py-3 text-left">Order ID</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-[#E0F7F1] transition-colors">
                            <td class="px-4 py-3 font-medium">#{{ $order->id }}</td>
                            <td class="px-4 py-3">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-sm font-semibold
                                    {{ $order->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                    {{ $order->status === 'Completed' ? 'bg-green-200 text-green-800' : '' }}
                                    {{ $order->status === 'Cancelled' ? 'bg-red-200 text-red-800' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                   class="inline-flex items-center gap-1 bg-[#2ECCB0] text-white px-4 py-2 rounded-lg shadow hover:bg-[#28b39e] transition">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                   </svg>
                                   View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-[#2E2E2E] text-center py-6">You have no orders yet.</p>
    @endif

</div>
@endsection
