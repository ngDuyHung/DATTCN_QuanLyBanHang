<?php

namespace App\Http\Controllers\admin;

use App\Models\Product_image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_images = Product_image::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.product_image.index', compact('product_images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image_url')->store('product_images', 'public');

        Product_image::create([
            'product_id' => $validated['product_id'],
            'image_url' => $path,
            'alt_text' => $validated['alt_text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? null,
        ]);

        return redirect()->route('admin.product_image.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product_image $product_image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_image $product_image)
    {
        return view('admin.product_image.edit', compact('product_image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_image $product_image)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('product_images', 'public');
            $product_image->image_url = $path;
        }

        $product_image->product_id = $validated['product_id'];
        $product_image->alt_text = $validated['alt_text'] ?? null;
        $product_image->sort_order = $validated['sort_order'] ?? null;
        $product_image->save();

        return redirect()->route('admin.product_image.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_image $product_image)
    {
        $product_image->delete();
        return redirect()->route('admin.product_image.index');
    }
}
