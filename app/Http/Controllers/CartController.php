<?php
#CartController By Radwa Khaled 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
class CartController extends Controller
{
    // public function index()
    // {
    //     $cart = Cart::with('items.product')->get(); 
    //     return view('cart.index', compact('cart'));
    // }
    public function index()

    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
        return view('cart.index', compact('cart'));
    }

    public function showCart()
    {
        // Assuming you have a Cart model and it's associated with the authenticated user
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        // Pass the cart data to the view
        return view('welcome', compact('cart'));
    }




    // public function welcome()
    // {
    //     $cart = Cart::with('items.product')->get(); 
    //     return view('welcome', compact('cart'));
    // }

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
    public function confirmOrder()
    {
        
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
    
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'No cart found!');
        }
    
        // calculate total price
        $totalPrice = $cart->items->sum(function ($item) {
            return $item->quantity_to_purchase * $item->product->price;
        });
    
       
        $user = Auth::user();
    
       
        return view('order.confirm', compact('cart', 'totalPrice', 'user'));
    }

  

    public function placeOrder(Request $request)
    {
        
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
    
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'No cart found!');
        }
    
        // check if is_processed = 0
        if ($cart->is_processed) {
            $products = Product::with('images')->get();
            return view('welcome', compact('products'));
        }
    
        //  deducting inventory quantities
        foreach ($cart->items as $item) {
            $product = $item->product;
            $product->inventory -= $item->quantity_to_purchase;
            $product->save();
        }
    
      
        $cart->is_processed = true;
        $cart->delete(); // Delete the cart 
        $cart->items()->delete(); // Delete the cart items 

        // Redirect to welcome
        $products = Product::with('images')->get();
        return redirect()->route('products.welcome')->with('success', 'Order placed successfully!');

        
     
  
    }
    
    

    

}
