<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Product = Product::with('category','brand')->findOrFail($id);
        //dd($Product->description); nay để debug thôi
        //lấy những sản phẩm có cùng thương hiệu cùng loại
        $relatedProducts = Product::where('brand_id', $Product->brand_id)
                                  ->where('category_id', $Product->category_id)
                                  ->get();

        return view('client.product',compact('Product', 'relatedProducts'));
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
