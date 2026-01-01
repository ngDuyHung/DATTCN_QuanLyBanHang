<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Chỉ yêu cầu đăng nhập với các chức năng quản lý
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy', 'dashboard']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands = Brand::orderBy('brand_id', 'desc')->take(5)->get();
        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        $LaptopBrands = Brand::where('category_id', Category::where('slug', 'laptop')->first()->category_id)
            ->orderBy('brand_id', 'desc')
            ->take(5)
            ->get();
        $productLaptops = Product::where('category_id', Category::where('slug', 'laptop')->first()->category_id)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $PCBrands = Brand::where('category_id', Category::where('slug', 'pcmaybo')->first()->category_id)
            ->orderBy('brand_id', 'desc')
            ->take(5)
            ->get();
        $productPCs = Product::where('category_id', Category::where('slug', 'pcmaybo')->first()->category_id)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $RamBrands = Brand::where('category_id', Category::where('slug', 'ram')->first()->category_id)
            ->orderBy('brand_id', 'desc')
            ->take(5)
            ->get();
        $productRams = Product::where('category_id', Category::where('slug', 'ram')->first()->category_id)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $home = true;
        return view('client.home', compact('brands', 'products', 'home', 'LaptopBrands', 'PCBrands', 'productLaptops', 'productPCs', 'RamBrands', 'productRams'));
    }

    public function dashboard()
    {
        // Thống kê cơ bản
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('total_amount');
        $totalCustomers = User::count();

        // Đơn hàng mới nhất
        $recentOrders = Order::with('user')->orderBy('placed_at', 'desc')->take(5)->get();

        // Sản phẩm sắp hết hàng
        $lowStockProducts = Inventory::with('product')
            ->whereColumn('quantity_in_stock', '<=', 'min_alert_quantity')
            ->orderBy('quantity_in_stock', 'asc')
            ->take(5)
            ->get();

        // Thống kê doanh thu theo tháng (cho biểu đồ) - 7 tháng gần nhất
        $monthlyRevenue = Order::select(
            DB::raw('YEAR(placed_at) as year'),
            DB::raw('MONTH(placed_at) as month'),
            DB::raw('SUM(total_amount) as total'),
            DB::raw('COUNT(*) as order_count')
        )
            ->where('placed_at', '>=', now()->subMonths(7))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Thống kê cho progress bar
        $ordersCompleted = Order::where('status', 'completed')->count();
        $ordersPending = Order::where('status', 'pending')->count();
        $ordersCancelled = Order::where('status', 'cancelled')->count();
        $productsActive = Product::where('is_active', 1)->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalRevenue',
            'totalCustomers',
            'recentOrders',
            'lowStockProducts',
            'monthlyRevenue',
            'ordersCompleted',
            'ordersPending',
            'ordersCancelled',
            'productsActive'
        ));
    }
}
