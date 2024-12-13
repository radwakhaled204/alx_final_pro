<?php
#CartItemsController By Radwa Khaled 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;

class CartItemsController extends Controller
{
    public function store(Request $request)
    {
        
        $cart = Cart::firstOrCreate(
            ['user_id' => $request->user_id],
            ['total_quantity' => 0, 'total_price' => 0]
        );
    
        
        $product = Product::find($request->product_id);
    
        
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity_to_purchase' => $request->quantity_to_purchase,
            'price' => $product->price,
            'total_item_price' => $product->price * $request->quantity_to_purchase,
        ]);
    
        
        app(CartController::class)->updateCartTotals($cart->id);
    
        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully!');
    }
    
    

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update([
            'quantity_to_purchase' => $request->quantity_to_purchase,
            'total_item_price' => $cartItem->price * $request->quantity_to_purchase,
        ]);

       
        app(CartController::class)->updateCartTotals($cartItem->cart_id);

        return redirect()->route('cart.index')->with('success', 'Item updated successfully!');
    }

    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartId = $cartItem->cart_id;

        $cartItem->delete();

       
        app(CartController::class)->updateCartTotals($cartId);

        return redirect()->route('cart.index')->with('success', 'Item removed successfully!');
    }
}
