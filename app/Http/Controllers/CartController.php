<?php
#CartController By Radwa Khaled 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->get(); 
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'total_quantity' => 0,
            'total_price' => 0,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart created successfully!');
    }

    public function updateCartTotals($cartId)
    {
        $cart = Cart::with('items.product')->find($cartId); 

        
        $totalQuantity = $cart->items->sum('quantity_to_purchase');
        $totalPrice = $cart->items->sum('total_item_price');

        $cart->update([
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
        ]);
    }
}
