<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //Show all orders for admin
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->get();

        return view('order.index', compact('orders'));
    }

    //Show orders for the authenticated user
    public function userOrders()
    {
        $user = Auth::user();

        $orders = Order::with('orderItems.product')
                        ->where('user_id', $user->id)
                        ->get();

        return view('order.show', compact('order'));
    }

    //Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:product,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Calculate total price of the order
        $totalPrice = 0;

        foreach ($request->items as $item) {
            $productPrice = Product::find($item['product_id'])->price;
            $totalPrice += $productPrice * $item['quantity'];
        }

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $totalPrice,
        ]);

        // Save order items
        foreach ($request->items as $item) {
            $productPrice = Product::find($item['product_id'])->price;

            Order_items::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity_to_purchase' => $item['quantity'],
                'price' => $productPrice,
                'total_item_price' => $productPrice * $item['quantity'],
            ]);
        }

        return redirect()->route('order.user_order')->with('success', 'Order placed successfully!');
    }

    // 4. Show a single order with its items
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('order.show', compact('order'));
    }

    // 5. Delete an order (admin only)
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Delete related order items
        $order->orderItems()->delete();

        // Delete the order
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully!');
    }
}
