@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}</h1>

    <!-- Quick stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gray-700 p-6 rounded-lg shadow hover:bg-gray-600 transition">
            <h2 class="text-xl font-semibold mb-2">Products</h2>
            <p class="text-gray-300 text-2xl font-bold">{{ \App\Models\Product::count() }}</p>
            <a href="{{ route('admin.products.index') }}" class="text-blue-400 hover:underline mt-2 inline-block">Manage Products</a>
        </div>

        <div class="bg-gray-700 p-6 rounded-lg shadow hover:bg-gray-600 transition">
            <h2 class="text-xl font-semibold mb-2">Categories</h2>
            <p class="text-gray-300 text-2xl font-bold">{{ \App\Models\Category::count() }}</p>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-400 hover:underline mt-2 inline-block">Manage Categories</a>
        </div>

        <div class="bg-gray-700 p-6 rounded-lg shadow hover:bg-gray-600 transition">
            <h2 class="text-xl font-semibold mb-2">Orders</h2>
            <p class="text-gray-300 text-2xl font-bold">{{ \App\Models\Order::count() ?? 0 }}</p>
            <a href="#" class="text-blue-400 hover:underline mt-2 inline-block">Manage Orders</a>
        </div>

        <div class="bg-gray-700 p-6 rounded-lg shadow hover:bg-gray-600 transition">
            <h2 class="text-xl font-semibold mb-2">Users</h2>
            <p class="text-gray-300 text-2xl font-bold">{{ \App\Models\User::count() }}</p>
            <a href="#" class="text-blue-400 hover:underline mt-2 inline-block">Manage Users</a>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Recent Products</h2>
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-gray-800 text-gray-100 rounded">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Stock</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Product::latest()->take(5)->get() as $product)
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">${{ $product->price }}</td>
                        <td class="px-4 py-2">{{ $product->stock }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700" onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Orders Bar Chart -->
    <div class="bg-gray-800 p-6 rounded-lg shadow mt-10 w-full md:w-3/4 lg:w-2/3 h-64 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Orders Last 7 Days</h2>
        <canvas id="ordersBarChart" height="150"></canvas>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('ordersBarChart').getContext('2d');

    const labels = @json($dates);
    const data = @json($values);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders',
                data: data,
                backgroundColor: '#36A2EB',
                borderColor: '#1E3A8A',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true, precision: 0 }
            }
        }
    });
});
</script>

@endsection
