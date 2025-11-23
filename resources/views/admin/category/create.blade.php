{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Thêm danh mục')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($category) ? route('admin.category.update', $category->category_id) : route('admin.category.store') }}" method="POST">
                @csrf
                @if(isset($category))
                @method('PUT')
                @endif


                @if(isset($category))
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" name="id" id="id"
                        class="form-control"
                        value="{{ old('id', $category->id ?? '') }}"
                        placeholder="Tự động hoặc nhập ID"
                        {{ isset($category) ? 'readonly' : '' }}>
                </div>
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" name="name" id="name"
                        class="form-control"
                        value="{{ old('name', $category->name ?? '') }}"
                        placeholder="Nhập tên danh mục" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug"
                        class="form-control bg-light"
                        value="{{ old('slug', $category->slug ?? '') }}"
                        placeholder="slug-tieng-viet-khong-dau" readonly>
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
                            value="{{ old('created_at', isset($category) ? $category->created_at->format('Y-m-d\TH:i') : '') }}"
                            {{ isset($category) ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="updated_at" class="form-label">Ngày cập nhật</label>
                        <input type="datetime-local" name="updated_at" id="updated_at"
                            class="form-control"
                            value="{{ old('updated_at', isset($category) ? $category->updated_at->format('Y-m-d\TH:i') : '') }}"
                            readonly>
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="is_active" class="form-label">Trạng thái</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $category->is_active ?? '') == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('is_active', $category->is_active ?? '') == 0 ? 'selected' : '' }}>Tạm tắt</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        {{ isset($category) ? 'Cập nhật' : 'Thêm mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Script sinh slug tự động --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function () {
        let slug = nameInput.value
            .toLowerCase()
            .normalize('NFD') // bỏ dấu tiếng Việt
            .replace(/[\u0300-\u036f]/g, '') 
            .replace(/[^a-z0-9\s-]/g, '') // bỏ ký tự đặc biệt
            .trim()
            .replace(/\s+/g, '-'); // thay khoảng trắng bằng dấu gạch
        slugInput.value = slug;
    });
});
</script>
@endsection