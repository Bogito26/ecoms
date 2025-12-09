<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mint Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FFFFFF;
            color: #2E2E2E;
        }

        .icon {
            width: 1.5rem;
            height: 1.5rem;
            color: #2ECCB0;
        }

        .cart-badge {
            background-color: #2ECCB0;
            color: #FFFFFF;
            font-size: 0.65rem;
            font-weight: bold;
            border-radius: 50%;
            padding: 0.15rem 0.4rem;
            position: absolute;
            top: -0.4rem;
            right: -0.4rem;
        }

        .nav-btn {
            background-color: transparent;
            color: #2E2E2E;
            transition: 0.2s;
        }

        .nav-btn:hover {
            background-color: #DFF9F3;
            color: #2ECCB0;
        }

        .logout-btn:hover {
            background-color: #ff6b6b;
            color: #fff;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

<!-- HEADER -->
<!-- HEADER -->
<!-- HEADER -->
<header class="p-4 flex justify-between items-center bg-white shadow-sm sticky top-0 z-50">
    <h1 class="text-2xl font-bold tracking-wide flex items-center space-x-2 text-[#2E2E2E]">

        <!-- Calendar Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-7 h-7 text-[#2ECCB0]" 
             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M8 7V3m8 4V3m-8 4h8M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
        </svg>

        Mint shop
    </h1>
      <nav class="flex items-center gap-2">
    <div class="flex items-center space-x-4">

        @auth

        <!-- CART ICON -->
        <a href="{{ route('cart.view') }}" class="relative hover:scale-110 transition nav-btn flex items-center gap-1 px-3 py-2 rounded-lg"> 
            
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-7 h-7 text-[#2E2E2E]"
                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7" />
            </svg>
My cart
            @php
                $cart = session()->get('cart', []);
                $count = count($cart);
            @endphp

            @if($count > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                {{ $count }}
            </span>
            @endif
            
        </a>
                
        <!-- NAV -->
  

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="nav-btn flex items-center gap-1 px-3 py-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                </svg>
                Dashboard
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" class="nav-btn flex items-center gap-1 px-3 py-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A9 9 0 1116.88 6.195M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Profile
            </a>

            <!-- Shop -->
            <a href="{{ route('store.index') }}" class="nav-btn flex items-center gap-1 px-3 py-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 001 1.3h12.1a1 1 0 001-1.3L17 13M7 13V6h10v7" />
                </svg>
                Shop
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="logout-btn flex items-center gap-1 px-3 py-2 rounded-lg font-semibold transition">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </form>

        </nav>
        @endauth


        <!-- IF NOT LOGGED IN -->

        @guest
        <nav class="flex items-center gap-2">

            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-lg bg-[#2ECCB0] text-white font-semibold shadow hover:bg-[#27b79e] transition flex items-center gap-2">
                
                <!-- Login Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5" 
                     fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12H3m12 0l-4-4m4 4l-4 4m6-9V5a2 2 0 00-2-2h-7" />
                </svg>

                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-4 py-2 rounded-lg border-2 border-[#2ECCB0] text-[#2ECCB0] font-semibold hover:bg-[#DFF9F3] transition flex items-center gap-2">

                <!-- Register Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M12 4v16m8-8H4" />
                </svg>

                Register
            </a>

        </nav>
        @endguest

    </div>
</header>



<!-- MAIN CONTENT -->
<main class="flex-1 p-6 bg-[#DFF9F3]">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="p-4 text-center mt-auto shadow-inner bg-white text-[#2E2E2E]">
    &copy; {{ date('Y') }} Mint Shop ni Daniel. Calm & Modern UI.
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
