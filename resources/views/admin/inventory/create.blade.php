{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Thêm sản phẩm vào kho')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.inventory.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product_id" class="form-label">Sản phẩm chưa có kho <span class="text-danger">*</span></label>
                    <select name="product_id" id="product_id" class="form-select" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $product)
                        @if(!isset($product->inventory))
                        <option value="{{ $product->product_id }}" {{ 
                                old('product_id', session('productId')) == $product->product_id ? 'selected' : '' }}>
                            {{ $product->name }} (SKU: {{ $product->sku }})
                        </option>
                        @endif
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
                        value="{{ old('location', '') }}"
                        placeholder="Nhập vị trí trong kho">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            

                <div class="mb-3">
                    <label for="quantity_in_stock" class="form-label">Số lượng trong kho <span class="text-danger">*</span></label>
                    <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                        class="form-control"
                        value="{{ old('quantity_in_stock', 0) }}"
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
                        value="{{ old('min_alert_quantity', 10) }}"
                        placeholder="Nhập số lượng cảnh báo tối thiểu"
                        min="0"
                        required>
                    @error('min_alert_quantity')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hệ thống sẽ cảnh báo khi số lượng trong kho nhỏ hơn hoặc bằng giá trị này</small>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection