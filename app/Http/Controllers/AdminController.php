<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
   public function index()
{
    $users = User::all();

    // Prepare orders data for the last 7 days
    $ordersData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->pluck('count', 'date')
        ->toArray();

    $dates = [];
    $values = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $dates[] = $date;
        $values[] = $ordersData[$date] ?? 0;
    }

    // Prepare revenue data for the last 7 days
    $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
        ->where('created_at', '>=', now()->subDays(6)->startOfDay())
        ->where('status', 'Completed')
        ->groupBy('date')
        ->pluck('total', 'date')
        ->toArray();

    $revenueDates = [];
    $revenueValues = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $revenueDates[] = $date;
        $revenueValues[] = $revenueData[$date] ?? 0;
    }

    return view('admin.dashboard', compact(
        'users', 'dates', 'values', 'revenueDates', 'revenueValues'
    ));
}

}
