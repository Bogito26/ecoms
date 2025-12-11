@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-8 bg-[#FFF3E0] rounded-3xl shadow-lg">

    <!-- Title -->
    <h2 class="text-3xl font-extrabold text-[#FF5722] flex items-center gap-2">
        <!-- Cart Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#FF5722]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2 3h2l3.6 9.59a2 2 0 001.87 1.29H17a2 2 0 001.92-1.46L21 6H6" />
            <circle cx="9" cy="20" r="1"></circle>
            <circle cx="17" cy="20" r="1"></circle>
        </svg>
        Your Cart
    </h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full text-left bg-white rounded-2xl overflow-hidden shadow-md">
            <thead class="bg-[#FF5722] text-white">
                <tr>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Subtotal</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>

            <tbody class="text-[#2E2E2E]">
                @php $total = 0; @endphp

                @foreach(session('cart') as $id => $item)
                    @php 
                        $subtotal = $item['price'] * $item['quantity']; 
                        $total += $subtotal; 
                    @endphp

                    <tr class="border-b border-[#FFECB3] hover:bg-[#FFF8E1] transition-colors">
                        <td class="px-4 py-3 flex items-center space-x-3">
                            @if($item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     class="h-14 w-14 object-cover rounded-2xl shadow-sm">
                            @else
                                <span class="h-14 w-14 flex items-center justify-center bg-gray-200 text-gray-500 rounded-2xl text-xs">No Image</span>
                            @endif
                            <span class="font-semibold">{{ $item['name'] }}</span>
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            ${{ number_format($item['price'], 2) }}
                        </td>

                        <td class="px-4 py-3">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="number"
                                       name="quantity"
                                       value="{{ $item['quantity'] }}"
                                       min="1"
                                       class="w-16 px-2 py-1 rounded-xl border border-[#FF5722] text-[#2E2E2E] bg-[#FFF3E0] focus:ring-2 focus:ring-[#FF5722] focus:border-transparent">
                                 
                                <button type="submit"
                                    class="bg-[#FF5722] hover:bg-[#E64A19] px-3 py-1 rounded-2xl text-white font-medium shadow transition transform hover:scale-105">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td class="px-4 py-3 font-semibold text-[#2E2E2E]">
                            ${{ number_format($subtotal, 2) }}
                        </td>

                        <td class="px-4 py-3">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-2xl text-white font-medium shadow flex items-center gap-1 transition transform hover:scale-105">
                                    <!-- Trash Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 7h12M9 7V4h6v3m2 0v13a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z" />
                                    </svg>
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

        <!-- TOTAL + CHECKOUT -->
        <div class="text-right mt-6">
            <p class="text-2xl font-bold text-[#2E2E2E]">
                Total: ${{ number_format($total, 2) }}
            </p>

            <a href="{{ route('checkout.index') }}"
               class="bg-[#FF5722] hover:bg-[#E64A19] px-6 py-3 rounded-2xl text-white font-semibold shadow-md mt-3 inline-flex items-center gap-2 transition transform hover:scale-105">
                <!-- Checkout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h6m-3-3v6m8-12v16a2 2 0 01-2 2H6a2 2 0 01-2-2V3a2 2 0 012-2h12a2 2 0 012 2z" />
                </svg>
                Proceed to Checkout
            </a>
        </div>

    @else
        <p class="text-[#2E2E2E] text-lg font-medium">Your cart is empty.</p>
        <a href="{{ route('store.index') }}" class="text-[#FF5722] hover:underline mt-2 inline-block font-semibold">
            Go Shopping →
        </a>
    @endif
</div>
@endsection
