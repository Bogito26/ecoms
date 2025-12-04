@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h2 class="text-3xl font-bold text-white mb-6">Checkout</h2>

    @if(session('cart') && count(session('cart')) > 0)

        <div class="bg-gray-800 p-6 rounded-xl shadow space-y-4">

            {{-- Cart Items --}}
            @foreach(session('cart') as $id => $details)
                <div class="flex justify-between items-center p-3 bg-gray-700 rounded">
                    <div class="flex items-center space-x-4">
                        @if(isset($details['image']))
                            <img src="{{ asset('storage/'.$details['image']) }}"
                                 class="w-16 h-16 object-cover rounded">
                        @endif

                        <span class="text-white">{{ $details['name'] }}</span>
                    </div>

                    <span class="text-green-400 font-bold">${{ $details['price'] }}</span>
                    <span class="text-gray-300">Qty: {{ $details['quantity'] }}</span>
                </div>
            @endforeach


            {{-- Checkout Form --}}
            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4 mt-4">
                @csrf

                <input type="text" name="name"
                       placeholder="Full Name"
                       class="w-full p-2 rounded bg-gray-700 text-white"
                       required>

                <input type="text" name="phone"
                       placeholder="Phone Number"
                       class="w-full p-2 rounded bg-gray-700 text-white"
                       required>

                <textarea name="address"
                          placeholder="Delivery Address"
                          class="w-full p-2 rounded bg-gray-700 text-white"
                          required></textarea>

                <button type="submit"
                        class="bg-green-600 px-4 py-2 rounded hover:bg-green-700 text-white w-full text-center">
                    Place Order & Proceed to PayPal
                </button>
            </form>

        </div>

    @else
        <p class="text-gray-300">Your cart is empty.</p>
    @endif

</div>
@endsection
