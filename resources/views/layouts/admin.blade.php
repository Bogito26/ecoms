<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Enable dark mode via Tailwind
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>
<body class="flex h-screen bg-gray-900 text-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 flex-shrink-0 dark:bg-gray-900 hidden md:flex flex-col">
        <div class="p-6 text-center font-bold text-xl border-b border-gray-700">Admin Panel</div>
        <nav class="flex-1 px-4 py-6 space-y-2">
           <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>

<a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Products</a>

<a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Categories</a>

<a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Orders</a>

<a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Users</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-700">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Mobile sidebar toggle -->
    <div class="md:hidden fixed top-4 left-4">
        <button id="sidebar-toggle" class="p-2 bg-gray-700 rounded-md focus:outline-none">☰</button>
    </div>

    <!-- Main content -->
    <div class="flex-1 overflow-auto p-6">
        @yield('content')
    </div>

    <script>
        // Toggle sidebar on mobile
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('aside');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
