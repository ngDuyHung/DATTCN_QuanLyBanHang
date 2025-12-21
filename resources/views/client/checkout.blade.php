<link rel="stylesheet" href="{{ asset('assets/client/checkout.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/client/checkout.vendor.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<style>
    /* Đảm bảo khung bao ngoài chiếm 100% */
    .iti {
        width: 100%;
        display: block;
    }

    /* Chỉnh lại padding cho input để không bị chữ đè lên cờ */
    /* Thư viện mặc định đã chỉnh, nhưng nếu bị lỗi thì dùng dòng dưới */
    /* .field__input { padding-left: 90px !important; } */

    /* Nếu dùng Floating Label (nhãn trôi), cần chỉnh lại vị trí label */
    /* Vì thư viện thêm padding-left, label cần dịch sang phải */
    .field__input-wrapper {
        position: relative;
    }

    /* Ẩn label mặc định của thư viện nếu nó xung đột với theme */
    .iti__flag-container {
        z-index: 2;
        /* Đảm bảo cờ nằm trên */
    }

    /* Sửa lỗi nút Áp dụng bị lệch */
    .field__input-btn-wrapper {
        display: flex;
        gap: 0;
        align-items: flex-start;
    }

    .field__input-btn-wrapper .field__input-wrapper {
        flex: 1;
    }

    #applyDiscountBtn {
        white-space: nowrap;
        min-width: 100px;
        height: 46px;
        margin-top: 0;
        border-radius: 0 4px 4px 0;
    }

    #applyDiscountBtn .spinner-loader {
        width: 20px;
        height: 20px;
        margin-left: 5px;
    }

    /* Style cho thông báo */
    .discount-message {
        padding: 10px 15px;
        margin-top: 10px;
        border-radius: 4px;
        font-size: 14px;
        display: none;
    }

    .discount-message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .discount-message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<body data-no-turbolink="">

    <header class="banner">
        <div class="wrap">
            <div class="logo logo--left">

                <a href="/">
                    <img class="logo__image  logo__image--small " alt="MemoryZone by SieuToc" src="https://upanhnhanh.com/9b1cf344335d43b21e2c4698250d46cc">
                </a>

            </div>
        </div>
    </header>
    <aside>
        <button class="order-summary-toggle" data-toggle="#order-summary" data-toggle-class="order-summary--is-collapsed">
            <span class="wrap">
                <span class="order-summary-toggle__inner">
                    <span class="order-summary-toggle__text expandable">
                        Đơn hàng ({{ count($cartItems) }} sản phẩm)
                    </span>
                    <span class="order-summary-toggle__total-recap" data-bind="getTextTotalPrice()">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
                </span>
            </span>
        </button>
    </aside>

    <style>
        /* Alert base */
        .alert {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 12px 0;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid transparent;
        }

        /* Danger style */
        .alert-danger {
            background: #fff5f5;
            /* nhẹ nhàng, dễ đọc */
            color: #b00020;
            /* màu chữ cảnh báo */
            border-color: #ffc9c9;
            /* viền nhẹ */
            box-shadow: 0 2px 6px rgba(176, 0, 32, 0.08);
        }

        /* Icon (optional, không cần phần tử riêng) */
        .alert-danger::before {
            content: "!";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            margin-right: 8px;
            border-radius: 50%;
            background: #b00020;
            color: #fff;
            font-weight: 700;
            font-size: 12px;
        }

        /* Close button (optional) */
        .alert [data-close] {
            position: absolute;
            top: 8px;
            right: 10px;
            padding: 4px 8px;
            border: none;
            background: transparent;
            color: inherit;
            cursor: pointer;
        }
    </style>



    <iframe height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    <div data-tg-refresh="checkout" id="checkout" class="content">
        <form id="checkoutForm" method="post" action="{{route('checkout')}}">
            @csrf
            <div class="wrap">
                <main class="main">
                    <header class="main__header">
                        <div class="logo logo--left">

                            <a href="/">
                                <img class="logo__image  logo__image--small " alt="MemoryZone by SieuToc" src="https://upanhnhanh.com/9b1cf344335d43b21e2c4698250d46cc">
                            </a>

                        </div>
                    </header>
                    <div class="main__content">
                        <article class="animate-floating-labels row">
                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <div class="col col--two">
                                <section class="section">
                                    <div class="section__header">
                                        <div class="layout-flex">
                                            <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                                <i class="fa fa-id-card-o fa-lg section__title--icon hide-on-desktop"></i>

                                                Thông tin nhận hàng

                                            </h2>


                                            <!-- <a href="/account/login?returnUrl=/checkout/a2cbbfd8146d4842b42ff66fd3371a9a">
                                                <i class="fa fa-user-circle-o fa-lg"></i>
                                                <span>Đăng nhập </span>
                                            </a> -->


                                        </div>
                                    </div>
                                    <div class="section__content">
                                        <div class="fieldset">




                                            <div class="field  field--show-floating-label" data-bind-class="{'field--show-floating-label': email}">
                                                <div class="field__input-wrapper">
                                                    <label for="email" class="field__label">
                                                        Email
                                                    </label>
                                                    <input name="email" id="email" type="email" class="field__input" data-bind="email" value="duyhungtest@gmail.com">
                                                </div>

                                            </div>



                                            <div class="field  field--show-floating-label" data-bind-class="{'field--show-floating-label': billing.name}">
                                                <div class="field__input-wrapper">
                                                    <label for="billingName" class="field__label">Họ và tên</label>
                                                    <input name="billingName" id="billingName" type="text" class="field__input" data-bind="billing.name" value="">
                                                </div>

                                            </div>

                                            <div class="field field--show-floating-label" data-bind-class="{'field--show-floating-label': billing.phone}">
                                                <div class="field__input-wrapper">
                                                    <label for="billingPhone" class="field__label">Số điện thoại</label>

                                                    <input name="billingPhone" id="billingPhone" type="tel" class="field__input" data-bind="billing.phone" value="">

                                                    <input type="hidden" name="full_phone" id="full_phone">
                                                </div>
                                            </div>


                                            <div class="field " data-bind-class="{'field--show-floating-label': billing.address}">
                                                <div class="field__input-wrapper">
                                                    <label for="billingAddress" class="field__label">
                                                        Số nhà, tên đường
                                                    </label>
                                                    <input name="billingAddress" id="billingAddress" type="text" class="field__input" data-bind="billing.address" value="">
                                                </div>

                                            </div>


                                            <div class="field field--show-floating-label">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingProvince" class="field__label">Tỉnh thành</label>
                                                    <select name="billingProvince" id="billingProvince" class="field__input field__input--select" data-bind="billing.province">
                                                        <option value="">--- Chọn Tỉnh/Thành ---</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="field field--show-floating-label">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingDistrict" class="field__label">Quận huyện</label>
                                                    <select name="billingDistrict" id="billingDistrict" class="field__input field__input--select" data-bind="billing.district" disabled>
                                                        <option value="">--- Chọn Quận/Huyện ---</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="field field--show-floating-label">
                                                <div class="field__input-wrapper field__input-wrapper--select2">
                                                    <label for="billingWard" class="field__label">Phường xã</label>
                                                    <select name="billingWard" id="billingWard" class="field__input field__input--select" data-bind="billing.ward" disabled>
                                                        <option value="">--- Chọn Phường/Xã ---</option>
                                                    </select>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </section>

                                <div class="fieldset">
                                    <h3 class="visually-hidden">Ghi chú</h3>
                                    <div class="field " data-bind-class="{'field--show-floating-label': note}">
                                        <div class="field__input-wrapper">
                                            <label for="note" class="field__label">
                                                Ghi chú (tùy chọn)
                                            </label>
                                            <textarea name="note" id="note" class="field__input" data-bind="note"></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col col--two">








                                <section class="section" data-define="{shippingMethod: ''}">
                                    <div class="section__header">
                                        <div class="layout-flex">
                                            <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                                <i class="fa fa-truck fa-lg section__title--icon hide-on-desktop"></i>
                                                Vận chuyển
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="section__content" data-tg-refresh="refreshShipping" id="shippingMethodList" data-define="{isAddressSelecting: true, shippingMethods: []}">
                                        <div class="alert alert--loader spinner spinner--active hide" data-bind-show="isLoadingShippingMethod">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                                <use href="#spinner"></use>
                                            </svg>
                                        </div>


                                        <div class="alert alert--danger hide" data-bind-show="!isLoadingShippingMethod &amp;&amp; !isAddressSelecting &amp;&amp; !isLoadingShippingError">
                                            Khu vực không hỗ trợ vận chuyển
                                        </div>

                                        <div class="alert alert-retry alert--danger hide" data-bind-event-click="handleShippingMethodErrorRetry()" data-bind-show="!isLoadingShippingMethod &amp;&amp; !isAddressSelecting &amp;&amp; isLoadingShippingError">
                                            <span data-bind="loadingShippingErrorMessage">Không thể load phí vận chuyển. Vui lòng thử lại</span> <i class="fa fa-refresh"></i>
                                        </div>


                                        <div class="content-box hide" data-bind-show="!isLoadingShippingMethod &amp;&amp; !isAddressSelecting &amp;&amp; !isLoadingShippingError">


                                        </div>

                                        <div class="alert alert--info" data-bind-show="!isLoadingShippingMethod &amp;&amp; isAddressSelecting">
                                            Vui lòng nhập thông tin giao hàng
                                        </div>
                                    </div>
                                </section>

                                <section class="section">
                                    <div class="section__header">
                                        <div class="layout-flex">
                                            <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                                <i class="fa fa-credit-card fa-lg section__title--icon hide-on-desktop"></i>
                                                Thanh toán
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="section__content">


                                        <div class="content-box" data-define="{paymentMethod: undefined}">


                                            <div class="content-box__row">
                                                <div class="radio-wrapper">
                                                    <div class="radio__input">
                                                        <input name="paymentMethod" id="paymentMethod-1945651" type="radio" class="input-radio" data-bind="paymentMethod" value="bank_transfer" data-provider-id="5">
                                                    </div>
                                                    <label for="paymentMethod-1945651" class="radio__label">
                                                        <span class="radio__label__primary">Chuyển khoản qua ngân hàng (VietQR) (Miễn phí thanh toán)</span>
                                                        <span class="radio__label__accessory">
                                                            <span class="radio__label__icon">
                                                                <i class="payment-icon payment-icon--5"></i>
                                                            </span>
                                                        </span>



                                                    </label>
                                                </div>

                                                <div class="content-box__row__desc hide" data-bind-show="paymentMethod == 1945651" data-provider-id="5">
                                                    <p>Scan mã VietQR tài khoản MB BANK của Siêu Tốc</p>
                                                    <p>VietQR là nhận diện thương hiệu chung cho các dịch vụ thanh toán, chuyển khoản bằng mã QR được xử lý qua mạng lưới Napas do Ngân hàng Nhà nước Việt Nam ban hành.</p>
                                                    <p>Quý khách sẽ nhận SMS và email thông báo khi scan thanh toán thành công.</p>

                                                </div>

                                            </div>

                                            <div class="content-box__row">
                                                <div class="radio-wrapper">
                                                    <div class="radio__input">
                                                        <input name="paymentMethod" id="paymentMethod-1945650" type="radio" class="input-radio" data-bind="paymentMethod" value="payoo" data-provider-id="5">
                                                    </div>
                                                    <label for="paymentMethod-1945650" class="radio__label">
                                                        <span class="radio__label__primary">Payoo - Thanh toán online, trả góp 0% lãi suất qua thẻ Visa, Master, JCB, Amex (Miễn phí thanh toán)</span>
                                                        <span class="radio__label__accessory">
                                                            <span class="radio__label__icon">
                                                                <i class="payment-icon payment-icon--5"></i>
                                                            </span>
                                                        </span>



                                                    </label>
                                                </div>

                                                <div class="content-box__row__desc hide" data-bind-show="paymentMethod == 1945650" data-provider-id="5">
                                                    <p>Thanh toán online qua thẻ Visa, Master, JCB, Amex (Miễn phí thanh toán).</p>
                                                    <p>Trả góp 0% qua thẻ tín dụng (Credit Card) Visa, Master, JCB, Amex liên kết với 32 ngân hàng. Phí chuyển đổi thấp nhất thị trường. Hỗ trợ các kì hạn từ 3 tháng - 36 tháng.</p>
                                                    <p>Lưu ý : ĐH thanh toán không thành công, hoặc quá thời gian thanh toán quý khách vui lòng đặt lại đơn mới hoặc gọi lại để MemoryZone hỗ trợ.</p>

                                                </div>

                                            </div>

                                            <div class="content-box__row">
                                                <div class="radio-wrapper">
                                                    <div class="radio__input">
                                                        <input name="paymentMethod" id="paymentMethod-618901" type="radio" class="input-radio" data-bind="paymentMethod" value="cod" data-provider-id="4">
                                                    </div>
                                                    <label for="paymentMethod-618901" class="radio__label">
                                                        <span class="radio__label__primary">Thanh toán khi giao hàng (COD)</span>
                                                        <span class="radio__label__accessory">
                                                            <span class="radio__label__icon">
                                                                <i class="payment-icon payment-icon--4"></i>
                                                            </span>
                                                        </span>



                                                    </label>
                                                </div>

                                                <div class="content-box__row__desc hide" data-bind-show="paymentMethod == 618901" data-provider-id="4">
                                                    <p>TP. Hồ Chí Minh: Ưu tiên giao hàng không tiếp xúc.</p>
                                                    <p><span style="color: #5897fb; font-weight: bold;">Hỗ trợ COD với đơn hàng giá trị &lt; 3.000.000đ.</span></p>
                                                    <p><span style="color: #5897fb; font-weight: bold;">Đơn hàng &gt;= 3.000.000đ hoặc có các sản phẩm Laptop, PC, Màn hình, Ghế quý khách vui lòng chọn chuyển khoản.</span></p>
                                                    <p>Lưu ý: MemoryZone miễn phí đồng kiểm cho khách hàng.</p>

                                                </div>

                                            </div>



                                        </div>

                                    </div>
                                </section>
                            </div>
                        </article>
                        <div class="field__input-btn-wrapper field__input-btn-wrapper--vertical hide-on-desktop">
                            <button type="submit" class="btn btn-checkout spinner" data-bind-class="{'spinner--active': isSubmitingCheckout}" data-bind-disabled="isSubmitingCheckout || isLoadingReductionCode" data-event-added="attached">
                                <span class="spinner-label">ĐẶT HÀNG</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                    <use href="#spinner"></use>
                                </svg>
                            </button>

                            <a href="/cart" class="previous-link">
                                <i class="previous-link__arrow">❮</i>
                                <span class="previous-link__content">Quay về giỏ hàng</span>
                            </a>

                        </div>

                        <div id="common-alert" data-tg-refresh="refreshError">


                            <div class="alert alert--danger hide-on-desktop hide" data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError" data-bind="submitingCheckoutErrorMessage">Có lỗi xảy ra khi xử lý. Vui lòng thử lại</div>
                        </div>
                    </div>

                    <div class="main__footer unprintable">
                        <ul class="main__policy">
                            <li>

                            </li>
                            <li>

                                <a data-toggle="#privacy_term" data-toggle-class="hide">Chính sách bảo mật</a>

                            </li>
                            <li>

                                <a data-toggle="#service_term" data-toggle-class="hide">Điều khoản sử dụng</a>

                            </li>
                        </ul>

                        <div class="modal-wrapper hide" id="refund_term">
                            <div class="modal" style="display: inline-block;">
                                <div class="modal-header">
                                    <h2 class="modal-title">Chính sách hoàn trả</h2>
                                    <span class="close" data-toggle="#refund_term" data-toggle-class="hide">×</span>
                                </div>
                                <div class="modal-body">
                                    <pre class="term-preview"></pre>
                                </div>
                            </div>
                        </div>
                        <div class="modal-wrapper hide" id="privacy_term">
                            <div class="modal" style="display: inline-block;">
                                <div class="modal-header">
                                    <h2 class="modal-title">Chính sách bảo mật</h2>
                                    <span class="close" data-toggle="#privacy_term" data-toggle-class="hide">×</span>
                                </div>
                                <div class="modal-body">
                                    <pre class="term-preview"><script type="text/javascript">
console.log('Payoo payment');
</script>
<style>
.main__policy li a[data-toggle="#privacy_term"],
.main__policy li a[data-toggle="#service_term"]{
display: none !important;
}
</style>
<script>
        $(document).ready(function () {
  const $wrapper = $(".field__input-btn-wrapper.field__input-btn-wrapper--floating").first();

  if ($wrapper.length) {
    const name = encodeURIComponent(Bizweb.checkout.order_name || "");
    const email = Bizweb.checkout.email;
    const order = encodeURIComponent(Bizweb.checkout.customer_first_name || "");

    const href = `https://hotro.sieutoc.com/vat?name=${name}&partner_email=${email}&partner_name=${order}`;
const link = `<a target="_blank" href="${href}" class="btn btn--large">Xuất hóa đơn</a>`;

    $wrapper.append(link);
  }
}); 
</script></pre>
                                </div>
                            </div>
                        </div>
                        <div class="modal-wrapper hide" id="service_term">
                            <div class="modal" style="display: inline-block;">
                                <div class="modal-header">
                                    <h2 class="modal-title">Điều khoản sử dụng</h2>
                                    <span class="close" data-toggle="#service_term" data-toggle-class="hide">×</span>
                                </div>
                                <div class="modal-body">
                                    <pre class="term-preview"><style>
.payment-icon--3 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/01icon-vietqr.png?v=1639481626593) !important;
background-size: contain;
background-repeat: no-repeat;
 width: 40px;
 height: 45px;
}
.payment-icon--3::before {
display: none;
}


.payment-icon--4 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/icon-cod.png?v=1685954438297) !important;
background-size: contain;
background-repeat: no-repeat;
}
.payment-icon--4::before {
display: none;
}

label[for="paymentMethod-1945651"] .payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/vietqr-4ce5743c-ae22-4d3b-85e9-3ddac91ef8ac.png?v=1732844013060) !important;
background-size: contain;
background-repeat: no-repeat;
}

label[for="paymentMethod-1945650"] .payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/jcb.png?v=1732844006870) !important;
background-size: contain;
background-repeat: no-repeat;
}

label[for="paymentMethod-618902"] .payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/icon-vietqr.png?v=1685954438297) !important;
background-size: contain;
background-repeat: no-repeat;
}
label[for="paymentMethod-523800"] .payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/icon-tragop.png?v=1685954438297) !important;
background-size: contain;
background-repeat: no-repeat;
}
label[for="paymentMethod-523794"] .payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/png-clipart-visa-mastercard-logo-removebg-preview.png?v=1719883511547) !important;
background-size: contain;
background-repeat: no-repeat;
}
.payment-icon--5::before {
display: none;
}

