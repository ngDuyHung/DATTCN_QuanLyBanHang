{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Chỉnh sửa tài khoản')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.account.update', $account) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id" class="form-label">Mã ID</label>
                    <input type="text" name="id" id="id"
                        class="form-control"
                        value="{{ old('id', $account->id ?? '') }}"
                        readonly style="background-color: #e9ecef;">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control"
                        value="{{ old('name', $account->name ?? '') }}"
                        placeholder="Nhập tên người dùng" 
                        required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                        class="form-control"
                        value="{{ old('email', $account->email ?? '') }}"
                        placeholder="Nhập email" 
                        required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone"
                        class="form-control"
                        value="{{ old('phone', $account->phone ?? '') }}"
                        placeholder="Nhập số điện thoại">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Vai trò <span class="text-danger">*</span></label>
                    <select name="role_id" id="role_id" class="form-select" required>
                        <option value="">-- Chọn vai trò --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->role_id }}" 
                                {{ old('role_id', $account->role_id ?? '') == $role->role_id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu mới</label>
                    <input type="password" name="password" id="password"
                        class="form-control"
                        placeholder="Để trống nếu không muốn thay đổi mật khẩu">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control"
                        placeholder="Nhập lại mật khẩu mới">
                </div>

                <div class="mb-3">
                    <label for="created_at" class="form-label">Ngày tạo</label>
                    <input type="text" name="created_at" id="created_at"
                        class="form-control"
                        value="{{ $account->created_at->format('d/m/Y H:i:s') ?? '' }}"
                        readonly style="background-color: #e9ecef;">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.account.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
