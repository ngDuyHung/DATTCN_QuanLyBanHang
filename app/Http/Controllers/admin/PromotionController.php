<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.promotion.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promotions,code',
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after_or_equal:starts_at',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ],[
            'code.required' => 'Mã khuyến mãi là bắt buộc.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Giá trị giảm giá là bắt buộc.',
            'starts_at.required' => 'Ngày bắt đầu là bắt buộc.',
            'ends_at.required' => 'Ngày kết thúc là bắt buộc.',
            'ends_at.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'usage_limit.min' => 'Giới hạn sử dụng phải lớn hơn hoặc bằng 1.',
        ]);

        $promotion = Promotion::create([
            'code' => $validated['code'],
            'description' => $validated['description'] ?? null,
            'discount_type' => $validated['discount_type'],
            'discount_value' => $validated['discount_value'],
            'starts_at' => $validated['starts_at'],
            'ends_at' => $validated['ends_at'],
            'usage_limit' => $validated['usage_limit'] ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.promotion.index')->with('success', 'Tạo mã khuyến mãi thành công.');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Promotion $promotion) 
    {
        
        return view('admin.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promotions,code,'.$promotion->promo_id.',promo_id',
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after_or_equal:starts_at',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ],[
            'code.required' => 'Mã khuyến mãi là bắt buộc.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',
            'discount_value.required' => 'Giá trị giảm giá là bắt buộc.',
            'starts_at.required' => 'Ngày bắt đầu là bắt buộc.',
            'ends_at.required' => 'Ngày kết thúc là bắt buộc.',
            'ends_at.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'usage_limit.min' => 'Giới hạn sử dụng phải lớn hơn hoặc bằng 1.',
        ]);

        $promotion->update([
            'code' => $validated['code'],
            'description' => $validated['description'] ?? null,
            'discount_type' => $validated['discount_type'],
            'discount_value' => $validated['discount_value'],
            'starts_at' => $validated['starts_at'],
            'ends_at' => $validated['ends_at'],
            'usage_limit' => $validated['usage_limit'] ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.promotion.index')->with('success', 'Cập nhật mã khuyến mãi thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.promotion.index')->with('success', 'Xóa mã khuyến mãi thành công.');
    }
}
