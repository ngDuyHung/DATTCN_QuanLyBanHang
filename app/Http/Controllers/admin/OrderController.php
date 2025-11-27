<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=Order::orderBy('placed_at', 'desc')->paginate(20);
        return view('admin.order.index', compact('orders'));
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
    public function show(Order $order)
    {
        $order->load(['orderItems.product', 'user']);
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['orderItems.product']);
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded',
            'note' => 'nullable|string',
        ]);

        $order->update([
            'status' => $validated['status'],
            'note' => $validated['note'] ?? $order->note,
            'handled_by' => auth()->check() ? auth()->user()->id : null,
        ]);

        return redirect()->route('admin.order.index')
            ->with('success', 'Cập nhật đơn hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Chỉ cho phép xóa đơn hàng đã hủy hoặc pending
        if (!in_array($order->status, ['pending', 'cancelled'])) {
            return redirect()->back()
                ->with('error', 'Chỉ có thể xóa đơn hàng ở trạng thái Chờ xử lý hoặc Đã hủy!');
        }

        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('admin.order.index')
            ->with('success', 'Xóa đơn hàng thành công!');
    }
}
