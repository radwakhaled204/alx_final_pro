<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\product_image;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load images for each product
        $products = Product::with('images')->get();
        return view('products.index', compact('products'));
    }

    public function welcome()
    {
        $products = Product::with('images')->where('inventory', '>', 0)->get(); // جلب المنتجات ذات المخزون الأكبر من 0 فقط

        return view('welcome', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'inventory' => 'required|integer|min:0'
        ]);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'inventory' => $request->inventory
        ]);

        // Handle multiple image uploads
        $images = $request->file('images');
        foreach ($images as $image) {
            $image_name = date('YmDHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/products'), $image_name);

            // Save the image details
            product_image::create([
                'image_name' => $image_name, // corrected to 'image_name'
                'product_id' => $product->id
            ]);
        }

        return redirect()->route('products.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by ID with its associated images
        $product = Product::with('images')->find($id);

        // Check if the product does not exists
        if (!$product) {
            return redirect()->route('welcome')->with('error', 'Product not found.');
        }

        // Return the product detail view
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('products.edit', compact('product'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'inventory' => 'required|integer|min:0', 
        ]);
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'inventory' => $request->inventory
        ]);
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        // Delete associated images
        foreach ($product->images as $image) {
            // Delete the physical image file if it exists
            $imagePath = public_path('upload/products/' . $image->image_name);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete the image record from the database
            $image->delete();
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product and its images deleted successfully.');
    }
}
