@extends('home')
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

                    <li><strong><span>Giỏ hàng</span></strong></li>

                </ul>
            </div>
        </div>
    </div>
</section>

<div id="tab-header"></div>
<section class="main-cart-page main-container col1-layout mobile-tab active" id="cart-tab" data-title="Giỏ hàng">
    <div class="wrap_background_aside padding-top-15 margin-bottom-40 padding-left-0 padding-right-0 cartmbstyle">
        @if(!$cartItems->isEmpty())
        <div id="data-cart" class="cart-mobile container card border-0 py-2">
            <form action="{{route('cart.checkout')}}" method="post" novalidate="" class="margin-bottom-0">
                @csrf
                <div class="header-cart">
                    <div class=" title_cart_mobile heading-bar">
                        <h1 class="heading-bar__title">Giỏ hàng</h1>
                    </div>
                </div>

                <div class="header-cart-content">
                    <div class="cart_page_mobile content-product-list">
                        @foreach($cartItems as $item)
                        <input type="hidden" name="products[{{ $item->product->product_id }}][id]" value="{{ $item->product->product_id }}">
                        <input type="hidden" name="products[{{ $item->product->product_id }}][qty]" value="{{ $item->quantity }}" class="hidden-qty">

                        <div class="item-product item productid-149063056 ">
                            <div class="text-center">
                                <a class="remove-itemx remove-item-cart " title="Xóa" href="javascript:;" data-id="{{ $item->product->product_id }}">
                                    <svg class="icon" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M0.620965 12C0.462896 12 0.304826 11.9399 0.184729 11.8189C-0.0563681 11.5778 -0.0563681 11.1869 0.184729 10.9458L10.9497 0.180823C11.1908 -0.0602744 11.5817 -0.0602744 11.8228 0.180823C12.0639 0.421921 12.0639 0.8128 11.8228 1.05405L1.05795 11.8189C0.936954 11.9392 0.778884 12 0.620965 12Z" fill="#8C9196"></path>
                                            <path d="M11.3867 12C11.2287 12 11.0707 11.9399 10.9505 11.8189L0.184729 1.05405C-0.0563681 0.8128 -0.0563681 0.421921 0.184729 0.180823C0.425827 -0.0602744 0.816706 -0.0602744 1.05795 0.180823L11.8228 10.9458C12.0639 11.1869 12.0639 11.5778 11.8228 11.8189C11.7018 11.9392 11.5439 12 11.3867 12Z" fill="#8C9196"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="12" height="12" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                            <div class="item-product-cart-mobile">
                                <a href="{{$item->product->product_id}}"
                                    title="{{$item->product->name}}">
                                </a><a class="product-images1  pos-relative embed-responsive embed-responsive-1by1" href="" title="{{$item->product->name}}">
                                    <img class="img-fluid" src="{{ asset('storage/' . $item->product->main_img_url) }}" alt="{{$item->product->name}}">
                                </a>

                            </div>
                            <div class="product-cart-infor">
                                <div class="title-product-cart-mobile">
                                    <h3 class="product-name"> <a class="text2line" href="{{$item->product->product_id}}" title="{{$item->product->name}}">
                                            {{$item->product->name}}</a> </h3>
                                    <span class="variant-title"></span>
                                </div>

                                <div class="cart-price">
                                    <span class="product-price price">{{$item->product->price_format}} ₫</span>
                                </div>
                                <div class="select-item-qty-mobile">
                                    <div class="txt_center">
                                        <button class="btn-minus btn" type="button" data-id="{{ $item->product->product_id }}">
                                            <svg class="icon">
                                                <use xlink:href="#icon-minus"></use>
                                            </svg>
                                        </button>

                                        <input type="text"
                                            class="form-control qty-input"
                                            data-id="{{ $item->product->product_id }}"
                                            value="{{ $item->quantity }}"
                                            min="1">

                                        <button class="btn-plus btn" type="button" data-id="{{ $item->product->product_id }}">
                                            <svg class="icon">
                                                <use xlink:href="#icon-plus"></use>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="cart-note">
                            <label for="note" class="note-label">Ghi chú đơn hàng</label>
                            <textarea id="note" name="note" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="header-cart-price">
                        <div class="timedeli-modal">
                            <div class="timedeli-modal-content">
                                <button type="button" class="close window-close d-sm-none" aria-label="Close" style="z-index: 9;"><span aria-hidden="true">×</span></button>
                                <div class="timedeli d-sm-block"></div>
                                <div class="timedeli-cta">
                                    <button class="btn btn-block timedeli-btn  d-sm-none" type="button">
                                        <span>Xong</span>
                                    </button>
                                </div>
                            </div>
                            <div class="timedeli-overaly">
                            </div>
                        </div>


                        <div class="title-cart d-none d-sm-flex ">
                            <h3 class="text-xs-left">TỔNG CỘNG</h3>
                            <span class="text-xs-right  totals_price_mobile">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
                        </div>

                        <div class="cart-limit-alert d-xs-none" style="display: none;">
                            <i class="fa fa-info-circle mr-1" aria-hidden="true"></i> Đơn hàng của bạn chưa đạt giá trị tối thiểu 100.000đ.
                            Vui lòng chọn mua thêm sản phẩm.
                        </div>



                        <div class="checkout d-block">
                            <button type="submit" class="btn btn-block btn-proceed-checkout-mobile" title="Tiến hành thanh toán">
                                <span>Thanh Toán</span>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        @endif
        <div id="empty-cart" class="cart-empty container card border-0 py-2 ">
            <div class="alert green-alert section" role="alert">
                <div class="title-cart text-center">
                    <h1 class="d-none">Giỏ hàng</h1>
                    <div>
                        <img src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/cart_empty_background.png?1764038849443" class="img-fluid" width="298" height="152">
                    </div>
                    <h3>
                        Hổng có gì trong giỏ hết
                    </h3>
                    <p> Về trang cửa hàng để chọn mua sản phẩm bạn nhé!!</p>
                    <a href="/" title="Mua sắm ngay" class="btn btn-main">Mua sắm ngay</a>
                </div>
            </div>
        </div>


    </div>
