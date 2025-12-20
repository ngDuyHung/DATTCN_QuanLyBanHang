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
            <!-- /.card-header -->
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
                                    <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-outline-primary shadow bi bi-pencil"> Sửa</a>
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
            <div class="card-footer clearfix mt-2">
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
    <!-- /.card -->
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!--end::Row-->
<!--begin::Row-->

<!--end::Row-->
</div>


{{-- script xử lý trang thái kèm thông báo toast  --}}
@push('scripts')
<script>
    $(document).ready(function() {
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
    });
</script>
@endpush
@endsection