@extends('layouts.admin')

@section('title','Thêm sản phẩm')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($product) ? route('admin.product.update', $product->product_id) : route('admin.product.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control"
                            value="{{ old('sku', $product->sku ?? '') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $product->name ?? '') }}" required>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <input type="text" name="short_description" class="form-control"
                        value="{{ old('short_description', $product->short_description ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả nổi bật</label>
                    <textarea name="description" id="description_ckeditor" rows="3" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Mô tả khuyển mãi</label>
                    <textarea name="sale_description" id="sale_description_ckeditor" rows="3" class="form-control">{{ old('sale_description', $product->sale_description ?? '') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giá bán</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giá vốn</label>
                        <input type="number" step="0.01" name="cost_price" class="form-control"
                            value="{{ old('cost_price', $product->cost_price ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Trọng lượng (kg)</label>
                        <input type="number" step="0.01" name="weight" class="form-control"
                            value="{{ old('weight', $product->weight ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ old('category_id', $product->category_id ?? '') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brand_id" class="form-select">
                            @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}"
                                {{ old('brand_id', $product->brand_id ?? '') == $brand->brand_id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="main_img_url" class="form-label">Hình ảnh chính sản phẩm</label>
                    <input type="file" name="main_img_url" id="main_img_url" class="form-control">
                    {{-- Ảnh mới chọn--}}
                    <div id="previewMain_img" class="mt-3 d-flex flex-wrap gap-2"></div>

                    {{-- Hiển thị ảnh cũ nếu đang ở chế độ edit --}}
                    @if(isset($product) && $product->main_img_url)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->main_img_url) }}" alt="Logo" width="100" class="rounded border">
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" name="images[]" id="imageInput" multiple class="form-control">
                    {{-- Ảnh mới chọn (preview tạm thời) --}}
                    <div id="previewNew" class="mt-3 d-flex flex-wrap gap-2"></div>

                    {{-- Ảnh cũ (đã lưu trong DB) --}}
                    @if(isset($product) && $product->images->count() > 0)
                    <label class="form-label mt-3">Ảnh hiện có</label>
                    <div id="existingImages" class="d-flex flex-wrap gap-2">
                        @foreach($product->images as $img)
                        <div class="position-relative border rounded overflow-hidden" style="width:100px;height:100px;">
                            <img src="{{ asset('storage/'.$img->image_url) }}" alt="Ảnh"
                                style="object-fit:cover;width:100%;height:100%;">
                                <input type="number" name="existing_sort_orders[{{ $img->image_id }}]" value="{{ $img->sort_order }}" class="form-control form-control-sm mt-1" placeholder="Thứ tự">
                            <button type="button"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 p-1 btn-mark-delete"
                                data-id="{{ $img->image_id }}" title="Xóa ảnh này">✕</button>
                            {{-- Input hidden để đánh dấu xóa --}}
                            <input type="checkbox" name="delete_images[]" value="{{ $img->image_id }}" class="d-none delete-checkbox">
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted d-block mt-2">Bấm ✕ để xóa ảnh đã lưu khi cập nhật.</small>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $product->is_active ?? '') == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('is_active', $product->is_active ?? '') == 0 ? 'selected' : '' }}>Tạm tắt</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Thuộc tính chung sản phẩm</label>
                    <textarea name="total_attributes" class="form-control">{{ old('total_attributes', $product->total_attributes ?? '') }}</textarea>
                </div>

                {{-- Thuộc tính sản phẩm --}}
                <div class="mb-3">
                    <label class="form-label">Thuộc tính sản phẩm</label>
                    <div id="attribute-list">
                        @php
                        // Lấy thuộc tính từ old() khi validate thất bại, nếu không thì lấy từ $product, nếu không thì rỗng
                        $attributes = old('attr_key')
                        ? array_map(null, old('attr_key'), old('attr_value'), old('sort_order'))
                        : (isset($product) ? $product->attributes->map(fn($attr) => [$attr->attr_key, $attr->attr_value, $attr->sort_order]) : []);
                        @endphp

                        @if(count($attributes) > 0)
                        @foreach($attributes as $index => $attr)
                        @php
                        // $attr[0] là key, $attr[1] là value, $attr[2] là sort
                        $key = is_array($attr) ? $attr[0] : (isset($product) ? $attr->attr_key : '');
                        $value = is_array($attr) ? $attr[1] : (isset($product) ? $attr->attr_value : '');
                        $sort = is_array($attr) ? $attr[2] : (issset($product) ? $attr->sort_order : '');
                        @endphp
                        <div class="d-flex mb-2 ">
                            <div class="container-fluid attribute-row">
                                <div class="row ">
                                    <div class="col-12 col-md-5">
                                        <input type="text" name="attr_key[]" class="form-control me-2" placeholder="Tên thuộc tính (VD: Màu)" value="{{ $key }}">
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" name="attr_value[]" class="form-control me-2" placeholder="Giá trị (VD: Đỏ)" value="{{ $value }}">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="number" name="sort_order[]" class="form-control me-2" placeholder="Thứ tự " value="{{ $sort }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm btn-remove-attr">Xóa</button>
                        </div>
                        @endforeach
                        @else
                        {{-- Luôn có ít nhất 1 dòng --}}
                        <div class="d-flex mb-2  attribute-row">
                            <div class="container-fluid">
                                <div class="row ">
                                    <div class="col-12 col-md-5">
                                        <input type="text" name="attr_key[]" class="form-control " placeholder="Tên thuộc tính (VD: Màu)">
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" name="attr_value[]" class="form-control " placeholder="Giá trị (VD: Đỏ)">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="number" name="sort_order[]" class="form-control " placeholder="Thứ tự ">
                                    </div>
                                </div>
                            </div>
                            <!-- <button type="button" class="btn btn-danger btn-sm btn-remove-attr">Xóa</button> -->
                        </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-attr">+ Thêm thuộc tính</button>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">{{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-attr');
        const attrList = document.getElementById('attribute-list');

        // Hàm thêm dòng mới
        function addAttributeRow() {
            const div = document.createElement('div');
            div.classList.add('d-flex', 'mb-2', 'attribute-row');
            div.innerHTML = `
             <div class="container-fluid">
                <div class="row ">
                    <div class="col-12 col-md-5">
                        <input type="text" name="attr_key[]" class="form-control me-2" placeholder="Tên thuộc tính">
                    </div>
                    <div class="col-12 col-md-5">
                    <input type="text" name="attr_value[]" class="form-control me-2" placeholder="Giá trị">
                    </div>
                    <div class="col-12 col-md-2">
                        <input type="number" name="sort_order[]" class="form-control me-2" placeholder="Thứ tự">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm btn-remove-attr">Xóa</button>
       
            `;
            attrList.appendChild(div);
        }

        // Xử lý nút Thêm
        addBtn.addEventListener('click', addAttributeRow);

        // Xử lý nút Xóa (dùng event delegation)
        attrList.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-attr')) {
                // Ngăn không cho xóa dòng cuối cùng
                if (attrList.querySelectorAll('.attribute-row').length > 1) {
                    e.target.closest('.attribute-row').remove();
                } else {
                    alert('Phải có ít nhất một thuộc tính.');
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('imageInput');
        const previewNew = document.getElementById('previewNew');

        // Preview ảnh mới
        imageInput.addEventListener('change', function(e) {
            previewNew.innerHTML = ''; // reset preview
            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = ev => {
                    const wrapper = document.createElement('div');
    wrapper.classList.add('position-relative', 'border', 'rounded', 'overflow-hidden', 'p-1');
    wrapper.style.width = '120px';
    wrapper.style.height = 'auto';
    wrapper.innerHTML = `
        <img src="${ev.target.result}" class="object-fit-cover mb-1" style="width:100px;height:100px;">
        <input type="number" name="sort_orders[]" class="form-control form-control-sm" placeholder="Thứ tự" min="0">
        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 p-1 btn-remove-temp">✕</button>
    `;
    previewNew.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        // Xóa ảnh mới chọn trước khi gửi form
        previewNew.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-temp')) {
                e.target.closest('.position-relative').remove();
            }
        });

        // Đánh dấu ảnh cũ để xóa
        const existingImages = document.getElementById('existingImages');
        if (existingImages) {
            existingImages.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-mark-delete')) {
                    const btn = e.target;
                    const wrapper = btn.closest('.position-relative');
                    const checkbox = wrapper.querySelector('.delete-checkbox');
                    const isMarked = checkbox.checked;

                    // toggle
                    checkbox.checked = !isMarked;
                    wrapper.classList.toggle('opacity-50', !isMarked);
                    btn.classList.toggle('btn-danger', isMarked);
                    btn.classList.toggle('btn-secondary', !isMarked);
                    btn.textContent = isMarked ? '✕' : '↺';
                    btn.title = isMarked ? 'Xóa ảnh này' : 'Bỏ xóa';
                }
            });
        }
    });

    
    document.getElementById('main_img_url').addEventListener('change', function (event) {
    const preview = document.getElementById('previewMain_img');
    preview.innerHTML = ''; // Xóa ảnh cũ nếu có


    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.style.maxWidth = '150px';
            img.style.maxHeight = '150px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});

    CKEDITOR.replace('description_ckeditor');
    CKEDITOR.replace('sale_description_ckeditor');
</script>
@endsection