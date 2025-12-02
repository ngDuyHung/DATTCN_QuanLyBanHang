@extends('home')
@section('content')

</style>

<link href="{{ asset('assets/client/sidebar-style.scss.css') }}" rel="stylesheet" type="text/css" media="all" />




<link href="{{ asset('assets/client/collection-style.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('assets/client/edit-collection.scss.css') }}" rel="stylesheet" type="text/css" media="all" />




<!-- start fill production -->
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

					@if(isset($brand))
					<li>
						<a class="changeurl link" href="/{{ $brand->category->slug }}" title="Laptop">
							<span>{{ $brand->category->name }}</span>
						</a>
						<span class="mr_lr">&nbsp;/&nbsp;</span>
					</li>
					<li><strong><span>
								{{$brand->name}}
							</span></strong>
					</li>
					@elseif(isset($category))
					<li><strong><span>
								{{ $name }}
							</span></strong>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</section>


<div class="container">


	<ul class="collection-tag-custom" name="brand-collection">

		@if(isset($brand))
		<li>
			<a href="/{{ $brand->category->slug }}-{{ $brand->slug }}" title="{{$name}}">

				<img src="{{asset('storage/' . $brand->logo_url)}}" alt="{{$brand->name}}">

			</a>
		</li>
		@elseif(isset($category))

		@foreach($category->brands as $brand)
		<li>
			<a href="/{{ $brand->category->slug }}-{{ $brand->slug }}" title="{{$name}}">

				<img src="{{asset('storage/' . $brand->logo_url)}}" alt="{{$brand->name}}">

			</a>
		</li>
		@endforeach

		@endif

	</ul>



</div>



<section class="section wrap_background">
	<div class="container">
		<div class="bg_collection section">
			<div class="row">
				<aside class=" scroll card py-2 dqdt-sidebar sidebar left-content col-lg-12 col-md-12 col-sm-12">
					<div class="wrap_background_aside asidecollection">
						<div class="filter-content aside-filter">
							<div class="aside-hidden-mobile">

							</div>
						</div>
					</div>
				</aside>
				<div class="card py-0 py-xl-2 main_container collection col-lg-12 col-md-12 col-sm-12">
					<h1 class="title_page collection-title mb-0">
						{{ $name }}
					</h1>
					<div class="filter-content aside-filter">
						<div class="filter-container">
							<div class="filter-container__selected-filter" style="display: none;">
								<div class="filter-container__selected-filter-list mb-2 ">
									<ul></ul>
								</div>
							</div>
						</div>
					</div>
					@if($products->isEmpty())
					<div class="alert alert-warning  green-alert section" role="alert">
						Không có sản phẩm nào trong danh mục này.
					</div>
					@else
					<div class="category-products products">
						<div class=" d-flex justify-content-between align-items-baseline">
							<div class="sortPagiBar">
								<div class="sort-cate clearfix">
									<div id="sort-by" class="d-flex align-items-baseline">
										<label class="left">
											<span class=''>Sắp xếp: </span></label>
										<ul class="ul_col ml-2 mb-0">
											<li><span class="d-flex d-lg-none align-items-center justify-content-between">Thứ tự </span>
												<i class='fas fa-chevron-down float-right'></i>
												<ul class="content_ul">

													<li data-sort="name:asc"><a class="link" href="javascript:;" onclick="sortby('alpha-asc')">Tên A &rarr; Z</a></li>
													<li data-sort="name:desc"><a class="link" href="javascript:;" onclick="sortby('alpha-desc')">Tên Z &rarr; A</a></li>
													<li data-sort="price_min:asc"><a class="link" href="javascript:;" onclick="sortby('price-asc')">Giá tăng dần</a></li>
													<li data-sort="price_min:desc"><a class="link" href="javascript:;" onclick="sortby('price-desc')">Giá giảm dần</a></li>
													<li data-sort="created_on:desc"><a class="link" href="javascript:;" onclick="sortby('created-desc')">Hàng mới </a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>

						</div>
						<div class="products-view products-view-grid collection_reponsive list_hover_pro">
							<div class="row product-list content-col">
								@foreach($products as $product)

								<div class="col-6 col-sm-3 col-md-15 product-col">
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


													<span class="aer-star-deactive"><svg height="20pt" viewBox="0 -10 511.98685 511" width="20pt"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
																fill="#ccc" />
														</svg></span>


													<span class="aer-star-deactive"><svg height="20pt" viewBox="0 -10 511.98685 511" width="20pt"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
																fill="#ccc" />
														</svg></span>


													<span class="aer-star-deactive"><svg height="20pt" viewBox="0 -10 511.98685 511" width="20pt"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
																fill="#ccc" />
														</svg></span>


													<span class="aer-star-deactive"><svg height="20pt" viewBox="0 -10 511.98685 511" width="20pt"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0"
																fill="#ccc" />
														</svg></span>


													<span class="aer-star-deactive"><svg height="20pt" viewBox="0 -10 511.98685 511" width="20pt"
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

											</div>
										</form>
									</div>
								</div>
								@endforeach

							</div>
							<div class="section pagenav">

							</div>

						</div>
					</div>
					@endif

				</div>
			</div>
		</div>

		<div class="collection-desc py-3">
			<h2 class="heading-bar__title mb-3">Mô tả nhóm sản phẩm</h2>
			<div class="rte js-product-getcontent product_getcontent pos-relative" style="--maxHeightContent: 100px">
				<div class="js-content">
					<p><!--StartFragment --></p>
					<h2 style="text-align: justify;">Giới thiệu về Laptop Lenovo ThinkPad T Series</h2>
					<p style="text-align: justify;"><a href="https://memoryzone.com.vn/laptop-lenovo-thinkpad-t-series"><strong>Laptop Lenovo ThinkPad T Series</strong></a> từ lâu đã được xem là biểu tượng của dòng laptop doanh nghiệp. Kế thừa di sản từ IBM cho đến Lenovo, ThinkPad T luôn dẫn đầu về độ bền, sự ổn định và hiệu năng mạnh mẽ. Tại MemoryZone, người dùng có thể tìm thấy các mẫu mới nhất như T14 Gen 6 và T16 Gen 4, trang bị cấu hình AI hiện đại phục vụ công việc chuyên nghiệp.</p>
					<h2 style="text-align: justify;">Lịch sử và vị thế của ThinkPad T Series</h2>
					<p style="text-align: justify;"><strong>Hành trình từ IBM đến Lenovo:&nbsp;</strong>ThinkPad T Series ra mắt lần đầu năm 1992 dưới thương hiệu IBM, nhanh chóng được yêu thích nhờ độ bền và bàn phím cùng <strong><a href="https://memoryzone.com.vn/trackpoint-la-gi">TrackPoint</a></strong> huyền thoại. Sau khi Lenovo tiếp quản, dòng T tiếp tục phát triển mạnh mẽ và trở thành dòng laptop business được doanh nghiệp toàn cầu tin dùng.</p>
					<p style="text-align: justify;"><strong>Vị thế hiện tại trong năm 2025:</strong>&nbsp;Bước sang năm 2025, ThinkPad T Series tập trung mạnh vào hiệu năng AI, khả năng di động và độ tin cậy cao. Điều này giúp dòng T trở thành lựa chọn hàng đầu của doanh nhân và người dùng chuyên nghiệp tại Việt Nam.</p>
					<h2 style="text-align: justify;">Đặc trưng nổi bật của Lenovo ThinkPad T Series</h2>
					<ul style="text-align: justify;">
						<li><strong>Thiết kế bền bỉ và chuyên nghiệp: </strong>Vỏ Carbon Fiber Hybrid, trọng lượng 1.4-1.8 kg, bản lề thép 360°, thiết kế tối giản, phù hợp môi trường doanh nghiệp.</li>
						<li><strong>Độ bền chuẩn quân đội MIL-STD-810H: </strong>Chống rơi 1.2m, chống bụi, chịu nhiệt -29°C đến 60°C, bàn phím chống tràn 500ml.</li>
						<li><strong>Hiệu năng mạnh mẽ:</strong> CPU Intel Core Ultra 7 255H tích hợp NPU 13 TOPS, GPU Intel Arc, xử lý AI và đa nhiệm mượt mà với hơn 100 tab Chrome.</li>
						<li><strong>RAM &amp; SSD linh hoạt: </strong>RAM 32GB DDR5, SSD 1TB PCIe Gen4, nâng cấp tối đa RAM 64GB, phù hợp lập trình, Excel lớn và phần mềm doanh nghiệp.</li>
						<li><strong>Màn hình sắc nét: </strong>14-16 inch IPS FHD+ 1920×1200, độ sáng 400-500 nits, chống chói, tỷ lệ 16:10, phiên bản WUXGA 500 nits cho công việc thiết kế cơ bản.</li>
						<li><strong>Trải nghiệm gõ và âm thanh:</strong> Bàn phím ThinkPad hành trình 1.5mm, touchpad Precision, loa Dolby Atmos, webcam FHD IR với Privacy Shutter.</li>
						<li><strong>Bảo mật toàn diện:</strong> ThinkShield bao gồm TPM 2.0, vân tay Match-on-Chip, nhận diện khuôn mặt Windows Hello, BIOS tự phục hồi.</li>
						<li><strong>Kết nối hiện đại: </strong>2x Thunderbolt 4 (140W PD), HDMI 2.1, 2x USB-A 3.2, jack 3.5mm, Wi-Fi 6E/7, Bluetooth 5.3, tùy chọn 5G WWAN.</li>
					</ul>
					<h2 style="text-align: justify;">Lý do chọn mua Laptop Lenovo ThinkPad T Series tại MemoryZone?</h2>
					<p style="text-align: justify;">Tại <strong><a href="https://memoryzone.com.vn/">MemoryZone</a></strong>, chúng tôi luôn đảm bảo 100% chính hãng, hỗ trợ giao siêu tốc 2-4 giờ tại TP.HCM và Hà Nội. Quý khách hàng sẽ được hưởng chính sách đổi trả 7 ngày, trả góp 0% và tư vấn nâng cấp miễn phí. Để sở hữu ThinkPad T Series chính hãng giá tốt, bạn có thể liên hệ hotline (028) 7301 3878 để được hỗ trợ nhanh chóng.</p>
					<h2 style="text-align: justify;">FAQs - Một số câu hỏi thường gặp về Lenovo ThinkPad T Series</h2>
					<h3 style="text-align: justify;">1. ThinkPad T Series có bền không?</h3>
					<p style="text-align: justify;">Có, các model T Series đời mới (T14 Gen 6, T16 Gen 4) đạt chuẩn quân đội MIL-STD-810H, chống rơi, bụi, nhiệt độ khắc nghiệt và bàn phím chống tràn nước. Tuy nhiên, độ bền chính xác có thể khác nhau tùy phiên bản.</p>
					<h3 style="text-align: justify;">2. Máy có nâng cấp RAM và SSD được không?</h3>
					<p style="text-align: justify;">Nhiều model hỗ trợ nâng cấp RAM và SSD (RAM tối đa 64GB DDR5, SSD PCIe Gen4), nhưng một số phiên bản RAM hàn sẵn (V-Series) không nâng cấp được.</p>
					<h3 style="text-align: justify;">3. Máy có an toàn cho dữ liệu doanh nghiệp không?</h3>
					<p style="text-align: justify;">Có, T Series tích hợp ThinkShield gồm TPM 2.0, cảm biến vân tay Match-on-Chip, nhận diện khuôn mặt Windows Hello, BIOS tự phục hồi.</p>
					<h3 style="text-align: justify;">4. ThinkPad T Series phù hợp ai?</h3>
					<p style="text-align: justify;">Phù hợp doanh nghiệp, dân văn phòng, lập trình viên và người dùng cần laptop bền bỉ, hiệu năng cao và di chuyển nhiều.</p>
					<p><!--EndFragment --></p>
					<p>
				</div>
			</div>

			<div class="js-seemore ega-pro__seemore text-center pos-relative mt-3">
				<a href="javascript:void(0)" title="Xem thêm" class="btn btn-icon w-100 justify-content-center btn-secondary">
					<i class="fas fa-plus-circle"></i> Xem thêm
				</a>
			</div>
		</div>


		<script>
			const $proContent = $(".collection-desc").find('.js-content');
			const $seeMore = $(".collection-desc").find('.js-seemore');
			const $proGetContent = $(".collection-desc").find('.js-product-getcontent');

			if ($proContent.height() > 100) {
				$seeMore.show();
				$seeMore.click(function() {
					$(this).toggleClass("show");
					if ($(this).hasClass('show')) {
						$proGetContent.css("maxHeight", "none");
						$(this).find('a').html('<i class="fas fa-minus-circle"></i> Thu gọn')
					} else {
						$proGetContent.css("maxHeight", "100px");
						$(this).find('a').html('<i class="fas fa-plus-circle"></i> Xem thêm')
						$('html, body').animate({
							scrollTop: $proGetContent.offset().top - 100 //#DIV_ID is an example. Use the id of your destination on the page
						}, 'slow');
					}
				})
			} else {
				$seeMore.hide();
			}
		</script>
	</div>
</section>
<!-- end fill production -->

@endsection