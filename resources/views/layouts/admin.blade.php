<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="flex h-screen bg-[#DFF9F3] text-[#2E2E2E]">

    <!-- Sidebar -->
    <aside class="w-64 bg-white flex-shrink-0 rounded-r-3xl shadow-lg hidden md:flex flex-col">
        <div class="p-6 text-center font-bold text-xl border-b border-[#2ECCB0] text-[#2ECCB0]">Admin Panel</div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-[#2ECCB0]/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-[#2ECCB0]/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21l-8-8h16l-8 8z"/>
                </svg>
                Products
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-[#2ECCB0]/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                Categories
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-[#2ECCB0]/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-[#2ECCB0]/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-[#2ECCB0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A5 5 0 1116.88 6.196"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7"/>
                </svg>
                Users
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-[#FF6B6B]/20 transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#FF6B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Mobile sidebar toggle -->
    <div class="md:hidden fixed top-4 left-4">
        <button id="sidebar-toggle" class="p-2 bg-[#2ECCB0] text-white rounded-md focus:outline-none shadow-lg">☰</button>
    </div>

    <!-- Main content -->
    <div class="flex-1 overflow-auto p-6">
        @yield('content')
    </div>

    <script>
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('aside');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
