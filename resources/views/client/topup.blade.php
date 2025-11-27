@extends('home')
@section('title', 'Thanh Toán Đơn Hàng')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- QR Code Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header btn-checkout text-white">
                    <h5 class="mb-0"><i class="fas fa-qrcode"></i> Quét Mã QR Để Thanh Toán</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="https://img.vietqr.io/image/{{ config('services.bank.bank_id', 'MB') }}-{{ config('services.bank.account_no', '0124676767777') }}-compact2.png?amount={{ $order->total_amount }}&addInfo=DH{{ $order->order_number }}&accountName={{ urlencode(config('services.bank.account_name', 'NGUYEN DUY HUNG')) }}"
                            alt="QR Code"
                            class="img-fluid"
                            style="max-width: 350px; border: 2px solid #ddd; border-radius: 8px; padding: 10px; background: white;">
                    </div>

                    <div class="alert alert-info">
                        <h6 class="mb-2"><i class="fas fa-info-circle"></i> Thông Tin Chuyển Khoản</h6>
                        <p class="mb-1"><strong>Ngân hàng:</strong> {{ config('services.bank.bank_name', 'MB Bank') }}</p>
                        <p class="mb-1"><strong>Số tài khoản:</strong> <code>{{ config('services.bank.account_no', '0124676767777') }}</code></p>
                        <p class="mb-1"><strong>Chủ tài khoản:</strong> {{ config('services.bank.account_name', 'NGUYEN DUY HUNG') }}</p>
                        <p class="mb-1"><strong>Số tiền:</strong> <span class="text-danger font-weight-bold">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</span></p>
                        <p class="mb-0"><strong>Nội dung:</strong> <code>DH{{ $order->order_number }}</code></p>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Lưu ý:</strong> Vui lòng chuyển đúng nội dung để đơn hàng được xử lý tự động.
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Information Section -->
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header btn-checkout text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Thông Tin Đơn Hàng #{{ $order->order_number }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p><strong>Mã đơn hàng:</strong> <span class="badge badge-primary">{{ $order->order_number }}</span></p>
                        <p><strong>Ngày đặt:</strong> {{ $order->placed_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng thái:</strong>
                            @if($order->status == 'pending')
                            <span class="status-badge status-pending">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Chờ thanh toán
                            </span>
                            @elseif($order->status == 'processing')
                            <span class="status-badge status-processing">
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Đang xử lý
                            </span>
                            @elseif($order->status == 'completed')
                            <span class="status-badge status-completed">
                                <i class="fas fa-check-circle"></i>
                                Hoàn thành
                            </span>
                            @else
                            <span class="status-badge status-default">{{ $order->status }}</span>
                            @endif
                        </p>
                    </div>

                    <hr>

                    <h6 class="mb-3"><i class="fas fa-box"></i> Sản Phẩm Đã Đặt</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">SL</th>
                                    <th class="text-right">Đơn giá</th>
                                    <th class="text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->main_img_url)
                                            <img src="{{ asset('storage/' . $item->product->main_img_url) }}"
                                                alt="{{ $item->product_name }}"
                                                class="img-thumbnail mr-2"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <div class="font-weight-bold">{{ $item->product_name }}</div>
                                                @if($item->sku)
                                                <small class="text-muted">SKU: {{ $item->sku }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">{{ number_format($item->unit_price, 0, ',', '.') }}₫</td>
                                    <td class="text-right font-weight-bold">{{ number_format($item->line_total, 0, ',', '.') }}₫</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                </div>
                <div class="container bg-light">
                    <div class="row justify-content-end">
                        <div class="col-4">
                           <p class="text-right font-weight-bold mt-1">Tổng cộng:</p> 
                        </div>
                        <div class="col-4">
                           <p class="text-danger font-weight-bold" style="font-size: 1.2em;">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card shadow-sm">
                <div class="card-header btn-checkout text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Thông Tin Khách Hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->full_name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->address_snapshot }}</p>
                    @if($order->note)
                    <p><strong>Ghi chú:</strong> <em>{{ $order->note }}</em></p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="payment-btn payment-btn-secondary">
                    <i class="fas fa-home"></i> Về Trang Chủ
                </a>
                <button class="payment-btn payment-btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Xuất Hóa đơn
                </button>
                <button class="payment-btn payment-btn-success" onclick="location.reload()">
                    <i class="fas fa-sync"></i> Kiểm Tra Thanh Toán
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Override theme CSS conflicts */
    .payment-btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        margin: 0.25rem;
    }

    .payment-btn:hover {
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .payment-btn-primary {
        color: #fff !important;
        background-color: #007bff !important;
        border-color: #007bff !important;
    }

    .payment-btn-primary:hover {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
    }

    .payment-btn-success {
        color: #fff !important;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    .payment-btn-success:hover {
        background-color: #218838 !important;
        border-color: #1e7e34 !important;
    }

    .payment-btn-secondary {
        color: #fff !important;
        background-color: #6c757d !important;
        border-color: #6c757d !important;
    }

    .payment-btn-secondary:hover {
        background-color: #5a6268 !important;
        border-color: #545b62 !important;
    }

    @media print {

        .payment-btn,
        .alert-warning {
            display: none !important;
        }
    }

    .card {
        border-radius: 8px;
        border: none;
    }

    .card-header {
        border-radius: 8px 8px 0 0 !important;
        padding: 15px 20px;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .img-thumbnail {
        border-radius: 4px;
    }

    code {
        background: #f8f9fa;
        padding: 2px 6px;
        border-radius: 3px;
        color: #e83e8c;
        font-size: 0.9em;
    }

    /* Status Badge Styles */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .status-pending {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
        animation: pulse-pending 2s ease-in-out infinite;
    }

    .status-processing {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
    }

    .status-completed {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }

    .status-completed i {
        animation: checkmark-pop 0.5s ease-out;
    }

    .status-default {
        background: #6c757d;
        color: #fff !important;
    }

    /* Spinner customization */
    .status-badge .spinner-border,
    .status-badge .spinner-grow {
        width: 14px;
        height: 14px;
        border-width: 2px;
    }

    /* Animations */
    @keyframes pulse-pending {

        0%,
        100% {
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
        }

        50% {
            box-shadow: 0 4px 16px rgba(255, 193, 7, 0.6);
        }
    }

    @keyframes checkmark-pop {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
@endsection