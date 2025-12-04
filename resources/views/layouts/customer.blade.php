<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        nav a:hover, nav button:hover {
            color: #3b82f6;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">

<header class="bg-gray-800 text-white p-4 flex justify-between items-center shadow">
    <h1 class="text-2xl font-bold">Customer Dashboard</h1>

    <div class="flex items-center space-x-4">

        {{-- Cart button (only if logged in) --}}
        @auth
            <a href="{{ route('cart.view') }}" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7"/>
                </svg>

                @php
                    $cart = session()->get('cart', []);
                    $count = count($cart);
                @endphp

                @if($count > 0)
                <span class="absolute -top-2 -right-2 bg-green-600 text-white text-xs rounded-full px-1">
                    {{ $count }}
                </span>
                @endif
            </a>
        @endauth

        {{-- Login button (only for guests) --}}
        @guest
            <a href="{{ route('login') }}"
               class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white shadow transition">
                Login
            </a>
        @endguest

    </div>
</header>


{{-- NAVIGATION (only visible when logged in) --}}
@auth
<nav class="bg-gray-800 p-4 flex flex-wrap md:flex-nowrap space-x-4 shadow-inner">
    <a href="{{ route('dashboard') }}" class="font-semibold px-3 py-1 rounded hover:bg-gray-700 transition">Dashboard</a>
    <a href="{{ route('profile.edit') }}" class="font-semibold px-3 py-1 rounded hover:bg-gray-700 transition">Profile</a>
    <a href="{{ route('store.index') }}" class="font-semibold px-3 py-1 rounded hover:bg-gray-700 transition">Shop</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="font-semibold px-3 py-1 rounded hover:bg-gray-700 transition">
            Logout
        </button>
    </form>
</nav>
@endauth


<!-- MAIN CONTENT -->
<main class="flex-1 p-6">
    @yield('content')
</main>


<!-- FOOTER -->
<footer class="bg-gray-800 text-gray-400 p-4 text-center mt-auto">
    &copy; {{ date('Y') }} My Shop. All rights reserved.
</footer>

</body>
</html>
