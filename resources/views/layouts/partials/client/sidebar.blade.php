 <section class="section awe-section-1">
     <div class="container section mt-0">
         <div class="row ">
             <div class="col-lg-3 d-xl-block d-none navigation-wrapper">
                 <nav class="h-100">
                     <ul class="navigation list-group list-group-flush scroll">
                         @foreach($categories_sidebar as $category)
                         <li class="menu-item list-group-item">
                             <a href="/{{ $category->slug }}" class="menu-item__link" title="{{ $category->name }}">
                                 <img loading="lazy" width='24' height='24'
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAeAAAAHgCAMAAABKCk6nAAAAA1BMVEXr6+uInxNMAAAA9UlEQVR42u3BgQAAAADDoPtTH2TVAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADghg0AAVGLwCwAAAAASUVORK5CYII="
                                     alt="{{ $category->name }}" />
                                 <span>{{ $category->name }}</span>
                                 <i class='float-right' data-toggle-submenu>


                                     <svg class="icon">
                                         <use xlink:href="#icon-arrow" />
                                     </svg>
                                 </i>
                             </a>

                             <!-- <div class="submenu scroll">
                                 <ul class="submenu__list">



                                     <li class="submenu__col">
                                         @foreach($category->brands as $brand)
                                         <span class="submenu__item submenu__item">
                                             <a class="link" href="/{{ $brand->slug }}" title="{{ $brand->name }}">{{ $brand->name }}</a>
                                         </span>
                                         @endforeach

                                     </li>








                                 </ul>
                             </div> -->
                         </li>
                         @endforeach

                     </ul>

                 </nav>
             </div>
             <div class="col-xl-9 col-12 home-banner-group pl-xl-0">
                 <div class='home-banner-left' style='--grid-colum: 1 / span 3'>
                     <section class="section-slider">
                         <div class="home-slider3 swiper-container gallery-top">
                             <div class="swiper-wrapper">







                                 <div class="swiper-slide">
                                     <a href="#" class="clearfix" title="Gear Arena - Đón Deal Vô Địch">
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-pc"
                                             src="{{asset('/assets/admin/img/slider/slider1_1.png')}}"
                                             alt="Gear Arena - Đ&#243;n Deal V&#244; Địch" width="890" height="443" />
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-mb"
                                             src="{{asset('/assets/admin/img/slider/slider1_1_mb.png')}}"
                                             alt="Gear Arena - Đ&#243;n Deal V&#244; Địch" width="480" height="480" />
                                     </a>
                                 </div>








                                 <div class="swiper-slide">
                                     <a href="#" class="clearfix" title="Nuphy">
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-pc"
                                             src="{{asset('/assets/admin/img/slider/slider1_2.png')}}"
                                             alt="Nuphy" width="890" height="443" />
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-mb"
                                             src="{{asset('/assets/admin/img/slider/slider1_2.png')}}"
                                             alt="Nuphy" width="480" height="480" />
                                     </a>
                                 </div>








                                 <div class="swiper-slide">
                                     <a href="#" class="clearfix" title="Asus Expertbook">
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-pc"
                                             src="{{asset('/assets/admin/img/slider/slider1_3.png')}}"
                                             alt="Asus Expertbook" width="890" height="443" />
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-mb"
                                             src="{{asset('/assets/admin/img/slider/slider1_3_mb.png')}}"
                                             alt="Asus Expertbook" width="480" height="480" />
                                     </a>
                                 </div>








                                 <div class="swiper-slide">
                                     <a href="#" class="clearfix" title="SanDisk">
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-pc"
                                             src="{{asset('/assets/admin/img/slider/slider1_4.png')}}"
                                             alt="SanDisk" width="890" height="443" />
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-mb"
                                             src="{{asset('/assets/admin/img/slider/slider1_4_mb.png')}}"
                                             alt="SanDisk" width="480" height="480" />
                                     </a>
                                 </div>








                                 <div class="swiper-slide">
                                     <a href="#" class="clearfix" title="PC siêu tốc">
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-pc"
                                             src="{{asset('/assets/admin/img/slider/slider1_5.png')}}"
                                             alt="PC si&#234;u tốc" width="890" height="443" />
                                         <img loading="lazy" class="img-fluid img-responsive center-block mx-auto slider-mb"
                                             src="{{asset('/assets/admin/img/slider/slider1_5_mb.png')}}"
                                             alt="PC si&#234;u tốc" width="480" height="480" />
                                     </a>
                                 </div>


                             </div>

                         </div>
                         <div class="home-slider2 swiper-container gallery-top">
                             <div class="swiper-wrapper">




                                 <div class="swiper-slide">
                                     <span>Gear Arena<br>Đón Deal Vô Địch</span>
                                 </div>





                                 <div class="swiper-slide">
                                     <span>New Arrival<br>NuPhy Air75 V3</span>
                                 </div>





                                 <div class="swiper-slide">
                                     <span>Asus Expertbook<br>Giá chỉ từ 13 triệu</span>
                                 </div>





                                 <div class="swiper-slide">
                                     <span>Sandisk <br> Flagship Store</span>
                                 </div>





                                 <div class="swiper-slide">
                                     <span>PC Siêu Tốc <br> Giá chỉ từ 6770K</span>
                                 </div>


                             </div>
                             <div class="swiper-pagination"></div>
                         </div>
                     </section>
                     <!-- Swiper JS -->

                     <!-- Initialize Swiper -->
                     <script>
                         var swiperslider = new Swiper(".home-slider2", {
                             spaceBetween: 10,
                             slidesPerView: 5,
                             freeMode: true,
                             watchSlidesProgress: true,
                             breakpoints: {
                                 280: {
                                     slidesPerView: 3,
                                     spaceBetween: 10
                                 },
                                 640: {
                                     slidesPerView: 3,
                                     spaceBetween: 10
                                 },
                                 768: {
                                     slidesPerView: 3,
                                     spaceBetween: 10
                                 },
                                 992: {
                                     slidesPerView: 3,
                                     spaceBetween: 10
                                 },
                                 1024: {
                                     slidesPerView: 5,
                                     spaceBetween: 10
                                 }
                             }

                         });
                         var swiperslider2 = new Swiper(".home-slider3", {

                             navigation: {
                                 nextEl: ".swiper-button-next",
                                 prevEl: ".swiper-button-prev",
                             },
                             thumbs: {
                                 swiper: swiperslider,
                             },
                             autoplay: {
                                 delay: 4000,
                                 disableOnInteraction: true,
                             }
                         });
                     </script>
                 </div>

                 <div class='sub_banner sub_banner--bottom d-none d-lg-flex'>

                     <a class="sub_banner__item banner" href="#"
                         title="Ổ cứng chính hãng">
                         <picture>
                             <source media="(max-width: 480px)"
                                 srcset="//bizweb.dktcdn.net/thumb/medium/100/329/122/themes/1038963/assets/bottom_banner_1.jpg?1762606819649">

                             <img loading="lazy" class='img-fluid'
                                 src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/bottom_banner_1.jpg?1762606819649"
                                 alt="Ổ cứng chính hãng" width="355" height="172" />
                         </picture>

                     </a>

                     <a class="sub_banner__item banner" href="#" title="Thẻ nhớ chính hãng">
                         <picture>
                             <source media="(max-width: 480px)"
                                 srcset="//bizweb.dktcdn.net/thumb/medium/100/329/122/themes/1038963/assets/bottom_banner_2.jpg?1762606819649">

                             <img loading="lazy" class='img-fluid'
                                 src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/bottom_banner_2.jpg?1762606819649"
                                 alt="Thẻ nhớ chính hãng" width="355" height="172" />
                         </picture>

                     </a>

                     <a class="sub_banner__item banner" href="#" title="Chuột - Bàn phím - Tai nghe22">
                         <picture>
                             <source media="(max-width: 480px)"
                                 srcset="//bizweb.dktcdn.net/thumb/medium/100/329/122/themes/1038963/assets/bottom_banner_3.jpg?1762606819649">

                             <img loading="lazy" class='img-fluid'
                                 src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/bottom_banner_3.jpg?1762606819649"
                                 alt="Chuột - Bàn phím - Tai nghe22" width="355" height="172" />
                         </picture>

                     </a>
                 </div>
             </div>
         </div>
     </div>
 </section>




 <div id="mobile-menu" class="scroll">
     <div class='media d-flex user-menu'>
         @guest
         @if (Route::has('login'))
         <i class="fas fa-user-circle mr-3 align-self-center"></i>
         <div class="media-body d-md-flex flex-column ">
             <a rel="nofollow" href="{{ route('login') }}" class="d-block" title="Tài khoản">
                 Đăng nhập
             </a>
             <small>
                 <a href="{{ route('register') }}" title="Đăng nhập" class="font-weight: light">
                     Đăng ký
                 </a> </small>

         </div>
         @endif
         @else
         <i class="fas fa-user-circle mr-3 align-self-center"></i>
         <div class="media-body d-md-flex flex-column ">
             <a rel="nofollow" href="" class="d-block" title="Tài khoản">
                 {{ Str::limit(Auth::user()->name, 15) }}
             </a>
             <small>
                 <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     Đăng xuất
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </small>

         </div>
         @endguest
     </div>
     <div class="mobile-menu-body scroll">
         <nav class="h-100">
             <ul class="navigation list-group list-group-flush scroll">


                 @foreach($categories_sidebar as $category)
                 <li class="menu-item list-group-item">
                     <a href="/{{ $category->slug }}" class="menu-item__link" title="{{ $category->name }}">
                         <img loading="lazy" width='24' height='24' src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAeAAAAHgCAMAAABKCk6nAAAAA1BMVEXr6+uInxNMAAAA9UlEQVR42u3BgQAAAADDoPtTH2TVAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADghg0AAVGLwCwAAAAASUVORK5CYII=" alt="{{ $category->name }}" />
                         <span>{{ $category->name }}</span>

                         <i class='float-right' data-toggle-submenu>


                             <svg class="icon">
                                 <use xlink:href="#icon-arrow" />
                             </svg>
                         </i>
                     </a>

                     <div class="submenu scroll">
                         <div class='toggle-submenu d-lg-none d-xl-none'>
                             <i class='mr-3'>


                                 <svg class="icon" style="transform: rotate(180deg)">
                                     <use xlink:href="#icon-arrow" />
                                 </svg>
                             </i>
                             <span>{{ $category->name }} </span>
                         </div>
                         <!-- <ul class="submenu__list">



                             <li class="submenu__col">
                                 <span class="submenu__item submenu__item--main">
                                     <a class="link" href="/chuot-gaming-van-phong" title="Chuột">Chuột</a>
                                 </span>

                                 <span class="submenu__item submenu__item">
                                     <a class="link" href="/chuot-razer" title="Razer">Razer</a>
                                 </span>


                             </li>


                         </ul> -->
                     </div>
                 </li>
                 @endforeach

             </ul>
         </nav>

         <ul class="shop-policises list-unstyled d-flex align-items-center flex-wrap m-0 pr-0">
             <li class="">
                 <a class="link" href="https://memoryzone.com.vn/huong-dan-thanh-toan" title="THANH TOÁN">
                     THANH TOÁN
                 </a>
             </li>
             <li class="">
                 <a class="link" href="https://memoryzone.com.vn/huong-dan-tra-gop" title="TRẢ GÓP">
                     TRẢ GÓP
                 </a>
             </li>
             <li class="">
                 <a class="link" href="/lien-he" title="LIÊN HỆ">
                     LIÊN HỆ
                 </a>
             </li>
             <li class="">
                 <a class="link" href="https://go.mmz.vn/Ho-Tro-Khach-Hang-Web" title="CHĂM SÓC KHÁCH HÀNG">
                     CHĂM SÓC KHÁCH HÀNG
                 </a>
             </li>
             <li class="">
                 <a class="link" href="/tin-tuc" title="THƯ VIỆN">
                     THƯ VIỆN
                 </a>
             </li>
             <li class="">
                 <a class="link" href="https://tuyendung.sieutoc.com/jobs" title="TUYỂN DỤNG">
                     TUYỂN DỤNG (TEST)
                 </a>
             </li>
         </ul>
     </div>

     <div class="mobile-menu-footer border-top w-100 d-flex align-items-center text-center">
         <div class="hotline  w-50   p-2 ">
             <a href="tel:02873013878" title="028 7301 3878">
                 Gọi điện <i class="fas fa-phone ml-3"></i>
             </a>
         </div>
         <div class="messenger border-left p-2 w-50 border-left">

             <a href="https://www.messenger.com/t/memoryzonevietnam/" title="https://www.messenger.com/t/memoryzonevietnam/">
                 Nhắn tin
                 <i class="fab fa-facebook-messenger ml-3"></i>
             </a>
         </div>

     </div>
 </div>
 <div class='menu-overlay'>

 </div>
 <section class="section awe-section-2">
     <section class="section_collections section">
         <div class="container border-0">
             <div class="mt-2 text-center row flex-nowrap collections-slide">



                 <div class="item  ">
                     <a href="#" title="PC - Máy bộ" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/pcmaybo.png')}}"
                             width="100" height="100" alt="coll_2_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="PC - Máy bộ">
                             PC - Máy bộ
                         </a>
                     </h3>
                 </div>


                 <div class="item  ">
                     <a href="#" title="Màn hình" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/manhinh.png')}}"
                             width="100" height="100" alt="coll_3_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Màn hình">
                             Màn hình
                         </a>
                     </h3>
                 </div>

                 <div class="item  ">
                     <a href="#" title="Laptop" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/laptop.png')}}"
                             width="100" height="100" alt="coll_4_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Laptop">
                             Laptop
                         </a>
                     </h3>
                 </div>

                 <div class="item  ">
                     <a href="#" title="Chuột - Phím Tai nghe"
                         class="pos-relative d-flex align-items-center " style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/chuotbanphim.png')}}"
                             width="100" height="100" alt="coll_5_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Chuột - Phím Tai nghe">
                             Chuột - Phím Tai nghe
                         </a>
                     </h3>
                 </div>

                 <div class="item  ">
                     <a href="#" title="Ổ cứng SSD Gắn trong"
                         class="pos-relative d-flex align-items-center " style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/ocungssdgantrong.png')}}"
                             width="100" height="100" alt="coll_6_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Ổ cứng SSD Gắn trong">
                             Ổ cứng SSD Gắn trong
                         </a>
                     </h3>
                 </div>

                 <div class="item  ">
                     <a href="#" title="Ổ cứng SSD Di động"
                         class="pos-relative d-flex align-items-center " style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/ocungssdidong.png')}}"
                             width="100" height="100" alt="coll_7_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Ổ cứng SSD Di động">
                             Ổ cứng SSD Di động
                         </a>
                     </h3>
                 </div>


                 <div class="item  ">
                     <a href="#" title="Thẻ nhớ" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                         src="{{asset('/assets/admin/img/thenho.png')}}"
                             width="100" height="100" alt="coll_8_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="Thẻ nhớ">
                             Thẻ nhớ
                         </a>
                     </h3>
                 </div>


                 <div class="item  ">
                     <a href="#" title="RAM" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/ram.png')}}"
                             width="100" height="100" alt="coll_9_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="RAM">
                             RAM
                         </a>
                     </h3>
                 </div>


                 <div class="item  ">
                     <a href="#" title="NAS" class="pos-relative d-flex align-items-center "
                         style="aspect-ratio:100/ 100">
                         <img class="img-fluid m-auto object-contain mh-100" loading="lazy"
                             src="{{asset('/assets/admin/img/usb.png')}}"
                             width="100" height="100" alt="coll_10_title" />
                     </a>
                     <h3 class="mb-0">
                         <a href="#" title="USB">
                             USB
                         </a>
                     </h3>
                 </div>
             </div>
         </div>
     </section>
 </section>
 </div>