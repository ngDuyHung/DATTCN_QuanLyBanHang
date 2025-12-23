{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách tài khoản')

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.account.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> Thêm mới
                        </a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped table-hover table-module mb-0">
                            <thead>
                                <tr>
                                    <th>Mã ID</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Vai trò</th>
                                    <th>Ngày tạo</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $user->role->role_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.account.edit', $user) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                        <form action="{{ route('admin.account.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow bi bi-trash3" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')"> Xóa</button>
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
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() ?? '#' }}">&laquo;</a>
                        </li>

                        {{-- Hiển thị danh sách số trang --}}
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- Nút sang trang sau --}}
                            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->nextPageUrl() ?? '#' }}">&raquo;</a>
                            </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.card -->

    </div>
</div>
@endsection