@extends('layouts.admin')

@section('title', 'Cập nhật đơn hàng #' . $order->order_number)

@section('content')
<div class="container-fluid">
    {{-- Header & Breadcrumb --}}

    <form action="{{ route('admin.order.update', $order->order_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- CỘT TRÁI: THÔNG TIN KHÁCH HÀNG & GIAO HÀNG --}}
            <div class="col-12 mb-3">
                <div class="order-detail-steps">
                    <div class="order-status-steps">
                        <div class="step {{ $order->status != 'cancelled' ? 'active' : '' }}">
                            <div class="thumb">
                                <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/icon_step_1.png?1767546091643" alt="Đặt Hàng Thành Công">
                            </div>
                            <div class="label">Đặt Hàng Thành Công</div>
                        </div>
                        <div class="step {{ $order->status == 'pending'  || $order->status == 'delivery' || $order->status == 'completed' ? 'active' : '' }}">
                            <div class="thumb">
                                <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/icon_step_2.png?1767546091643" alt="Chờ Lấy Hàng">
                            </div>
                            <div class="label">Chờ Lấy Hàng</div>
                        </div>
                        <div class="step {{ $order->status == 'delivery' || $order->status == 'completed' ? 'active' : '' }}">
                            <div class="thumb">
                                <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/icon_step_3.png?1767546091643" alt="Đang Vận Chuyển">
                            </div>
                            <div class="label">Đang Vận Chuyển</div>
                        </div>
                        <div class="step {{ $order->status == 'completed' ? 'active' : '' }}">
                            <div class="thumb">
                                <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/icon_step_4.png?1767546091643" alt="Giao Hàng Thành Công">
                            </div>
                            <div class="label">Giao Hàng Thành Công</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                {{-- Card 1: Thông tin khách hàng --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-person-lines-fill me-2"></i>Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $order->full_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $order->phone) }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $order->email) }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address_snapshot" class="form-label fw-bold">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address_snapshot') is-invalid @enderror" id="address_snapshot" name="address_snapshot" rows="3" required>{{ old('address_snapshot', $order->address_snapshot) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Ghi chú đơn hàng --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-journal-text me-2"></i>Ghi chú & Xử lý</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú của khách hàng / Admin</label>
                            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Nhập ghi chú...">{{ old('note', $order->note) }}</textarea>
                        </div>
                        <div class="alert alert-light border">
                            <small class="text-muted">
                                <strong>Người xử lý gần nhất:</strong> {{ $order->handled_by ?? 'Chưa có' }} <br>
                                <strong>Cập nhật lần cuối:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- CỘT PHẢI: TRẠNG THÁI & TÀI CHÍNH --}}
            <div class="col-lg-4">
                {{-- Card 3: Hành động & Trạng thái (Quan trọng nhất để lên đầu) --}}
                <div class="card shadow-sm mb-4 border-top-primary">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Trạng thái đơn hàng</label>
                            <select class="form-select form-select-lg @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🕒 Đang chờ xử lý</option>
                                <option value="delivery" {{ $order->status == 'delivery' ? 'selected' : '' }}>🚛 Đang giao hàng</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Đã hủy</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-1"></i> Cập nhật đơn hàng
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Chi tiết tài chính --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-cash-coin me-2"></i>Chi tiết thanh toán</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-4">Tổng tiền hàng</td>
                                    <td class="text-end pe-4 fw-bold">{{ number_format($order->subtotal) }} đ</td>
                                    {{-- Input ẩn để gửi dữ liệu nếu cần, nhưng controller không update subtotal nên chỉ hiển thị --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-4">Giảm giá (Coupon)</td>
                                    <td class="text-end pe-4 text-success">- {{ number_format($order->discount_amount) }} đ</td>
                                </tr>
                                <tr class="bg-light">
                                    <td class="ps-4 align-middle">Phí vận chuyển</td>
                                    <td class="pe-4">
                                        {{-- Phí ship thường có thể sửa được --}}
                                        <input type="number" class="form-control form-control-sm text-end" name="shipping_fee" value="{{ $order->shipping_fee }}">
                                    </td>
                                </tr>
                                <tr class="border-top">
                                    <td class="ps-4 py-3 fw-bold h5">Tổng cộng</td>
                                    <td class="text-end pe-4 py-3 fw-bold h5 text-primary">{{ number_format($order->total_amount) }} đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="px-4 pb-3">
                            <label class="form-label text-muted small">Phương thức thanh toán</label>
                            <input type="text" class="form-control bg-light" value="{{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến' }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- Card 5: Thông tin hệ thống (Read-only) --}}
                <div class="card shadow-sm">
                    <div class="card-body bg-light text-muted small">
                        <div class="mb-2">
                            <strong>Mã đơn hàng (ID):</strong> #{{ $order->order_id }}
                        </div>
                        @if(!empty($order->user_id))
                        <div class="mb-2">
                            <strong>User ID:</strong> {{ $order->user_id }}
                        </div>
                        @endif
                        <div class="mb-2">
                            <strong>Ngày đặt hàng:</strong> {{ $order->placed_at->format('d/m/Y H:i') }}
                        </div>
                        @if($order->promo_id)
                        <div>
                            <strong>Mã KM sử dụng:</strong> {{ $order->promo_id }}
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2 mt-sm-0">
        <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
        </a>
    </div>
</div>
@endsection