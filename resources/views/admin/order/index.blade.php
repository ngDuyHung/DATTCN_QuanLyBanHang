{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Danh sách đơn hàng')

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
                                <th>mã đơn hàng </th>
                                <th>người dùng </th>
                                <th>họ và tên</th>
                                <th>email/phone</th>
                                <th>hình thức</th>
                                <th>tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>@if(!empty($order->user_id)){{ 'Mã user:' . $order->user_id }}@else Khách vãng lai @endif</td>
                                <td>{{ $order->full_name }}</td>
                                <td>
                                    {{ $order->email }}<br>{{ $order->phone }}
                                </td>
                                <td>@if($order->payment_method== 'cod')
                                    Thanh toán khi nhận hàng
                                    @elseif($order->payment_method== 'bank_transfer')
                                    Thanh toán online
                                    @endif
                                </td>
                                <td>{{ $order->total_amount_format }}</td>
                                <td>@if($order->status == 'pending')
                                    <p class="badge text-bg-warning">Chờ thanh toán</p> 
                                    @elseif($order->status == 'processing')
                                    <p class="badge text-bg-info">Đang xử lý</p>
                                    @elseif($order->status == 'shipped')
                                    <p class="badge text-bg-primary">Đã giao hàng</p>
                                    @elseif($order->status == 'delivered')
                                    <p class="badge text-bg-success">Đã nhận hàng</p>
                                    @elseif($order->status == 'completed')
                                    <p class="badge text-bg-secondary">Hoàn thành</p>
                                    @elseif($order->status == 'cancelled')
                                    <p class="badge text-bg-danger">Đã hủy không hoàn tiền</p>
                                    @elseif($order->status == 'refunded')
                                    <p class="badge text-bg-danger">Đã hủy và hoàn tiền</p>
                                    @endif
                                <td>{{ $order->placed_at }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-outline-primary shadow bi bi-eye" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                                    <form action="{{ route('admin.order.destroy', $order) }}" method="POST" class="d-inline">
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
                    <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $orders->previousPageUrl() ?? '#' }}">&laquo;</a>
                    </li>

                    {{-- Hiển thị danh sách số trang --}}
                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        <li class="page-item {{ $i == $orders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Nút sang trang sau --}}
                        <li class="page-item {{ !$orders->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->nextPageUrl() ?? '#' }}">&raquo;</a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <div class="modal-content border-0 shadow-lg">
            
            <div class="modal-header bg-light">
                <h5 class="modal-title text-uppercase fw-bold text-primary" id="exampleModalLabel">
                    <i class="bi bi-box-seam-fill me-2"></i>Chi tiết đơn hàng #{{ $order->order_number }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form action="" method="post">
                    @csrf
                    
                    <div class="row g-4">
                        
                        <div class="col-lg-4 col-md-6 border-end">
                            <h6 class="text-secondary mb-3"><i class="bi bi-person-lines-fill me-2"></i>Thông tin khách hàng</h6>
                            
                            <div class="mb-3">
                                <label class="small text-muted">Họ và tên</label>
                                <div class="fw-bold">{{ $order->full_name }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="small text-muted">User ID / Email</label>
                                <div>
                                    <span class="badge bg-secondary me-1">ID: {{ $order->user_id }}</span>
                                    <span>{{ $order->email }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small text-muted">Số điện thoại</label>
                                <div class="fw-bold"><i class="bi bi-telephone me-1"></i> {{ $order->phone }}</div>
                            </div>

                            <div class="mb-3">
                                <label class="small text-muted">Địa chỉ giao hàng</label>
                                <div class="p-2 bg-light rounded border text-break">
                                    <i class="bi bi-geo-alt text-danger me-1"></i> {{ $order->address_snapshot }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 border-end">
                            <h6 class="text-secondary mb-3"><i class="bi bi-info-circle-fill me-2"></i>Chi tiết vận hành</h6>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="small text-muted">Mã đơn (Order ID)</label>
                                    <div class="fw-bold">{{ $order->order_id }}</div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="small text-muted">Ngày đặt</label>
                                    <div>{{ $order->placed_at }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small text-muted">Phương thức thanh toán</label>
                                <div class="fw-bold text-success">
                                    <i class="bi bi-credit-card-2-front me-1"></i> {{ $order->payment_method }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small text-muted">Trạng thái đơn hàng</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-activity"></i></span>
                                    <input type="text" class="form-control fw-bold text-primary" value="{{ $order->status_label }}" name="status" readonly> 
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="small text-muted">Ghi chú</label>
                                <textarea class="form-control bg-light" rows="2" readonly>{{ $order->note }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <h6 class="text-secondary mb-3"><i class="bi bi-currency-dollar me-2"></i>Tổng kết tài chính</h6>
                            
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Tạm tính (Subtotal)</span>
                                    <span class="fw-bold">{{ number_format($order->subtotal) }} đ</span> </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Phí vận chuyển</span>
                                    <span>{{ $order->shipping_fee_format }} </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-success">
                                    <span><i class="bi bi-ticket-perforated me-1"></i>Giảm giá ({{ $order->promo_id }})</span>
                                    <span>- {{ $order->discount_amount_format }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light border rounded mt-2 p-2">
                                    <span class="fw-bold text-uppercase">Tổng cộng</span>
                                    <span class="fs-5 fw-bold text-danger">{{ $order->total_amount_format }}</span>
                                </li>
                            </ul>

                            <div class="alert alert-info py-2 small">
                                <i class="bi bi-clock-history me-1"></i> Cập nhật lần cuối: {{ $order->updated_at }} <br>
                                <i class="bi bi-person-gear me-1"></i> Xử lý bởi: {{ $order->handled_by }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-4">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-warning px-4 fw-bold">
                            <i class="bi bi-save me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection