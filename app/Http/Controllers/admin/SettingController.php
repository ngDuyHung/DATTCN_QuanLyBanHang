<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.setting');
    }

    public function update(Request $request)
    {
        // Lấy tất cả dữ liệu trừ _token
        $inputs = $request->except('_token');

        foreach ($inputs as $key => $value) {
            // 1. Xử lý nếu là File (Ảnh logo, favicon...)
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                // Lưu file vào storage/app/public/configs
                $path = $file->store('configs', 'public');

                // Giá trị lưu trong DB sẽ là đường dẫn public/storage/...
                $value = $path;
            }


            // 2. Lưu hoặc Cập nhật vào DB
            // Nếu đã có opt_key thì update, chưa có thì tạo mới (Insert)
            Option::updateOrCreate(
                ['opt_key' => $key],
                ['opt_value' => $value]
            );
        }

        return back()->with('success', 'Đã lưu tất cả thay đổi!');
    }
}
