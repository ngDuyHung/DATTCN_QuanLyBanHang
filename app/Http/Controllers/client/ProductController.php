<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
        $Product = Product::with('category', 'brand')->findOrFail($id);
        //dd($Product->description); nay để debug thôi
        //lấy những sản phẩm có cùng thương hiệu cùng loại
        $relatedProducts = Product::where('brand_id', $Product->brand_id)
            ->where('category_id', $Product->category_id)
            ->get();

        return view('client.product', compact('Product', 'relatedProducts'));
    }

    public function showBySlug(string $slug)
    {
        $part = explode('-', $slug);
        if (count($part) > 3) {
            return redirect()->route('home');
        }
        $categrorySlug = $part[0] ?? null;
        $brandSlug = $part[1] ?? null;
        $productSlug = $part[2] ?? null;

        if ($productSlug) {
            $Product = Product::with('category', 'brand')->where('slug', $slug)->first();
            if (!$Product) {
                return redirect()->route('home');
            }
            //dd($Product); //nay để debug thôi
            //lấy những sản phẩm có cùng thương hiệu cùng loại
            $relatedProducts = Product::where('brand_id', $Product->brand_id)
                ->where('category_id', $Product->category_id)
                ->get();

            return view('client.product', compact('Product', 'relatedProducts'));
        } else if ($brandSlug) {
            //tìm theo brand slug
            $brand = Brand::where('slug', $brandSlug)->first();
            if (!$brand) {
                return redirect()->route('home');
            }
            $name=$brand->category->name.' '.$brand->name;
            $products = Product::where('brand_id', $brand->brand_id)->get();
            return view('client.showBySlug', compact('brand', 'products', 'name'));
        } else if ($categrorySlug) {
            //tìm theo category slug
            $category = Category::where('slug', $categrorySlug)->first();
            if (!$category) {
                return redirect()->route('home');
            }
            $name=$category->name;
            $products = Product::where('category_id', $category->category_id)->get();
            return view('client.showBySlug', compact('category', 'products', 'name'));
        } else {
            return redirect()->route('home');
        }
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
