{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách kho hàng')
@section('name_btn_add', 'Thêm kho hàng')
@section('link_btn_add', route('admin.inventory.create'))
{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped table-hover table-module mb-0">
                            <thead>
                                <tr>
                                    <th>Mã ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Mã SKU</th>
                                    <th>Tình trạng</th>
                                    <th>Đã bán</th>
                                    <th>SL trong kho</th>
                                    <th class="text-danger" title="Ngưỡng cảnh báo tối thiểu">
                                        Tối thiểu
                                    </th>
                                    <th>Ngày cập nhật cuối</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventorys as $inventory)
                                <tr>
                                    <td>{{ $inventory->inventory_id }}</td>
                                    <td>{{ Str::limit($inventory->product->name ?? 'N/A', 25) }}</td>
                                    <td>{{ $inventory->product->sku ?? 'N/A' }}</td>
                                    <td>
                                        @if($inventory->quantity_in_stock <= $inventory->min_alert_quantity)
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-circle me-1"></i> Sắp hết hàng</span>
                                            @else
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Đủ hàng</span>
                                            @endif
                                    </td>
                                    <td></td>
                                    <td>{{ $inventory->quantity_in_stock }}</td>
                                    <td class="text-danger">{{ $inventory->min_alert_quantity }}</td>
                                    <td>{{ $inventory->last_updated }}</td>

                                    <td>
                                        <a href="{{ route('admin.inventory.edit', $inventory) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                        <form action="{{ route('admin.inventory.destroy', $inventory) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow bi bi-trash3" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"> Xóa</button>
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
                        <li class="page-item {{ $inventorys->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $inventorys->previousPageUrl() ?? '#' }}">&laquo;</a>
                        </li>

                        {{-- Hiển thị danh sách số trang --}}
                        @for ($i = 1; $i <= $inventorys->lastPage(); $i++)
                            <li class="page-item {{ $i == $inventorys->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $inventorys->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- Nút sang trang sau --}}
                            <li class="page-item {{ !$inventorys->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $inventorys->nextPageUrl() ?? '#' }}">&raquo;</a>
                            </li>
                    </ul>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->


@endsection