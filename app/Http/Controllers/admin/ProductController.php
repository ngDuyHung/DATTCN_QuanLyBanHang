<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage; // <-- Thêm thư viện Storage
use Illuminate\Support\Facades\DB; // <-- Thêm thư viện DB để dùng Transaction
use Illuminate\Support\Facades\Log;

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
            $query->where(function ($q) use ($search) {
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
        // Nếu có category_id thì chỉ lấy brand thuộc category đó 
        if ($request->filled('category_id')) {
            $brands = Brand::where('category_id', $request->category_id)
                ->orderBy('name')
                ->get();
        } else {
            $brands = Brand::orderBy('name')->get();
        }

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
            $productId = $product->product_id;
            return redirect()->route('admin.inventory.create')->with('success', 'Thêm sản phẩm thành công, Bây giờ hãy thêm số lượng vào kho.')->with('productId', $productId);
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

        //Kiểm tra tất cả các giỏ hàng có sản phẩm này không

        //lấy tất cả giỏ hàng có sản phẩm này
        $cart = DB::table('cart_items')->where('product_id', $product->product_id);

        $cartItemsCount = $cart->count();
        if ($cartItemsCount > 0) {
            return redirect()->route('admin.product.index')->with('error', 'Đã có đơn hàng đang được đặt với sản phẩm KHÔNG THỂ XÓA..');
        }


        //lấy tất cả đơn hàng có sản phẩm này
        $orderItems = DB::table('order_items')->where('product_id', $product->product_id);
        //nếu sản phẩm đã có trong đơn hàng có trang thái chưa hoàn thành thì không được xóa
        $incompleteOrdersCount = $orderItems->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->whereIn('orders.status', ['pending', 'processing', 'on-hold']) //các trạng thái chưa hoàn thành
            ->count();
        if ($incompleteOrdersCount > 0) {
            return redirect()->route('admin.product.index')->with('error', 'Đã có đơn hàng đang được đặt với sản phẩm KHÔNG THỂ XÓA.');
        }

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

    /**
     * Get brands by category for AJAX request.
     */
    public function getAjaxBrandsByCategory($category_id)
    {
        if ($category_id == 0) {
            $brands = Brand::orderBy('name')->get();
        } else {
            $brands = Brand::where('category_id', $category_id)
                ->orderBy('name')
                ->get();
        }
        return response()->json($brands);
    }

    /**
     * Generate random sample products data.
     */
    public function generateSampleData(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1|max:100'
            ]);

            $quantity = $validated['quantity'];

            // Lấy tất cả categories và brands từ database
            $categories = Category::all();
            $brands = Brand::all();

            if ($categories->isEmpty()) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng tạo ít nhất một danh mục trước.'
                    ], 400);
                }
                return back()->with('error', 'Vui lòng tạo ít nhất một danh mục trước.');
            }

            if ($brands->isEmpty()) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng tạo ít nhất một thương hiệu trước.'
                    ], 400);
                }
                return back()->with('error', 'Vui lòng tạo ít nhất một thương hiệu trước.');
            }

            $sampleNames = [
                // Laptops
                'Dữ liệu mẫu ThinkPad E14',
                'Dữ liệu mẫu ThinkPad T15',
                'Dữ liệu mẫu Lenovo IdeaPad 5',
                'Dữ liệu mẫu Lenovo Legion 5',
                'Dữ liệu mẫu ASUS VivoBook 15',
                'Dữ liệu mẫu ASUS TUF Gaming F15',
                'Dữ liệu mẫu MSI GF63 Thin',
                'Dữ liệu mẫu MSI Creator M17',
                'Dữ liệu mẫu HP Pavilion 15',
                'Dữ liệu mẫu HP Envy 13',
                'Dữ liệu mẫu Acer Aspire 5',
                'Dữ liệu mẫu Acer Nitro 5',

                // Desktop PCs
                'Dữ liệu mẫu PC Văn Phòng Core i5',
                'Dữ liệu mẫu PC Văn Phòng Core i7',
                'Dữ liệu mẫu PC Gaming RTX 3060',
                'Dữ liệu mẫu PC Gaming RTX 4070',
                'Dữ liệu mẫu PC Đồ Họa Render Workstation',
                'Dữ liệu mẫu PC Nhỏ Gọn Mini ITX',

                // Components
                'Dữ liệu mẫu RAM Kingston 8GB DDR4',
                'Dữ liệu mẫu RAM Corsair 16GB DDR4',
                'Dữ liệu mẫu RAM G.Skill 32GB DDR4',
                'Dữ liệu mẫu SSD Kingston 256GB NVMe',
                'Dữ liệu mẫu SSD Corsair 512GB NVMe',
                'Dữ liệu mẫu SSD Samsung 1TB',
                'Dữ liệu mẫu RTX 3060 12GB',
                'Dữ liệu mẫu RTX 4080 16GB',
                'Dữ liệu mẫu RX 7900 XT 24GB',

                // Peripherals
                'Dữ liệu mẫu Mechanical Keyboard RGB',
                'Dữ liệu mẫu Gaming Mouse DPI 16000',
                'Dữ liệu mẫu Wireless Headset 7.1',
                'Dữ liệu mẫu Monitor 24\" 144Hz',
                'Dữ liệu mẫu Monitor 27\" 4K',
                'Dữ liệu mẫu Gaming Chair',
                'Dữ liệu mẫu Laptop Cooling Pad',
                'Dữ liệu mẫu Power Supply 650W 80+',
                'Dữ liệu mẫu CPU Cooler'
            ];

            $descriptions = [
                'Thiết bị máy tính chất lượng cao, hiệu suất mạnh mẽ.',
                'Phù hợp cho công việc văn phòng và gaming.',
                'Hiệu năng vượt trội, thiết kế hiện đại.',
                'Bảo hành 24 tháng, hỗ trợ kỹ thuật miễn phí.',
                'Công nghệ mới nhất, đáng tin cậy.',
                'Tương thích với các hệ thống phổ biến.',
                'Giá cạnh tranh, chất lượng đảm bảo.',
                'Được nhiều chuyên gia lựa chọn.'
            ];

            DB::beginTransaction();

            $createdCount = 0;

            for ($i = 0; $i < $quantity; $i++) {
                // Chọn random category
                $category = $categories->random();

                // Lấy brands thuộc category này
                $categoryBrands = $brands->filter(function ($b) use ($category) {
                    return $b->category_id == $category->category_id;
                });

                // Chọn random brand từ category, nếu không có thì chọn từ tất cả
                if ($categoryBrands->isNotEmpty()) {
                    $brand = $categoryBrands->random();
                } else {
                    $brand = $brands->random();
                }

                // Lấy hình ảnh từ các sản phẩm có cùng category và brand
                $existingProducts = Product::where('category_id', $category->category_id)
                    ->where('brand_id', $brand->brand_id)
                    ->whereNotNull('main_img_url')
                    ->get();

                $mainImgUrl = null;

                // Nếu có sản phẩm cùng category + brand, lấy hình từ đó
                if ($existingProducts->isNotEmpty()) {
                    $randomProduct = $existingProducts->random();
                    $mainImgUrl = $randomProduct->main_img_url;
                } else {
                    // Nếu không có, lấy random từ tất cả sản phẩm có hình
                    $allProductsWithImage = Product::whereNotNull('main_img_url')->get();
                    if ($allProductsWithImage->isNotEmpty()) {
                        $randomProduct = $allProductsWithImage->random();
                        $mainImgUrl = $randomProduct->main_img_url;
                    }
                }

                $productName = $sampleNames[array_rand($sampleNames)];

                // Tạo SKU unique với timestamp và random
                $timestamp = microtime(true) * 10000;
                $randomNum = rand(1000, 9999);
                $sku = strtoupper('SKU' . substr($timestamp, -8) . $randomNum);

                // Kiểm tra SKU exists (an toàn)
                if (Product::where('sku', $sku)->exists()) {
                    continue;
                }
                $slugProduct = $brand->slug . '-' . $category->slug . '-' . strtolower($sku);
                $product = Product::create([
                    'sku' => $sku,
                    'name' => $productName . ' - ' . uniqid(),
                    'slug' => $slugProduct,
                    'short_description' => $descriptions[array_rand($descriptions)],
                    'description' => '<p>' . $descriptions[array_rand($descriptions)] . '</p>',
                    'sale_description' => 'Khuyến mại đặc biệt: Giảm 15% cho đơn hàng trong tuần.',
                    'price' => rand(3000000, 50000000), // Từ 3 triệu đến 50 triệu
                    'cost_price' => rand(2000000, 40000000), // Giá vốn thấp hơn
                    'weight' => rand(500, 5000), // Từ 500g đến 5kg
                    'is_active' => 1,
                    'category_id' => $category->category_id,
                    'brand_id' => $brand->brand_id,
                    'main_img_url' => $mainImgUrl,
                    'total_attributes' => 0
                ]);

                //Tạo hình ảnh phụ nếu có hình đại diện chính
                if ($mainImgUrl) {
                    for ($j = 0; $j < rand(1, 3); $j++) {
                        $product->images()->create([
                            'image_url' => $mainImgUrl,
                            'alt_text' => $product->name . ' - Image ' . ($j + 1),
                            'sort_order' => $j + 1
                        ]);
                    }
                }

                // Tạo inventory record
                Inventory::create([
                    'product_id' => $product->product_id,
                    'location' => 'Kho chính #' . rand(1, 5),
                    'quantity_in_stock' => rand(5, 100),
                    'min_alert_quantity' => rand(2, 10)
                ]);

                // Tạo một số thuộc tính ngẫu nhiên phù hợp với thiết bị máy tính
                $attributeKeys = ['Thông số kỹ thuật', 'Bộ nhớ', 'Lưu trữ', 'Màu sắc', 'Bảo hành', 'Loại sản phẩm'];
                $attributeValues = [
                    'Thông số kỹ thuật' => ['Intel Core i5', 'Intel Core i7', 'Intel Core i9', 'AMD Ryzen 5', 'AMD Ryzen 7', 'AMD Ryzen 9'],
                    'Bộ nhớ' => ['8GB DDR4', '16GB DDR4', '32GB DDR4', '64GB DDR5', '8GB GDDR6', '12GB GDDR6'],
                    'Lưu trữ' => ['256GB SSD', '512GB SSD', '1TB SSD', '2TB SSD', '4TB SSD', 'Dual Storage'],
                    'Màu sắc' => ['Đen', 'Bạc', 'Xám', 'Trắng', 'Đỏ', 'Xanh'],
                    'Bảo hành' => ['12 tháng', '24 tháng', '36 tháng', '5 năm', 'Trọn đời'],
                    'Loại sản phẩm' => ['Laptop', 'Desktop', 'Component', 'Peripheral', 'Workstation', 'Gaming Rig']
                ];

                $selectedAttributes = array_rand($attributeKeys, rand(2, 4));
                if (!is_array($selectedAttributes)) {
                    $selectedAttributes = [$selectedAttributes];
                }

                foreach ($selectedAttributes as $attrIndex) {
                    $key = $attributeKeys[$attrIndex];
                    $values = $attributeValues[$key];
                    $product->attributes()->create([
                        'attr_key' => $key,
                        'attr_value' => $values[array_rand($values)],
                        'sort_order' => 0
                    ]);
                }

                $createdCount++;
            }

            DB::commit();

            $message = "Đã tạo thành công $createdCount sản phẩm mẫu!";
            Log::info($message);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'created_count' => $createdCount
                ]);
            }

            return back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMsg = implode(', ', $e->errors()['quantity'] ?? ['Dữ liệu không hợp lệ']);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi xác thực: ' . $errorMsg
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi tạo dữ liệu mẫu: ' . $e->getMessage() . '\n' . $e->getTraceAsString());

            $errorMsg = 'Lỗi: ' . $e->getMessage();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 500);
            }

            return back()->with('error', $errorMsg);
        }
    }
}
