@extends('layouts.customer')

@section('content')

<h1 class="text-2xl font-bold mb-5">Your Cart</h1>

@if(empty($cart))
    <p class="text-gray-600">Your cart is empty.</p>
@else

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="border-b">
            <th class="px-4 py-2">Product</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Qty</th>
            <th class="px-4 py-2">Total</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @php $grandTotal = 0; @endphp

        @foreach($cart as $id => $item)
        @php $total = $item['price'] * $item['qty']; $grandTotal += $total; @endphp

        <tr class="border-b">
            <td class="px-4 py-2 flex items-center gap-3">
                <img src="{{ asset('storage/' . $item['image']) }}"
                     class="w-16 h-16 rounded object-cover">
                {{ $item['name'] }}
            </td>

            <td class="px-4 py-2">₱{{ number_format($item['price'],2) }}</td>

            <td class="px-4 py-2">
                <form action="{{ route('cart.update', $id) }}" method="POST">
                    @csrf
                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                        class="w-16 border px-2 py-1">
                    <button class="bg-green-600 text-white px-2 py-1 rounded ml-2">Update</button>
                </form>
            </td>

            <td class="px-4 py-2 font-bold">₱{{ number_format($total, 2) }}</td>

            <td class="px-4 py-2">
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    <button class="bg-red-600 text-white px-3 py-1 rounded">Remove</button>
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

<div class="text-right mt-4">
    <h2 class="text-xl font-bold">Grand Total: ₱{{ number_format($grandTotal, 2) }}</h2>

    <a href="{{ route('checkout.index') }}"
       class="bg-blue-600 text-white px-6 py-2 rounded mt-3 inline-block hover:bg-blue-700">
        Proceed to Checkout
    </a>
</div>

@endif

@endsection
