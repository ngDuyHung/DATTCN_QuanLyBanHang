{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Chỉnh sửa thông tin kho hàng')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.inventory.update', $inventory) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inventory_id" class="form-label">Mã kho</label>
                    <input type="text" name="inventory_id" id="inventory_id"
                        class="form-control"
                        value="{{ old('inventory_id', $inventory->inventory_id ?? '') }}"
                        readonly style="background-color: #e9ecef;">
                </div>

                <div class="mb-3">
                    <label for="product_id" class="form-label">Sản phẩm <span class="text-danger">*</span></label>
                    <select name="product_id" id="product_id" class="form-select" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" 
                                {{ old('product_id', $inventory->product_id ?? '') == $product->product_id ? 'selected' : '' }}>
                                {{ $product->name }} (SKU: {{ $product->sku }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                  <div class="mb-3">
                    <label for="location" class="form-label">Vị trí trong kho</label>
                    <input type="text" name="location" id="location"
                        class="form-control"
                        value="{{ old('location', $inventory->location ?? '') }}"
                        placeholder="Vị trí trong kho">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity_in_stock" class="form-label">Số lượng trong kho <span class="text-danger">*</span></label>
                    <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                        class="form-control"
                        value="{{ old('quantity_in_stock', $inventory->quantity_in_stock ?? 0) }}"
                        placeholder="Nhập số lượng trong kho" 
                        min="0"
                        required>
                    @error('quantity_in_stock')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="min_alert_quantity" class="form-label">Số lượng cảnh báo tối thiểu <span class="text-danger">*</span></label>
                    <input type="number" name="min_alert_quantity" id="min_alert_quantity"
                        class="form-control"
                        value="{{ old('min_alert_quantity', $inventory->min_alert_quantity ?? 10) }}"
                        placeholder="Nhập số lượng cảnh báo tối thiểu" 
                        min="0"
                        required>
                    @error('min_alert_quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hệ thống sẽ cảnh báo khi số lượng trong kho nhỏ hơn hoặc bằng giá trị này</small>
                </div>

                <div class="mb-3">
                    <label for="last_updated" class="form-label">Ngày cập nhật cuối</label>
                    <input type="text" name="last_updated" id="last_updated"
                        class="form-control"
                        value="{{ $inventory->last_updated ?? '' }}"
                        readonly style="background-color: #e9ecef;">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
