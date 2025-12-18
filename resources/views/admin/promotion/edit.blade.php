{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Chỉnh sửa mã khuyến mãi')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.promotion.update', $promotion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code" class="form-label">Mã id</label>
                    <input type="text" name="promo_id " id="promo_id "
                        class="form-control"
                        value="{{ old('promo_id ', $promotion->promo_id  ?? '') }}"
                        placeholder="" readonly style="background-color: #e9ecef;">
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">code</label>
                    <input type="text" name="code" id="code"
                        class="form-control"
                        value="{{ old('code', $promotion->code ?? '') }}"
                        placeholder="Nhập mã khuyến mãi" required>
                </div>

                <div class="mb-3">
                    <label for="discount_type" class="form-label">Loại giảm giá</label>
                    <select name="discount_type" id="discount_type" class="form-select">
                        <option value="percent" {{ old('discount_type', $promotion->discount_type ?? '') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                        <option value="fixed" {{ old('discount_type', $promotion->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>Số tiền cố định</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Giá trị giảm</label>
                    <input type="number" name="discount_value" id="discount_value"
                        class="form-control"
                        placeholder="Nhập giá trị giảm" value="{{ old('discount_value', $promotion->discount_value ?? '') }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="starts_at" class="form-label">Ngày bắt đầu</label>
                        <input type="datetime-local" name="starts_at" id="starts_at"
                            class="form-control"
                            value="{{ old('starts_at', $promotion->starts_at ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ends_at" class="form-label">Ngày kết thúc</label>
                        <input type="datetime-local" name="ends_at" id="ends_at"
                            class="form-control"
                            value="{{ old('ends_at', $promotion->ends_at ?? '') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="usage_limit" class="form-label">Giới hạn sử dụng</label>
                    <input type="number" name="usage_limit" id="usage_limit"
                        class="form-control"
                        value="{{ old('usage_limit', $promotion->usage_limit ?? '') }}"
                        placeholder="Nhập giới hạn sử dụng">
                </div>
                <div class="mb-3">
                    <label for="times_used" class="form-label">Số lần đã sử dụng</label>
                    <input type="number" name="times_used" id="times_used"
                        class="form-control"
                        value="{{ old('times_used', $promotion->times_used ?? '') }}"
                        placeholder="Nhập số lần đã sử dụng">
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Trạng thái</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $promotion->is_active ?? '') == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('is_active', $promotion->is_active ?? '') == 0 ? 'selected' : '' }}>Tạm tắt</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.promotion.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        {{ 'Cập nhật' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection