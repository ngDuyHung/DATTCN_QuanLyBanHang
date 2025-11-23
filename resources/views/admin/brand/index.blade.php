{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách thương hiệu')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-bordered table-striped table-hover table-module mb-0">
                        <thead>
                            <tr>	
                                <th>id</th>
                                <th>Tên</th>
                                <th>Logo</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->brand_id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td><img src="{{ asset('storage/' . $brand->logo_url) }}" alt="" style="height: 40px; max-width: 100%;"></td>
                                <td>{{ $brand->description }}</td>
                                <td>{{ $brand->created_at }}</td>
                                <td>{{ $brand->updated_at }}</td>
                                <td>
                                    <div class="form-check form-switch custom-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            {{ $brand->is_staff ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.brand.edit', $brand) }}" class="btn btn-sm btn-outline-primary shadow bi bi-pencil"> Sửa</a>
                                    <form action="{{ route('admin.brand.destroy', $brand) }}" method="POST" class="d-inline">
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
                    <li class="page-item {{ $brands->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->previousPageUrl() ?? '#' }}">&laquo;</a>
                    </li>

                    {{-- Hiển thị danh sách số trang --}}
                    @for ($i = 1; $i <= $brands->lastPage(); $i++)
                        <li class="page-item {{ $i == $brands->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $brands->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$brands->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $brands->nextPageUrl() ?? '#' }}">&raquo;</a>
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
@endsection