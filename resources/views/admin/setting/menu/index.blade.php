{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Quản lý Menu')
@section('name_btn_add', 'Thêm menu')
@section('link_btn_add', route('admin.menu.create'))

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Url</th>
                                    <th>Loại</th>
                                    <th>Menu cha</th>
                                    <th>Sắp xếp</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->menu_id }}</td>
                                    <td>
                                        @if($menu->parent_id)
                                            <span class="text-muted">└─</span>
                                        @endif
                                        {{ $menu->name }}
                                    </td>
                                    <td>
                                        <a href="{{ $menu->full_url }}" target="_blank" class="text-primary">
                                            {{ Str::limit($menu->url, 30) }}
                                        </a>
                                    </td>
                                    <td>
                                        @switch($menu->type)
                                            @case('header')
                                                <span class="badge bg-primary">Header</span>
                                                @break
                                            @case('footer')
                                                <span class="badge bg-info">Footer</span>
                                                @break
                                            @case('sidebar')
                                                <span class="badge bg-secondary">Sidebar</span>
                                                @break
                                            @default
                                                <span class="badge bg-dark">{{ $menu->type }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($menu->parent)
                                            <span class="text-muted">{{ $menu->parent->name }}</span>
                                        @else
                                            <span class="text-secondary">--</span>
                                        @endif
                                    </td>
                                    <td>{{ $menu->sort_order }}</td>
                                    <td>
                                        <div class="form-check form-switch custom-switch">
                                            <input class="form-check-input change-status" type="checkbox" role="switch"
                                                data-id="{{ $menu->menu_id }}"
                                                {{ $menu->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $menu->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.menu.edit', $menu->menu_id) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                        <form action="{{ route('admin.menu.destroy', $menu->menu_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow bi bi-trash3" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này?')"> Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Chưa có menu nào được tạo.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                        {{-- Nút quay về trang trước --}}
                        <li class="page-item {{ $menus->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $menus->previousPageUrl() ?? '#' }}">&laquo;</a>
                        </li>

                        {{-- Hiển thị danh sách số trang --}}
                        @for ($i = 1; $i <= $menus->lastPage(); $i++)
                            <li class="page-item {{ $i == $menus->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $menus->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$menus->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $menus->nextPageUrl() ?? '#' }}">&raquo;</a>
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

{{-- Script xử lý trạng thái kèm thông báo toast --}}
@push('scripts')
<script>
    $(document).ready(function() {
        // Xử lý thay đổi trạng thái
        $('.change-status').on('change', function() {
            let is_active = $(this).prop('checked') ? 1 : 0;
            let menu_id = $(this).data('id');
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('admin.menu.changeStatus') }}",
                type: "POST",
                data: {
                    menu_id: menu_id,
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
