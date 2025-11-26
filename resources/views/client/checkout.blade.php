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
                        Đơn hàng (1 sản phẩm)
                    </span>
                    <span class="order-summary-toggle__total-recap" data-bind="getTextTotalPrice()">12.000.000 ₫</span>
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

                                            <!-- <div class="content-box__row">
                                                <div class="radio-wrapper">
                                                    <div class="radio__input">
                                                        <input name="paymentMethod" id="paymentMethod-612321" type="radio" class="input-radio" data-bind="paymentMethod" value="612321" data-provider-id="22" data-event-added="attached">
                                                    </div>
                                                    <label for="paymentMethod-612321" class="radio__label">
                                                        <span id="fundiin-method" class="radio__label__primary">
                                                            Fundiin - Mua trả sau 0% lãi
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="137" height="22" viewBox="0 0 137 22" fill="none">
                                                                <rect width="136.1" height="22" rx="5" fill="url(#paint0_linear_1268_3004)"></rect>
                                                                <circle cx="15" cy="11" r="8" fill="white"></circle>
                                                                <path d="M14.7936 5.98541L14.7933 5.98566L13.8908 6.88666C13.8906 6.8868 13.8905 6.88694 13.8903 6.88708C13.6487 7.12893 13.321 7.26501 12.9791 7.26544L12.9785 7.26544L11.5562 7.26544C11.4792 7.26544 11.4053 7.29603 11.3508 7.3505C11.2964 7.40496 11.2658 7.47883 11.2658 7.55587V8.97832V8.97895C11.2653 9.3208 11.1293 9.64851 10.8875 9.89014C10.8873 9.89029 10.8872 9.89044 10.887 9.8906L9.98546 10.7946L9.98505 10.7951C9.93061 10.8495 9.90002 10.9234 9.90002 11.0004C9.90002 11.0773 9.93053 11.1511 9.98483 11.2055C9.98483 11.2055 9.98484 11.2055 9.98484 11.2055C9.98491 11.2056 9.98498 11.2057 9.98505 11.2057L10.8888 12.1087L10.889 12.1089C11.0087 12.2287 11.1037 12.3709 11.1685 12.5274C11.2333 12.6838 11.2666 12.8515 11.2666 13.0209C11.2666 13.0209 11.2666 13.0209 11.2666 13.0209V14.4433C11.2666 14.604 11.3963 14.7337 11.557 14.7337H12.9793C13.3213 14.7337 13.6495 14.8695 13.8915 15.1125C13.8917 15.1127 13.892 15.1129 13.8922 15.1132L14.7951 16.0153L14.7951 16.0154C14.8496 16.0698 14.9234 16.1004 15.0004 16.1004C15.0773 16.1004 15.151 16.0699 15.2055 16.0156L14.7936 5.98541ZM14.7936 5.98541C14.848 5.93097 14.9218 5.90039 14.9988 5.90039C15.0758 5.90039 15.1496 5.93097 15.2041 5.98541L15.2045 5.98581L16.1085 6.88746C16.1087 6.88762 16.1088 6.88779 16.109 6.88795C16.3506 7.12975 16.6783 7.26581 17.0201 7.26624H17.0208H18.4431C18.5201 7.26624 18.594 7.29683 18.6484 7.3513C18.7029 7.40576 18.7335 7.47963 18.7335 7.55667V8.97912V8.97924C18.7336 9.32112 18.8693 9.649 19.1109 9.89089L19.1113 9.89124L20.015 10.7943L14.7936 5.98541ZM16.1086 15.1116L15.2057 16.0154L20.0152 10.7945C20.0695 10.8489 20.1 10.9227 20.1 10.9996C20.1 11.0766 20.0694 11.1505 20.015 11.2049L20.0149 11.205L19.1128 12.1079C19.1126 12.1082 19.1124 12.1084 19.1121 12.1087C18.8692 12.3507 18.7335 12.6789 18.7335 13.0209V14.4433C18.7335 14.5203 18.7029 14.5942 18.6484 14.6487C18.594 14.7031 18.5201 14.7337 18.4431 14.7337H17.0208H17.0206C16.6787 14.7338 16.3509 14.8696 16.109 15.1112L16.1086 15.1116Z" fill="white" stroke="url(#paint1_linear_1268_3004)"></path>
                                                                <path d="M13.753 9.50741C13.753 9.64367 13.6425 9.75408 13.5064 9.75408C13.3702 9.75408 13.2598 9.64367 13.2598 9.50741C13.2598 9.37114 13.3702 9.26074 13.5064 9.26074C13.6425 9.26074 13.753 9.37114 13.753 9.50741ZM16.7394 12.4941C16.7394 12.6303 16.629 12.7407 16.4928 12.7407C16.3567 12.7407 16.2462 12.6303 16.2462 12.4941C16.2462 12.3578 16.3567 12.2474 16.4928 12.2474C16.629 12.2474 16.7394 12.3578 16.7394 12.4941Z" fill="white" stroke="url(#paint2_linear_1268_3004)"></path>
                                                                <path d="M17.2395 9.15625L13.5291 12.8669" stroke="url(#paint3_linear_1268_3004)" stroke-width="0.5" stroke-linecap="round"></path>
                                                                <path d="M32.844 6.98215C33.4413 6.98215 33.9873 7.06148 34.482 7.22015C34.986 7.36948 35.4247 7.58415 35.798 7.86415C36.1807 8.14415 36.5027 8.48482 36.764 8.88615C37.0253 9.27815 37.2167 9.72148 37.338 10.2161H35.658C35.4433 9.70282 35.098 9.28282 34.622 8.95615C34.146 8.62948 33.558 8.46615 32.858 8.46615C32.3913 8.46615 31.962 8.55015 31.57 8.71815C31.178 8.87682 30.8373 9.11015 30.548 9.41815C30.2587 9.72615 30.0347 10.0995 29.876 10.5381C29.7173 10.9675 29.638 11.4575 29.638 12.0081C29.638 12.5775 29.7173 13.0861 29.876 13.5341C30.044 13.9821 30.2727 14.3601 30.562 14.6681C30.8607 14.9761 31.2153 15.2141 31.626 15.3821C32.046 15.5408 32.508 15.6201 33.012 15.6201C33.4133 15.6201 33.7913 15.5595 34.146 15.4381C34.51 15.3075 34.832 15.1208 35.112 14.8781C35.392 14.6355 35.6253 14.3368 35.812 13.9821C35.9987 13.6275 36.1247 13.2215 36.19 12.7641H32.564V11.5881H37.534V13.1141C37.45 13.6461 37.282 14.1501 37.03 14.6261C36.7873 15.1021 36.4653 15.5221 36.064 15.8861C35.672 16.2408 35.2053 16.5255 34.664 16.7401C34.1227 16.9455 33.5207 17.0481 32.858 17.0481C32.13 17.0481 31.4673 16.9268 30.87 16.6841C30.2727 16.4321 29.7593 16.0821 29.33 15.6341C28.91 15.1861 28.5833 14.6541 28.35 14.0381C28.1167 13.4221 28 12.7455 28 12.0081C28 11.2708 28.1167 10.5941 28.35 9.97815C28.5833 9.36215 28.91 8.83482 29.33 8.39615C29.75 7.94815 30.2587 7.60282 30.856 7.36015C31.4533 7.10815 32.116 6.98215 32.844 6.98215Z" fill="white"></path>
                                                                <path d="M38.9261 6.99615C38.9261 6.72548 39.0195 6.50148 39.2061 6.32415C39.3928 6.14682 39.6401 6.05815 39.9481 6.05815C40.2655 6.05815 40.5175 6.14682 40.7041 6.32415C40.8908 6.50148 40.9841 6.72548 40.9841 6.99615C40.9841 7.26682 40.8908 7.48615 40.7041 7.65415C40.5175 7.82215 40.2655 7.90615 39.9481 7.90615C39.6401 7.90615 39.3928 7.82215 39.2061 7.65415C39.0195 7.48615 38.9261 7.26682 38.9261 6.99615ZM40.7461 9.23615V16.9501H39.1501V9.23615H40.7461Z" fill="white"></path>
                                                                <path d="M46.3875 5.69415C46.8261 5.69415 47.1435 5.80615 47.3395 6.03015C47.5355 6.24482 47.6335 6.52948 47.6335 6.88415C47.6335 7.18282 47.5355 7.43948 47.3395 7.65415C47.1435 7.86882 46.8961 8.12548 46.5975 8.42415L46.1215 8.00415C46.3641 7.77082 46.5461 7.56548 46.6675 7.38815C46.7981 7.21082 46.8635 7.04282 46.8635 6.88415C46.8635 6.69748 46.8168 6.57148 46.7235 6.50615C46.6395 6.44082 46.5181 6.40815 46.3595 6.40815C46.1821 6.40815 46.0561 6.45482 45.9815 6.54815C45.9068 6.64148 45.8555 6.79548 45.8275 7.01015L45.0855 6.94015C45.1041 6.79082 45.1321 6.64148 45.1695 6.49215C45.2068 6.34282 45.2721 6.21215 45.3655 6.10015C45.4588 5.97882 45.5848 5.88082 45.7435 5.80615C45.9115 5.73148 46.1261 5.69415 46.3875 5.69415ZM45.7715 9.13815C46.4995 9.13815 47.1061 9.31548 47.5915 9.67015C48.0768 10.0155 48.4175 10.4681 48.6135 11.0281V9.23615H50.2095V16.9501H48.6135V15.1581C48.4175 15.7181 48.0768 16.1755 47.5915 16.5301C47.1061 16.8755 46.4995 17.0481 45.7715 17.0481C45.2675 17.0481 44.8008 16.9595 44.3715 16.7821C43.9515 16.5955 43.5875 16.3341 43.2795 15.9981C42.9715 15.6528 42.7288 15.2375 42.5515 14.7521C42.3741 14.2575 42.2855 13.7021 42.2855 13.0861C42.2855 12.4701 42.3741 11.9195 42.5515 11.4341C42.7288 10.9395 42.9715 10.5241 43.2795 10.1881C43.5875 9.85215 43.9515 9.59548 44.3715 9.41815C44.8008 9.23148 45.2675 9.13815 45.7715 9.13815ZM46.2615 10.5381C45.5615 10.5381 44.9968 10.7621 44.5675 11.2101C44.1381 11.6581 43.9235 12.2835 43.9235 13.0861C43.9235 13.8981 44.1381 14.5281 44.5675 14.9761C44.9968 15.4148 45.5615 15.6341 46.2615 15.6341C46.5975 15.6341 46.9101 15.5781 47.1995 15.4661C47.4888 15.3448 47.7361 15.1721 47.9415 14.9481C48.1561 14.7241 48.3195 14.4581 48.4315 14.1501C48.5528 13.8328 48.6135 13.4781 48.6135 13.0861C48.6135 12.6941 48.5528 12.3441 48.4315 12.0361C48.3195 11.7188 48.1561 11.4528 47.9415 11.2381C47.7361 11.0141 47.4888 10.8415 47.1995 10.7201C46.9101 10.5988 46.5975 10.5381 46.2615 10.5381Z" fill="white"></path>
                                                                <path d="M61.7707 9.11015C62.2187 9.11015 62.6247 9.18482 62.9887 9.33415C63.3621 9.47415 63.6794 9.68415 63.9407 9.96415C64.2114 10.2441 64.4167 10.5941 64.5567 11.0141C64.7061 11.4248 64.7807 11.9055 64.7807 12.4561V16.9501H63.1847V12.6241C63.1847 11.9335 63.0121 11.4108 62.6667 11.0561C62.3307 10.6921 61.8734 10.5101 61.2947 10.5101C60.6881 10.5101 60.1934 10.7015 59.8107 11.0841C59.4374 11.4668 59.2507 12.0548 59.2507 12.8481V16.9501H57.6547V12.6241C57.6547 11.9335 57.4821 11.4108 57.1367 11.0561C56.8007 10.6921 56.3434 10.5101 55.7647 10.5101C55.1581 10.5101 54.6634 10.7015 54.2807 11.0841C53.9074 11.4668 53.7207 12.0548 53.7207 12.8481V16.9501H52.1247V9.23615H53.7207V10.8461C53.9167 10.2768 54.2434 9.84748 54.7007 9.55815C55.1674 9.25948 55.7041 9.11015 56.3107 9.11015C56.9454 9.11015 57.5007 9.26415 57.9767 9.57215C58.4527 9.88015 58.7981 10.3421 59.0127 10.9581C59.2461 10.3701 59.6101 9.91748 60.1047 9.60015C60.5994 9.27348 61.1547 9.11015 61.7707 9.11015Z" fill="white"></path>
                                                                <path d="M78.1855 8.52215H77.4575V16.9501H75.8475V15.1581C75.6608 15.7181 75.3248 16.1755 74.8395 16.5301C74.3542 16.8755 73.7475 17.0481 73.0195 17.0481C72.5155 17.0481 72.0488 16.9595 71.6195 16.7821C71.1995 16.5955 70.8355 16.3341 70.5275 15.9981C70.2195 15.6528 69.9768 15.2375 69.7995 14.7521C69.6222 14.2575 69.5335 13.7021 69.5335 13.0861C69.5335 12.4701 69.6222 11.9195 69.7995 11.4341C69.9768 10.9395 70.2195 10.5241 70.5275 10.1881C70.8355 9.85215 71.1995 9.59548 71.6195 9.41815C72.0488 9.23148 72.5155 9.13815 73.0195 9.13815C73.7475 9.13815 74.3542 9.31548 74.8395 9.67015C75.3248 10.0155 75.6608 10.4681 75.8475 11.0281V8.52215H73.7475V7.76615H75.8475V6.59015H77.4575V7.76615H78.1855V8.52215ZM73.5095 15.6341C73.8455 15.6341 74.1582 15.5781 74.4475 15.4661C74.7369 15.3448 74.9842 15.1721 75.1895 14.9481C75.4042 14.7241 75.5675 14.4581 75.6795 14.1501C75.8008 13.8328 75.8615 13.4781 75.8615 13.0861C75.8615 12.6941 75.8008 12.3441 75.6795 12.0361C75.5675 11.7188 75.4042 11.4528 75.1895 11.2381C74.9842 11.0141 74.7369 10.8415 74.4475 10.7201C74.1582 10.5988 73.8455 10.5381 73.5095 10.5381C72.8095 10.5381 72.2449 10.7621 71.8155 11.2101C71.3862 11.6581 71.1715 12.2835 71.1715 13.0861C71.1715 13.8981 71.3862 14.5281 71.8155 14.9761C72.2449 15.4148 72.8095 15.6341 73.5095 15.6341Z" fill="white"></path>
                                                                <path d="M82.0022 6.84215L81.7222 6.28215L84.0182 4.95215L84.3682 5.75015L82.0022 6.84215ZM81.3862 8.59215L81.1202 7.94815L82.8702 6.92615L84.5922 7.94815L84.2982 8.59215L82.8702 7.79415L81.3862 8.59215ZM86.6502 12.7221C86.6502 12.8715 86.6455 12.9975 86.6362 13.1001C86.6268 13.1935 86.6128 13.2961 86.5942 13.4081H80.6582C80.6768 13.8281 80.7468 14.1875 80.8682 14.4861C80.9895 14.7848 81.1482 15.0275 81.3442 15.2141C81.5495 15.4008 81.7782 15.5361 82.0302 15.6201C82.2915 15.7041 82.5622 15.7461 82.8422 15.7461C83.3835 15.7461 83.8362 15.6108 84.2002 15.3401C84.5642 15.0695 84.7882 14.7101 84.8722 14.2621H86.5802C86.5055 14.6635 86.3655 15.0368 86.1602 15.3821C85.9548 15.7181 85.6935 16.0121 85.3762 16.2641C85.0588 16.5068 84.6902 16.6981 84.2702 16.8381C83.8595 16.9781 83.4068 17.0481 82.9122 17.0481C82.3522 17.0481 81.8388 16.9595 81.3722 16.7821C80.9055 16.5955 80.5042 16.3341 80.1682 15.9981C79.8322 15.6528 79.5662 15.2375 79.3702 14.7521C79.1835 14.2575 79.0902 13.7021 79.0902 13.0861C79.0902 12.4701 79.1835 11.9195 79.3702 11.4341C79.5662 10.9395 79.8322 10.5241 80.1682 10.1881C80.5042 9.85215 80.9055 9.59548 81.3722 9.41815C81.8388 9.23148 82.3522 9.13815 82.9122 9.13815C83.5002 9.13815 84.0228 9.23148 84.4802 9.41815C84.9468 9.60482 85.3388 9.86148 85.6562 10.1881C85.9828 10.5055 86.2302 10.8835 86.3982 11.3221C86.5662 11.7515 86.6502 12.2181 86.6502 12.7221ZM85.0402 12.6801C85.0588 12.2881 85.0075 11.9475 84.8862 11.6581C84.7742 11.3688 84.6155 11.1355 84.4102 10.9581C84.2142 10.7715 83.9855 10.6361 83.7242 10.5521C83.4628 10.4588 83.1922 10.4121 82.9122 10.4121C82.6228 10.4121 82.3428 10.4588 82.0722 10.5521C81.8108 10.6361 81.5775 10.7715 81.3722 10.9581C81.1668 11.1448 80.9988 11.3828 80.8682 11.6721C80.7468 11.9521 80.6768 12.2881 80.6582 12.6801H85.0402Z" fill="white"></path>
                                                                <path d="M92.5031 9.11015C92.9418 9.11015 93.3385 9.18482 93.6931 9.33415C94.0571 9.47415 94.3698 9.68415 94.6311 9.96415C94.9018 10.2441 95.1071 10.5941 95.2471 11.0141C95.3965 11.4248 95.4711 11.9055 95.4711 12.4561V16.9501H93.8751V12.6241C93.8751 11.9148 93.6931 11.3781 93.3291 11.0141C92.9745 10.6408 92.4938 10.4541 91.8871 10.4541C91.2711 10.4541 90.7671 10.6501 90.3751 11.0421C89.9831 11.4341 89.7871 12.0361 89.7871 12.8481V16.9501H88.1911V9.23615H89.7871V10.9301C90.0018 10.3421 90.3471 9.89415 90.8231 9.58615C91.3085 9.26882 91.8685 9.11015 92.5031 9.11015Z" fill="white"></path>
                                                                <path d="M108.113 8.34015H103.343V10.4851C103.553 10.2551 103.843 10.0701 104.213 9.93015C104.583 9.79015 104.993 9.72015 105.443 9.72015C106.003 9.72015 106.483 9.81515 106.883 10.0051C107.283 10.1951 107.613 10.4551 107.873 10.7851C108.133 11.1051 108.323 11.4751 108.443 11.8951C108.573 12.3151 108.638 12.7551 108.638 13.2151C108.638 13.7851 108.558 14.3051 108.398 14.7751C108.238 15.2351 107.998 15.6301 107.678 15.9601C107.368 16.2801 106.978 16.5301 106.508 16.7101C106.048 16.8901 105.518 16.9801 104.918 16.9801C104.308 16.9801 103.758 16.9001 103.268 16.7401C102.788 16.5701 102.378 16.3351 102.038 16.0351C101.698 15.7351 101.433 15.3801 101.243 14.9701C101.063 14.5501 100.968 14.0901 100.958 13.5901H103.463C103.513 13.9101 103.643 14.1851 103.853 14.4151C104.063 14.6451 104.378 14.7601 104.798 14.7601C105.278 14.7601 105.623 14.6101 105.833 14.3101C106.043 14.0101 106.148 13.6301 106.148 13.1701C106.148 12.7101 106.028 12.3551 105.788 12.1051C105.558 11.8551 105.223 11.7301 104.783 11.7301C104.433 11.7301 104.153 11.8051 103.943 11.9551C103.733 12.1051 103.588 12.2901 103.508 12.5101H101.018V6.09015H108.113V8.34015Z" fill="white"></path>
                                                                <path d="M109.922 11.5351C109.922 10.7651 109.997 10.0551 110.147 9.40515C110.297 8.74515 110.537 8.17515 110.867 7.69515C111.207 7.21515 111.642 6.84015 112.172 6.57015C112.712 6.30015 113.367 6.16515 114.137 6.16515C114.907 6.16515 115.557 6.30015 116.087 6.57015C116.627 6.84015 117.062 7.21515 117.392 7.69515C117.732 8.17515 117.977 8.74515 118.127 9.40515C118.277 10.0551 118.352 10.7651 118.352 11.5351C118.352 12.3151 118.277 13.0351 118.127 13.6951C117.977 14.3551 117.732 14.9251 117.392 15.4051C117.062 15.8851 116.627 16.2601 116.087 16.5301C115.557 16.8001 114.907 16.9351 114.137 16.9351C113.367 16.9351 112.712 16.8001 112.172 16.5301C111.642 16.2601 111.207 15.8851 110.867 15.4051C110.537 14.9251 110.297 14.3551 110.147 13.6951C109.997 13.0351 109.922 12.3151 109.922 11.5351ZM115.802 11.5351C115.802 11.1351 115.782 10.7601 115.742 10.4101C115.712 10.0501 115.637 9.73515 115.517 9.46515C115.397 9.19515 115.227 8.98515 115.007 8.83515C114.787 8.67515 114.497 8.59515 114.137 8.59515C113.767 8.59515 113.472 8.67515 113.252 8.83515C113.032 8.98515 112.862 9.19515 112.742 9.46515C112.622 9.73515 112.542 10.0501 112.502 10.4101C112.462 10.7601 112.442 11.1351 112.442 11.5351C112.442 11.9351 112.462 12.3151 112.502 12.6751C112.542 13.0351 112.622 13.3501 112.742 13.6201C112.862 13.8901 113.032 14.1051 113.252 14.2651C113.472 14.4251 113.767 14.5051 114.137 14.5051C114.497 14.5051 114.787 14.4251 115.007 14.2651C115.227 14.1051 115.397 13.8901 115.517 13.6201C115.637 13.3501 115.712 13.0351 115.742 12.6751C115.782 12.3151 115.802 11.9351 115.802 11.5351Z" fill="white"></path>
                                                                <path d="M124.825 11.5351L129.1 16.9501H125.995L122.395 12.1951V16.9501H119.83V6.34515H122.395V11.0101L126.025 6.34515H129.1L124.825 11.5351Z" fill="white"></path>
                                                                <defs>
                                                                    <linearGradient id="paint0_linear_1268_3004" x1="1.01402e-06" y1="11" x2="139.508" y2="11" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.15625" stop-color="#F2AF36"></stop>
                                                                        <stop offset="1" stop-color="#F43D33"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint1_linear_1268_3004" x1="9.40002" y1="11.0004" x2="20.8805" y2="11.0004" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.15625" stop-color="#F2AF36"></stop>
                                                                        <stop offset="1" stop-color="#F43D33"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint2_linear_1268_3004" x1="12.7598" y1="11.0007" x2="17.3516" y2="11.0007" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.15625" stop-color="#F2AF36"></stop>
                                                                        <stop offset="1" stop-color="#F43D33"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint3_linear_1268_3004" x1="13.5291" y1="11.0116" x2="17.3324" y2="11.0116" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.15625" stop-color="#F2AF36"></stop>
                                                                        <stop offset="1" stop-color="#F43D33"></stop>
                                                                    </linearGradient>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                        <span class="radio__label__accessory">
                                                            <span class="radio__label__icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="82" height="20" viewBox="0 0 48 12">
                                                                    <defs>
                                                                        <linearGradient id="paint0_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint1_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint2_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint3_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint4_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint5_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint6_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint7_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint8_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint9_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                        <linearGradient id="paint10_linear_1270_3013" x1="0" y1="1.54321" x2="-5.91245e-07" y2="11.1111" gradientUnits="userSpaceOnUse">
                                                                            <stop offset="0" stop-color="#00E6CB"></stop>
                                                                            <stop offset="1" stop-color="#744DEF"></stop>
                                                                        </linearGradient>
                                                                    </defs>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3228 4.53773C15.4564 4.5287 15.5904 4.54836 15.7158 4.59538C15.8412 4.6424 15.9551 4.7157 16.0498 4.81035C16.1445 4.90501 16.2178 5.01882 16.2648 5.14415C16.3119 5.26948 16.3316 5.40341 16.3225 5.53696V9.82618C16.3316 9.95973 16.3119 10.0937 16.2648 10.219C16.2178 10.3443 16.1445 10.4582 16.0498 10.5528C15.9551 10.6475 15.8412 10.7208 15.7158 10.7678C15.5904 10.8148 15.4564 10.8344 15.3228 10.8254C15.1847 10.8312 15.0469 10.8089 14.9177 10.7598C14.7885 10.7107 14.6706 10.6359 14.5712 10.5399L14.4624 10.4312L14.3196 10.5399C13.9243 10.7839 13.4643 10.9024 13.0002 10.8798C12.6337 10.8974 12.2682 10.8291 11.9329 10.6804C11.5975 10.5317 11.3016 10.3067 11.0687 10.0233C10.5967 9.45145 10.3543 8.72461 10.3886 7.98407V5.51657C10.4035 5.26119 10.5155 5.02116 10.7017 4.84562C10.8878 4.67007 11.1341 4.57229 11.3901 4.57229C11.646 4.57229 11.8923 4.67007 12.0784 4.84562C12.2646 5.02116 12.3766 5.26119 12.3915 5.51657V7.94668C12.3915 8.84055 12.7826 9.01728 13.3573 9.01728C13.4948 9.02258 13.632 9.00004 13.7605 8.95098C13.8891 8.90191 14.0064 8.82736 14.1054 8.73179C14.2944 8.51435 14.3961 8.23467 14.391 7.94668V5.51657C14.3711 5.3876 14.381 5.25578 14.42 5.13125C14.459 5.00671 14.5262 4.89279 14.6162 4.79824C14.7062 4.70369 14.8166 4.63104 14.9391 4.58588C15.0617 4.54072 15.1929 4.52424 15.3228 4.53773Z" fill="url(#paint0_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.3313 4.53754C21.6978 4.51993 22.0633 4.58821 22.3987 4.73692C22.734 4.88563 23.0299 5.11066 23.2628 5.39403C23.7348 5.9659 23.9772 6.69273 23.9429 7.43328V9.90077C23.928 10.1561 23.816 10.3962 23.6299 10.5717C23.4437 10.7473 23.1974 10.845 22.9415 10.845C22.6855 10.845 22.4392 10.7473 22.2531 10.5717C22.0669 10.3962 21.9549 10.1561 21.94 9.90077V7.46726C21.94 6.57339 21.5489 6.39667 20.9742 6.39667C20.8367 6.39136 20.6996 6.4139 20.571 6.46296C20.4424 6.51203 20.3251 6.58659 20.2261 6.68215C20.0474 6.9034 19.9576 7.18337 19.9745 7.46726V9.89736C19.9596 10.1527 19.8476 10.3928 19.6614 10.5683C19.4752 10.7439 19.229 10.8416 18.973 10.8416C18.7171 10.8416 18.4708 10.7439 18.2846 10.5683C18.0985 10.3928 17.9865 10.1527 17.9716 9.89736V5.60816C17.9622 5.47275 17.9823 5.33691 18.0305 5.21003C18.0788 5.08315 18.154 4.96825 18.251 4.87325C18.3479 4.77825 18.4644 4.70543 18.5923 4.65979C18.7202 4.61415 18.8565 4.5968 18.9917 4.60892C19.1297 4.60432 19.2672 4.62718 19.3962 4.6762C19.5252 4.72521 19.6432 4.79938 19.7433 4.89441L19.8487 5.00317L19.9915 4.93181C20.3897 4.6717 20.8556 4.53457 21.3313 4.53754Z" fill="url(#paint1_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M34.7059 4.60932C34.8398 4.59977 34.9742 4.61905 35.1 4.66585C35.2258 4.71264 35.3401 4.78586 35.4352 4.88057C35.5303 4.97528 35.604 5.08926 35.6512 5.21485C35.6985 5.34043 35.7182 5.4747 35.7091 5.60856V9.93177C35.717 10.0681 35.6971 10.2047 35.6503 10.333C35.6036 10.4614 35.5311 10.5788 35.4373 10.6782C35.3436 10.7775 35.2305 10.8567 35.105 10.9108C34.9795 10.9649 34.8443 10.9928 34.7076 10.9928C34.571 10.9928 34.4358 10.9649 34.3103 10.9108C34.1848 10.8567 34.0717 10.7775 33.9779 10.6782C33.8842 10.5788 33.8117 10.4614 33.765 10.333C33.7182 10.2047 33.6982 10.0681 33.7062 9.93177V5.57456C33.6976 5.44264 33.7179 5.31045 33.7656 5.18715C33.8133 5.06386 33.8873 4.95242 33.9824 4.86058C34.0776 4.76873 34.1916 4.69868 34.3165 4.65529C34.4414 4.6119 34.5743 4.59622 34.7059 4.60932Z" fill="url(#paint2_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M38.4908 4.6093C38.6244 4.60026 38.7584 4.6199 38.8838 4.66692C39.0092 4.71394 39.1231 4.78724 39.2178 4.8819C39.3125 4.97655 39.3858 5.09036 39.4328 5.21569C39.4799 5.34102 39.4996 5.47497 39.4905 5.60853V9.93172C39.4985 10.0681 39.4785 10.2046 39.4317 10.333C39.385 10.4613 39.3125 10.5788 39.2188 10.6781C39.125 10.7774 39.0119 10.8566 38.8864 10.9107C38.7609 10.9648 38.6257 10.9927 38.4891 10.9927C38.3524 10.9927 38.2172 10.9648 38.0917 10.9107C37.9662 10.8566 37.8531 10.7774 37.7594 10.6781C37.6656 10.5788 37.5931 10.4613 37.5464 10.333C37.4997 10.2046 37.4797 10.0681 37.4876 9.93172V5.57453C37.4824 5.44316 37.5051 5.31219 37.5542 5.19022C37.6033 5.06825 37.6776 4.95804 37.7724 4.86686C37.8672 4.77568 37.9802 4.70559 38.104 4.6612C38.2278 4.6168 38.3596 4.59912 38.4908 4.6093Z" fill="url(#paint3_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M44.6356 4.53754C45.002 4.51993 45.3675 4.58821 45.7029 4.73692C46.0383 4.88563 46.3342 5.11066 46.5671 5.39403C47.0391 5.9659 47.2815 6.69273 47.2472 7.43328V9.90077C47.2323 10.1561 47.1203 10.3962 46.9341 10.5717C46.7479 10.7473 46.5017 10.845 46.2457 10.845C45.9898 10.845 45.7435 10.7473 45.5573 10.5717C45.3712 10.3962 45.2591 10.1561 45.2443 9.90077V7.46726C45.2443 6.57339 44.8498 6.39667 44.2785 6.39667C44.141 6.39136 44.0038 6.4139 43.8752 6.46296C43.7467 6.51203 43.6294 6.58659 43.5304 6.68215C43.3516 6.9034 43.2619 7.18337 43.2788 7.46726V9.89736C43.2639 10.1527 43.1519 10.3928 42.9657 10.5683C42.7795 10.7439 42.5332 10.8416 42.2773 10.8416C42.0213 10.8416 41.7751 10.7439 41.5889 10.5683C41.4027 10.3928 41.2907 10.1527 41.2758 9.89736V5.60816C41.2667 5.4743 41.2865 5.34003 41.3337 5.21445C41.381 5.08887 41.4546 4.97489 41.5497 4.88018C41.6448 4.78547 41.7591 4.71225 41.8849 4.66545C42.0107 4.61866 42.1451 4.59938 42.279 4.60892C42.4165 4.60362 42.5537 4.62616 42.6822 4.67522C42.8108 4.72429 42.9281 4.79885 43.0271 4.89441L43.1359 5.00317L43.2788 4.93181C43.6817 4.66848 44.1541 4.5312 44.6356 4.53754Z" fill="url(#paint4_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M31.0199 1.71699C30.8862 1.70739 30.7519 1.72665 30.6263 1.77347C30.5006 1.82029 30.3865 1.89357 30.2917 1.98835C30.1969 2.08312 30.1235 2.19716 30.0767 2.32275C30.0299 2.44833 30.0106 2.58254 30.0202 2.71622V4.89481L29.7311 4.75206C29.3637 4.57866 28.9608 4.49369 28.5546 4.50396C28.1596 4.49502 27.7673 4.56975 27.4033 4.72323C27.0393 4.87671 26.712 5.10545 26.4428 5.39443C25.8641 6.02757 25.5564 6.86207 25.5859 7.71916C25.5632 8.56294 25.8706 9.38231 26.4428 10.0031C26.7094 10.2981 27.0353 10.5336 27.3992 10.6941C27.7631 10.8545 28.1568 10.9364 28.5546 10.9344C29.0706 10.9446 29.579 10.8079 30.0202 10.5401L30.163 10.4314L30.2684 10.5741C30.3607 10.6817 30.4764 10.7668 30.6067 10.8227C30.737 10.8787 30.8783 10.9041 31.0199 10.897C31.1519 10.9055 31.2842 10.8853 31.4076 10.8376C31.5309 10.7899 31.6424 10.7159 31.7343 10.6209C31.8262 10.5258 31.8963 10.4119 31.9397 10.287C31.9831 10.1621 31.9988 10.0293 31.9857 9.89776V2.76041C31.9857 2.10785 31.6456 1.71699 31.0199 1.71699ZM29.6597 8.71839C29.5552 8.84335 29.4239 8.94333 29.2756 9.01096C29.1273 9.0786 28.9658 9.11218 28.8028 9.10925C28.6435 9.12118 28.4836 9.09679 28.3352 9.03791C28.1867 8.97903 28.0536 8.88721 27.9459 8.76938C27.7147 8.48078 27.5941 8.11925 27.6058 7.74976C27.5924 7.56443 27.6172 7.37835 27.6787 7.20298C27.7401 7.02761 27.8368 6.86668 27.9629 6.73013C28.0714 6.61243 28.2052 6.52074 28.3542 6.46189C28.5031 6.40304 28.6635 6.37856 28.8232 6.39026C28.9862 6.38733 29.1477 6.42091 29.296 6.48855C29.4443 6.55618 29.5756 6.65616 29.6801 6.78112C29.9237 7.05702 30.0516 7.41607 30.0372 7.78373C30.014 8.12951 29.8818 8.45906 29.6597 8.72519V8.71839Z" fill="url(#paint5_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M34.7063 1.89349C34.9435 1.89349 35.171 1.98766 35.3387 2.1553C35.5064 2.32293 35.6007 2.5503 35.6007 2.78737C35.6007 3.02444 35.5064 3.2518 35.3387 3.41943C35.171 3.58706 34.9435 3.68122 34.7063 3.68122C34.4691 3.68122 34.2417 3.58706 34.0739 3.41943C33.9062 3.2518 33.812 3.02444 33.812 2.78737C33.812 2.5503 33.9062 2.32293 34.0739 2.1553C34.2417 1.98766 34.4691 1.89349 34.7063 1.89349Z" fill="url(#paint6_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M38.4908 1.89378C38.728 1.89378 38.9554 1.98795 39.1232 2.15558C39.2909 2.32322 39.3851 2.55059 39.3851 2.78766C39.3851 3.02473 39.2909 3.25209 39.1232 3.41973C38.9554 3.58736 38.728 3.68152 38.4908 3.68152C38.37 3.69503 38.2478 3.68121 38.1332 3.64107C38.0185 3.60092 37.9143 3.53548 37.8284 3.44962C37.7425 3.36376 37.6771 3.25969 37.6369 3.14509C37.5967 3.03049 37.5829 2.90833 37.5964 2.78766C37.5861 2.66767 37.6021 2.54686 37.6433 2.4337C37.6846 2.32055 37.7502 2.21778 37.8354 2.13262C37.9206 2.04745 38.0234 1.98195 38.1366 1.94069C38.2498 1.89943 38.3707 1.88342 38.4908 1.89378Z" fill="url(#paint7_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.96233 8.60962C3.29422 8.60962 3.61251 8.7414 3.84719 8.97596C4.08187 9.21052 4.21373 9.52866 4.21373 9.86037C4.21373 10.1921 4.08187 10.5102 3.84719 10.7448C3.61251 10.9793 3.29422 11.1111 2.96233 11.1111H1.26206C0.930169 11.1111 0.611864 10.9793 0.377181 10.7448C0.142499 10.5102 0.0106439 10.1921 0.0106439 9.86037C0.0106439 9.52866 0.142499 9.21052 0.377181 8.97596C0.611864 8.7414 0.930169 8.60962 1.26206 8.60962H2.96233Z" fill="url(#paint8_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.9644 4.30703C7.28681 4.31188 7.5949 4.44094 7.82443 4.66728C8.05397 4.89361 8.18724 5.19975 8.19645 5.5219C8.20566 5.84404 8.09011 6.1573 7.87387 6.39637C7.65764 6.63544 7.35742 6.78185 7.03582 6.80509H1.25489C0.932484 6.80024 0.624393 6.67121 0.394856 6.44487C0.165318 6.21853 0.0320469 5.91237 0.022838 5.59023C0.0136291 5.26809 0.129183 4.95482 0.345416 4.71575C0.56165 4.47669 0.861868 4.33027 1.18347 4.30703H6.9644Z" fill="url(#paint9_linear_1270_3013)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3614 0.000509602C10.6933 -0.00895507 11.0154 0.113742 11.2567 0.341608C11.4981 0.569474 11.6391 0.883848 11.6485 1.21556C11.658 1.54728 11.5352 1.86917 11.3072 2.11042C11.0793 2.35167 10.7647 2.49253 10.4328 2.50199H1.25139C0.9206 2.49845 0.604358 2.36554 0.370439 2.13175C0.136519 1.89795 0.0035382 1.58187 0 1.25125C0.00582342 0.933443 0.129943 0.629205 0.348127 0.397939C0.566311 0.166673 0.862886 0.0249725 1.17997 0.000509602H10.3614Z" fill="url(#paint10_linear_1270_3013)"></path>
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <div class="content-box__row__desc hide" data-bind-show="paymentMethod == 612321" data-provider-id="22">
                                                    <p></p>
                                                    <div id="script-checkout-container">

                                                        <style>
                                                            .fundiin-method {
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: flex-start;
                                                                gap: 8px;
                                                            }

                                                            #script-checkout-container {
                                                                white-space: normal;

                                                                .fundiin-desc {
                                                                    text-align: left;

                                                                    strong {
                                                                        display: inline-block;
                                                                        font-weight: 600;
                                                                        margin-bottom: 12px;
                                                                    }

                                                                    strong:not(:first-child) {
                                                                        margin-top: 12px;
                                                                    }

                                                                    ul {
                                                                        list-style-type: disc;
                                                                        padding-inline-start: 40px;
                                                                    }
                                                                }
                                                            }
                                                        </style>

                                                        <div id="fundiin-description" class="fundiin-desc">
                                                            <strong>Mua trước Trả sau linh hoạt đến 12 tháng - chuẩn 3 KHÔNG với Fundiin</strong>
                                                            <ul class="fundiin-desc-intro__list">
                                                                <li>Không lãi suất - không phí ẩn</li>
                                                                <li>Không thủ tục rườm rà - chỉ với CCCD và hình selfie</li>
                                                                <li>Không chờ đợi - xét duyệt nhanh chóng</li>
                                                            </ul>

                                                            <strong>Ưu đãi*:</strong>
                                                            <ul>
                                                                <li>
                                                                    <p>Giảm 20% tối đa <strong>30K</strong> cho khách hàng lần đầu thanh toán Fundiin</p>
                                                                </li>
                                                                <li>
                                                                    <p>Giảm 3% tối đa <strong>50K</strong> cho khách hàng lần đầu thanh toán Fundiin</p>
                                                                </li>
                                                            </ul>

                                                            <p>(*) Mã được nhập tại giao diện thanh toán của Fundiin</p>
                                                        </div>
                                                    </div>
                                                    <script type="application/javascript" src="https://gateway.fundiin.vn/merchants/checkoutjs/Sapo_Web_329122.js"> </script>
                                                    <p></p>

                                                </div>

                                            </div> -->

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
                            Đơn hàng (1 sản phẩm)
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
                                                        <label for="reductionCode" class="field__label">Nhập mã giảm giá</label>
                                                        <input name="reductionCode" id="reductionCode" type="text" class="field__input" autocomplete="off" data-bind-disabled="isLoadingReductionCode" data-bind-event-keypress="handleReductionCodeKeyPress(event)" data-define="{reductionCode: null}" data-bind="reductionCode">
                                                    </div>
                                                    <button class="field__input-btn btn spinner btn--disabled" type="button" data-bind-disabled="isLoadingReductionCode || !reductionCode" data-bind-class="{'spinner--active': isLoadingReductionCode, 'btn--disabled': !reductionCode}" data-bind-event-click="applyReductionCode()" disabled="">
                                                        <span class="spinner-label">Áp dụng</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                                            <use href="#spinner"></use>
                                                        </svg>
                                                    </button>
                                                </div>

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
                                                <td class="total-line__price">{{ number_format($totalPrice, 0, ',', '.') }} ₫</td>
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
                                                    <span class="payment-due__price" data-bind="getTextTotalPrice()">{{ number_format($totalPrice, 0, ',', '.') }} ₫</span>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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