@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- Order Title -->
    <h2 class="text-3xl font-bold text-[#2ECCB0] mb-4">Order #{{ $order->id }}</h2>

    <!-- Customer Info -->
    <div class="bg-[#DFF9F3] text-[#2E2E2E] shadow-md rounded-2xl p-6">
        <h3 class="text-xl font-semibold mb-4">Customer Info</h3>
        <p><span class="font-semibold">Name:</span> {{ $order->user->name }}</p>
        <p><span class="font-semibold">Email:</span> {{ $order->user->email }}</p>
        <p><span class="font-semibold">Created At:</span> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><span class="font-semibold">Status:</span> <span class="text-[#2ECCB0] font-semibold">{{ $order->status }}</span></p>
    </div>

    <!-- Items Table -->
    <div class="bg-[#DFF9F3] text-[#2E2E2E] shadow-md rounded-2xl p-6">
        <h3 class="text-xl font-semibold mb-4">Items</h3>
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-[#2ECCB0] text-[#2E2E2E]">
                <tr>
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr class="border-b border-[#2ECCB0]">
                        <td class="p-3">{{ $item->product->name }}</td>
                        <td class="p-3">{{ $item->quantity }}</td>
                        <td class="p-3 font-semibold">${{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Update Status -->
    <div class="bg-[#DFF9F3] text-[#2E2E2E] shadow-md rounded-2xl p-6">
        <h3 class="text-xl font-semibold mb-4">Update Status</h3>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex flex-wrap items-center gap-3">
            @csrf
            @method('PUT')
            <select name="status" class="p-2 rounded-lg border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0]">
                @foreach(['Pending','Processing','Completed','Cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] font-semibold px-6 py-2 rounded-lg shadow transition">
                Update
            </button>
        </form>
    </div>

</div>
@endsection
