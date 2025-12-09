@extends('layouts.customer')

@section('content')

<div class="max-w-4xl mx-auto p-6 space-y-8 bg-[#DFF9F3] rounded-3xl shadow-md">

    <!-- Page Title -->
    <h1 class="text-3xl font-extrabold text-[#2ECCB0] flex items-center gap-2 mb-6">
        <!-- Cart Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2 3h2l3.6 9.59a2 2 0 001.87 1.29H17a2 2 0 001.92-1.46L21 6H6" />
            <circle cx="9" cy="20" r="1"/>
            <circle cx="17" cy="20" r="1"/>
        </svg>
        Your Cart
    </h1>

    @if(empty($cart))
        <p class="text-[#2E2E2E] text-lg font-medium">Your cart is empty.</p>
        <a href="{{ route('store.index') }}" class="text-[#2ECCB0] hover:underline mt-2 inline-block">
            Go Shopping →
        </a>
    @else

    <table class="w-full bg-white rounded-2xl shadow overflow-hidden">
        <thead class="bg-[#2ECCB0] text-white">
            <tr>
                <th class="px-4 py-3">Product</th>
                <th class="px-4 py-3">Price</th>
                <th class="px-4 py-3">Qty</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>

        <tbody class="text-[#2E2E2E]">
            @php $grandTotal = 0; @endphp

            @foreach($cart as $id => $item)
            @php $total = $item['price'] * $item['qty']; $grandTotal += $total; @endphp

            <tr class="border-b border-[#DFF9F3]">
                <td class="px-4 py-3 flex items-center gap-3">
                    @if($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                    @else
                        <span class="w-16 h-16 flex items-center justify-center bg-gray-200 text-gray-500 rounded-xl text-xs">No Image</span>
                    @endif
                    {{ $item['name'] }}
                </td>

                <td class="px-4 py-3 font-semibold">
                    ${{ number_format($item['price'],2) }}
                </td>

                <td class="px-4 py-3">
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                               class="w-16 px-2 py-1 rounded-xl border border-[#2ECCB0] text-[#2E2E2E] bg-[#DFF9F3]">
                        <button type="submit" class="bg-[#2ECCB0] hover:bg-[#27b79e] px-3 py-1 rounded-xl text-white font-medium shadow flex items-center gap-1">
                            <!-- Update Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6M20 20v-6h-6"/>
                            </svg>
                            Update
                        </button>
                    </form>
                </td>

                <td class="px-4 py-3 font-bold">$ {{ number_format($total, 2) }}</td>

                <td class="px-4 py-3">
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-xl text-white font-medium shadow flex items-center gap-1">
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

    <div class="text-right mt-6">
        <p class="text-2xl font-bold text-[#2E2E2E]">
            Grand Total: ${{ number_format($grandTotal, 2) }}
        </p>

        <a href="{{ route('checkout.index') }}"
           class="bg-[#2ECCB0] hover:bg-[#27b79e] px-6 py-3 rounded-2xl text-white font-semibold shadow-md mt-3 inline-flex items-center gap-2">
            <!-- Checkout Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-3-3v6m8-12v16a2 2 0 01-2 2H6a2 2 0 01-2-2V3a2 2 0 012-2h12a2 2 0 012 2z" />
            </svg>
            Proceed to Checkout
        </a>
    </div>

    @endif
</div>

@endsection
