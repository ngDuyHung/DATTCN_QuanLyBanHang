<?php

namespace App\Http\Controllers\admin;

use App\Models\Product_attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $product_attributes = Product_attribute::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.product_attribute.index', compact('product_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'attr_key' => 'required|string|max:255',
            'attr_value' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        Product_attribute::create($validated);
        return redirect()->route('admin.product_attribute.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product_attribute $product_attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_attribute $product_attribute)
    {
        return view('admin.product_attribute.edit', compact('product_attribute'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_attribute $product_attribute)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'attr_key' => 'required|string|max:255',
            'attr_value' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        $product_attribute->update($validated);
        return redirect()->route('admin.product_attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_attribute $product_attribute)
    {
        $product_attribute->delete();
        return redirect()->route('admin.product_attribute.index');
    }
}
