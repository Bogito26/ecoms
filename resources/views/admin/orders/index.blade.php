@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-3xl font-bold text-gray-100 mb-6">Orders</h2>

    <div class="overflow-x-auto bg-gray-800 rounded shadow">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700 text-gray-200 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Created At</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($orders as $order)
                    <tr class="bg-gray-800 hover:bg-gray-700 transition">
                        <td class="p-3 text-gray-200">{{ $order->id }}</td>
                        <td class="p-3 text-gray-200">{{ $order->user->name }}</td>
                        <td class="p-3 text-green-400 font-semibold">${{ number_format($order->total, 2) }}</td>
                        <td class="p-3">
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-500 text-white',
                                    'Processing' => 'bg-blue-500 text-white',
                                    'Completed' => 'bg-green-500 text-white',
                                    'Cancelled' => 'bg-red-500 text-white',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded {{ $statusColors[$order->status] ?? 'bg-gray-500 text-white' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-3 text-gray-300">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow-sm transition">
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
</div>
@endsection
