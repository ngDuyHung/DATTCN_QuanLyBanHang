<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('brand_id', 'desc')->paginate(20);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'logo_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,category_id',
            'is_staff' => 'required|boolean',
        ]);

        $path = null;
        if ($request->hasFile('logo_url')) {
            $path = $request->file('logo_url')->store('logos', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'logo_url' => $path,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_staff' => $request->is_staff,
        ]);

        return redirect()->route('admin.brand.index')->with('success', 'Thêm thương hiệu thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $categories = Category::all();
        return view('admin.brand.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->brand_id . ',brand_id',
            'logo_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,category_id',
            'is_staff' => 'required|boolean',
        ]);

        $path = $brand->logo_url;
        if ($request->hasFile('logo_url')) {
            $path = $request->file('logo_url')->store('logos', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'logo_url' => $path,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_staff' => $request->is_staff,
        ]);

        return redirect()->route('admin.brand.edit', $brand->brand_id)
            ->with('success', 'Cập nhật thương hiệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brand.index')->with('success', 'Xóa thương hiệu thành công.');
    }
}
