@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    <!-- Title -->
    <h1 class="text-3xl font-bold mb-6 text-[#2ECCB0] animate-fadeIn">Welcome, {{ auth()->user()->name }}</h1>

    <!-- Ring Charts for Key Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @php
            $ringStats = [
                ['title'=>'Products','count'=>\App\Models\Product::count(),'color'=>'#2ECCB0'],
                ['title'=>'Categories','count'=>\App\Models\Category::count(),'color'=>'#FFB547'],
                ['title'=>'Orders','count'=>\App\Models\Order::count(),'color'=>'#FF6B6B'],
                ['title'=>'Users','count'=>\App\Models\User::count(),'color'=>'#6B5BFF']
            ];
        @endphp

        @foreach($ringStats as $index => $stat)
        <div class="bg-white p-6 rounded-2xl shadow flex flex-col items-center transform hover:scale-105 transition-transform duration-300">
            <canvas id="ringChart{{ $index }}" class="mb-4" width="120" height="120"></canvas>
            <h2 class="text-lg font-semibold text-[#2E2E2E]">{{ $stat['title'] }}</h2>
            <p class="text-2xl font-bold text-[#1F1F1F] mt-1">{{ $stat['count'] }}</p>
        </div>
        @endforeach

    </div>

    <!-- Analytics Charts: Orders & Revenue -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

        <!-- Orders Chart -->
        <div class="bg-white p-6 rounded-2xl shadow animate-fadeInUp">
            <h2 class="text-2xl font-bold mb-4 text-[#2E2E2E]">Orders Last 7 Days</h2>
            <canvas id="ordersBarChart" height="180"></canvas>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white p-6 rounded-2xl shadow animate-fadeInUp delay-150">
            <h2 class="text-2xl font-bold mb-4 text-[#2E2E2E]">Revenue Last 7 Days (USD)</h2>
            <canvas id="revenueChart" height="180"></canvas>
        </div>

    </div>

    <!-- Recent Products Table -->
    <div class="mt-10 animate-fadeInUp delay-300">
        <h2 class="text-2xl font-bold mb-4 text-[#2E2E2E]">Recent Products</h2>
        <div class="overflow-x-auto rounded-2xl shadow">
            <table class="w-full table-auto bg-white text-[#2E2E2E] rounded-2xl">
                <thead>
                    <tr class="border-b border-[#2ECCB0]/40">
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Category</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Stock</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Product::latest()->take(5)->get() as $product)
                    <tr class="border-b border-[#2ECCB0]/20 hover:bg-[#DFF9F3]/50 transition-all duration-300">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">${{ number_format($product->price,2) }}</td>
                        <td class="px-4 py-2">{{ $product->stock }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="bg-[#FCFF4B] px-3 py-1 rounded hover:bg-[#E5E600] transition">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 transition" onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Ring Charts for summary stats with animation
    @foreach($ringStats as $index => $stat)
    new Chart(document.getElementById('ringChart{{ $index }}'), {
        type: 'doughnut',
        data: {
            labels: ['{{ $stat["title"] }}', 'Remaining'],
            datasets: [{
                data: [{{ $stat["count"] }}, 1000 - {{ $stat["count"] }}],
                backgroundColor: ['{{ $stat["color"] }}', '#E5E5E5'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { display: false } },
            responsive: true,
            animation: { animateRotate: true, duration: 1500 }
        }
    });
    @endforeach

    // Orders Bar Chart with animation
    new Chart(document.getElementById('ordersBarChart'), {
        type: 'bar',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Orders',
                data: @json($values),
                backgroundColor: '#2ECCB0',
                borderColor: '#27b79e',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
            scales: { y: { beginAtZero: true, precision: 0 }, x: { grid: { display: false } } },
            animation: { duration: 1500, easing: 'easeOutQuart' }
        }
    });

    // Revenue Line Chart (USD) with animation
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: @json($revenueDates),
            datasets: [{
                label: 'Revenue',
                data: @json($revenueValues),
                backgroundColor: 'rgba(46,204,176,0.2)',
                borderColor: '#2ECCB0',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2ECCB0',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: function(value){ return '$' + value.toLocaleString(); } }
                },
                x: { grid: { display: false } }
            },
            animation: { duration: 1800, easing: 'easeOutQuart' }
        }
    });

});
</script>

<!-- Tailwind animations -->
<style>
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
.animate-fadeInUp { animation: fadeIn 0.8s ease-out forwards; }
.animate-fadeInUp.delay-150 { animation-delay: 0.15s; }
.animate-fadeInUp.delay-300 { animation-delay: 0.3s; }
</style>
@endsection
