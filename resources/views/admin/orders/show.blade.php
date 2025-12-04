@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- Order Title -->
    <h2 class="text-3xl font-bold text-green-700 mb-4">Order #{{ $order->id }}</h2>

    <!-- Customer Info -->
    <div class="bg-gray-800 text-white shadow rounded p-6">
        <h3 class="text-xl font-semibold mb-4">Customer Info</h3>
        <p><span class="font-semibold">Name:</span> {{ $order->user->name }}</p>
        <p><span class="font-semibold">Email:</span> {{ $order->user->email }}</p>
        <p><span class="font-semibold">Created At:</span> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><span class="font-semibold">Status:</span> <span class="text-green-400">{{ $order->status }}</span></p>
    </div>

    <!-- Items Table -->
    <div class="bg-gray-800 text-white shadow rounded p-6">
        <h3 class="text-xl font-semibold mb-4">Items</h3>
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr class="border-b border-gray-700">
                        <td class="p-3">{{ $item->product->name }}</td>
                        <td class="p-3">{{ $item->quantity }}</td>
                        <td class="p-3">${{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Update Status -->
    <div class="bg-gray-800 text-white shadow rounded p-6">
        <h3 class="text-xl font-semibold mb-4">Update Status</h3>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center space-x-2">
            @csrf
            @method('PUT')
            <select name="status" class="p-2 rounded bg-gray-700 text-white border border-gray-600">
                @foreach(['Pending','Processing','Completed','Cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-green-600 px-4 py-2 rounded hover:bg-green-700 text-white">Update</button>
        </form>
    </div>

</div>
@endsection
