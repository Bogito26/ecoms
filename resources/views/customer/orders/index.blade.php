@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h2 class="text-3xl font-bold text-green-400 mb-6">Your Orders</h2>

    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-gray-800 text-gray-100 rounded">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="px-4 py-2">Order ID</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $order->id }}</td>
                            <td class="px-4 py-2">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-2">{{ $order->status }}</td>
                            <td class="px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                   class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                   View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-300">You have no orders yet.</p>
    @endif

</div>
@endsection
