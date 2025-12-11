@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-4 space-y-6">

    <!-- Order Title -->
    <h2 class="text-2xl font-bold text-[#D85C20] mb-2">Order #{{ $order->id }}</h2>

    <!-- Customer Info -->
    <div class="bg-[#FFF4EB] text-[#2E2E2E] shadow rounded-xl p-4">
        <h3 class="text-lg font-semibold mb-3 text-[#D85C20]">Customer Info</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
            <p><span class="font-semibold">Name:</span> {{ $order->user->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $order->user->email }}</p>
            <p><span class="font-semibold">Created:</span> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <p><span class="font-semibold">Status:</span> <span class="font-semibold text-[#D85C20]">{{ $order->status }}</span></p>
        </div>
    </div>

    <!-- Items Table -->
    <div class="bg-[#FFF4EB] shadow rounded-xl p-4 overflow-x-auto">
        <h3 class="text-lg font-semibold mb-3 text-[#D85C20]">Items</h3>
        <table class="min-w-full text-sm">
            <thead class="bg-[#D85C20] text-white">
                <tr>
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2 text-left">Qty</th>
                    <th class="p-2 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr class="border-b border-[#D85C20]/30 hover:bg-[#FFE4D1] transition">
                    <td class="p-2">{{ $item->product->name }}</td>
                    <td class="p-2">{{ $item->quantity }}</td>
                    <td class="p-2 font-semibold text-[#D85C20]">${{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Update Status -->
    <div class="bg-[#FFF4EB] shadow rounded-xl p-4">
        <h3 class="text-lg font-semibold mb-3 text-[#D85C20]">Update Status</h3>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex flex-wrap items-center gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="p-2 rounded-lg border border-[#D85C20] focus:ring-2 focus:ring-[#D85C20] text-sm">
                @foreach(['Pending','Processing','Completed','Cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-[#D85C20] hover:bg-[#b14a1a] text-white px-4 py-2 rounded-lg shadow text-sm transition">
                Update
            </button>
        </form>
    </div>

</div>
@endsection
