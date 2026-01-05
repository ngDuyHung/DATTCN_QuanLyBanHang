<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_attribute;
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


    // Hàm bổ trợ để xử lý Query sắp xếp
    private function applySorting($query, $sortType)
    {
        switch ($sortType) {
            case 'name_asc':
                return $query->orderBy('name', 'asc');
            case 'name_desc':
                return $query->orderBy('name', 'desc');
            case 'price_asc':
                return $query->orderBy('price', 'asc');
            case 'price_desc':
                return $query->orderBy('price', 'desc');
            case 'newest':
                return $query->orderBy('created_at', 'desc');
            default:
                return $query->orderBy('created_at', 'asc');
        }
    }

    public function showBySlug(Request $request, string $slug)
    {
        $part = explode('-', $slug);
        if (count($part) > 3) {
            return redirect()->route('home');
        }

        $categrorySlug = $part[0] ?? null;
        $brandSlug = $part[1] ?? null;
        $productSlug = $part[2] ?? null;

        // 1. Trường hợp là Trang chi tiết Sản phẩm 
        if ($productSlug) {
            $Product = Product::with('category', 'brand')->where('slug', $slug)->first();
            if (!$Product) return redirect()->route('home');

            $relatedProducts = Product::where('brand_id', $Product->brand_id)
                ->where('category_id', $Product->category_id)
                ->limit(5)->get();

            return view('client.product', compact('Product', 'relatedProducts'));
        }


        $query = Product::query()->with(['category', 'brand'])->where('is_active', 1);
        $brand = null;
        $category = null;

        if ($brandSlug) {
            // Nếu URL có brand slug (ví dụ: laptop-dell)
            $brand = Brand::where('slug', $brandSlug)->firstOrFail();
            $query->where('brand_id', $brand->brand_id);
            $name = ($brand->category->name ?? '') . ' ' . $brand->name;
        } else if ($categrorySlug) {
            // Nếu URL chỉ có category slug (ví dụ: laptop)
            $category = Category::where('slug', $categrorySlug)->firstOrFail();
            $query->where('category_id', $category->category_id);
            $name = $category->name;
        } else {
            return redirect()->route('home');
        }

        //Lấy danh sách các thuộc tính (RAM, Màu...) để hiện lên Form lọc
        // lấy tất cả thuộc tính của những sản phẩm đang hiển thị
        $filterAttributes = Product_attribute::whereIn('product_id', (clone $query)->select('product_id'))
            ->get()
            ->groupBy('attr_key');

        if ($request->filled('attrs')) {
            foreach ($request->attrs as $key => $value) {
                if ($value != null) {
                    // Lọc những sản phẩm có thuộc tính khớp với lựa chọn
                    $query->whereHas('attributes', function ($q) use ($key, $value) {
                        $q->where('attr_key', $key)->where('attr_value', $value);
                    });
                }
            }
        }

        //Lọc từ form
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->status == 'sale') {
            $query->whereColumn('price', '<', 'cost_price');
        }

        //nhận và áp dụng sắp xếp
        $products = $this->applySorting($query, $request->query('sort'))->get();

        return view('client.showBySlug', compact('products', 'name', 'brand', 'category', 'filterAttributes'));
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
