<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventorys = Inventory::with('product')->orderBy('last_updated', 'desc')->paginate(20);
        return view('admin.inventory.index', compact('inventorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', 1)->get();
        return view('admin.inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id|unique:inventory,product_id',
            'quantity_in_stock' => 'required|integer|min:0',
            'min_alert_quantity' => 'required|integer|min:0',
        ],[
            'product_id.required' => 'Sản phẩm là bắt buộc.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'product_id.unique' => 'Sản phẩm đã có trong kho.',
            'quantity_in_stock.required' => 'Số lượng trong kho là bắt buộc.',
            'quantity_in_stock.min' => 'Số lượng trong kho phải lớn hơn hoặc bằng 0.',
            'min_alert_quantity.required' => 'Số lượng cảnh báo tối thiểu là bắt buộc.',
            'min_alert_quantity.min' => 'Số lượng cảnh báo tối thiểu phải lớn hơn hoặc bằng 0.',
        ]);

        $inventory = Inventory::create([
            'product_id' => $validated['product_id'],
            'quantity_in_stock' => $validated['quantity_in_stock'],
            'min_alert_quantity' => $validated['min_alert_quantity'],
            'last_updated' => now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Thêm sản phẩm vào kho thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        // Lấy các sản phẩm đang active HOẶC chính là sản phẩm đang sửa (dù nó bị off)
    $products = Product::where('is_active', 1)
                ->orWhere('product_id', $inventory->product_id)
                ->get();
        return view('admin.inventory.edit', compact('inventory', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id|unique:inventory,product_id,'.$inventory->inventory_id.',inventory_id',
            'quantity_in_stock' => 'required|integer|min:0',
            'min_alert_quantity' => 'required|integer|min:0',
        ],[
            'product_id.required' => 'Sản phẩm là bắt buộc.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'product_id.unique' => 'Sản phẩm đã có trong kho.',
            'quantity_in_stock.required' => 'Số lượng trong kho là bắt buộc.',
            'quantity_in_stock.min' => 'Số lượng trong kho phải lớn hơn hoặc bằng 0.',
            'min_alert_quantity.required' => 'Số lượng cảnh báo tối thiểu là bắt buộc.',
            'min_alert_quantity.min' => 'Số lượng cảnh báo tối thiểu phải lớn hơn hoặc bằng 0.',
        ]);

        $inventory->update([
            'product_id' => $validated['product_id'],
            'quantity_in_stock' => $validated['quantity_in_stock'],
            'min_alert_quantity' => $validated['min_alert_quantity'],
            'last_updated' => now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Cập nhật thông tin kho hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('admin.inventory.index')->with('success', 'Xóa sản phẩm khỏi kho thành công.');
    }
}
