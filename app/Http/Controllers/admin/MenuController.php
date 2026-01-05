<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('parent')
            ->orderBy('type')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.setting.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Menu::getTypes();
        $parentMenus = Menu::whereNull('parent_id')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();
        
        return view('admin.setting.menu.create', compact('types', 'parentMenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'type' => 'required|string|in:header,footer,sidebar',
            'parent_id' => 'nullable|exists:menus,menu_id',
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Vui lòng nhập tên menu.',
            'name.max' => 'Tên menu không được vượt quá 255 ký tự.',
            'url.max' => 'URL không được vượt quá 500 ký tự.',
            'type.required' => 'Vui lòng chọn loại menu.',
            'type.in' => 'Loại menu không hợp lệ.',
            'parent_id.exists' => 'Menu cha không tồn tại.',
            'sort_order.required' => 'Vui lòng nhập thứ tự sắp xếp.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'sort_order.min' => 'Thứ tự sắp xếp phải lớn hơn 0.',
        ]);

        Menu::create($request->all());
        
        return redirect()->route('admin.menu.create')->with('success', 'Thêm menu thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $menu->load('parent', 'children');
        
        if (request()->ajax()) {
            return response()->json([
                'menu' => $menu,
                'parent_name' => $menu->parent ? $menu->parent->name : null,
                'children_count' => $menu->children->count()
            ]);
        }
        
        return view('admin.setting.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $types = Menu::getTypes();
        $parentMenus = Menu::whereNull('parent_id')
            ->where('is_active', 1)
            ->where('menu_id', '!=', $menu->menu_id) // Không cho chọn chính nó làm cha
            ->orderBy('sort_order')
            ->get();
        
        return view('admin.setting.menu.edit', compact('menu', 'types', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'type' => 'required|string|in:header,footer,sidebar',
            'parent_id' => 'nullable|exists:menus,menu_id',
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Vui lòng nhập tên menu.',
            'name.max' => 'Tên menu không được vượt quá 255 ký tự.',
            'url.max' => 'URL không được vượt quá 500 ký tự.',
            'type.required' => 'Vui lòng chọn loại menu.',
            'type.in' => 'Loại menu không hợp lệ.',
            'parent_id.exists' => 'Menu cha không tồn tại.',
            'sort_order.required' => 'Vui lòng nhập thứ tự sắp xếp.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'sort_order.min' => 'Thứ tự sắp xếp phải lớn hơn 0.',
        ]);

        // Không cho phép menu tự chọn chính nó làm parent
        if ($request->parent_id == $menu->menu_id) {
            return back()->withErrors(['parent_id' => 'Menu không thể tự chọn chính nó làm menu cha.']);
        }

        $menu->update($request->all());
        
        return redirect()->route('admin.menu.edit', $menu->menu_id)->with('success', 'Cập nhật menu thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Cập nhật các menu con để parent_id = null trước khi xóa
        Menu::where('parent_id', $menu->menu_id)->update(['parent_id' => null]);
        
        $menu->delete();
        
        return redirect()->route('admin.menu.index')->with('success', 'Xóa menu thành công.');
    }

    /**
     * Change menu status via AJAX
     */
    public function changeStatus(Request $request)
    {
        $menu = Menu::find($request->menu_id);
        
        if ($menu) {
            $menu->is_active = $request->is_active;
            $menu->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái menu.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy menu.'
        ], 404);
    }

    /**
     * Get parent menus by type via AJAX
     */
    public function getParentMenusByType(Request $request)
    {
        $type = $request->type;
        
        $parentMenus = Menu::whereNull('parent_id')
            ->where('type', $type)
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get(['menu_id', 'name']);
        
        return response()->json($parentMenus);
    }
}
