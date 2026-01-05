@extends('home')
@section('title', 'Lịch sử đơn hàng')

@section('content')
<section class="bread-crumb mb-1 aebreadcrumb">
    <span class="crumb-border"></span>
    <div class="container ">
        <div class="row">
            <div class="col-12 a-left">
                <ul class="breadcrumb m-0 px-0 py-2">
                    <li class="home">
                        <a href="/" class='link'><span>Trang chủ</span></a>
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>

                    <li>
                        <a href="/account" class="link"><span>Tài khoản</span></a>
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>

                    <li><strong><span>Đơn hàng 588605</span></strong></li>


                </ul>
            </div>
        </div>
    </div>
</section>
<h1 class="d-none">Chi tiết đơn hàng 588605</h1>
<section class="page_customer_account order-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="block-account">
                    <div class="block-title">
                        <div class="thumb">
                            <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/account_user.svg?1767531620370" alt="Ảnh đại diện">
                        </div>
                        <div class="info">
                            @if($user = Auth::user())
                            <h2>{{ Auth::user()->name }}</h2>
                            @else
                            <h2>Khách chưa đăng nhập</h2>
                            @endif
                            <!-- <button type="button">
				<img width="12" height="12" src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/account_edit.svg?1767531620370" alt="Sửa Hồ Sơ">
				<span>Sửa hồ sơ</span>
				</button> -->
                        </div>
                        <button type="button" class="show-menu"><svg xmlns="http://www.w3.org/2000/svg" height="384pt" viewBox="0 -53 384 384" width="384pt">
                                <path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" />
                                <path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" />
                                <path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" />
                            </svg></button>
                    </div>
                    <ul class="block-menu">

                        <li>
                            <a href="/account">Tài Khoản Của Tôi</a>
                        </li>
                        <li class="active">
                            <a href="/account/orders">Đơn Mua</a>
                        </li>

                        @if(Auth::check())
                        <li>
                            <a href="{{ route('logout') }}">Đăng xuất</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="order-detail-title">
                    <a href="/account/orders" title="TRỞ LẠI"> <i class="fa fa-arrow-left"></i> TRỞ LẠI</a>
                    <div class="order-code">
                        MÃ ĐƠN HÀNG: {{ $order->order_id }} | <b>
                            @if($order->status == 'pending')
                            <span style="color: orange; font-weight: 600;">Đang xử lý</span>
                            @elseif($order->status == 'delivery')
                            <span style="color: blue; font-weight: 600;">Đang vận chuyển</span>
                            @elseif($order->status == 'completed')
                            <span style="color: green; font-weight: 600;">Hoàn thành</span>
                            @elseif($order->status == 'cancelled')
                            <span style="color: red; font-weight: 600;">Đã hủy</span>
                            @endif
                        </b>
                    </div>
                </div>
                <div class="order-detail-steps">



                    <div class="order-status-steps">
                        <div class="step {{ $order->status != 'cancelled' ? 'active' : '' }}">
                            <div class="thumb " >
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
                            <div class="thumb " >
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
                        <!-- <div class="step ">
                            <div class="thumb">
                                <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/icon_step_5.png?1767546091643" alt="Đánh Giá">
                            </div>
                            <div class="label">Đánh Giá</div>
                        </div> -->
                    </div>
                </div>
                <div class="order-detail-action">


                    <button type="button" class="btn btn-contact" id="cmmz-contact-btn">LIÊN HỆ</button>
                    <!-- <button type="button" class="btn btn-review">ĐÁNH GIÁ</button> -->

                </div>
                <div class="order-detail-info">
                    <h3>THÔNG TIN GIAO HÀNG</h3>
                    <p>TÊN NGƯỜI NHẬN: {{ $order->full_name }}</p>

                    <p>SỐ ĐIỆN THOẠI: 0{{ $order->phone }}</p>

                    <p>ĐỊA CHỈ:

                        {{ $order->address_snapshot }}
                    </p>
                    <p>PHƯƠNG THỨC GIAO HÀNG:
                        @if($order->payment_method == 'cod')
                        GIAO HÀNG TIÊU CHUẨN - Thanh toán khi nhận hàng
                        @elseif($order->payment_method == 'bank_transfer')
                        GIAO HÀNG TIÊU CHUẨN - Chuyển khoản ngân hàng
                        @endif
                    </p>
                    <p>GHI CHÚ:
                        @if($order->note)
                        {{ $order->note }}
                        @else
                        Không có ghi chú
                        @endif
                    </p>
                </div>
                <!-- <div class="order-detail-transport">
                    <h3>ĐƠN VỊ VẬN CHUYỂN</h3>



                </div> -->
                <div class="order-detail-product">
                    <h3>THÔNG TIN SẢN PHẨM</h3>
                    <div id="order_details" class="table table-cart">
                        @foreach($order->orderItems as $item)
                        <div class="order-product">
                            <a target="_blank" href="/{{$item->product->slug}}"></a>
                            <img src="{{ asset('storage/' . $item->product->main_img_url) }}" alt="{{$item->product->name}}">
                            <div class="product-info">
                                <div class="product-title">{{$item->product->name}}</div>

                                <div class="product-price">{{$item->quantity}} x <b>{{ $item->getUnitPriceFormatAttribute() }}</b></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <table class="table totalorders">
                        <tfoot>
                            <tr class="order_summary discount">
                                <td>Khuyến mại </td>

                                <td class="total money right">{{ $order->getDiscountAmountFormatAttribute() }}</td>
                            </tr>

                            <tr class="order_summary ">
                                <td colspan="">Phí vận chuyển</td>
                                <td class="total money right">

                                    {{ $order->getShippingFeeFormatAttribute() }}


                                    (GIAO NHANH 8-16 tiếng (Trong giờ hành chính)</br>Giao từ thứ 2 đến thứ 7)

                                </td>

                            </tr>

                            <tr class="order_summary order_total">
                                <td>Tổng tiền</td>
                                <td class="right"><strong style="color:#CA170E;font-size:19px;">{{ $order->getTotalAmountFormatAttribute() }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection