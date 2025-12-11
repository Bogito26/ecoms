<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Niek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
      tailwind = window.tailwind || {}
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        shopee: {
                            DEFAULT: '#D85C20',       /* primary dark orange */
                            light: '#F36C21',         /* brighter */
                            bg: '#FFF4EB'             /* soft backdrop */
                        }
                    },
                    fontFamily: {
                        roboto: ['Roboto', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #F5F7FA; color: #2E2E2E; }
        .nav-btn:hover { background-color: rgba(216,92,32,0.08); color: #D85C20; }
        .logout-btn:hover { background-color: #ff6b6b; color: #fff; }
    </style>
</head>
<body class="flex flex-col min-h-screen">

<!-- HEADER -->
<header class="p-4 flex justify-between items-center bg-white shadow-sm sticky top-0 z-50">

    <!-- LEFT SIDE BRAND -->
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-10 h-10 rounded-full border-2 border-[#FFEFE6]">
        <h1 class="text-2xl font-bold tracking-wide text-[#2E2E2E]">Niek Shop</h1>
    </div>

    <!-- MOBILE MENU BUTTON -->
    <button id="menuBtn" class="md:hidden p-2">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-7 h-7 text-[#2E2E2E]"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <!-- NAV -->
    <nav id="mobileMenu"
         class="hidden md:flex flex-col md:flex-row absolute md:static top-16 left-0 w-full md:w-auto
                bg-white md:bg-transparent shadow md:shadow-none p-4 md:p-0 space-y-3 md:space-y-0 md:space-x-3">

        @auth
        <div class="flex flex-col md:flex-row gap-3 items-center">

            <!-- CART -->
            <a href="{{ route('cart.view') }}" class="relative nav-btn flex items-center gap-2 px-3 py-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 text-[#2E2E2E]"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                </svg>

                @php
                    $cart = session()->get('cart', []);
                    $count = count($cart);
                @endphp

                @if($count > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">
                    {{ $count }}
                </span>
                @endif
            </a>

<!-- PROFILE DROPDOWN -->
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#FFF4EB] transition">
        <img src="{{ auth()->user()->profile_picture ? asset('storage/profile_pictures/' . auth()->user()->profile_picture) : asset('default-avatar.png') }}"
             alt="avatar" class="w-8 h-8 rounded-full border-2 border-[#FFEFE6] object-cover">
        <span class="font-medium text-sm text-[#2E2E2E]">{{ auth()->user()->name }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition
         class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-50 overflow-hidden">
        
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-[#FFF4EB] text-[#2E2E2E] font-medium">
            Home
        </a>

        <a href="{{ route('store.index') }}" class="block px-4 py-2 hover:bg-[#FFF4EB] text-[#2E2E2E] font-medium">
            Shop
        </a>

        <a href="{{ route('contact.show') }}" class="block px-4 py-2 hover:bg-[#FFF4EB] text-[#2E2E2E] font-medium">
            Contact
        </a>

        <a href="{{ route('about') }}" class="block px-4 py-2 hover:bg-[#FFF4EB] text-[#2E2E2E] font-medium">
            About
        </a>

        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-[#FFF4EB] text-[#2E2E2E] font-medium">
            Edit Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-50 text-[#2E2E2E] font-medium">
                Logout
            </button>
        </form>
    </div>
</div>



            <!-- Optional small spacer -->
        </div>
        @endauth

        @guest
        <div class="flex flex-col md:flex-row gap-3">
            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-lg bg-[#D85C20] hover:bg-[#b14a1a] text-white font-semibold shadow text-sm transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-4 py-2 rounded-lg border-2 border-[#D85C20] text-[#D85C20] font-semibold hover:bg-[#FFF4EB] text-sm transition">
                Register
            </a>
        </div>
        @endguest

    </nav>
</header>

<!-- MAIN CONTENT -->
<main class="flex-1 p-6 max-w-5xl mx-auto w-full">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="p-4 text-center bg-white shadow-inner mt-auto">
    &copy; {{ date('Y') }} Niek Shop. ni Bayola.
</footer>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>
