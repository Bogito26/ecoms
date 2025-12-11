<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { 
            theme: {
                extend: {
                    colors: {
                        shopeeOrange: '#F36C21',
                        shopeeOrangeLight: '#FF7F3F',
                        shopeeOrangeBg: '#FFF2E6'
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="flex h-screen bg-shopeeOrangeBg font-poppins text-gray-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-shopeeOrange flex-shrink-0 md:flex flex-col text-white">
        
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 ">
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Products
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Categories
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Users
            </a>
            <a href="{{ route('admin.messages.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Messages
            </a>
            <button onclick="window.print()" class="flex items-center px-4 py-2 rounded-lg hover:bg-shopeeOrangeLight transition">
                Print
            </button>
        </nav>
    </aside>

    <!-- Mobile sidebar toggle -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button id="sidebar-toggle" class="p-2 bg-shopeeOrange text-white rounded-md focus:outline-none shadow-lg">☰</button>
    </div>

    <!-- Main content wrapper -->
    <div class="flex-1 flex flex-col overflow-auto">

        <!-- Top Navbar -->
        <header class="flex justify-between items-center p-4 bg-white shadow-md -b-3xl">
            <h1 class="text-2xl font-bold text-shopeeOrange">Admin Dashboard</h1>

            <!-- Profile dropdown -->
            <div class="relative">
                <button id="profile-btn" class="flex items-center gap-2 focus:outline-none">

              <img src="{{ asset('profile/profile.jpg') }}"
                  alt="Profile Picture"
                    class="w-24 h-24 mx-auto rounded-full object-cover">             
                    <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 hover:bg-shopeeOrangeBg transition">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100 transition">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('aside');
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('hidden'));

        const profileBtn = document.getElementById('profile-btn');
        const profileDropdown = document.getElementById('profile-dropdown');
        profileBtn.addEventListener('click', () => profileDropdown.classList.toggle('hidden'));

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
