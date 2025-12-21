<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; // <-- Thêm thư viện Storage
use Illuminate\Support\Facades\DB; // <-- Thêm thư viện DB để dùng Transaction

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Khởi tạo query với Eager Loading
        $query = Product::with('category', 'brand');

        // Tìm kiếm theo tên hoặc SKU
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo thương hiệu
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Lọc theo trạng thái
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Lọc theo khoảng giá
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Sắp xếp và phân trang
        $products = $query->orderBy('created_at', 'desc')->paginate(20);

        // Lấy danh sách categories và brands cho dropdown
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.product.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate đầy đủ các trường
        $validated = $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string|max:500',
            'sale_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,category_id',
            'brand_id' => 'nullable|exists:brands,brand_id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'attr_key.*' => 'nullable|string',
            'attr_value.*' => 'nullable|string',
            'sort_order.*' => 'nullable|numeric',
            'sort_orders.*' => 'nullable|numeric',
            'main_img_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'total_attributes' => 'nullable|string|max:255',
        ]);

        //tạo slug
        $categorySlug = Category::find($request->category_id)?->slug;
        $brandSlug = Brand::find($request->brand_id)?->slug;
        $slug = $categorySlug . '-' . $brandSlug . '-' . strtolower($request->sku);

        // 2. Dùng Transaction để đảm bảo an toàn
        DB::beginTransaction();
        try {
            // 3. Tạo sản phẩm
            $product = Product::create($request->only([
                'sku',
                'name',
                'short_description',
                'sale_description',
                'description',
                'price',
                'cost_price',
                'weight',
                'is_active',
                'category_id',
                'total_attributes',
                'brand_id'
            ]));
             $product->slug = $slug;
            $product->save();
            // Lưu ảnh đại diện chính nếu có
            if ($request->hasFile('main_img_url')) {
                $path = $request->file('main_img_url')->store('products', 'public');
                $product->main_img_url = $path;
                $product->save();
            }
            // 4. Lưu ảnh
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $index => $img) {
                    $path = $img->store('products', 'public');
                    $product->images()->create([
                        'image_url' => $path,
                        'alt_text' => $product->name,
                        'sort_order' => $request->sort_orders[$index],
                    ]);
                }
            }

            // 5. Lưu thuộc tính
            if ($request->attr_key) {
                foreach ($request->attr_key as $index => $key) {
                    if (!empty($key) && isset($request->attr_value[$index])) { // Kiểm tra kỹ hơn
                        $product->attributes()->create([
                            'attr_key' => $key,
                            'attr_value' => $request->attr_value[$index] ?? '',
                            'sort_order' => $request->sort_order[$index] ?? '',
                        ]);
                    }
                }
            }

            DB::commit(); // Hoàn tất
            return redirect()->route('admin.product.create')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            return back()->withInput()->with('error', $e->getMessage()); // Dùng khi debug
            //return back()->withInput()->with('error', 'Đã xảy ra lỗi khi thêm sản phẩm.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('images', 'attributes', 'category', 'brand');
        
        // Nếu là AJAX request, trả về JSON
        if (request()->ajax()) {
            return response()->json([
                'product' => $product,
                'images' => $product->images,
                'attributes' => $product->attributes,
                'category_name' => $product->category->name ?? 'N/A',
                'brand_name' => $product->brand->name ?? 'N/A'
            ]);
        }
        
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product->load('images', 'attributes');
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate (giống 'store' nhưng 'unique' phải bỏ qua chính nó)
        $validated = $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->product_id . ',product_id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string|max:500',
            'sale_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,category_id',
            'brand_id' => 'nullable|exists:brands,brand_id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'main_img_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'total_attributes' => 'nullable|string|max:255',
            'attr_key.*' => 'nullable|string',
            'attr_value.*' => 'nullable|string',
            'sort_order.*' => 'nullable|numeric',
            'sort_orders.*' => 'nullable|numeric',
            'delete_images' => 'nullable|array', // Thêm validation cho ảnh cần xóa
            'delete_images.*' => 'integer|exists:product_images,image_id'
        ]);

        //tạo slug
        $categorySlug = Category::find($request->category_id)?->slug;
        $brandSlug = Brand::find($request->brand_id)?->slug;
        $slug = $categorySlug . '-' . $brandSlug . '-' . strtolower($request->sku);
        DB::beginTransaction();
        try {
            // Cập nhật thông tin chính (An toàn, không dùng $request->all())
            $product->update($request->only([
                'sku',
                'name',
                'short_description',
                'sale_description',
                'description',
                'price',
                'cost_price',
                'weight',
                'is_active',
                'category_id',
                'total_attributes',
                'brand_id'
            ]));

            $product->slug = $slug;
            $product->save();
            // Xử lý xóa ảnh cũ 
            if ($request->has('delete_images')) {
                foreach ($request->input('delete_images') as $imageId) {
                    $image = $product->images()->find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image_url);
                        $image->delete();
                    }
                }
            }

            //  Cập nhật sort_order cho ảnh cũ
            if ($request->has('sort_orders')) {
                foreach ($request->input('sort_orders') as $imageId => $order) {
                    $image = $product->images()->find($imageId);
                    if ($image) {
                        $image->sort_order = $order;
                        $image->save();
                    }
                }
            }

            // Cập nhật ảnh đại diện chính nếu có
            if ($request->hasFile('main_img_url')) {
                // Xóa ảnh cũ nếu có
                if ($product->main_img_url) {
                    Storage::disk('public')->delete($product->main_img_url);
                }
                $path = $request->file('main_img_url')->store('products', 'public');
                $product->main_img_url = $path;
                $product->save();
            }

            // 4. Thêm ảnh mới
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $img) {
                    $path = $img->store('products', 'public');
                    $product->images()->create([
                        'image_url' => $path,
                        'alt_text' => $product->name,
                        'sort_order' => $request->sort_orders[$index],
                    ]);
                }
            }

            // 5. Cập nhật thuộc tính (Xóa hết và tạo lại)
            $product->attributes()->delete(); // Xóa hết thuộc tính cũ
            if ($request->attr_key) {
                foreach ($request->attr_key as $index => $key) {
                    if (!empty($key) && isset($request->attr_value[$index])) {
                        $product->attributes()->create([ // Tạo lại
                            'attr_key' => $key,
                            'attr_value' => $request->attr_value[$index] ?? '',
                            'sort_order' => $request->sort_order[$index] ?? '',
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.product.edit', $product->product_id)->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // return back()->withInput()->with('error', $e->getMessage()); // Dùng khi debug
            return back()->withInput()->with('error', 'Đã xảy ra lỗi khi cập nhật.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            // LỖI CỦA BẠN: Phải xóa file ảnh trước
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_url);
            }

            // Xóa ảnh và thuộc tính trong DB (hoặc để foreign key 'onDelete('cascade')' tự xử lý)
            $product->images()->delete();
            $product->attributes()->delete();

            // Xóa sản phẩm
            $product->delete();

            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->with('error', 'Lỗi khi xóa sản phẩm.');
        }
    }

    /**
     * Change the status of the product.
     */
    public function changeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product) {
            $product->is_active = $request->is_active;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái sản phẩm.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm.'
        ], 404);
    }
}
