<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories')); // Ensure you pass the collection to the view
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        return view('categories.show', compact('category')); // Pass the single category instance
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $image = $request->file('image');
        $image_name = date('YmDHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/categories'), $image_name);
        Category::create([
            'name' => $request->name,
            'image' => $image_name
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $category=Category::find($id);
    //     return view('categories.show',compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'category not found.');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;

        // Check if an image is being uploaded
        if ($request->hasFile('image')) {
            // If there is a new image, upload it and update the field
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/categories'), $imageName);
            $category->image = $imageName;
        }

        // Update the category
        $category->save();
        return redirect()->route('categories.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        // Delete all products associated with the category
        foreach ($category->products as $product) {
            // Delete all images associated with the product
            foreach ($product->images as $image) {
                // Delete the physical image file
                $imagePath = public_path('upload/products/' . $image->image_name);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                // Delete the image record from the database
                $image->delete();
            }

            // Delete the product
            $product->delete();
        }

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category and associated products deleted successfully.');
    }
}
