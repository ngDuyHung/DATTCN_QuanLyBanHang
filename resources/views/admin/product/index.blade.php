{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách sản phẩm')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped table-hover table-module mb-0">
                        <thead>
                            <tr>
                                <th>Mã SKU</th>
                                <th>Hình ảnh</th>
                                <th>Giá bán</th>
                                <th>Loại</th>
                                <th>Thương hiệu</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->sku }}</td>
                                <td><img src="{{ asset('storage/'.$product->main_img_url) }}" alt="" style="height: 40px; max-width: 100%;"></td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>
                                    <div class="form-check form-switch custom-switch">
                                        <input class="form-check-input change-status-product" type="checkbox" role="switch"
                                            data-id="{{ $product->product_id }}"
                                            {{ $product->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow bi bi-eye view-product"
                                        data-product-id="{{ $product->product_id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#productModal"></button>
                                    <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                    <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger shadow bi bi-trash3"> Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix mt-2">
                <ul class="pagination pagination-sm m-0 float-end">
                    {{-- Nút quay về trang trước --}}
                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products->previousPageUrl() ?? '#' }}">&laquo;</a>
                    </li>

                    {{-- Hiển thị danh sách số trang --}}
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->nextPageUrl() ?? '#' }}">&raquo;</a>
                        </li>
                </ul>
            </div>

        </div>
        <!-- /.card -->

    </div>
    <!-- /.card -->
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!--end::Row-->
<!--begin::Row-->
<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="productModalLabel">
                    <i class="bi bi-box-seam me-2"></i>Thông tin chi tiết sản phẩm
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="productModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Đóng
                </button>
                <a href="#" id="editProductBtn" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i>Sửa
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý thay đổi trạng thái sản phẩm
        document.querySelectorAll('.change-status-product').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const isActive = this.checked ? 1 : 0;
                const productId = this.getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch('/admin/products/change-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        is_active: isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        new Notify({
                            status: 'success',
                            title: 'Thành công',
                            text: data.message,
                            effect: 'fade',
                            speed: 300,
                            autoclose: true,
                            autotimeout: 2000,
                            position: 'right top'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    new Notify({
                        status: 'error',
                        title: 'Lỗi',
                        text: 'Không thể cập nhật trạng thái!',
                        effect: 'fade',
                        speed: 300,
                        autoclose: true,
                        autotimeout: 2000,
                        position: 'right top'
                    });
                    // Hoàn trả lại trạng thái cũ
                    checkbox.checked = !checkbox.checked;
                });
            });
        });

        // Xử lý khi click nút xem chi tiết
        document.querySelectorAll('.view-product').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                loadProductDetails(productId);
            });
        });

        function loadProductDetails(productId) {
            const modalBody = document.getElementById('productModalBody');
            const editBtn = document.getElementById('editProductBtn');

            // Hiển thị loading
            modalBody.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Đang tải...</span>
                </div>
            </div>
        `;

            // Gọi AJAX
            fetch(`/admin/product/${productId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const product = data.product;
                    const images = data.images || [];
                    const attributes = data.attributes || [];

                    // Cập nhật nút sửa
                    editBtn.href = `/admin/product/${productId}/edit`;

                    // Render nội dung
                    let imagesHtml = '';
                    if (images.length > 0) {
                        imagesHtml = '<div class="row">';
                        images.forEach(img => {
                            imagesHtml += `
                        <div class="col-md-3 mb-2">
                            <img src="/storage/${img.image_url}" class="img-thumbnail" alt="${img.alt_text}">
                        </div>
                    `;
                        });
                        imagesHtml += '</div>';
                    }

                    let attributesHtml = '';
                    if (attributes.length > 0) {
                        attributesHtml = '<div class="table-responsive"><table class="table table-sm table-bordered">';
                        attributes.forEach(attr => {
                            attributesHtml += `
                        <tr>
                            <td class="fw-bold" style="width: 40%">${attr.attr_key}</td>
                            <td>${attr.attr_value}</td>
                        </tr>
                    `;
                        });
                        attributesHtml += '</table></div>';
                    }

                    modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="/storage/${product.main_img_url}" class="img-fluid rounded shadow-sm" alt="${product.name}">
                    </div>
                    <div class="col-md-8">
                        <h4 class="mb-3">${product.name}</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">Mã SKU:</th>
                                <td><span class="badge bg-dark">${product.sku}</span></td>
                            </tr>
                            <tr>
                                <th>Giá bán:</th>
                                <td class="text-danger fw-bold">${new Intl.NumberFormat('vi-VN').format(product.price)} đ</td>
                            </tr>
                            <tr>
                                <th>Giá vốn:</th>
                                <td>${product.cost_price ? new Intl.NumberFormat('vi-VN').format(product.cost_price) + ' đ' : 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Khối lượng:</th>
                                <td>${product.weight ? product.weight + ' g' : 'N/A'}</td>
                            </tr>
                            <tr>
                                <th>Danh mục:</th>
                                <td>${data.category_name}</td>
                            </tr>
                            <tr>
                                <th>Thương hiệu:</th>
                                <td>${data.brand_name}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái:</th>
                                <td>${product.is_active ? '<span class="badge bg-success">Đang hoạt động</span>' : '<span class="badge bg-secondary">Không hoạt động</span>'}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                ${product.short_description ? `
                <div class="mt-3">
                    <h6 class="fw-bold">Mô tả ngắn:</h6>
                    <p class="text-muted">${product.short_description}</p>
                </div>
                ` : ''}
                
                ${attributesHtml ? `
                <div class="mt-3">
                    <h6 class="fw-bold">Thuộc tính sản phẩm:</h6>
                    ${attributesHtml}
                </div>
                ` : ''}
                
                ${imagesHtml ? `
                <div class="mt-3">
                    <h6 class="fw-bold">Hình ảnh sản phẩm:</h6>
                    ${imagesHtml}
                </div>
                ` : ''}
            `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Có lỗi xảy ra khi tải dữ liệu. Vui lòng thử lại!
                </div>
            `;
                });
        }
    });
</script>



@endpush
<!--end::Row-->
</div>
@endsection