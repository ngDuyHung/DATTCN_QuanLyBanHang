<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.account.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.account.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'name.required' => 'Tên người dùng là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'role_id.required' => 'Vai trò là bắt buộc.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role_id' => $validated['role_id'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.account.index')->with('success', 'Tạo tài khoản thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $account)
    {
        $roles = Role::all();
        return view('admin.account.edit', compact('account', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $account)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$account->id.',id',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'nullable|string|min:6|confirmed',
        ],[
            'name.required' => 'Tên người dùng là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'role_id.required' => 'Vai trò là bắt buộc.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role_id' => $validated['role_id'],
        ];

        // Chỉ cập nhật mật khẩu nếu có nhập mới
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $account->update($updateData);

        return redirect()->route('admin.account.index')->with('success', 'Cập nhật tài khoản thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $account)
    {
        $account->delete();
        return redirect()->route('admin.account.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
