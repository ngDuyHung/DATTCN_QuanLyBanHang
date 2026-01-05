<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        Category::create($request->all());
        return redirect()->route('admin.category.create')->with('success', 'Thêm danh mục thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->loadCount('products');
        
        // Nếu là AJAX request, trả về JSON
        if (request()->ajax()) {
            return response()->json([
                'category' => $category,
                'products_count' => $category->products_count ?? 0
            ]);
        }
        
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->category_id  . ',category_id',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        $category->update($request->all());
        return redirect()->route('admin.category.edit', $category->category_id)->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công.');
    }

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->category_id);
        if ($category) {
            $category->is_active = $request->is_active;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái danh mục.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy danh mục.'
        ], 404);
    }
}
