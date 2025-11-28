{{-- Phần Header --}}
<div class="modal-header bg-light">
    <h5 class="modal-title text-uppercase fw-bold text-primary">
        <i class="bi bi-box-seam-fill me-2"></i>Chi tiết đơn hàng #{{ $order->order_number }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

{{-- Phần Body --}}
<div class="modal-body p-4">
    <div class="row g-4">
        {{-- Cột Trái: Thông tin khách hàng --}}
        <div class="col-lg-4 col-md-6 border-end">
            <h6 class="text-secondary mb-3"><i class="bi bi-person-lines-fill me-2"></i>Thông tin khách hàng</h6>
            
            <div class="mb-3">
                <label class="small text-muted">Họ và tên</label>
                <div class="fw-bold">{{ $order->full_name }}</div>
            </div>

            <div class="mb-3">
                <label class="small text-muted">User ID / Email</label>
                <div>
                    @if($order->user_id)
                        <span class="badge bg-secondary me-1">ID: {{ $order->user_id }}</span>
                    @endif
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

        {{-- Cột Giữa: Thông tin vận hành --}}
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
                    <i class="bi bi-credit-card-2-front me-1"></i> 
                    {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản / Online' }}
                </div>
            </div>

            <div class="mb-3">
                <label class="small text-muted">Trạng thái đơn hàng</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-activity"></i></span>
                    {{-- Hiển thị trạng thái dạng text --}}
                    <input type="text" class="form-control fw-bold text-primary" 
                           value="{{ ucfirst($order->status) }}" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label class="small text-muted">Ghi chú</label>
                <textarea class="form-control bg-light" rows="2" readonly>{{ $order->note }}</textarea>
            </div>
        </div>

        {{-- Cột Phải: Tài chính --}}
        <div class="col-lg-4 col-md-12">
            <h6 class="text-secondary mb-3"><i class="bi bi-currency-dollar me-2"></i>Tổng kết tài chính</h6>

            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">Tạm tính</span>
                    <span class="fw-bold">{{ number_format($order->subtotal) }} đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-muted">Phí vận chuyển</span>
                    <span>{{ number_format($order->shipping_fee) }} đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-success">
                    <span><i class="bi bi-ticket-perforated me-1"></i>Giảm giá ({{ $order->promo_id }})</span>
                    <span>- {{ number_format($order->discount_amount) }} đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light border rounded mt-2 p-2">
                    <span class="fw-bold text-uppercase">Tổng cộng</span>
                    <span class="fs-5 fw-bold text-danger">{{ number_format($order->total_amount) }} đ</span>
                </li>
            </ul>

            <div class="alert alert-info py-2 small">
                <i class="bi bi-clock-history me-1"></i> Cập nhật: {{ $order->updated_at }} <br>
                <i class="bi bi-person-gear me-1"></i> Xử lý bởi: {{ $order->handler->name ?? 'Chưa có' }}
            </div>
        </div>
    </div>
</div>

{{-- Phần Footer --}}
<div class="modal-footer border-0 pt-4">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
    <a href="{{ route('admin.order.edit', $order->order_id) }}" class="btn btn-sm btn-warning shadow">
        <i class="bi bi-pencil me-1"></i>Sửa đơn hàng
    </a>
</div>