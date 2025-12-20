{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Thêm tài khoản mới')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.account.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control"
                        value="{{ old('name') }}"
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
                        value="{{ old('email') }}"
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
                        value="{{ old('phone') }}"
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
                            <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password"
                        class="form-control"
                        placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)" 
                        required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control"
                        placeholder="Nhập lại mật khẩu" 
                        required>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.account.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
