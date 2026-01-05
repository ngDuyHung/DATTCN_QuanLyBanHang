{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Thêm menu')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Nhập tên menu" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">Url (có thể điền đầy đủ https hoặc không)</label>
                    <input type="text" name="url" id="url"
                        class="form-control @error('url') is-invalid @enderror"
                        value="{{ old('url') }}"
                        placeholder="Đường dẫn url (VD: /san-pham hoặc https://example.com)">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Để trống nếu menu chỉ là danh mục cha không có liên kết</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Loại <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">-- Chọn loại menu --</option>
                            @foreach($types as $key => $value)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="parent_id" class="form-label">Parent menu (Menu cha)</label>
                        <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">-- Menu cha (nếu là menu cấp 2) --</option>
                            @foreach($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->menu_id }}" {{ old('parent_id') == $parentMenu->menu_id ? 'selected' : '' }}>
                                    {{ $parentMenu->name }} ({{ $parentMenu->type_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Chọn menu cha nếu muốn menu này là menu cấp 2</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Sắp xếp <span class="text-danger">*</span></label>
                        <input type="number" name="sort_order" id="sort_order"
                            class="form-control @error('sort_order') is-invalid @enderror"
                            value="{{ old('sort_order', 1) }}"
                            min="1" required>
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Số nhỏ hơn sẽ hiển thị trước</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="is_active" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Tạm tắt</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Khi thay đổi loại menu, load lại danh sách menu cha tương ứng
        $('#type').on('change', function() {
            var type = $(this).val();
            var parentSelect = $('#parent_id');
            
            if (type) {
                $.ajax({
                    url: "{{ route('admin.menu.getParentMenusByType') }}",
                    type: "GET",
                    data: { type: type },
                    success: function(data) {
                        parentSelect.html('<option value="">-- Menu cha (nếu là menu cấp 2) --</option>');
                        $.each(data, function(index, item) {
                            parentSelect.append('<option value="' + item.menu_id + '">' + item.name + '</option>');
                        });
                    }
                });
            } else {
                parentSelect.html('<option value="">-- Menu cha (nếu là menu cấp 2) --</option>');
            }
        });
    });
</script>
@endpush
@endsection
