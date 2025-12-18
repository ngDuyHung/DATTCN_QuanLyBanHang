{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách mã khuyến mãi')

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
                                 <!-- promo_id	code	description	discount_type	discount_value	starts_at	ends_at	usage_limit	times_used	is_active	created_at	updated_at	 -->
   
                                <th>Mã id</th>
                                <th>code</th>
                                <th>Loại giảm giá</th>
                                <th>Giá trị giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Giới hạn sử dụng</th>
                                <th>Số lần đã sử dụng</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->promo_id }}</td>
                                <td>{{ $promotion->code }}</td>
                                <td>
                                    @if($promotion->discount_type == 'percent')
                                        Giảm theo phần trăm
                                    @elseif($promotion->discount_type == 'fixed')
                                        Giảm theo số tiền cố định
                                    @endif
                                </td>
                                <td>
                                    @if($promotion->discount_type == 'percent')
                                        {{ $promotion->discount_value }}%
                                    @elseif($promotion->discount_type == 'fixed')
                                        {{ $promotion->discount_value }} VNĐ
                                    @endif
                                <td>{{ $promotion->starts_at }}</td>
                                <td>{{ $promotion->ends_at }}</td>
                                <td>{{ $promotion->usage_limit }}</td>
                                <td>{{ $promotion->times_used }}</td>
                                <td>
                                    <div class="form-check form-switch custom-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            {{ $promotion->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.promotion.edit', $promotion) }}" class="btn btn-sm btn-outline-warning shadow bi bi-pencil"> Sửa</a>
                                    <form action="{{ route('admin.promotion.destroy', $promotion) }}" method="POST" class="d-inline">
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
                    <li class="page-item {{ $promotions->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $promotions->previousPageUrl() ?? '#' }}">&laquo;</a>
                    </li>

                    {{-- Hiển thị danh sách số trang --}}
                    @for ($i = 1; $i <= $promotions->lastPage(); $i++)
                        <li class="page-item {{ $i == $promotions->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $promotions->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$promotions->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $promotions->nextPageUrl() ?? '#' }}">&raquo;</a>
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

<!--end::Row-->
</div>
@endsection