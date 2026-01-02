 @extends('home')
 @section('content')
 @include('layouts.partials.client.sidebar')
 <section class="section awe-section-2">
   <section class="section_collections section">
     <div class="container border-0">
       <div class="mt-2 text-center row flex-nowrap collections-slide">

       </div>
     </div>
   </section>
 </section>
 <section class="section awe-section-3">

 </section>
 <section class="section awe-section-5">
   <section class="section_banner_coll section">
     <div class="container">
       <div class="row text-center justify-content-md-center justify-content-start">
         <div class="item col-8 col-md-4">
           <a class="banner" href="#" title="Samsung">
             <picture>
               <source media="(max-width: 600px)"
                 srcset="{{asset('/assets/admin/img/banner/banner_coll_1_1.png')}}">
               <img loading="lazy" class="img-fluid"
                 src="{{asset('/assets/admin/img/banner/banner_coll_1_1.png')}}"
                 alt="banner_coll_1_1_title" width="380" height="204" />

             </picture>
           </a>
         </div>


         <div class="item col-8 col-md-4">
           <a class="banner" href="#" title="SanDisk Flagship Store">
             <picture>
               <source media="(max-width: 600px)"
                 srcset="{{asset('/assets/admin/img/banner/banner_coll_1_2.png')}}">
               <img loading="lazy" class="img-fluid"
                 src="{{asset('/assets/admin/img/banner/banner_coll_1_2.png')}}"
                 alt="banner_coll_1_2_title" width="380" height="204" />

             </picture>
           </a>
         </div>


         <div class="item col-8 col-md-4">
           <a class="banner" href="#" title="Laptop Expertbook">
             <picture>
               <source media="(max-width: 600px)"
                 srcset="{{asset('/assets/admin/img/banner/banner_coll_1_3.png')}}">
               <img loading="lazy" class="img-fluid"
                 src="{{asset('/assets/admin/img/banner/banner_coll_1_3.png')}}"
                 alt="banner_coll_1_3_title" width="380" height="204" />

             </picture>
           </a>
         </div>


       </div>


     </div>
   </section>
 </section>
 <section class="section awe-section-6">
   <div class="section_product section_product_1 section_product_tag section">
     <div class="container">
       <div
         class="title_module_main heading-bar e-tabs not-dqtab d-flex justify-content-between align-items-center flex-wrap">
         <h2 class="heading-bar__title ">
           <a class='link' href="laptop" title="LAPTOP BÁN CHẠY">
             LAPTOP BÁN CHẠY
           </a>
         </h2>

         <div class="tagnav--horizontal d-lg-flex align-items-center mt-3">
           <div class="tagnav-wrapper">
             <ul class='mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
               <!-- brand -->
               @foreach($LaptopBrands as $brand)
               <li class="menu-item ega-small tab-link link mr-2 mt-2111">
                 <a href='/laptop-{{$brand->name}}' class="menu-item__link" title="{{$brand->name}}">{{$brand->name}}</a>
               </li>
               @endforeach
               <!--End brand -->
               <li class="menu-item ega-small tab-link link d-none d-sm-block">
                 <a href="{{route('client.showBySlug', 'laptop')}}" title="Xem tất cả" class="menu-item__link text-primary">
                   Xem tất cả

                   <svg class="icon">
                     <use xlink:href="#icon-arrow" />
                   </svg> </a>
               </li>
             </ul>
           </div>
           <div class="navigation-arrows">
             <i class="fas fa-chevron-left prev disabled"></i>
             <i class="fas fa-chevron-right next"></i>
           </div>
         </div>

         <ul
           class='tagnav--scroll mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
           @foreach($LaptopBrands as $brand)
           <li class="ega-small tab-link px-3 py-2 link mr-2 mt-2">
             <a href='/laptop-{{$brand->name}}' title="{{$brand->name}}">{{$brand->name}}</a>
           </li>
           @endforeach
           <li class="ega-small tab-link px-3 py-2 link d-none d-sm-block mt-2">
             <a href="laptop" title="Xem tất cả" class="text-primary">
               Xem tất cả

               <svg class="icon">
                 <use xlink:href="#icon-arrow" />
               </svg> </a>
           </li>
         </ul>
       </div>
       <div class="clearfix"></div>
       <div class="row">
         <div class="col-md-9 col-lg-9 order-lg-1 order-md-1 order-1 product-box-content">
           <div class="md-product-slider-1 swiper-container">
             <div class="swiper-wrapper">

               @foreach($productLaptops as $product)


               <div class="swiper-slide">
                 <div class="item_product_main">

                   <style>
                     .ae-badge {
                       position: absolute;
                       border-radius: 4px;
                       background-color: #e4e4e4;
                       font-size: 12px;
                       max-width: calc(100% - 16px);
                       text-overflow: ellipsis;
                       white-space: nowrap;
                       overflow: hidden;
                       z-index: 1;
                     }

                     .ae-badge.top-left {
                       top: 8px;
                       left: 8px;
                     }

                     .ae-badge.bottom-left {
                       bottom: 8px;
                       left: 8px;
                     }

                     .ae-badge.top-right {
                       top: 8px;
                       right: 8px;
                     }

                     .ae-badge.bottom-right {
                       bottom: 8px;
                       right: 8px;
                     }

                     .ae-badge.percent {
                       background-color: #fff0e9;
                       color: #eb5757;
                       padding: 2px 4px;
                     }

                     .ae-badge.voucher {
                       background: linear-gradient(to right, #ef3006, #c60004);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge.hot {
                       background: linear-gradient(to right, #e91f63, #db2663);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge__image {
                       width: 20px !important;
                       height: 20px;
                     }
                   </style>

                   <form action="/cart/add" method="post" class="variants product-action" enctype="multipart/form-data"
                     data-tags='[""]'>

                     <div class="product-thumbnail pos-relative">


                       <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1"
                         href="{{route('client.showBySlug', $product->slug)}}"
                         title="{{ $product->name }}">

                         <img class='lazyload product-thumbnail__img product-thumbnail__img--primary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                         <img class='lazyload product-thumbnail__img product-thumbnail__img--secondary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                       </a>

                       <div class='ae-badge bottom-left image'>
                         <img class="ae-badge__image"
                           src=""
                           alt="" />
                       </div>


                       <div class="tagdacbiet_sale sale-flash">
                         <div class="font16">
                           {{ $product->discount_percent.'%'}}
                         </div>
                       </div>


                     </div>
                     <div class="product-info">
                       <h3 class="product-name"><a href="{{route('client.showBySlug', $product->slug)}}"
                           title="{{$product->name}}">{{$product->name}} </a></h3>
                       <div class="product-item-cta position-relative">
                         <div class="price-box">
                           <span class="price">{{$product->price_format}} đ</span>
                           <span class="compare-price">{{$product->cost_price_format}} đ</span>
                         </div>
                       </div>


                       <div class="aer-review-result ae-total-">
                       </div>
                       <style>
                         .ae-total-review {
                           display: none;
                         }

                         .ae-total-review-grid {
                           display: inline-block;
                           font-size: 12px;
                           color: #888;
                         }

                         .aer-star-active svg,
                         .aer-star-active path {
                           fill: rgb(255, 193, 7);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-star-deactive svg,
                         .aer-star-deactive path {
                           fill: rgb(204, 204, 204);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-ordered svg,
                         .aer-ordered path {
                           fill: #52B858;
                         }

                         .ae-total-,
                         .ae-total-0 {
                           display: none;
                         }
                       </style>

                     </div>
                   </form>
                 </div>
               </div>

               @endforeach

             </div>
           </div>
         </div>
         <div class="col-lg-3 col-md-3 order-lg-2 order-md-2 order-2 product-box-image">
           <a href="laptop-asus-expertbook">
             <img loading="lazy" class="img-fluid img-responsive center-base"
               src="{{asset('/assets/admin/img/section/section_product_1_1.png')}}"
               alt="Laptop Asus Expertbook" width="280" height="337" />
           </a>
           <a href="laptop-acer-nitro">
             <img loading="lazy" class="img-fluid img-responsive center-base"
               src="{{asset('/assets/admin/img/section/section_product_1_2.png')}}"
               alt="Best Combo Laptop Acer Nitro V" width="280" height="337" />
           </a>
         </div>
       </div>
     </div>
   </div>
   <script>
     var swiperproduct1 = new Swiper(".md-product-slider-1", {
       slidesPerView: 4,
       loop: false,
       grabCursor: true,
       slidesPerColumn: 2,
       slidesPerColumnFill: 'row',
       spaceBetween: 10,
       roundLengths: true,
       slideToClickedSlide: false,
       navigation: {
         nextEl: '.section_product_1 .swiper-button-next',
         prevEl: '.section_product_1 .swiper-button-prev',
       },
       autoplay: false,
       breakpoints: {
         300: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         500: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         640: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         768: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         991: {
           slidesPerView: 3,
           spaceBetween: 10
         },
         1200: {
           slidesPerView: 4,
           spaceBetween: 10
         }
       }
     });
   </script>
 </section>
 <section class="section awe-section-7">
   <div class="section_product section_product_2 section_product_tag section">
     <div class="container">
       <div
         class="title_module_main heading-bar e-tabs not-dqtab d-flex justify-content-between align-items-center flex-wrap">
         <h2 class="heading-bar__title ">
           <a class='link' href="pcmaybo" title="MINI PC - MÁY BỘ">
             MINI PC - MÁY BỘ
           </a>
         </h2>
         <div class="product-box-image-full mt-3">
           <a href="pcmaybo">
             <img loading="lazy" class="img-fluid img-responsive center-base"
               src="{{asset('/assets/admin/img/section/section_product_2.png')}}"
               alt="MINI PC - MÁY BỘ" />
           </a>
         </div>
         <div class="tagnav--horizontal d-lg-flex align-items-center mt-3">
           <div class="tagnav-wrapper">
             <ul class='mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
               @foreach($PCBrands as $brand)
               <li class="menu-item ega-small tab-link link mr-2 mt-2111">
                 <a href='/{{$brand->slug}}' class="menu-item__link" title="{{$brand->name}}">{{$brand->name}}</a>
               </li>
               @endforeach
               <li class="menu-item ega-small tab-link link d-none d-sm-block">
                 <a href="pcmaybo" title="Xem tất cả" class="menu-item__link text-primary">
                   Xem tất cả

                   <svg class="icon">
                     <use xlink:href="#icon-arrow" />
                   </svg> </a>
               </li>
             </ul>
           </div>
           <div class="navigation-arrows">
             <i class="fas fa-chevron-left prev disabled"></i>
             <i class="fas fa-chevron-right next"></i>
           </div>
         </div>

         <!-- dành cho mobile -->
         <ul
           class='tagnav--scroll mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
           @foreach($PCBrands as $brand)
           <li class="ega-small tab-link px-3 py-2 link mr-2 mt-2">
             <a href='/{{$brand->slug}}' title="{{$brand->name}}">{{$brand->name}}</a>
           </li>
           @endforeach
           <li class="ega-small tab-link px-3 py-2 link d-none d-sm-block mt-2">
             <a href="pcmaybo" title="Xem tất cả" class="text-primary">
               Xem tất cả

               <svg class="icon">
                 <use xlink:href="#icon-arrow" />
               </svg> </a>
           </li>
         </ul>
       </div>
       <div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-lg-12 product-box-content">
           <div class="md-product-slider-2 swiper-container">
             <div class="swiper-wrapper">
               @foreach($productPCs as $product)
               <div class="swiper-slide">
                 <div class="item_product_main">

                   <style>
                     .ae-badge {
                       position: absolute;
                       border-radius: 4px;
                       background-color: #e4e4e4;
                       font-size: 12px;
                       max-width: calc(100% - 16px);
                       text-overflow: ellipsis;
                       white-space: nowrap;
                       overflow: hidden;
                       z-index: 1;
                     }

                     .ae-badge.top-left {
                       top: 8px;
                       left: 8px;
                     }

                     .ae-badge.bottom-left {
                       bottom: 8px;
                       left: 8px;
                     }

                     .ae-badge.top-right {
                       top: 8px;
                       right: 8px;
                     }

                     .ae-badge.bottom-right {
                       bottom: 8px;
                       right: 8px;
                     }

                     .ae-badge.percent {
                       background-color: #fff0e9;
                       color: #eb5757;
                       padding: 2px 4px;
                     }

                     .ae-badge.voucher {
                       background: linear-gradient(to right, #ef3006, #c60004);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge.hot {
                       background: linear-gradient(to right, #e91f63, #db2663);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge__image {
                       width: 20px !important;
                       height: 20px;
                     }
                   </style>

                   <form action="/cart/add" method="post" class="variants product-action" enctype="multipart/form-data"
                     data-tags='["OLED","qlkm_Office_2019","16GB","SSD 512GB","DDR5","14 inch","Thiết kế Đồ họa","Học tập Văn phòng","Mỏng nhẹ cao cấp","Ryzen 5","Radeon Graphics","90Hz - 120Hz","2.8K - 3.2K"]'>

                     <div class="product-thumbnail pos-relative">


                       <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1"
                         href="{{route('client.showBySlug', $product->slug)}}"
                         title="{{ $product->name }}">

                         <img class='lazyload product-thumbnail__img product-thumbnail__img--primary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                         <img class='lazyload product-thumbnail__img product-thumbnail__img--secondary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                       </a>

                       <div class='ae-badge bottom-left image'>
                         <img class="ae-badge__image"
                           src=""
                           alt="" />
                       </div>


                       <div class="tagdacbiet_sale sale-flash">
                         <div class="font16">
                           {{ $product->discount_percent.'%'}}
                         </div>
                       </div>


                     </div>
                     <div class="product-info">
                       <h3 class="product-name"><a href="{{route('client.showBySlug', $product->slug)}}"
                           title="{{$product->name}}">{{$product->name}} </a></h3>
                       <div class="product-item-cta position-relative">
                         <div class="price-box">
                           <span class="price">{{$product->price_format}} đ</span>
                           <span class="compare-price">{{$product->cost_price_format}} đ</span>
                         </div>
                       </div>


                       <div class="aer-review-result ae-total-">
                       </div>
                       <style>
                         .ae-total-review {
                           display: none;
                         }

                         .ae-total-review-grid {
                           display: inline-block;
                           font-size: 12px;
                           color: #888;
                         }

                         .aer-star-active svg,
                         .aer-star-active path {
                           fill: rgb(255, 193, 7);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-star-deactive svg,
                         .aer-star-deactive path {
                           fill: rgb(204, 204, 204);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-ordered svg,
                         .aer-ordered path {
                           fill: #52B858;
                         }

                         .ae-total-,
                         .ae-total-0 {
                           display: none;
                         }
                       </style>

                     </div>
                   </form>
                 </div>
               </div>
               @endforeach

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   </div>
   <script>
     var swiperproduct2 = new Swiper(".md-product-slider-2", {
       slidesPerView: 5,
       loop: false,
       grabCursor: true,
       slidesPerColumn: 2,
       slidesPerColumnFill: 'row',
       spaceBetween: 10,
       roundLengths: true,
       slideToClickedSlide: false,
       navigation: {
         nextEl: '.section_product_2 .swiper-button-next',
         prevEl: '.section_product_2 .swiper-button-prev',
       },
       autoplay: false,
       breakpoints: {
         300: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         500: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         640: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         768: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         991: {
           slidesPerView: 3,
           spaceBetween: 10
         },
         1200: {
           slidesPerView: 5,
           spaceBetween: 10
         }
       }
     });
   </script>
 </section>

 <section class="section awe-section-8">
   <div class="section_product section_product_2 section_product_tag section">
     <div class="container">
       <div
         class="title_module_main heading-bar e-tabs not-dqtab d-flex justify-content-between align-items-center flex-wrap">
         <h2 class="heading-bar__title ">
           <a class='link' href="ram" title="RAM PC – LAPTOP">
             RAM PC – LAPTOP
           </a>
         </h2>
         <div class="product-box-image-full mt-3">
           <a href="ram">
             <img loading="lazy" class="img-fluid img-responsive center-base"
               src="{{asset('/assets/admin/img/section/section_product_4.webp')}}"
               alt="RAM PC – LAPTOP" />
           </a>
         </div>
         <div class="tagnav--horizontal d-lg-flex align-items-center mt-3">
           <div class="tagnav-wrapper">
             <ul class='mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
               @foreach($RamBrands as $brand)
               <li class="menu-item ega-small tab-link link mr-2 mt-2111">
                 <a href='/{{$brand->slug}}' class="menu-item__link" title="{{$brand->name}}">{{$brand->name}}</a>
               </li>
               @endforeach
               <li class="menu-item ega-small tab-link link d-none d-sm-block">
                 <a href="ram" title="Xem tất cả" class="menu-item__link text-primary">
                   Xem tất cả

                   <svg class="icon">
                     <use xlink:href="#icon-arrow" />
                   </svg> </a>
               </li>
             </ul>
           </div>
           <div class="navigation-arrows">
             <i class="fas fa-chevron-left prev disabled"></i>
             <i class="fas fa-chevron-right next"></i>
           </div>
         </div>

         <!-- dành cho mobile -->
         <ul
           class='tagnav--scroll mt-2 mt-sm-0 tabs tabs-title list-unstyled mb-0 d-flex align-items-center overflow-auto'>
           @foreach($RamBrands as $brand)
           <li class="ega-small tab-link px-3 py-2 link mr-2 mt-2">
             <a href='/{{$brand->slug}}' title="{{$brand->name}}">{{$brand->name}}</a>
           </li>
           @endforeach
           <li class="ega-small tab-link px-3 py-2 link d-none d-sm-block mt-2">
             <a href="ram" title="Xem tất cả" class="text-primary">
               Xem tất cả

               <svg class="icon">
                 <use xlink:href="#icon-arrow" />
               </svg> </a>
           </li>
         </ul>
       </div>
       <div class="clearfix"></div>
       <div class="row">
         <div class="col-md-12 col-lg-12 product-box-content">
           <div class="md-product-slider-2 swiper-container">
             <div class="swiper-wrapper">
               @foreach($productRams as $product)
               <div class="swiper-slide">
                 <div class="item_product_main">

                   <style>
                     .ae-badge {
                       position: absolute;
                       border-radius: 4px;
                       background-color: #e4e4e4;
                       font-size: 12px;
                       max-width: calc(100% - 16px);
                       text-overflow: ellipsis;
                       white-space: nowrap;
                       overflow: hidden;
                       z-index: 1;
                     }

                     .ae-badge.top-left {
                       top: 8px;
                       left: 8px;
                     }

                     .ae-badge.bottom-left {
                       bottom: 8px;
                       left: 8px;
                     }

                     .ae-badge.top-right {
                       top: 8px;
                       right: 8px;
                     }

                     .ae-badge.bottom-right {
                       bottom: 8px;
                       right: 8px;
                     }

                     .ae-badge.percent {
                       background-color: #fff0e9;
                       color: #eb5757;
                       padding: 2px 4px;
                     }

                     .ae-badge.voucher {
                       background: linear-gradient(to right, #ef3006, #c60004);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge.hot {
                       background: linear-gradient(to right, #e91f63, #db2663);
                       color: #f5f5f5;
                       padding: 2px 6px;
                     }

                     .ae-badge__image {
                       width: 20px !important;
                       height: 20px;
                     }
                   </style>

                   <form action="/cart/add" method="post" class="variants product-action" enctype="multipart/form-data"
                     data-tags='[""]'>

                     <div class="product-thumbnail pos-relative">


                       <a class="image_thumb pos-relative embed-responsive embed-responsive-1by1"
                         href="{{route('client.showBySlug', $product->slug)}}"
                         title="{{ $product->name }}">

                         <img class='lazyload product-thumbnail__img product-thumbnail__img--primary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                         <img class='lazyload product-thumbnail__img product-thumbnail__img--secondary' width="480"
                           height="480" style="--image-scale: 1;"
                           src="{{ asset('storage/'.$product->main_img_url) }}"
                           data-src=""
                           alt="{{ $product->name }}">
                       </a>

                       <div class='ae-badge bottom-left image'>
                         <img class="ae-badge__image"
                           src=""
                           alt="" />
                       </div>


                       <div class="tagdacbiet_sale sale-flash">
                         <div class="font16">
                           {{ $product->discount_percent.'%'}}
                         </div>
                       </div>


                     </div>
                     <div class="product-info">
                       <h3 class="product-name"><a href="{{route('client.showBySlug', $product->slug)}}"
                           title="{{$product->name}}">{{$product->name}} </a></h3>
                       <div class="product-item-cta position-relative">
                         <div class="price-box">
                           <span class="price">{{$product->price_format}} đ</span>
                           <span class="compare-price">{{$product->cost_price_format}} đ</span>
                         </div>
                       </div>


                       <div class="aer-review-result ae-total-">
                       </div>
                       <style>
                         .ae-total-review {
                           display: none;
                         }

                         .ae-total-review-grid {
                           display: inline-block;
                           font-size: 12px;
                           color: #888;
                         }

                         .aer-star-active svg,
                         .aer-star-active path {
                           fill: rgb(255, 193, 7);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-star-deactive svg,
                         .aer-star-deactive path {
                           fill: rgb(204, 204, 204);
                           width: 15px;
                           height: 15px;
                         }

                         .aer-ordered svg,
                         .aer-ordered path {
                           fill: #52B858;
                         }

                         .ae-total-,
                         .ae-total-0 {
                           display: none;
                         }
                       </style>

                     </div>
                   </form>
                 </div>
               </div>
               @endforeach

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   </div>
   <script>
     var swiperproduct2 = new Swiper(".md-product-slider-2", {
       slidesPerView: 5,
       loop: false,
       grabCursor: true,
       slidesPerColumn: 2,
       slidesPerColumnFill: 'row',
       spaceBetween: 10,
       roundLengths: true,
       slideToClickedSlide: false,
       navigation: {
         nextEl: '.section_product_2 .swiper-button-next',
         prevEl: '.section_product_2 .swiper-button-prev',
       },
       autoplay: false,
       breakpoints: {
         300: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         500: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         640: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         768: {
           slidesPerView: 2,
           spaceBetween: 10
         },
         991: {
           slidesPerView: 3,
           spaceBetween: 10
         },
         1200: {
           slidesPerView: 5,
           spaceBetween: 10
         }
       }
     });
   </script>
 </section>

 <section class="section awe-section-12">
   <link href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/bpr-products-module.css?1762606819649"
     rel="stylesheet" type="text/css" media="all" />
   <div class="sapo-product-reviews-module"></div>
 </section>
 <section class="section awe-section-13">
   <div class="section_banner_adv">
     <div class="container">
     </div>
   </div>
 </section>
 @include('layouts.partials.client.news')


 <script>
   function tagNav() {
     return {
       wrapper: $('.tagnav--horizontal .tagnav-wrapper'),
       navigation: $('.tagnav--horizontal .tagnav-wrapper > ul'),
       item: $('.tagnav--horizontal .tagnav-wrapper > ul .menu-item '),
       arrows: $('.navigation-arrows'),
       scrollStep: 0,
       totalStep: 0,
       transform: function() {
         return `translateY(-${this.scrollStep * 100}%)`
       },
       onCalcNavOverView: function($this) {
         let itemHeight = $this.find(".tagnav-wrapper > ul .menu-item").eq(0).outerHeight(),
           navHeight = $this.find(".tagnav-wrapper > ul").height()
         return Math.ceil(navHeight / itemHeight)
       },
       handleArrowClick: function(e, $this) {
         this.totalStep = this.onCalcNavOverView($this)
         this.scrollStep = $(e.currentTarget).hasClass('prev') ? this.scrollStep - 1 : this.scrollStep + 1
         this.handleScroll($this)
       },
       handleScroll: function($this) {
         $this.find(".navigation-arrows i").removeClass('disabled')
         if (this.totalStep - 1 <= this.scrollStep) {
           $this.find(".navigation-arrows").find('.next').addClass('disabled')
           this.scrollStep = this.totalStep - 1
         }
         if (this.scrollStep <= 0) {
           $this.find(".navigation-arrows").find('.prev').addClass('disabled')
           this.scrollStep = 0
         }
         $this.find(".tagnav-wrapper > ul .menu-item").css('transform', this.transform())
       },
       init: function($this) {
         this.totalStep = this.onCalcNavOverView($this)
         if (this.totalStep > 1) {
           $this.find(".tagnav-wrapper").addClass('overflow')
         }
         this.handleScroll($this)
         $this.find(".navigation-arrows i").click((e) => this.handleArrowClick(e, $this))
       }
     }
   }

   $(document).ready(function() {
     if (window.matchMedia('(min-width: 992px)').matches) {
       $(".section_product_tag .tagnav--horizontal").each(function() {
         tagNav().init($(this));
         $(window).on('resize', () => tagNav().init($(this)))
       })
     }
   })
 </script>



 <section class="section_service_end">
   <div class="container">
     <div class="service-slider service_content swiper-container">
       <div class="swiper-wrapper">




         <div class="swiper-slide">
           <div class="col-item-srv">
             <div class="service_item_ed">
               <span class="iconx">
                 <img alt="Giao hàng Siêu Tốc 2 - 4H"
                   src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/service_1.png?1762606819649" />
               </span>
               <div class="content_srv">
                 <span class="title_service">Giao hàng Siêu Tốc 2 - 4H</span>
                 <span class="sum_service">Giao hàng trong nội thành HCM & Hà Nội nhanh chóng từ 2 - 4H.</span>
               </div>
             </div>
           </div>
         </div>




         <div class="swiper-slide">
           <div class="col-item-srv">
             <div class="service_item_ed">
               <span class="iconx">
                 <img alt="7 ngày đổi trả"
                   src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/service_2.png?1762606819649" />
               </span>
               <div class="content_srv">
                 <span class="title_service">7 ngày đổi trả</span>
                 <span class="sum_service">Yên tâm mua sắm với chính sách đổi trả trong vòng 7 ngày</span>
               </div>
             </div>
           </div>
         </div>




         <div class="swiper-slide">
           <div class="col-item-srv">
             <div class="service_item_ed">
               <span class="iconx">
                 <img alt="100% chính hãng"
                   src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/service_3.png?1762606819649" />
               </span>
               <div class="content_srv">
                 <span class="title_service">100% chính hãng</span>
                 <span class="sum_service">Cam kết chất lượng sản phẩm chính hãng 100%</span>
               </div>
             </div>
           </div>
         </div>




         <div class="swiper-slide">
           <div class="col-item-srv">
             <div class="service_item_ed">
               <span class="iconx">
                 <img alt="Thanh toán dễ dàng"
                   src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/service_4.png?1762606819649" />
               </span>
               <div class="content_srv">
                 <span class="title_service">Thanh toán dễ dàng</span>
                 <span class="sum_service">Đa dạng phương thức như COD, chuyển khoản, quẹt thẻ trả góp</span>
               </div>
             </div>
           </div>
         </div>

       </div>
     </div>
   </div>
 </section>
 <script>
   var swiperservice = new Swiper(".service-slider", {
     spaceBetween: 15,
     slidesPerView: 4,
     freeMode: true,
     watchSlidesProgress: false,
     breakpoints: {
       280: {
         slidesPerView: 1.5,
         spaceBetween: 15
       },
       640: {
         slidesPerView: 1.5,
         spaceBetween: 15
       },
       768: {
         slidesPerView: 2,
         spaceBetween: 15
       },
       992: {
         slidesPerView: 3,
         spaceBetween: 15
       },
       1024: {
         slidesPerView: 4,
         spaceBetween: 15
       }
     }

   });
 </script>
 @endsection