@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h2 class="text-3xl font-bold text-[#2ECCB0] mb-6">Orders</h2>

    <!-- Data Visualization: Line/Trend Chart -->
    <div class="bg-[#DFF9F3] rounded-2xl p-6 shadow">
        <h3 class="text-xl font-semibold mb-4 text-[#2E2E2E]">Order Total Trend</h3>
        <canvas id="ordersTrendChart" height="150"></canvas>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto bg-[#DFF9F3] rounded-2xl shadow">
        <table class="min-w-full divide-y divide-[#2ECCB0]/40">
            <thead class="bg-[#2ECCB0] text-[#2E2E2E]/90 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Created At</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#2ECCB0]/40">
                @forelse($orders as $order)
                    <tr class="bg-[#FFFFFF] hover:bg-[#DFF9F3] transition">
                        <td class="p-3 text-[#2E2E2E]">{{ $order->id }}</td>
                        <td class="p-3 text-[#2E2E2E]">{{ $order->user->name }}</td>
                        <td class="p-3 text-green-600 font-semibold">${{ number_format($order->total, 2) }}</td>
                        <td class="p-3">
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-500 text-white',
                                    'Processing' => 'bg-blue-500 text-white',
                                    'Completed' => 'bg-green-500 text-white',
                                    'Cancelled' => 'bg-red-500 text-white',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded {{ $statusColors[$order->status] ?? 'bg-gray-500 text-white' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-3 text-[#2E2E2E]/80">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="bg-[#2ECCB0] hover:bg-[#26b696] text-[#2E2E2E] px-3 py-1 rounded shadow-sm transition">
                               View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-400">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('ordersTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($orders->pluck('created_at')->map(fn($date) => $date->format('M d'))),
            datasets: [{
                label: 'Order Total ($)',
                data: @json($orders->pluck('total')),
                fill: true,
                backgroundColor: 'rgba(46, 204, 176, 0.2)',
                borderColor: '#2ECCB0',
                tension: 0.3, // smooth curve like RSI
                pointBackgroundColor: '#2ECCB0',
                pointBorderColor: '#2ECCB0',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#2E2E2E' }
                },
                x: {
                    ticks: { color: '#2E2E2E' },
                    grid: { color: '#2ECCB0/20' }
                }
            }
        }
    });
});
</script>
@endsection
