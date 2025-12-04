@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    <h2 class="text-3xl font-bold text-green-400 mb-6">Order #{{ $order->id }}</h2>

    <div class="bg-gray-800 p-6 rounded-xl shadow space-y-4">
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
        <p><strong>Placed on:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
    </div>

    <div class="mt-6">
        <h3 class="text-2xl font-semibold text-white mb-4">Order Items</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-gray-800 text-gray-100 rounded">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $item->product->name ?? 'Product removed' }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2">${{ number_format($item->quantity * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
