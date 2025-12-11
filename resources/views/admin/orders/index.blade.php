@extends('layouts.admin')

@section('content')

<!-- Orders Table -->
<div class="overflow-x-auto bg-[#FFF4EB] rounded-2xl shadow-lg">
    <table class="min-w-full divide-y divide-[#D85C20]/30">
        <thead class="bg-[#D85C20] text-white uppercase text-sm">
            <tr>
                <th class="p-2 text-left">ID</th>
                <th class="p-2 text-left">Customer</th>
                <th class="p-2 text-left">Total</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Created At</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#D85C20]/30 text-sm">
            @forelse($orders as $order)
                <tr class="bg-white hover:bg-[#FFE4D1] transition">
                    <td class="p-2 font-medium text-[#2E2E2E]">{{ $order->id }}</td>
                    <td class="p-2 text-[#2E2E2E]">{{ $order->user->name }}</td>
                    <td class="p-2 text-[#D85C20] font-semibold">${{ number_format($order->total, 2) }}</td>
                    <td class="p-2">
                        @php
                            $statusColors = [
                                'Pending' => 'bg-yellow-400 text-white',
                                'Processing' => 'bg-blue-500 text-white',
                                'Completed' => 'bg-green-500 text-white',
                                'Cancelled' => 'bg-red-500 text-white',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs rounded {{ $statusColors[$order->status] ?? 'bg-gray-400 text-white' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-2 text-[#2E2E2E]/80">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2 flex space-x-1">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-2 py-1 rounded text-xs shadow-sm transition">
                           View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-400">No orders yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
