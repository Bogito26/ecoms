@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-12 bg-[#DFF9F3] text-[#2E2E2E] relative">

    <!-- WELCOME HEADER -->
    <div class="flex items-center justify-center sm:justify-between gap-4 sm:gap-0 flex-wrap sm:flex-nowrap" data-aos="fade-down">
        <div class="flex items-center gap-3">
          
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#2ECCB0] tracking-wide">
        
            </h2>
        </div>
        <a href="{{ route('cart.view') }}" class="flex items-center gap-2 bg-[#2ECCB0] text-white px-4 py-2 rounded-xl shadow hover:bg-[#27b79e] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
            </svg>
            Cart
        </a>
    </div>

    <!-- DASHBOARD CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @php
            $cards = [
                ['title'=>'Your Orders','icon'=>'M3 7h18M3 12h18M3 17h18','route'=>route('customer.orders.index'),'desc'=>'View and manage your orders.'],
                ['title'=>'Your Profile','icon'=>'M12 12c2.28 0 4-1.72 4-4s-1.72-4-4-4-4 1.72-4 4 1.72 4 4 4zm6 8v-1c0-2.76-3.58-5-6-5s-6 2.24-6 5v1','route'=>route('profile.edit'),'desc'=>'Update your personal information.'],
                ['title'=>'Shop','icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13m-6 0V6h10v7','route'=>route('store.index'),'desc'=>'Browse products and add to your cart.']
            ];
        @endphp

        @foreach($cards as $index => $card)
        <div class="bg-white p-6 rounded-3xl border border-[#2ECCB0]/40 shadow-[0_0_18px_rgba(46,204,176,0.2)] hover:shadow-[0_0_35px_rgba(46,204,176,0.6)] hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <div class="flex items-center gap-3 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                </svg>
                <h3 class="text-lg sm:text-xl font-bold text-[#2E2E2E]">{{ $card['title'] }}</h3>
            </div>
            <p class="text-[#6B6B6B] text-sm sm:text-base">{{ $card['desc'] }}</p>
            <a href="{{ $card['route'] }}" class="text-[#2ECCB0] font-semibold hover:underline mt-3 sm:mt-4 inline-block">
                See All →
            </a>
        </div>
        @endforeach
    </div>

    <!-- PRODUCTS GRID -->
    <div class="mt-10 sm:mt-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#2E2E2E]" data-aos="fade-right">Available Products</h2>
            <a href="{{ route('store.index') }}" class="text-[#2ECCB0] font-semibold hover:underline hidden sm:inline-block">See All →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            @forelse(\App\Models\Product::latest()->get() as $product)
            <div class="bg-white rounded-3xl border border-[#2ECCB0]/40 shadow-[0_0_15px_rgba(46,204,176,0.15)] hover:shadow-[0_0_30px_rgba(46,204,176,0.5)] hover:-translate-y-1 transition-all duration-300 overflow-hidden relative" data-aos="zoom-in">

                <!-- Product Image -->
                <div class="h-48 sm:h-52 w-full overflow-hidden flex items-center justify-center bg-white relative group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="object-cover h-full w-full rounded-2xl transition-transform duration-300 group-hover:scale-105">
                    @else
                        <span class="text-[#2ECCB0]">No Image</span>
                    @endif

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-opacity rounded-2xl">
                        <a href="{{ route('store.show', $product->id) }}" class="bg-[#2ECCB0] text-white px-3 py-2 rounded-2xl font-semibold flex items-center gap-2 hover:bg-[#27b79e] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m12 0l-4-4m4 4l-4 4m6-9V5a2 2 0 00-2-2h-7" />
                            </svg>
                            View
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="bg-[#2ECCB0] text-white px-3 py-2 rounded-2xl font-semibold flex items-center gap-2 hover:bg-[#27b79e] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                                </svg>
                                Add
                            </button>
                        </form>
                    </div>

                    <!-- Badge -->
                    <div class="absolute top-3 left-3 bg-[#2ECCB0] text-white px-2 py-1 rounded-lg text-xs font-bold shadow flex items-center gap-1">
                        New
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                        </svg>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-4 sm:p-5 space-y-1 sm:space-y-2">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#2E2E2E]">{{ $product->name }}</h3>
                    <p class="text-[#6B6B6B] text-sm sm:text-base">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <p class="text-[#2E2E2E] font-bold text-lg sm:text-xl flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 1v2m0 18v2m4-20a4 4 0 00-8 0m8 20a4 4 0 00-8 0M8 7h8M8 17h8"/>
                        </svg>
                        ${{ number_format($product->price, 2) }}
                    </p>
                </div>
            </div>
            @empty
            <p class="text-[#6B6B6B] col-span-4 text-center text-base sm:text-lg">No products available.</p>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
