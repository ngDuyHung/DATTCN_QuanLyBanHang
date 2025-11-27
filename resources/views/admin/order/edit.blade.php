{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Sửa thương hiệu')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($brand) ? route('admin.brand.update', $brand->brand_id) : route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($brand))
                @method('PUT')
                @endif


                @if(isset($brand))
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" name="id" id="id"
                        class="form-control"
                        value="{{ old('id', $brand->brand_id ?? '') }}"
                        placeholder="Tự động hoặc nhập ID"
                        {{ isset($brand) ? 'readonly' : '' }}>
                </div>
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Tên thương hiệu</label>
                    <input type="text" name="name" id="name"
                        class="form-control"
                        value="{{ old('name', $brand->name ?? '') }}"
                        placeholder="Nhập tên thương hiệu" required>
                </div>
                <div class="mb-3">
                    <label for="logo_url" class="form-label">Logo thương hiệu</label>
                    <input type="file" name="logo_url" id="logo_url" class="form-control">

                    {{-- Hiển thị ảnh cũ nếu đang ở chế độ edit --}}
                    @if(isset($brand) && $brand->logo_url)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="Logo" width="100" class="rounded border">
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description"
                        rows="3" class="form-control"
                        placeholder="Nhập mô tả danh mục">{{ old('description', $category->description ?? '') }}</textarea>
                </div>
                @if(isset($category))
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="created_at" class="form-label">Ngày tạo</label>
                        <input type="datetime-local" name="created_at" id="created_at"
                            class="form-control"
                            value="{{ old('created_at', isset($brand) ? $brand->created_at->format('Y-m-d\TH:i') : '') }}"
                            {{ isset($brand) ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="updated_at" class="form-label">Ngày cập nhật</label>
                        <input type="datetime-local" name="updated_at" id="updated_at"
                            class="form-control"
                            value="{{ old('updated_at', isset($brand) ? $brand->updated_at->format('Y-m-d\TH:i') : '') }}"
                            readonly>
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="is_staff" class="form-label">Trạng thái</label>
                    <select name="is_staff" id="is_staff" class="form-select">
                        <option value="1" {{ old('is_staff', $brand->is_staff ?? '') == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('is_staff', $brand->is_staff ?? '') == 0 ? 'selected' : '' }}>Tạm tắt</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        {{ isset($brand) ? 'Cập nhật' : 'Thêm mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection