@extends('home')
@section('title', 'Thanh Toán Đơn Hàng Thành công')

@section('content')
<style>
    .order-success-container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        margin-top: 0px;
    }

    .success-header {
        text-align: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 15px;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .success-icon svg {
        width: 50px;
        height: 50px;
        fill: #28a745;
    }

    .success-header h1 {
        font-size: 28px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .success-header p {
        font-size: 16px;
        opacity: 0.95;
        margin: 0;
    }

    /* Layout 2 cột cho desktop */
    .order-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 30px;
        align-items: start;
    }

    .order-left-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-right-column {
        position: sticky;
        top: 20px;
    }

    .order-details-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .order-info-section {
        padding: 30px;
    }

    .order-number {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .order-number-label {
        font-weight: 600;
        color: #495057;
        font-size: 15px;
    }

    .order-number-value {
        font-size: 18px;
        font-weight: 700;
        color: #28a745;
        font-family: monospace;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 15px;
        color: #212529;
        font-weight: 500;
        word-break: break-word;
    }

    .order-items-section {
        padding: 30px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .section-title svg {
        width: 24px;
        height: 24px;
        margin-right: 10px;
        fill: #28a745;
    }

    /* Container có scroll cho sản phẩm */
    .order-items-container {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* Custom scrollbar */
    .order-items-container::-webkit-scrollbar {
        width: 8px;
    }

    .order-items-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .order-items-container::-webkit-scrollbar-thumb {
        background: #28a745;
        border-radius: 10px;
    }

    .order-items-container::-webkit-scrollbar-thumb:hover {
        background: #218838;
    }

    .order-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        background: white;
    }

    .order-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
        border: 1px solid #e9ecef;
        flex-shrink: 0;
    }

    .item-details {
        flex: 1;
        min-width: 0;
    }

    .item-name {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-meta {
        font-size: 14px;
        color: #6c757d;
    }

    .item-price {
        text-align: right;
        flex-shrink: 0;
        margin-left: 15px;
    }

    .item-quantity {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .item-total {
        font-size: 18px;
        font-weight: 700;
        color: #28a745;
        white-space: nowrap;
    }

    /* Summary Card - Sticky */
    .order-summary-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .order-summary {
        padding: 30px;
    }

    .summary-title {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 15px;
    }

    .summary-row.total {
        border-top: 2px solid #dee2e6;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 22px;
        font-weight: 700;
    }

    .summary-label {
        color: #495057;
        font-weight: 500;
    }

    .summary-value {
        font-weight: 600;
        color: #212529;
    }

    .summary-row.total .summary-value {
        color: #28a745;
    }

    .action-buttons {
        padding: 0 30px 30px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-custom {
        padding: 14px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .btn-primary-custom {
        background: #28a745;
        color: white;
    }

    .btn-primary-custom:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .btn-secondary-custom {
        background: white;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .btn-secondary-custom:hover {
        background: #f8f9fa;
        border-color: #28a745;
        color: #28a745;
        transform: translateY(-2px);
    }

    .payment-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .payment-status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .payment-status.paid {
        background: #d4edda;
        color: #155724;
    }

    .payment-status.cod {
        background: #d1ecf1;
        color: #0c5460;
    }

    /* Tablet */
    @media (max-width: 1024px) {
        .order-content-wrapper {
            grid-template-columns: 1fr;
        }

        .order-right-column {
            position: relative;
            top: 0;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .order-success-container {
            margin: 20px 10px;
            padding: 0;
        }

        .success-header {
            padding: 30px 15px;
            margin-bottom: 20px;
        }

        .success-header h1 {
            font-size: 22px;
        }

        .success-icon {
            width: 60px;
            height: 60px;
        }

        .success-icon svg {
            width: 35px;
            height: 35px;
        }

        .order-info-section,
        .order-items-section,
        .order-summary {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .order-items-container {
            max-height: 400px;
        }

       

        .item-image {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .item-name {
            white-space: normal;
        }

        .item-price {
            text-align: center;
            margin-top: 10px;
            margin-left: 0;
        }

        .action-buttons {
            padding: 0 20px 20px;
        }

        .summary-row {
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
        }
    }
</style>

<section class="bread-crumb mb-1 aebreadcrumb">
    <span class="crumb-border"></span>
    <div class="container">
        <div class="row">
            <div class="col-12 a-left">
                <ul class="breadcrumb m-0 px-0 py-2">
                    <li class="home">
                        <a href="/" class='link'><span>Trang chủ</span></a>
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>
                    <li><strong><span>Đặt hàng thành công</span></strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="order-success-container">
    <!-- Success Header -->
    <div class="success-header">
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </div>
        <h1>Đặt Hàng Thành Công!</h1>
        <p>Cảm ơn bạn đã tin tưởng và mua sắm tại cửa hàng chúng tôi</p>
    </div>

    @if(isset($order))
    <!-- Layout 2 cột cho PC/Laptop -->
    <div class="order-content-wrapper">
        
        <!-- Cột trái: Thông tin đơn hàng & Chi tiết sản phẩm -->
        <div class="order-left-column">
            
            <!-- Thông tin đơn hàng -->
            <div class="order-details-card">
                <div class="order-info-section">
                    <div class="order-number">
                        <span class="order-number-label">Mã đơn hàng:</span>
                        <span class="order-number-value">#{{ $order->order_number }}</span>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Người nhận</span>
                            <span class="info-value">{{ $order->full_name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $order->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Số điện thoại</span>
                            <span class="info-value">{{ $order->phone }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phương thức thanh toán</span>
                            <span class="info-value">
                                @if($order->payment_method === 'cod')
                                    Thanh toán khi nhận hàng (COD)
                                @elseif($order->payment_method === 'bank_transfer')
                                    Chuyển khoản ngân hàng
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
                            </span>
                        </div>
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <span class="info-label">Địa chỉ giao hàng</span>
                            <span class="info-value">{{ $order->address_snapshot }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Trạng thái đơn hàng</span>
                            <span class="info-value">
                                @if($order->status === 'pending')
                                    <span class="payment-status pending">Chờ xử lý</span>
                                @elseif($order->status === 'delivery')
                                    <span class="payment-status paid">Đang giao hàng</span>
                                @elseif($order->status === 'completed')
                                    <span class="payment-status cod">Hoàn thành</span>
                                @else
                                    <span class="payment-status">{{ ucfirst($order->status) }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    @if($order->note)
                    <div class="info-item mt-3">
                        <span class="info-label">Ghi chú đơn hàng</span>
                        <span class="info-value">{{ $order->note }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Chi tiết sản phẩm với scroll -->
            <div class="order-details-card">
                <div class="order-items-section">
                    <div class="section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        Chi tiết đơn hàng ({{ $order->orderItems->count() }} sản phẩm)
                    </div>

                    <!-- Container có scroll cho nhiều sản phẩm -->
                    <div class="order-items-container">
                        @if($order->orderItems && $order->orderItems->count() > 0)
                            @foreach($order->orderItems as $item)
                            <div class="order-item">
                                @if($item->product && $item->product->main_img_url)
                                    <img src="{{ asset('storage/' . $item->product->main_img_url) }}" 
                                         alt="{{ $item->product->product_name }}" 
                                         class="item-image">
                                @else
                                    <img src="https://via.placeholder.com/80" alt="Product" class="item-image">
                                @endif
                                
                                <div class="item-details">
                                    <div class="item-name" title="{{ $item->product->product_name ?? 'Sản phẩm' }}">
                                        {{ $item->product->product_name ?? 'Sản phẩm' }}
                                    </div>
                                    <div class="item-meta">
                                        @if($item->attribute_snapshot)
                                            {{ $item->attribute_snapshot }}
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="item-price">
                                    <div class="item-quantity">SL: {{ $item->quantity }}</div>
                                    <div class="item-total">{{ number_format($item->line_total, 0, ',', '.') }}₫</div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Cột phải: Tổng kết đơn hàng (Sticky) -->
        <div class="order-right-column">
            
            <!-- Tổng kết đơn hàng -->
            <div class="order-summary-card">
                <div class="order-summary">
                    <div class="summary-title">Tổng đơn hàng</div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Tạm tính:</span>
                        <span class="summary-value">{{ number_format($order->subtotal, 0, ',', '.') }}₫</span>
                    </div>
                    
                    @if($order->discount_amount > 0)
                    <div class="summary-row">
                        <span class="summary-label">Giảm giá:</span>
                        <span class="summary-value" style="color: #dc3545;">-{{ number_format($order->discount_amount, 0, ',', '.') }}₫</span>
                    </div>
                    @endif

                    <div class="summary-row">
                        <span class="summary-label">Phí vận chuyển:</span>
                        <span class="summary-value">
                            @if($order->shipping_fee > 0)
                                {{ number_format($order->shipping_fee, 0, ',', '.') }}₫
                            @else
                                Miễn phí
                            @endif
                        </span>
                    </div>
                    
                    <div class="summary-row total">
                        <span class="summary-label">Tổng cộng:</span>
                        <span class="summary-value">{{ number_format($order->total_amount, 0, ',', '.') }}₫</span>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="action-buttons">
                    <a href="/" class="btn-custom btn-primary-custom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="white" style="margin-right: 8px;">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Tiếp tục mua sắm
                    </a>
                    <a href="#" class="btn-custom btn-secondary-custom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                            <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        Xem đơn hàng của tôi
                    </a>
                </div>
            </div>

        </div>

    </div>
    @else
    <!-- Trường hợp không có thông tin đơn hàng -->
    <div class="order-details-card">
        <div class="order-info-section text-center">
            <p>Không tìm thấy thông tin đơn hàng. Vui lòng kiểm tra email của bạn để biết chi tiết.</p>
            <a href="/" class="btn-custom btn-primary-custom mt-3">Về trang chủ</a>
        </div>
    </div>
    @endif
</div>

<!-- Thông báo bổ sung -->
@if(isset($order))
<div class="container mb-5">
    <div class="alert alert-info" style="border-radius: 10px; border-left: 4px solid #28a745;">
        <h5 style="color: #28a745; font-weight: 700;">📧 Thông tin quan trọng</h5>
        <ul style="margin-bottom: 0; padding-left: 20px;">
            <li>Chúng tôi đã gửi email xác nhận đơn hàng đến <strong>{{ $order->email }}</strong></li>
            <li>Đơn hàng của bạn sẽ được xử lý trong vòng 24h</li>
            <li>Bạn có thể theo dõi tình trạng đơn hàng qua email hoặc số điện thoại đã đăng ký</li>
            @if($order->payment_method === 'bank_transfer')
            <li><strong>Lưu ý:</strong> Vui lòng chuyển khoản theo thông tin đã được gửi trong email</li>
            @endif
        </ul>
    </div>
</div>
@endif

@endsection