</section>


<script>
    $(document).on('click', '.remove-item-cart', function() {
        let productID = $(this).data('id');

        $.ajax({
            url: '/cart/delete/' + productID,
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {

                // Xoá đúng item
                $(`.remove-item-cart[data-id="${productID}"]`)
                    .closest('.item-product')
                    .remove();

                // Cập nhật tổng tiền
                $('.totals_price_mobile').text(res.totalPrice.toLocaleString('vi-VN') + ' ₫');
                // Kiểm tra giỏ hàng trống
                if ($('.item-product').length === 0) {
                    $('#data-cart').hide();
                    $('#empty-cart').show();
                }
            }
        });
    });


    $(document).on('change', '.qty-input', function() {
        updateQuantity($(this));
    });

    $(document).on('click', '.btn-plus', function() {
        let parent = $(this).closest('.txt_center');
        let input = parent.find('.qty-input');

        let qty = parseInt(input.val()) + 1;
        input.val(qty);

        updateQuantity(input);
    });

    $(document).on('click', '.btn-minus', function() {
        let parent = $(this).closest('.txt_center');
        let input = parent.find('.qty-input');

        let qty = parseInt(input.val());
        if (qty > 1) {
            qty--;
            input.val(qty);
            updateQuantity(input);
        }
    });

    function updateQuantity(input) {
        let productID = input.data('id');

        //Cập nhật hidden input trong form
        $('input[name="products[' + productID + '][qty]"]').val(input.val());

        $.ajax({
            url: '/cart/update',
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: input.data('id'),
                quantity: input.val()
            },
            success: function(res) {
                // Cập nhật tổng tiền
                $('.totals_price_mobile').text(res.totalPrice.toLocaleString('vi-VN') + ' ₫');
            }
        });
    }

    // Kiểm tra giỏ hàng trống khi vừa load trang
    $(window).on("load", function() {
        if ($('.item-product').length === 0) {
            $('#data-cart').hide();
            $('#empty-cart').show();
        } else {
            $('#data-cart').show();
            $('#empty-cart').hide();
        }
    });
</script>
@endsection