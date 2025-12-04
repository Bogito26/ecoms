@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    <h2 class="text-2xl font-bold mb-4 text-white">Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full text-left bg-gray-800 rounded-xl text-white overflow-hidden">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Subtotal</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2 flex items-center space-x-2">
                            @if($item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="h-12 w-12 object-cover rounded">
                            @else
                                <span class="h-12 w-12 flex items-center justify-center bg-gray-600 text-gray-300 rounded text-xs">No Image</span>
                            @endif
                            <span>{{ $item['name'] }}</span>
                        </td>
                        <td class="px-4 py-2">${{ number_format($item['price'], 2) }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                       class="w-16 px-2 py-1 rounded text-black mr-2">
                                <button type="submit" class="bg-green-600 px-3 py-1 rounded hover:bg-green-700">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2">${{ number_format($subtotal, 2) }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4">
            <p class="text-xl font-bold text-white">Total: ${{ number_format($total, 2) }}</p>
            <a href="{{ route('checkout.index') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded mt-2 inline-block">
                Proceed to Checkout
            </a>
        </div>
    @else
        <p class="text-gray-300">Your cart is empty.</p>
        <a href="{{ route('store.index') }}" class="text-green-400 hover:underline mt-2 inline-block">Go Shopping →</a>
    @endif
</div>
@endsection
