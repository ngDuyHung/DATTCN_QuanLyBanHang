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
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped table-hover table-module mb-0">
                            <thead>
                                <tr>
                                    <th>mã đơn hàng </th>
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
                                    <td>{{ $order->full_name }}<br>
                                        @if(!empty($order->user_id)){{ 'Mã user:' }}<span class="h6 text-danger">{{ $order->user_id }}</span>@else <span class="h6 text-danger">Khách vãng lai</span> @endif
                                    </td>
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
                                        <p class="badge text-bg-warning">Đang chờ xử lý</p>
                                        @elseif($order->status == 'delivery')
                                        <p class="badge text-bg-primary">Đang giao hàng</p>
                                        @elseif($order->status == 'completed')
                                        <p class="badge text-bg-success">Hoàn thành</p>
                                        @elseif($order->status == 'cancelled')
                                        <p class="badge text-bg-danger">Đã hủy </p>

                                        @endif
                                    <td>{{ $order->placed_at }}</td>
                                    <td class="text-center">
                                        <!-- Nút xem -->
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-outline-primary shadow bi bi-eye btn-show-order"
                                            data-url="{{ route('admin.order.show_api', ['id' => $order->order_id]) }}">
                                        </a>

                                        <!-- Dropdown cho Sửa / Xóa -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary shadow dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-gear"></i> <!-- icon bánh răng -->
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('admin.order.edit', $order) }}" class="dropdown-item">
                                                        <i class="bi bi-pencil text-warning"></i> Sửa
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.order.destroy', $order) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="bi bi-trash3"></i> Xóa
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
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


{{-- Đoạn Modal Vỏ Rỗng --}}
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">

        {{-- QUAN TRỌNG: id="modalContentArea" nằm ở class modal-content --}}
        <div class="modal-content border-0 shadow-lg" id="modalContentArea">

            {{-- Loading State mặc định --}}
            <div class="modal-body p-5 text-center">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-3 text-muted">Đang tải dữ liệu...</p>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Script loaded successfully');

        // Sử dụng Event Delegation (bắt sự kiện từ body) để không bị lỗi với các element sinh ra sau
        document.body.addEventListener('click', function(event) {

            // Tìm xem người dùng có click vào nút (hoặc icon bên trong nút) có class .btn-show-order không
            const button = event.target.closest('.btn-show-order');

            if (button) {
                event.preventDefault(); // Ngăn chặn load lại trang
                console.log('Button clicked!');

                const url = button.getAttribute('data-url');
                console.log('URL:', url);

                const modalElement = document.getElementById('orderDetailModal');
                const modalContent = document.getElementById('modalContentArea');

                // 1. Mở Modal (Hỗ trợ Bootstrap 5)
                if (typeof bootstrap !== 'undefined') {
                    const myModal = new bootstrap.Modal(modalElement);
                    myModal.show();
                    console.log('Modal opened with Bootstrap 5');
                } else if (typeof $ !== 'undefined' && $.fn.modal) {
                    // Fallback cho Bootstrap 4 với jQuery
                    $(modalElement).modal('show');
                    console.log('Modal opened with Bootstrap 4');
                } else {
                    console.error('Bootstrap not found!');
                    return;
                }

                // 2. Hiển thị Loading
                modalContent.innerHTML = `
                    <div class="modal-body p-5 text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Đang tải dữ liệu...</p>
                    </div>
                `;

                // 3. Gọi AJAX bằng Fetch API
                console.log('Fetching data from:', url);
                fetch(url)
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error('HTTP error! status: ' + response.status);
                        }
                        return response.text();
                    })
                    .then(html => {
                        console.log('HTML received, length:', html.length);
                        console.log('First 200 chars:', html.substring(0, 200));

                        // 4. Gán HTML vào modal
                        modalContent.innerHTML = html;
                        console.log('HTML injected successfully');
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        modalContent.innerHTML = `
                            <div class="modal-body text-center text-danger p-5">
                                <i class="bi bi-exclamation-triangle fs-1"></i>
                                <p class="mt-3">Lỗi: Không thể tải dữ liệu đơn hàng.</p>
                                <p class="text-muted small">${error.message}</p>
                                <button type="button" class="btn btn-light mt-2" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        `;
                    });
            }
        });
    });
</script>
@endsection