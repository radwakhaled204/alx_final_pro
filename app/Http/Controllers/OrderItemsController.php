<?php

namespace App\Http\Controllers;

use App\Models\Order_items;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Update a single order item
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_to_purchase' => 'required|integer|min:1',
        ]);

        $orderItem = Order_items::findOrFail($id);

        // Update total price
        $orderItem->quantity_to_purchase = $request->quantity_to_purchase;
        $orderItem->total_item_price = $orderItem->price * $request->quantity_to_purchase;

        $orderItem->save();

        return redirect()->back()->with('success', 'Order item updated successfully!');
    }

    // Delete a single order item
    public function destroy($id)
    {
        $orderItem = Order_items::findOrFail($id);
        
        $orderItem->delete();

        return redirect()->back()->with('success', 'Order item deleted successfully!');
    }
}
