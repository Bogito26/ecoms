@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<style>
    :root {
        --shopee-orange: #FF6700;
        --shopee-orange-light: #FF8A3D;
        --text-dark: #2E2E2E;
        --text-gray: #6B6B6B;
    }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 bg-[#FFF6F0] text-[var(--text-dark)]">

    <!-- PROFILE HEADER -->
    <div class="flex items-center justify-between mb-6" data-aos="fade-down">

        <div class="flex items-center gap-3">
            <img src="{{ auth()->user()->profile_picture ? asset('storage/profile_pictures/' . auth()->user()->profile_picture) : asset('default-avatar.png') }}"
                alt="Profile" 
                class="w-14 h-14 rounded-full object-cover border-2 border-[var(--shopee-orange)]">

            <div>
                <h2 class="font-bold text-lg">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-[var(--text-gray)]">{{ auth()->user()->email }}</p>
            </div>
        </div>

       
    </div>

    <!-- SMALLER DASHBOARD CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">

        @php
            $cards = [
                ['title'=>'Orders','route'=>route('customer.orders.index'), 'icon'=>'M3 7h18M3 12h18M3 17h18'],
                ['title'=>'Account','route'=>route('profile.edit'), 'icon'=>'M12 12a4 4 0 100-8 4 4 0 000 8z M6 20v-1c0-2.5 3-4 6-4s6 1.5 6 4v1'],
                ['title'=>'Shop','route'=>route('store.index'), 'icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4'],
            ];
        @endphp

        @foreach($cards as $index => $card)
        <a href="{{ $card['route'] }}"
            class="bg-white border border-[var(--shopee-orange-light)] p-4 rounded-xl shadow hover:shadow-md transition flex flex-col gap-2"
            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[var(--shopee-orange)]"
                    fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                </svg>

                <h3 class="text-lg font-bold">{{ $card['title'] }}</h3>
            </div>

            <p class="text-[var(--text-gray)] text-sm">Tap to view →</p>
        </a>
        @endforeach
    </div>

    <!-- PRODUCTS -->
    <div class="mt-10">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl sm:text-2xl font-bold">New Products</h2>

            <a href="{{ route('store.index') }}"
                class="text-[var(--shopee-orange)] font-semibold text-sm hover:underline">
                View All →
            </a>
        </div>

        <!-- PRODUCT LIST -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">

            @forelse(\App\Models\Product::latest()->get() as $product)
            <div class="bg-white rounded-xl border border-[var(--shopee-orange-light)] shadow hover:shadow-lg transition"
                data-aos="zoom-in">

                <!-- IMAGE -->
                <div class="h-40 sm:h-48 overflow-hidden rounded-t-xl">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="object-cover w-full h-full hover:scale-105 transition duration-300">
                    @else
                        <div class="flex items-center justify-center h-full text-[var(--shopee-orange)]">No Image</div>
                    @endif
                </div>

                <!-- INFO -->
                <div class="p-3 space-y-1">
                    <p class="font-semibold text-sm line-clamp-1">{{ $product->name }}</p>
                    <p class="text-[var(--text-gray)] text-xs">{{ $product->category->name ?? 'Uncategorized' }}</p>

                    <p class="font-bold text-[var(--shopee-orange)] text-base">
                        ₱{{ number_format($product->price, 2) }}
                    </p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="w-full bg-[var(--shopee-orange)] hover:bg-[var(--shopee-orange-light)] text-white py-1.5 rounded-lg text-xs font-semibold mt-2 transition">
                            Add to Cart
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <p class="col-span-4 text-center text-sm text-[var(--text-gray)]">No products found.</p>
            @endforelse

        </div>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
@endsection
