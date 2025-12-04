<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\PayPalService;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('store.checkout', compact('cart'));
    }

    /**
     * Process customer checkout form
     */
    public function process(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->route('store.index')
                ->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'Pending',
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        // Save order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to PayPal
        return redirect()->route('checkout.paypal', $order->id);
    }

    /**
     * Create PayPal payment and redirect customer
     */
    public function payWithPayPal($orderId)
    {
        $order = Order::findOrFail($orderId);
        $paypal = new PayPalService();

        // Create PayPal Payment
        $approvalUrl = $paypal->createPayment($order);

        return redirect($approvalUrl);
    }

    /**
     * PayPal callback (after user approved payment)
     */
    public function handlePayPalCallback(Request $request)
    {
        $paypal = new PayPalService();
        $paymentStatus = $paypal->executePayment($request);

        if ($paymentStatus['success']) {

            $order = Order::find($paymentStatus['order_id']);

            if ($order) {
                $order->status = 'Processing';
                $order->save();
            }

            return redirect()->route('dashboard')
                ->with('success', 'Payment successful! Your order is now Processing.');
        }

        return redirect()->route('checkout.index')
            ->with('error', 'Payment failed or was canceled.');
    }
}
