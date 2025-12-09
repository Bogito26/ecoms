<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the logged-in user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.orders.show', compact('order'));
    }

    // Cancel Order Method
    public function cancel(Order $order)
    {
        // Ensure the order belongs to the logged-in user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow cancellation if the order is pending
        if ($order->status !== 'Pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        $order->status = 'Cancelled';
        $order->save();

        return back()->with('success', 'Order has been cancelled.');
    }
}
