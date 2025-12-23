{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách danh mục')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tên</th>
                                    <th>slug</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorys as $category)
                                <tr>
                                    <td>{{ $category->category_id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <div class="form-check form-switch custom-switch">
                                            <input class="form-check-input change-status" type="checkbox" role="switch"
                                                data-id="{{ $category->category_id }}"
                                                {{ $category->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-info shadow bi bi-eye view-category"
                                            data-category-id="{{ $category->category_id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#categoryModal"></button>
                                        <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="d-inline">
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
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                        {{-- Nút quay về trang trước --}}
                        <li class="page-item {{ $categorys->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $categorys->previousPageUrl() ?? '#' }}">&laquo;</a>
                        </li>

                        {{-- Hiển thị danh sách số trang --}}
                        @for ($i = 1; $i <= $categorys->lastPage(); $i++)
                            <li class="page-item {{ $i == $categorys->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $categorys->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$categorys->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $categorys->nextPageUrl() ?? '#' }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="categoryModalLabel">
                    <i class="bi bi-folder me-2"></i>Thông tin chi tiết danh mục
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="categoryModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Đóng
                </button>
                <a href="#" id="editCategoryBtn" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i>Sửa
                </a>
            </div>
        </div>
    </div>
</div>


{{-- script xử lý trang thái kèm thông báo toast  --}}
@push('scripts')
<script>
    $(document).ready(function() {
        // Xử lý thay đổi trạng thái
        $('.change-status').on('change', function() {
            let is_active = $(this).prop('checked') ? 1 : 0;
            let category_id = $(this).data('id');
            let _token = $('meta[name="csrf-token"]').attr('content'); // Đảm bảo layout admin có thẻ meta csrf-token

            $.ajax({
                url: "{{ route('admin.category.changeStatus') }}",
                type: "POST",
                data: {
                    category_id: category_id,
                    is_active: is_active,
                    _token: _token
                },
                success: function(response) {
                    if (response.success) {
                        new Notify({
                            status: 'success',
                            title: 'Thành công',
                            text: response.message,
                            effect: 'fade',
                            speed: 300,
                            autoclose: true,
                            autotimeout: 1000,
                            position: 'right top'
                        });
                    }
                },
                error: function() {
                    new Notify({
                        status: 'error',
                        title: 'Lỗi',
                        text: 'Không thể cập nhật trạng thái!',
                        effect: 'fade',
                        speed: 300,
                        autoclose: true,
                        autotimeout: 1000,
                        position: 'right top'
                    });
                }
            });
        });

        // Xử lý khi click nút xem chi tiết category
        $('.view-category').on('click', function() {
            const categoryId = $(this).data('category-id');
            loadCategoryDetails(categoryId);
        });

        function loadCategoryDetails(categoryId) {
            const modalBody = $('#categoryModalBody');
            const editBtn = $('#editCategoryBtn');

            // Hiển thị loading
            modalBody.html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                </div>
            `);

            // Gọi AJAX
            $.ajax({
                url: `/admin/category/${categoryId}`,
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(data) {
                    const category = data.category;
                    const productsCount = data.products_count || 0;

                    // Cập nhật nút sửa
                    editBtn.attr('href', `/admin/category/${categoryId}/edit`);

                    // Render nội dung
                    modalBody.html(`
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h4 class="mb-3 text-info">${category.name}</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 25%"><i class="bi bi-hash me-2"></i>ID:</th>
                                                <td><span class="badge bg-dark">${category.category_id}</span></td>
                                            </tr>
                                            <tr>
                                                <th><i class="bi bi-link-45deg me-2"></i>Slug:</th>
                                                <td><code>${category.slug}</code></td>
                                            </tr>
                                            <tr>
                                                <th><i class="bi bi-box-seam me-2"></i>Số sản phẩm:</th>
                                                <td><span class="badge bg-primary fs-6">${productsCount} sản phẩm</span></td>
                                            </tr>
                                            <tr>
                                                <th><i class="bi bi-toggle-on me-2"></i>Trạng thái:</th>
                                                <td>${category.is_active ? '<span class="badge bg-success">Đang hoạt động</span>' : '<span class="badge bg-secondary">Không hoạt động</span>'}</td>
                                            </tr>
                                            <tr>
                                                <th><i class="bi bi-calendar-plus me-2"></i>Ngày tạo:</th>
                                                <td>${new Date(category.created_at).toLocaleString('vi-VN')}</td>
                                            </tr>
                                            <tr>
                                                <th><i class="bi bi-calendar-check me-2"></i>Cập nhật:</th>
                                                <td>${new Date(category.updated_at).toLocaleString('vi-VN')}</td>
                                            </tr>
                                        </table>
                                        
                                        ${category.description ? `
                                        <div class="mt-3">
                                            <h6 class="fw-bold"><i class="bi bi-file-text me-2"></i>Mô tả:</h6>
                                            <div class="border rounded p-3 bg-light">
                                                ${category.description}
                                            </div>
                                        </div>
                                        ` : '<div class="alert alert-info mt-3"><i class="bi bi-info-circle me-2"></i>Chưa có mô tả</div>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                },
                error: function(error) {
                    console.error('Error:', error);
                    modalBody.html(`
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Có lỗi xảy ra khi tải dữ liệu. Vui lòng thử lại!
                        </div>
                    `);
                }
            });
        }
    });
</script>
@endpush
@endsection