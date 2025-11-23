<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands=Brand::orderBy('brand_id','desc')->take(5)->get();
        $products=Product::orderBy('created_at','desc')->take(8)->get();
        return view('client.home', compact('brands', 'products'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
