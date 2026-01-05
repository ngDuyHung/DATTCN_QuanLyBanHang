  @extends('home')
  @section('content')
  <aside class="bottom">

      <div class="container">
          <!-- <a class="left" href="https://memoryzone.com.vn/samsung-official-store" target="_blank">
                <img src=""
                    alt="Samsung Memory Storage">
            </a>
            <a class="right" href="https://go.mmz.vn/SanDisk-Flagship-Store" target="_blank">
                <img src=""
                    alt="Sandisk Flagship Store">
            </a> -->
      </div>

  </aside>
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


                      <li><a class="changeurl link" href="/{{$Product->category->slug}}"><span>{{$Product->category->name}}</span></a><span
                              class="mr_lr">&nbsp;/&nbsp;</span></li>

                      <li><a class="changeurl link" href="/{{$Product->category->slug}}-{{$Product->brand->slug}}"><span>{{$Product->brand->name}}</span></a><span
                              class="mr_lr">&nbsp;/&nbsp;</span></li>
                      <li class="breadcrumb-last"><span>
                              <a class="changeurl link" href="/{{$Product->slug}}"><span> {{$Product->sku}}</span></a>
                      </li>





                  </ul>
              </div>
          </div>
      </div>
  </section>
  <link rel="preload" as='style' type="text/css"
      href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/lightbox.css?1762621286385">
  <link href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/lightbox.css?1762621286385" rel="stylesheet"
      type="text/css" media="all" />
  <link rel="preload" as="script"
      href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/lightgallery.js?1762621286385">
  <script src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/lightgallery.js?1762621286385"
      type="text/javascript"></script>


  <!-- product -->
  <section class="product details-main" itemscope itemtype="https://schema.org/Product">
      <!-- Start Product Schema -->

      <section class='section mt-0 mb-lg-4 mb-3 mb-sm-0'>
          <div class="container">
              <div class="section wrap-padding-15 wp_product_main m-0">
                  <div class="details-product">
                      <div class="row m-sm-0">
                          <div class="product-detail-left product-images bg-white py-3 col-12 col-lg-5 col-xl-5">
                              <div class="position-relative pb-3 pt-0col_large_default large-image">



                                  <div class='ae-badge bottom-left image'>
                                      <img class="ae-badge__image"
                                          src="https://bizweb.dktcdn.net/100/329/122/themes/1038963/assets/ae-image-1757320392.png?1757320393088"
                                          alt="" />
                                  </div>



                                  <div id="gallery_1" class="slider-for">




                                      <!--  -->

                                      @foreach($Product->images as $image)

                                      <div class="item gallery-item"
                                          data-src="{{ asset('storage/'.$image->image_url) }}">
                                          <a class="d-block  pos-relative embed-responsive embed-responsive-1by1"
                                              href="javascript:void(0);"
                                              title="{{$Product->name}}"
                                              data-image=" {{ asset('storage/'.$image->image_url) }}"
                                              data-zoom-image="{{ asset('storage/'.$image->image_url) }}">

                                              <img loading="lazy" class=" img-fluid" style="--image-scale: 1;"
                                                  data-img="{{ asset('storage/'.$image->image_url) }}"
                                                  src="{{ asset('storage/'.$image->image_url) }}"
                                                  alt="{{$Product->name}}"
                                                  width="600" height="600"
                                                  data-src="{{ asset('storage/'.$image->image_url) }}">
                                          </a>
                                      </div>
                                      @endforeach


                                  </div>

                                  <div class="hidden">


                                      @foreach($Product->images as $image)


                                      <div class="item ">
                                          <a class="d-block  pos-relative embed-responsive embed-responsive-1by1"
                                              href="{{ asset('storage/'.$image->image_url) }}"
                                              title="{{ $Product->name }}"
                                              data-image="{{ asset('storage/'.$image->image_url) }}"
                                              data-zoom-image="{{ asset('storage/'.$image->image_url) }}">
                                          </a>
                                      </div>

                                      @endforeach





                                  </div>
                              </div>

                              <div class="section slickthumb_relative_product_1">
                                  <div id="gallery_02" class=" slider-nav slickproduct thumb_product_details">





                                      @foreach($Product->images as $image)


                                      <div class="item gallery_02_thumb">
                                          <a href="javascript:void(0)"
                                              data-zoom-image="{{ asset('storage/'.$image->image_url) }}">
                                              <img class=" img-fluid"
                                                  data-img="{{ asset('storage/'.$image->image_url) }}"
                                                  src="{{ asset('storage/'.$image->image_url) }}"
                                                  alt="{{ $Product->name }}"
                                                  loading="lazy">
                                          </a>
                                      </div>
                                      @endforeach



                                  </div>
                              </div>





                              <div class="product-summary product_description margin-bottom-20 summary-desktop">
                                  <div class="rte description  rte-summary">
                                      <ul style="margin: 0;">
                                          @foreach($Product->attributes as $attribute)
                                          <li>{{$attribute->attr_key}}: {{$attribute->attr_value}}</li>
                                          @endforeach
                                      </ul>

                                  </div>
                              </div>
                              <div class="sapo-buyxgety-module-detail-v2"></div>

                          </div>
                          <div class="col-xs-12 col-lg-7 col-xl-7 details-pro bg-white py-3 mt-3 mt-lg-0 px-3">
                              <div class="">
                                  <div class="">
                                      <h1 class="title-product">{{$Product->name}}</h1>


                                      <div class="aer-review-result ae-total-">


                                          <span class="aer-star-deactive"><svg height="20pt"
                                                  viewBox="0 -10 511.98685 511" width="20pt"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path
                                                      d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
                                                      fill="#ccc" />
                                              </svg></span>


                                          <span class="aer-star-deactive"><svg height="20pt"
                                                  viewBox="0 -10 511.98685 511" width="20pt"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path
                                                      d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
                                                      fill="#ccc" />
                                              </svg></span>


                                          <span class="aer-star-deactive"><svg height="20pt"
                                                  viewBox="0 -10 511.98685 511" width="20pt"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path
                                                      d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
                                                      fill="#ccc" />
                                              </svg></span>


                                          <span class="aer-star-deactive"><svg height="20pt"
                                                  viewBox="0 -10 511.98685 511" width="20pt"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path
                                                      d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
                                                      fill="#ccc" />
                                              </svg></span>


                                          <span class="aer-star-deactive"><svg height="20pt"
                                                  viewBox="0 -10 511.98685 511" width="20pt"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                  <path
                                                      d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
                                                      fill="#ccc" />
                                              </svg></span>
                                          <span class="ae-total-review"> là người đánh giá đầu tiên
                                          </span>
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
                                      <form enctype="multipart/form-data" id="add-to-cart-form" action="{{ route('cart.store') }}"
                                          method="post" class="form_background  margin-bottom-0">
                                          @csrf

                                          <input type="hidden" value="{{$Product->product_id}}" class="d-none" name="product_id" />
                                          <link
                                              href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/ae-flashsale.css?1762621286385"
                                              rel="stylesheet" type="text/css" media="all" />
                                          <script
                                              src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/ae-flashsale.js?1762621286385"
                                              type="text/javascript"></script>

                                          <script>
                                              var aeFlashsaleVariants = {};
                                              var aeFlashsaleQuantityVariants = {};

                                              var aeFlashsales = {};
                                          </script>

                                          <style>
                                              .btn_duyet_dt:hover {
                                                  filter: brightness(1.2);
                                              }

                                              .ae-flashsale {
                                                  --color-foreground: #ffffff;
                                                  --countdown-background: #000000;
                                              }
                                          </style>

                                          <div class="group-status">
                                              <span class="first_status mr-2">
                                                  Thương hiệu:
                                                  <span class="status_name">
                                                      <a href='/{{$Product->category->slug}}-{{$Product->brand->slug}}'
                                                          target="_blank" class="text-primary" title="{{$Product->brand->name}}">
                                                          {{$Product->brand->name}}
                                                      </a>
                                                  </span>
                                              </span>




                                              <span class="first_status product_sku mr-2">
                                                  SKU:
                                                  <span class="status_name product-sku" itemprop="sku" content="{{$Product->sku}}">

                                                      {{$Product->sku}}

                                                  </span>
                                              </span>


                                              <!-- <a href=''
                                                  class='js-compare-product-add d-inline-block text-success mt-2 pd-compare-product-add'
                                                  data-id="54117557" title='So sánh'>
                                                  <i class="fas fa-random mr-1"></i> <span>So sánh</span>
                                              </a> -->
                                          </div>

                                          <!-- Start Aeflashsale -->
                                          <div class="ae-flashsale disabled" style="--color-background: ">
                                              <img id="ae-flashsale-banner" class="ae-flashsale-banner hidden" alt=""
                                                  src="" width="1200" />
                                              <div class="ae-flashsale-content">
                                                  <div class="flashsale__header">
                                                      <div class="flashsale__title text-center text-md-left ">
                                                          <h5></h5>
                                                      </div>
                                                      <div class="flashsale__countdown-wrapper">

                                                      </div>
                                                  </div>
                                                  <div class="flashsale__product">
                                                      <!-- Start The old product content -->
                                                      <div class="price-box">





                                                          <span class="special-price"><span
                                                                  class="price product-price">{{ $Product->price_format }} ₫</span>
                                                          </span> <!-- Giá Khuyến mại -->
                                                          <span class="old-price">
                                                              <del class=" product-price-old sale">{{ $Product->cost_price_format }} ₫</del>
                                                          </span> <!-- Giá gốc -->

                                                          <div class="label_product">

                                                              {{ $Product->discount_percent }}%
                                                          </div>



                                                      </div>

                                                      <div class="form-product pt-sm-2">




                                                          <div class="thongtinkhuyenmai">
                                                              {!! $Product->sale_description !!}
                                                          </div>
                                                          <script defer>
                                                              const kmEl = document.querySelector('.thongtinkhuyenmai');
                                                              if (kmEl && kmEl.getElementsByTagName('*').length > 0) {
                                                                  kmEl.style.display = 'block';
                                                              }
                                                          </script>






                                                          <div class="variant_lineup_series">


                                                          </div>
                                                      </div>

                                                      <div class="variant_lineup_element">
                                                          <div class="a-row">
                                                              <label>Cấu hình: </label>
                                                          </div>
                                                          <div class="element_list">
                                                              @foreach($relatedProducts as $relatedProduct)
                                                              <div class="element_item @if($relatedProduct->product_id == $Product->product_id) active @endif">
                                                                  <a
                                                                      href="/{{$relatedProduct->slug}}">
                                                                      <div class="name">

                                                                          {{$relatedProduct->total_attributes}}
                                                                      </div>
                                                                      <div class="price">
                                                                          {{$relatedProduct->price_format}} ₫
                                                                      </div>
                                                                  </a>
                                                              </div>
                                                              @endforeach


                                                          </div>
                                                      </div>


                                                      <div class="box-variant clearfix d-none">

                                                          <input type="hidden" name="variantId"
                                                              value="159871631" />

                                                      </div>

                                                      <div class="form_button_details w-100">
                                                          <div class="form_product_content type1 ">
                                                              <div class="soluong soluong_type_1 show">
                                                                  <label>Số lượng:</label>
                                                                  <div
                                                                      class="custom input_number_product custom-btn-number ">
                                                                      <button
                                                                          class="btn btn_num num_1 button button_qty"
                                                                          onClick="var result = document.getElementsByClassName('pd-qtym')[0];var stick_result = document.getElementsByClassName('pd-qtym')[1]; var qtypro = result.value; if(!isNaN( qtypro ) && qtypro > 1){result.value--;stick_result.value--;}else{return false;}"
                                                                          type="button">
                                                                          <svg class="icon">
                                                                              <use xlink:href="#icon-minus" />
                                                                          </svg></button>
                                                                      <input type="text" id="qtym" name="quantity"
                                                                          value="1" maxlength="3"
                                                                          class="form-control prd_quantity pd-qtym"
                                                                          onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                                                                      <button
                                                                          class="btn btn_num num_2 button button_qty"
                                                                          onClick="var result = document.getElementsByClassName('pd-qtym')[0];var stick_result = document.getElementsByClassName('pd-qtym')[1]; var qtypro = result.value; if( !isNaN( qtypro )) result.value++;stick_result.value++;return false;"
                                                                          type="button">
                                                                          <svg class="icon">
                                                                              <use xlink:href="#icon-plus" />
                                                                          </svg> </button>
                                                                  </div>
                                                              </div>
                                                              <div class="button_actions">


                                                                  <div class="action-new">

                                                                      <button type="submit"
                                                                          class="btn btn_base btn-checkout ">
                                                                          <span>MUA NGAY</span><span>Giao hàng tận
                                                                              nơi hoặc nhận tại cửa hàng</span>
                                                                      </button>
                                                                      <button type="button" data-product="{{ $Product->product_id }}"
                                                                          class="btn btn_base add_to_cart ">
                                                                          <svg viewBox="0 0 512.003 512.003"
                                                                              enable-background="new 0 0 512.003 512.003">
                                                                              <circle cx="226" cy="436.002"
                                                                                  r="45" />
                                                                              <circle cx="377" cy="436.002"
                                                                                  r="45" />
                                                                              <path
                                                                                  d="m15 61.002h62.553l72.418 253.513-5.68 11.36c-14.956 29.88 6.755 65.127 40.254 65.127h252.455c8.291 0 15-6.709 15-15s-6.709-15-15-15h-252.455c-11.139 0-18.419-11.729-13.418-21.709l4.146-8.291h261.727c6.694 0 12.583-4.438 14.429-10.884l60-210c1.289-4.526.381-9.39-2.446-13.154-2.842-3.75-7.28-5.962-11.982-5.962h-379.678l-14.033-49.117c-1.846-6.445-7.734-10.884-14.429-10.884h-73.861c-8.291 0-15 6.709-15 15s6.709 15.001 15 15.001z" />
                                                                          </svg> THÊM VÀO GIỎ
                                                                      </button>
                                                                  </div>

                                                                  <div
                                                                      style='display: flex; flex-wrap: wrap; width: 100%'>
                                                                      <button type="button" data-product="{{ $Product->product_id }}" class="d-none btn btn_add_cart btn-cart add_to_cart
											   ">
                                                                          THÊM VÀO GIỎ
                                                                      </button>

                                                                  </div>
                                                              </div>

                                                              <!-- PPrice: product.price -->



                                                              <script>
                                                                  var price = 12300000;
                                                              </script>
                                                              <script id="product-detail"
                                                                  src="https://assets.fundiin.vn/merchant/product-detail.js"></script>
                                                              <div id="script-product-detail"></div>



                                                              <p class='product-hotline mb-0 text-center'>
                                                                  Gọi đặt mua <a href="tel:098 7667 849">098 7667 849</a> (8:00 - 20:00)
                                                              </p>

                                                          </div>
                                                      </div>
                                                  </div><!-- End The old product content -->
                                              </div>
                                          </div>

                                  </div><!-- End Aeflashsale -->





                                  <style>
                                      .button_actions .btn.buynow span:first-child {
                                          position: relative;
                                          font-size: 16px;
                                      }
                                  </style>
                                  </form>
                                  <div
                                      class="product-summary product_description margin-bottom-20 summary-mobile">
                                      <div class="rte description  rte-summary">

                                          <ul style="margin: 0;">
                                              @foreach($Product->attributes as $attribute)
                                              <li>{{$attribute->attr_key}}: {{$attribute->attr_value}}</li>
                                              @endforeach
                                          </ul>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          </div>
      </section>

      <section class="section mt-0 mb-lg-4 mb-3 mb-sm-0 product_poli_wrap">
          <div class="container">
              <div class="product_poli swiper-container m-0">
                  <div class="swiper-wrapper">
                      <div class="swiper-slide">
                          <div class="item d-flex align-items-center pb-2 pt-2 pl-2 pr-2 pl-sm-0 pr-sm-0">
                              <div class="mr-2 mr-sm-3">
                                  <img src="//bizweb.dktcdn.net/thumb/icon/100/329/122/themes/1038963/assets/img_poli_1.png?1762621286385"
                                      alt="Giao Siêu Tốc 2 - 4H" decoding="async">
                              </div>
                              <div class="media-body">
                                  Giao Siêu Tốc 2 - 4H
                              </div>
                          </div>
                      </div>
                      <div class="swiper-slide">
                          <div class="item d-flex align-items-center pb-2 pt-2 pl-2 pr-2 pl-sm-0 pr-sm-0">
                              <div class="mr-2 mr-sm-3">
                                  <img src="//bizweb.dktcdn.net/thumb/icon/100/329/122/themes/1038963/assets/img_poli_2.png?1762621286385"
                                      alt="7 ngày đổi trả" decoding="async">
                              </div>
                              <div class="media-body">
                                  7 ngày đổi trả
                              </div>
                          </div>
                      </div>
                      <div class="swiper-slide">
                          <div class="item d-flex align-items-center pb-2 pt-2 pl-2 pr-2 pl-sm-0 pr-sm-0">
                              <div class="mr-2 mr-sm-3">
                                  <img src="//bizweb.dktcdn.net/thumb/icon/100/329/122/themes/1038963/assets/img_poli_3.png?1762621286385"
                                      alt="100% chính hãng" decoding="async">
                              </div>
                              <div class="media-body">
                                  100% chính hãng
                              </div>
                          </div>
                      </div>
                      <div class="swiper-slide">
                          <div class="item d-flex align-items-center pb-2 pt-2 pl-2 pr-2 pl-sm-0 pr-sm-0">
                              <div class="mr-2 mr-sm-3">
                                  <img src="//bizweb.dktcdn.net/thumb/icon/100/329/122/themes/1038963/assets/img_poli_4.png?1762621286385"
                                      alt="Đa dạng thanh toán" decoding="async">
                              </div>
                              <div class="media-body">
                                  Đa dạng thanh toán
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>



      <section class="section sec_tab ">
          <div class="container">
              <div class="row mr-sm-0 ml-sm-0">
                  <div class="mb-3 mb-sm-0 col-12 col-xl-8 product-content js-content-wrapper card border-0">
                      <div class="title_module_main heading-bar d-flex justify-content-between align-items-center">
                          <h2 class="heading-bar__title ">
                              <a class="product_content">
                                  Đặc điểm nổi bật của {{$Product->name}}
                              </a>
                          </h2>
                      </div>
                      <div id="ega-uti-editable-content" data-platform='sapo' data-id="54117557"
                          class="rte js-product-getcontent product_getcontent pos-relative"
                          style="--maxHeightContent: 200px">
                          <div id="content" class='content js-content'>
                              {!! $Product->description !!}
                          </div>
                      </div>

                      <div class="js-seemore ega-pro__seemore text-center pos-relative mt-3">
                          <a href="javascript:void(0)" title="Xem thêm"
                              class="btn btn-icon w-100 justify-content-center btn-secondary">
                              <i class="fas fa-plus-circle"></i> Xem thêm
                          </a>
                      </div>
                  </div>
                  <div class="col-12 col-xl-4 product_sidebar pl-0 pl-sm-3 pr-0">
                      <div class="product-specifications card border-0">
                          <div
                              class="title_module_main heading-bar d-flex justify-content-between align-items-center">
                              <h2 class="heading-bar__title ">
                                  Thông số kỹ thuật </h2>
                          </div>
                          <div class='product_getcontent' style="--maxHeightContent: 200px">



















                              <table class="specTable aecom-table">
                                  <thead>
                                      <tr>
                                          <th>Tên thông số</th>
                                          <th>Giá trị</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($Product->attributes as $attribute)
                                      <tr>
                                          <td class='specTopic'><strong>{{ $attribute->attr_key }}</strong></td>
                                          <td class='specDetail'><span>{{ $attribute->attr_value }}</span></td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>



                          </div>
                          <div class="ega-pro__seemore text-center pos-relative mt-3 js-show-specifications">
                              <a href="javascript:void(0)" title="Xem thêm"
                                  class="btn btn-icon w-100 justify-content-center btn-secondary" data-toggle="modal"
                                  data-target="#specification-modal">
                                  <i class="fas fa-plus-circle"></i> Xem thêm
                              </a>
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="specification-modal" tabindex="-1"
                              aria-labelledby="specification-modal-label" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-scrollable">
                                  <div class="modal-content">
                                      <div class="modal-header border-0 pb-0">
                                          <h5 class="modal-title" id="specification-modal-label">Thông số kỹ thuật
                                          </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">



















                                          <table class="specTable aecom-table">
                                              <thead>
                                                  <tr>
                                                      <th>Tên thông số</th>
                                                      <th>Giá trị</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach($Product->attributes as $attribute)
                                                  <tr>
                                                      <td class='specTopic'><strong>{{ $attribute->attr_key }}</strong></td>
                                                      <td class='specDetail'><span>{{ $attribute->attr_value }}</span></td>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>



                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </section>

    


      <section class="section d-xl-block d-none">
          <div id="ega-sticky-addcart" class="section ">
              <div class="container">
                  <div class="card">
                      <div class="productAnchor_horizonalNavs">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="productAnchor_horizonalNav">
                                      <div class="product_info_image hidden-xs">
                                          <img loading="lazy" class="pict image"
                                              src="{{ asset('storage/'.$Product->main_img_url) }}"
                                              alt="{{$Product->name}}">
                                      </div>
                                      <div class="product_info_content details-pro hidden-xs ">
                                          <span class="product_info_name"
                                              title="{{$Product->name}}">{{$Product->name}}</span>

                                          <div class="price-box">

















                                              <span class="special-price"><span class="price product-price">{{$Product->price_format}}
                                                      ₫</span>
                                              </span> <!-- Giá Khuyến mại -->
                                              <span class="old-price">
                                                  <del class=" product-price-old sale">{{$Product->cost_price_format}} ₫</del>
                                              </span> <!-- Giá gốc -->

                                              <div class="label_product">

                                                  {{$Product->discount_percent}}%
                                              </div>



                                          </div>
                                      </div>
                                      <div class="product_info_buttons">
                                          <div class="box-variant   ">
                                          </div>
                                          <div class="soluong soluong_type_1 show">
                                              <label>Số lượng:</label>
                                              <div class="custom input_number_product custom-btn-number ">
                                                  <button class="btn btn_num num_1 button button_qty"
                                                      onClick="var result = document.getElementsByClassName('pd-qtym')[0];var stick_result = document.getElementsByClassName('pd-qtym')[1]; var qtypro = result.value; if( !isNaN( qtypro ) && qtypro > 1 ){result.value--;stick_result.value--;}else{return false;}"
                                                      type="button">
                                                      <svg class="icon">
                                                          <use xlink:href="#icon-minus" />
                                                      </svg> </button>
                                                  <input type="text" id="sticky_qtym" name="quantity" value="1"
                                                      maxlength="3" class="form-control prd_quantity pd-qtym"
                                                      onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                                                  <button class="btn btn_num num_2 button button_qty"
                                                      onClick="var result = document.getElementsByClassName('pd-qtym')[0];var stick_result = document.getElementsByClassName('pd-qtym')[1]; var qtypro = result.value; if( !isNaN( qtypro )) result.value++;stick_result.value++;return false;"
                                                      type="button">
                                                      <svg class="icon">
                                                          <use xlink:href="#icon-plus" />
                                                      </svg> </button>
                                              </div>
                                          </div>

                                          <div class="form-product">
                                              <div class="button_actions " style="grid-template-columns: 1fr">
                                                  <button type="button"
                                                      class="btn btn_base btn_add_cart btn-cart add_to_cart mt-0  " data-product="{{ $Product->product_id }}">
                                                      <span class="text_1">Thêm vào giỏ </span>
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </section>



  <!-- <section class='section container' id='equalprice-products'>
      <div class='row ml-sm-0 mr-sm-0'>
          <div class='col-12 pl-0 pr-0'>


              <div class='card border-0 p-3'>
                  <div class="title_module section heading-bar d-flex justify-content-between align-items-center">
                      <h2 class="bf_flower heading-bar__title">
                          SẢN PHẨM CÙNG PHÂN KHÚC GIÁ
                      </h2>
                  </div>
                  <div class="">
                      <div
                          class="section_prd_feature section products slick-product product_related js-equal-price row m-0">
                      </div>
                  </div>
              </div>

              <script>
                  function equalPriceProductSlide() {
                      if (window.matchMedia('(min-width: 768px)').matches && $('.js-equal-price .item').length >= 6) {
                          $('.js-equal-price').slick({
                              autoplay: false,
                              autoplaySpeed: 6000,
                              dots: false,
                              arrows: true,
                              infinite: false,
                              speed: 300,
                              slidesToShow: 5,
                              slidesToScroll: 5,
                              centerMode: false,
                              responsive: [{
                                      breakpoint: 1200,
                                      settings: {
                                          slidesToShow: 5,
                                          slidesToScroll: 5
                                      }
                                  },
                                  {
                                      breakpoint: 991,
                                      settings: {
                                          slidesToShow: 4,
                                          slidesToScroll: 1
                                      }
                                  },
                                  {
                                      breakpoint: 767,
                                      settings: {
                                          slidesToShow: 2,
                                          slidesToScroll: 2
                                      }
                                  }
                              ]
                          });
                      }
                  }

                  function initEqualPriceProducts() {
                      const id = "54117557"
                      $.get(`/search?q= NOT id:${id} AND product_type:Laptop AND price_min:(<=13530000 AND >=11070000)&view=equal_price`).then(response => {
                          if (response && response.length) {
                              $('.js-equal-price').append(response)
                              equalPriceProductSlide();
                          } else {
                              $('#equalprice-products').hide();
                          }
                      })
                  }
                  initEqualPriceProducts()
              </script>
          </div>
      </div>
  </section> -->

  <!-- <section class="section container" id="recent-view-coll">
      <div class='row ml-sm-0 mr-sm-0'>
          <div class='col-12 pl-0 pr-0'>
              <div class='card border-0 p-3'>
                  <div class="title_module section heading-bar d-flex justify-content-between align-items-center">
                      <h2 class="bf_flower heading-bar__title">
                          SẢN PHẨM ĐÃ XEM
                      </h2>
                  </div>
                  <link rel="preload" as='style' type="text/css"
                      href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/recentview.css?1762621286385">
                  <link rel="stylesheet"
                      href="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/recentview.css?1762621286385">

                  <div class="recent-view-list m-0 row"></div>

                  <script>
                      function getRecentView(query) {
                          try {
                              let storage = JSON.parse(localStorage.getItem('recentProduct')) || []
                              if (storage && storage.length && Array.isArray(storage)) {

                                  storage = storage.filter(item => item !== 'laptop-acer-aspire-lite-al15-41p-r3u5-nx-j53sv-001')
                                  let filter = storage.join(' OR ')
                                  $.ajax({
                                      url: `/search?q=alias:${filter}&view=recent`,
                                      success: function(data) {
                                          if (data && data.length) {
                                              let wrapper = $(query).find('.recent-view-list');
                                              wrapper.html(data);
                                              if (window.BPR && window.BPR.loadBadges) {
                                                  window.BPR.initDomEls(), window.BPR.loadBadges()
                                              }
                                              window.matchMedia('(min-width: 768px)').matches && wrapper.find('.item_product_main').length >= 5 && $(`${query} .recent-view-list`).slick({
                                                  autoplay: false,
                                                  autoplaySpeed: 6000,
                                                  dots: false,
                                                  arrows: true,
                                                  infinite: false,
                                                  speed: 300,
                                                  slidesToShow: 5,
                                                  slidesToScroll: 5,
                                                  centerMode: false,
                                                  responsive: [{
                                                          breakpoint: 1200,
                                                          settings: {
                                                              slidesToShow: 5,
                                                              slidesToScroll: 5
                                                          }
                                                      },
                                                      {
                                                          breakpoint: 991,
                                                          settings: {
                                                              slidesToShow: 4,
                                                              slidesToScroll: 1
                                                          }
                                                      },
                                                      {
                                                          breakpoint: 767,
                                                          settings: {
                                                              slidesToShow: 2,
                                                              slidesToScroll: 2
                                                          }
                                                      }
                                                  ]
                                              });

                                          } else {
                                              $(query).remove()
                                          }
                                      }
                                  })
                              } else {
                                  $(query).remove()
                              }
                          } catch (e) {
                              console.log(e)
                              $(query).remove()
                          }
                      }
                      $(document).ready(() => {
                          getRecentView('#recent-view-coll')
                      })
                  </script>
              </div>
          </div>
      </div>
  </section> -->
  <!-- end product -->





  <script>
      // Đồng bộ tất cả input quantity khi thay đổi
      $(document).on('input change', '.pd-qtym', function() {
          let newValue = $(this).val();
          $('.pd-qtym').val(newValue);
      });

      // Xử lý sự kiện click nút thêm vào giỏ
      $(document).on("click", ".add_to_cart", function() {
          let productId = $(this).data("product");

          // Lấy giá trị từ input đầu tiên
          let quantity = parseInt($('.pd-qtym').first().val()) || 1;

          $.ajax({
              url: "{{ route('cart.storeAjax') }}",
              type: "POST",
              data: {
                  product_id: productId,
                  quantity: quantity,
                  _token: "{{ csrf_token() }}"
              },
              success: function(res) {
                  console.log(res);
                  $(".count_item").text(res.cart_count);
                  // Reset quantity về 1 sau khi thêm thành công
                  $('.pd-qtym').val(1);

                  // Hiển thị thông báo (nếu có modal)
                  if ($("#addedToCartModal").length) {
                      // $("#addedToCartModal .product-title").text(res.product.name);
                      // $("#addedToCartModal img").attr("src", res.product.image);
                        $("#cart-popup-count").text(res.cart_count);
                      $("#addedToCartModal").modal("show");
                  } else {
                      alert('Đã thêm sản phẩm vào giỏ hàng!');
                  }
              },
              error: function(err) {
                  console.log(err.responseText);
                  alert('Có lỗi xảy ra. Vui lòng thử lại!');
              }
          });
      });
  </script>

  <div class="modal fade" id="addedToCartModal" tabindex="-1" role="dialog" aria-labelledby="addedToCartLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content border-0 shadow-lg">

              <div class="modal-header border-bottom-0 pb-0">
                  <h5 class="modal-title text-success d-flex align-items-center" id="addedToCartLabel">
                      <span class="mr-2">
                          <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M8.00006 15.3803C12.0761 15.3803 15.3804 12.076 15.3804 7.99995C15.3804 3.92391 12.0761 0.619629 8.00006 0.619629C3.92403 0.619629 0.619751 3.92391 0.619751 7.99995C0.619751 12.076 3.92403 15.3803 8.00006 15.3803Z" fill="#28a745"></path>
                              <path d="M8 16C3.58916 16 0 12.4115 0 8C0 3.58916 3.58916 0 8 0C12.4115 0 16 3.58916 16 8C16 12.4115 12.4115 16 8 16ZM8 1.23934C4.27203 1.23934 1.23934 4.27203 1.23934 8C1.23934 11.728 4.27203 14.7607 8 14.7607C11.728 14.7607 14.7607 11.7273 14.7607 8C14.7607 4.27203 11.728 1.23934 8 1.23934Z" fill="#28a745"></path>
                              <path d="M7.03336 10.9434C6.8673 10.9434 6.70865 10.8771 6.59152 10.7582L4.30493 8.43438C4.06511 8.19023 4.06821 7.7986 4.31236 7.55816C4.55652 7.31898 4.94877 7.32145 5.18858 7.5656L7.0154 9.42213L10.7948 5.25979C11.0259 5.00635 11.4176 4.98838 11.6698 5.21766C11.9232 5.44757 11.9418 5.8392 11.7119 6.09326L7.49193 10.7408C7.3773 10.8672 7.21618 10.9403 7.04577 10.944C7.04143 10.9434 7.03771 10.9434 7.03336 10.9434Z" fill="white"></path>
                          </svg>
                      </span>
                      Thêm vào giỏ thành công
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body">
                  <div class="media">
                      <img src="{{ asset('storage/'.$Product->main_img_url) }}" class="align-self-center mr-3 rounded img-thumbnail border-0" alt="SSD Image" style="width: 80px; height: 80px; object-fit: cover;">
                      <div class="media-body">
                          <h6 class="mt-0 font-weight-bold text-dark">{{ $Product->name }}</h6>
                      </div>
                  </div>
              </div>

              <div class="modal-footer bg-light d-block">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                      <span class="text-muted">Giỏ hàng hiện có: <strong class="cart-popup-count text-dark" id="cart-popup-count">0</strong> sản phẩm</span>
                      <span class="h5 mb-0 text-danger font-weight-bold">{{$Product->price_format}} ₫</span>
                  </div>

                  <div class="row">
                      <div class="col-6">
                          <button type="button" class="btn btn-main btn-block py-2" data-dismiss="modal">
                              Tiếp tục mua
                          </button>
                      </div>
                      <div class="col-6">
                          <a href="/cart" class="btn btn_base btn-checkout btn-block py-2">
                              Xem giỏ hàng
                          </a>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </div>



  <script>
      var productDetail = {}

      function onQtyChange() {
          let qty = parseInt($('.pd-qtym').val())
          let variantId = parseInt($('#product-selectors').val()) || parseInt($('.details-product [name="variantId"]').val())
          let validQty = validateQty(productDetail, variantId, qty)
          validQty && $('.pd-qtym').val(validQty)
      }

      function onQtyCRChange() {
          let qty = parseInt($('.cr-qty-input').val())
          console.log(qty)
          let variantId = window.EGACRAddonSettings.variantId
          let validQty = validateQty(productDetail, variantId, qty)
          if (validQty) {
              window.EGACRAddon.updateQty(validQty)
          }
      }
      let isProductInit = false;

      $(document).ready(function(e) {
          $('#gallery_02').slick({
              slidesToShow: 7,
              slidesToScroll: 1,
              asNavFor: '.slider-for',
              dots: false,
              arrows: false,
              focusOnSelect: true,
              infinite: false,

          });

          function getRatioImgHeight(devideWidth, width, height) {
              return Math.round(devideWidth * height / width);
          }

          $(window).on('scroll mousemove touchstart', () => {
              if (isProductInit) return
              isProductInit = true
              $('#videolary').lightGallery({
                  thumbnail: true
              });
              $('#gallery_1').lightGallery({
                  selector: '.gallery-item',
                  thumbnail: true
              });
              var wDW = $(window).width();
              $('#gallery_1').slick({
                  autoplay: false,
                  autoplaySpeed: 6000,
                  dots: false,
                  arrows: true,
                  infinite: false,
                  speed: 300,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  asNavFor: '#gallery_02'
              })
              let prevPos = 0
              $('#gallery_1 .item').on('mousedown', function(e) {
                  prevPos = e.pageX
                  $(this).one('mouseup', function(e) {
                      $(this).off('mousemove');
                      $('#gallery_1 .item').css('pointer-events', 'initial')

                  }).on('mousemove', function(e) {
                      if (prevPos !== e.pageX) {
                          prev = e.pageX
                          $('#gallery_1 .item').css('pointer-events', 'none')
                          e.preventDefault()
                      }
                  });

              });
              $('#gallery_1').on('swipe', function(event, slick, currentSlide, nextSlide) {

                  $('#gallery_1 .item').css('pointer-events', 'none')
              });
              $('#gallery_1').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                  $('#gallery_1 .item').css('pointer-events', 'initial')
              });
              $('#gallery_1').on('afterChange', function(event, slick, currentSlide, nextSlide) {
                  $('#gallery_1 .item').css('pointer-events', 'initial')
              });


              jQuery(function($) {


                  // Add label if only one product option and it isn't 'Title'. Could be 'Size'.

                  // Hide selectors if we only have 1 variant and its title contains 'Default'.

                  $('.selector-wrapper').hide();

                  $('.selector-wrapper').css({
                      'text-align': 'left',
                      'margin-bottom': '15px'
                  });

                  $('#ega-sticky-addcart .box-variant').append($('.selector-wrapper').clone())
              });


              // load more content
              const $contentWrapper = $('.js-content-wrapper');
              $contentWrapper.each(function(index, element) {
                  const $proContent = $(element).find('.js-content');
                  const $seeMore = $(element).find('.js-seemore');
                  const $proGetContent = $(element).find('.js-product-getcontent');

                  $seeMore.click(function() {
                      $(this).toggleClass("show");
                      if ($(this).hasClass('show')) {
                          $proGetContent.css("maxHeight", "none");
                          $(this).find('a').html('<i class="fas fa-minus-circle"></i> Thu gọn')
                      } else {
                          $proGetContent.css("maxHeight", "200px");
                          $(this).find('a').html('<i class="fas fa-plus-circle"></i> Xem thêm')
                          $('html, body').animate({
                              scrollTop: $proGetContent.offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
                          }, 'slow');
                      }
                  })
              })



              let imgTotalHeight = 0;
              let contentImgCount = 0;
              let contentImg = $("#content img").length;

              if (/webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && contentImg > 0) {
                  $("#content img").map(function(v, i) {
                      let img = new Image();
                      img.src = this.src;
                      img.onload = function() {
                          contentImgCount += 1;
                          let devideWidth = $("#content").width();
                          if (this.width != 0 && this.height != 0) {
                              imgTotalHeight += getRatioImgHeight(devideWidth, this.width, this.height);
                          }
                          if (contentImg == contentImgCount) {
                              if (($('.js-content-wrapper .js-content').height() + imgTotalHeight) <= 693) {
                                  $('.js-content-wrapper .js-seemore').hide();
                              }
                          }
                      }
                  })
              } else {
                  if ($('.js-content-wrapper .js-content').height() <= 200) {
                      $('.js-content-wrapper .js-seemore').hide();
                  }
              }


          })



      });


      var copyButton = {
          "copiedText": "Đã chép",
          "copyText": "Sao chép"
      };

      function convertCouponItem(content) {
          const regex = /\[(.*?)\]/gi
          content = content.replace(regex, function(str, innerString) {
              let code = innerString.split('=')[1].replace(/"/g, '').trim();

              return `<span onClick="codeCopy(this)" class="smb-copy smb-cursor-pointer text-danger" 
data-code="${code}"
data-copied-text="${copyButton.copiedText}">${copyButton.copyText}</span>`
          })
          return content
      }

      function codeCopy(el) {
          const copyText = copyButton.copyText;
          const copiedText = el.dataset.copiedText;
          const coupon = el.dataset.code;


          const _this = $(el);
          _this.html(`<span>${copiedText}</span>`);
          _this.addClass('disabled');
          setTimeout(function() {
              _this.html(`<span>${copyText}</span>`);
              _this.removeClass('disabled');
          }, 3000)
          navigator.clipboard.writeText(coupon);
      }
      // Hide Promotion + Specifications in content
      const specificationsTitle = 'h6:contains("Thông số kỹ thuật")';
      const promotionTitle = 'h6:contains("KHUYẾN MÃI - ƯU ĐÃI")';
      $(`#content ${specificationsTitle}, #content ${specificationsTitle} + *, #content ${promotionTitle}, #content ${promotionTitle} + *`).hide();
  </script>





  @endsection