.content-box__row:last-child i.payment-icon.payment-icon--5 {
    background-image: url(https://bizweb.dktcdn.net/100/329/122/files/04icon-visamaster.png?v=1639481634747) !important;
background-size: contain;
background-repeat: no-repeat;
}
.content-box__row:last-child i.payment-icon.payment-icon--5::before {
display: none;
}


.animate-floating-labels .col:first-child .section__content .fieldset{
        display: flex;
    flex-direction: column;
}
.animate-floating-labels .col:first-child .section__content .fieldset .field:nth-child(4){
    order: 999;
        margin-bottom: 11.2px;
}
</style></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
                <aside class="sidebar">
                    <div class="sidebar__header">
                        <h2 class="sidebar__title">
                            Đơn hàng ({{ count($cartItems) }} sản phẩm)
                        </h2>
                    </div>
                    <div class="sidebar__content">
                        <div id="order-summary" class="order-summary order-summary--is-collapsed">
                            <div class="order-summary__sections">
                                <div class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                                    <table class="product-table" id="product-table" data-tg-refresh="refreshDiscount">
                                        <caption class="visually-hidden">Chi tiết đơn hàng</caption>
                                        <thead class="product-table__header">
                                            <tr>
                                                <th>
                                                    <span class="visually-hidden">Ảnh sản phẩm</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Mô tả</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Sổ lượng</span>
                                                </th>
                                                <th>
                                                    <span class="visually-hidden">Đơn giá</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                            <input type="hidden" name="products[{{ $item->product->product_id }}][id]" value="{{ $item->product->product_id }}">
                                            <input type="hidden" name="products[{{ $item->product->product_id }}][qty]" value="{{ $item->quantity }}" class="hidden-qty">

                                            <tr class="product">
                                                <td class="product__image">
                                                    <div class="product-thumbnail">
                                                        <div class="product-thumbnail__wrapper" data-tg-static="">
                                                            <img src="{{ asset('storage/' . $item->product->	main_img_url) }}" alt="" class="product-thumbnail__image">
                                                        </div>
                                                        <span class="product-thumbnail__quantity">{{ $item->quantity }}</span>
                                                    </div>
                                                </td>
                                                <th class="product__description">
                                                    <span class="product__description__name">
                                                        {{ $item->product->name }}
                                                    </span>



                                                </th>
                                                <td class="product__quantity visually-hidden"><em>Số lượng:</em> {{ $item->quantity }}</td>
                                                <td class="product__price">

                                                    {{$item->product->price_format}} ₫

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="order-summary__section order-summary__section--discount-code" data-tg-refresh="refreshDiscount" id="discountCode">
                                    <h3 class="visually-hidden">Mã khuyến mại</h3>
                                    <div class="edit_checkout animate-floating-labels">
                                        <div class="fieldset">
                                            <div class="field ">
                                                <div class="field__input-btn-wrapper">
                                                    <div class="field__input-wrapper">
                                                        <input name="reductionCode" id="reductionCode" type="text" class="field__input" autocomplete="off" placeholder="Nhập mã giảm giá, ví dụ: SALE10">
                                                        <input type="hidden" name="promo_id" id="promo_id" value="">
                                                    </div>
                                                    <button class="field__input-btn btn" type="button" id="applyDiscountBtn">
                                                        <span class="spinner-label">Áp dụng</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader" style="display:none;">
                                                            <use href="#spinner"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- Thông báo -->
                                                <div id="discountMessage" class="discount-message"></div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="order-summary__section order-summary__section--total-lines order-summary--collapse-element" data-define="{subTotalPriceText: '12.000.000 ₫'}" data-tg-refresh="refreshOrderTotalPrice" id="orderSummary">
                                    <table class="total-line-table">
                                        <caption class="visually-hidden">Tổng giá trị</caption>
                                        <thead>
                                            <tr>
                                                <td><span class="visually-hidden">Mô tả</span></td>
                                                <td><span class="visually-hidden">Giá tiền</span></td>
                                            </tr>
                                        </thead>
                                        <tbody class="total-line-table__tbody">
                                            <tr class="total-line total-line--subtotal">
                                                <th class="total-line__name">
                                                    Tạm tính
                                                </th>
                                                <td class="total-line__price" id="subtotal-price">{{ number_format($totalPrice, 0, ',', '.') }} ₫</td>
                                            </tr>

                                            <!-- Dòng giảm giá -->
                                            <tr class="total-line total-line--discount" id="discount-row" style="display: none;">
                                                <th class="total-line__name">
                                                    Giảm giá (<span id="discount-code"></span>)
                                                    <a href="javascript:void(0)" id="removeDiscountBtn" style="color: #dc3545; font-size: 12px; margin-left: 5px;">× Xóa</a>
                                                </th>
                                                <td class="total-line__price" id="discount-amount" style="color: #dc3545;">-0 ₫</td>
                                            </tr>



                                            <!-- <tr class="total-line total-line--shipping-fee">
                                                <th class="total-line__name">
                                                    Phí vận chuyển
                                                </th>
                                                <td class="total-line__price">
                                                    <span class="origin-price" data-bind="getTextShippingPriceOriginal()"></span>
                                                    <span data-bind="getTextShippingPriceFinal()">-</span>
                                                </td>
                                            </tr> -->



                                        </tbody>
                                        <tfoot class="total-line-table__footer">
                                            <tr class="total-line payment-due">
                                                <th class="total-line__name">
                                                    <span class="payment-due__label-total">
                                                        Tổng cộng
                                                    </span>
                                                </th>
                                                <td class="total-line__price">
                                                    <span class="payment-due__price" id="final-price">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="order-summary__nav field__input-btn-wrapper hide-on-mobile layout-flex--row-reverse">
                                    <button type="submit" class="btn btn-checkout spinner" data-bind-class="{'spinner--active': isSubmitingCheckout}" data-bind-disabled="isSubmitingCheckout || isLoadingReductionCode" data-event-added="attached">
                                        <span class="spinner-label">ĐẶT HÀNG</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                            <use href="#spinner"></use>
                                        </svg>
                                    </button>


                                    <a href="{{ route('cart') }}" class="previous-link">
                                        <i class="previous-link__arrow">❮</i>
                                        <span class="previous-link__content">Quay về giỏ hàng</span>
                                    </a>

                                </div>
                                <div id="common-alert-sidebar" data-tg-refresh="refreshError">


                                    <div class="alert alert--danger hide-on-mobile hide" data-bind-show="!isSubmitingCheckout &amp;&amp; isSubmitingCheckoutError" data-bind="submitingCheckoutErrorMessage">Có lỗi xảy ra khi xử lý. Vui lòng thử lại</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </form>


        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="spinner">
                <svg viewBox="0 0 30 30">
                    <circle stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-dasharray="85%" cx="50%" cy="50%" r="40%">
                        <animateTransform attributeName="transform" type="rotate" from="0 15 15" to="360 15 15" dur="0.7s" repeatCount="indefinite"></animateTransform>
                    </circle>
                </svg>
            </symbol>
        </svg>
    </div>


</body>

<script>
    // Lấy thẻ input
    var input = document.querySelector("#billingPhone");
    var fullPhoneInput = document.querySelector("#full_phone");

    // Khởi tạo thư viện
    var iti = window.intlTelInput(input, {
        // Tự động chọn Việt Nam làm mặc định
        initialCountry: "vn",

        // Hiển thị mã vùng riêng biệt bên cạnh cờ (Ví dụ: 🇻🇳 +84)
        separateDialCode: true,

        // Tự động tìm quốc gia người dùng dựa trên IP (Optional - API geoip)
        geoIpLookup: function(callback) {
            fetch('https://ipinfo.io/json?token=<YOUR_TOKEN>', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then((resp) => resp.json())
                .then((resp) => {
                    var countryCode = (resp && resp.country) ? resp.country : "vn";
                    callback(countryCode);
                })
                .catch(() => {
                    callback("vn");
                });
        },

        // Đường dẫn tới utils.js để hỗ trợ format và validate số
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
    });

    // Xử lý khi người dùng gõ số hoặc đổi cờ -> Cập nhật vào input ẩn để gửi lên server
    var handleChange = function() {
        // Lấy số đầy đủ chuẩn quốc tế (VD: +84987778789)
        var full_number = iti.getNumber();
        fullPhoneInput.value = full_number;

        // Nếu bạn muốn cập nhật ngược lại vào chính ô input billingPhone
        // input.value = full_number; 
    };

    input.addEventListener('change', handleChange);
    input.addEventListener('keyup', handleChange);
</script>

<!-- Load jQuery trước khi sử dụng -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Lưu tổng tiền ban đầu kh được formatted nếu formatting sẽ lỗi khi tính toán
        const originalTotal = {{ $totalPrice }};
        let currentDiscount = 0;
        let currentPromoId = null;

        // Hàm hiển thị thông báo
        function showMessage(message, type) {
            const $msg = $('#discountMessage');
            $msg.removeClass('success error')
                .addClass(type)
                .text(message)
                .fadeIn();

            if (type === 'success') {
                setTimeout(function() {
                    $msg.fadeOut();
                }, 3000);
            }
        }

        // Xử lý khi click nút Áp dụng mã giảm giá
        $('#applyDiscountBtn').on('click', function() {
            const code = $('#reductionCode').val().trim();

            if (!code) {
                showMessage('Vui lòng nhập mã giảm giá!', 'error');
                return;
            }

            // Hiển thị loading
            const $btn = $(this);
            const $spinner = $btn.find('.spinner-loader');
            const $label = $btn.find('.spinner-label');

            $btn.prop('disabled', true);
            $spinner.show();
            $label.text('Đang kiểm tra...');
            $('#discountMessage').fadeOut();

            // Gửi AJAX request
            $.ajax({
                url: '{{ route("checkout.applyDiscount") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    code: code,
                    totalAmount: originalTotal
                },
                success: function(response) {
                    if (response.success) {
                        // Hiển thị thông báo thành công
                        showMessage(response.message, 'success');

                        // Cập nhật giá trị giảm giá
                        currentDiscount = response.data.discount_amount;
                        currentPromoId = response.data.promo_id;

                        // Hiển thị dòng giảm giá
                        $('#discount-code').text(response.data.code);
                        $('#discount-amount').text('-' + response.data.discount_amount_formatted);
                        $('#discount-row').fadeIn();

                        // Cập nhật tổng tiền
                        $('#final-price').text(response.data.final_amount_formatted);

                        // Lưu promo_id vào input hidden
                        $('#promo_id').val(currentPromoId);

                        // Disable input và nút áp dụng
                        $('#reductionCode').prop('disabled', true);
                        $btn.hide();
                    } else {
                        showMessage(response.message, 'error');
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Có lỗi xảy ra. Vui lòng thử lại!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    showMessage(errorMsg, 'error');
                    console.error(xhr);
                },
                complete: function() {
                    // Ẩn loading
                    $spinner.hide();
                    $label.text('Áp dụng');
                    $btn.prop('disabled', false);
                }
            });
        });

        // Xử lý khi click nút xóa mã giảm giá
        $('#removeDiscountBtn').on('click', function() {
            // Reset về giá ban đầu
            currentDiscount = 0;
            currentPromoId = null;

            // Ẩn dòng giảm giá
            $('#discount-row').fadeOut();

            // Cập nhật lại tổng tiền
            $('#final-price').text(new Intl.NumberFormat('vi-VN').format(originalTotal) + ' ₫');

            // Xóa mã giảm giá trong input
            $('#reductionCode').val('').prop('disabled', false).focus();
            $('#promo_id').val('');

            // Hiện lại nút áp dụng
            $('#applyDiscountBtn').show();

            // Ẩn thông báo
            $('#discountMessage').fadeOut();
        });

        // Cho phép nhấn Enter để áp dụng mã
        $('#reductionCode').on('keypress', function(e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                $('#applyDiscountBtn').click();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // API lấy dữ liệu hành chính Việt Nam (Depth 3: Tỉnh > Huyện > Xã)
        const API_URL = "https://provinces.open-api.vn/api/?depth=3";

        var provinces = []; // Biến lưu trữ toàn bộ dữ liệu

        // Gọi API lấy dữ liệu
        $.ajax({
            url: API_URL,
            method: 'GET',
            success: function(data) {
                provinces = data; // Lưu dữ liệu vào biến global
                renderProvince(data);
            },
            error: function(error) {
                console.log("Lỗi không lấy được dữ liệu tỉnh thành", error);
            }
        });

        // Hàm render Tỉnh/Thành
        function renderProvince(data) {
            var html = '<option value="">--- Chọn Tỉnh/Thành ---</option>';
            data.forEach(function(element) {
                // Lưu ý: Value ở đây dùng code (số) hoặc name (chữ) tùy vào backend của bạn cần gì.
                // Ở đây tôi để name để dễ hiển thị lên đơn hàng.
                html += `<option value="${element.name}" data-code="${element.code}">${element.name}</option>`;
            });

            $('#billingProvince').html(html);

            // Quan trọng: Trigger event để Select2 cập nhật giao diện
            $('#billingProvince').trigger('change.select2');
        }

        // Sự kiện khi chọn Tỉnh -> Load Huyện
        $('#billingProvince').on('change', function() {
            var selectedName = $(this).val();

            // Reset Quận/Huyện và Phường/Xã
            $('#billingDistrict').html('<option value="">--- Chọn Quận/Huyện ---</option>').prop('disabled', true).trigger('change');
            $('#billingWard').html('<option value="">--- Chọn Phường/Xã ---</option>').prop('disabled', true).trigger('change');

            if (selectedName) {
                // Tìm tỉnh đã chọn trong dữ liệu
                var result = provinces.find(n => n.name === selectedName);

                if (result && result.districts) {
                    var html = '<option value="">--- Chọn Quận/Huyện ---</option>';
                    result.districts.forEach(function(element) {
                        html += `<option value="${element.name}" data-code="${element.code}">${element.name}</option>`;
                    });

                    $('#billingDistrict').html(html).prop('disabled', false).trigger('change');
                }
            }
        });

        // Sự kiện khi chọn Huyện -> Load Xã
        $('#billingDistrict').on('change', function() {
            var provinceName = $('#billingProvince').val();
            var districtName = $(this).val();

            // Reset Phường/Xã
            $('#billingWard').html('<option value="">--- Chọn Phường/Xã ---</option>').prop('disabled', true).trigger('change');

            if (provinceName && districtName) {
                var province = provinces.find(n => n.name === provinceName);
                var district = province.districts.find(n => n.name === districtName);

                if (district && district.wards) {
                    var html = '<option value="">--- Chọn Phường/Xã ---</option>';
                    district.wards.forEach(function(element) {
                        html += `<option value="${element.name}" data-code="${element.code}">${element.name}</option>`;
                    });

                    $('#billingWard').html(html).prop('disabled', false).trigger('change');
                }
            }
        });
    });
</script>