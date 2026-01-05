@extends('home')
@section('content')

<style>
	/* Container chứa các nút lọc */
	.filter-container-tags {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin-bottom: 20px;
	}

	/* Phong cách nút lọc dạng Tag */
	.filter-tag-item {
		position: relative;
		display: inline-block;
	}

	.btn-tag {
		background: #f1f1f1;
		border: 1px solid #e0e0e0;
		padding: 8px 15px;
		border-radius: 20px;
		font-size: 13px;
		color: #333;
		cursor: pointer;
		transition: all 0.2s;
		display: flex;
		align-items: center;
		gap: 5px;
	}

	.btn-tag:hover,
	.btn-tag.active {
		background: #fff;
		border-color: #2f80ed;
		color: #2f80ed;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	}

	/* Menu xổ xuống (Dropdown) */
	.filter-dropdown-content {
		display: none;
		position: absolute;
		top: 110%;
		left: 0;
		z-index: 1000;
		background-color: #fff;
		min-width: 250px;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		z-index: 1000;
		padding: 15px;
		border-radius: 8px;
		border: 1px solid #eee;
	}

	
	/* Lưới các lựa chọn bên trong dropdown */
	.filter-grid-options {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: 8px;
	}

	.option-item {
		padding: 5px 10px;
		border: 1px solid #eee;
		border-radius: 4px;
		font-size: 12px;
		text-align: center;
		cursor: pointer;
		text-decoration: none;
		color: #555;
	}

	.option-item:hover,
	.option-item.selected {
		border-color: #2f80ed;
		color: #2f80ed;
	}

	.filter-actions-bar {
		margin-top: 15px;
		padding-top: 10px;
		border-top: 1px solid #eee;
		display: flex;
		justify-content: space-between;
	}

	/* Class để hiển thị */
	.filter-dropdown-content.active {
		display: block;
	}
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
						<a class="changeurl link" href="/{{ $brand->category->slug }}" title="{{ $brand->category->name }}">
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
							<div class="category-products products">
								<div class="filter-wrapper">
									<form id="filterForm" action="{{ url()->current() }}" method="GET">
										<div class="filter-container-tags">

											<div class="filter-tag-item">
												<div class="btn-tag {{ (request('min_price') || request('max_price')) ? 'active' : '' }}">
													Giá <i class="fas fa-chevron-down"></i>
												</div>
												<div class="filter-dropdown-content">
													<span class="filter-item-label small fw-bold mb-2 d-block">CHỌN KHOẢNG GIÁ</span>
													<div class="d-flex gap-2">
														<input type="number" name="min_price" class="form-control form-control-sm" placeholder="Từ" value="{{ request('min_price') }}">
														<input type="number" name="max_price" class="form-control form-control-sm" placeholder="Đến" value="{{ request('max_price') }}">
													</div>
													<div class="filter-actions-bar">
														<button type="submit" class="btn btn-primary btn-sm w-100">Áp dụng</button>
													</div>
												</div>
											</div>

											@foreach($filterAttributes as $key => $values)
											<div class="filter-tag-item">
												<div class="btn-tag {{ request("attrs.$key") ? 'active' : '' }}">
													{{ $key }} <i class="fas fa-chevron-down"></i>
												</div>
												<div class="filter-dropdown-content">
													<span class="filter-item-label small fw-bold mb-2 d-block">CHỌN {{ strtoupper($key) }}</span>
													<div class="filter-grid-options">
														@foreach($values->unique('attr_value') as $item)
														<label class="option-item {{ request("attrs.$key") == $item->attr_value ? 'selected' : '' }}">
															<input type="radio" name="attrs[{{ $key }}]" value="{{ $item->attr_value }}"
																{{ request("attrs.$key") == $item->attr_value ? 'checked' : '' }}
																class="d-none" onchange="this.form.submit()">
															{{ $item->attr_value }}
														</label>
														@endforeach
													</div>
												</div>
											</div>
											@endforeach

											<div class="filter-tag-item">
												<div class="btn-tag {{ request('sort') ? 'active' : '' }}">
													Sắp xếp <i class="fas fa-chevron-down"></i>
												</div>
												<div class="filter-dropdown-content">
													<div class="d-flex flex-column gap-2">
														<label class="option-item {{ request('sort') == 'price_asc' ? 'selected' : '' }}">
															<input type="radio" name="sort" value="price_asc" onchange="this.form.submit()" class="d-none"> Giá thấp đến cao
														</label>
														<label class="option-item {{ request('sort') == 'price_desc' ? 'selected' : '' }}">
															<input type="radio" name="sort" value="price_desc" onchange="this.form.submit()" class="d-none"> Giá cao đến thấp
														</label>
														<label class="option-item {{ request('sort') == 'newest' ? 'selected' : '' }}">
															<input type="radio" name="sort" value="newest" onchange="this.form.submit()" class="d-none"> Mới nhất
														</label>
													</div>
												</div>
											</div>

											@if(count(request()->all()) > 0)
											<a href="{{ url()->current() }}" class="btn-tag text-danger border-danger">
												<i class="fas fa-times"></i> Xóa lọc
											</a>
											@endif
										</div>
									</form>
								</div>

								<div class="products-view products-view-grid ...">

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
													data-tags=''>

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
						</div>
					</div>
					@endif
				</div>

				<div class="collection-desc py-3">
					<h2 class="heading-bar__title mb-3">Mô tả nhóm sản phẩm</h2>
					<div class="rte js-product-getcontent product_getcontent pos-relative" style="--maxHeightContent: 100px">
						<div class="js-content">
							@if(isset($category))
							<p>{!! $category->description !!}</p>
							@elseif(isset($brand))
							<p>{!! $brand->description !!}</p>
							@endif
						</div>
					</div>

					<div class="js-seemore ega-pro__seemore text-center pos-relative mt-3">
						<a href="javascript:void(0)" title="Xem thêm" class="btn btn-icon w-100 justify-content-center btn-secondary">
							<i class="fas fa-plus-circle"></i> Xem thêm
						</a>
					</div>
				</div>

				<script>
					document.addEventListener('click', function(e) {
						// 1. Tìm cái nút Tag mà mình vừa click vào
						const btn = e.target.closest('.btn-tag');
						const container = e.target.closest('.filter-tag-item');

						// 2. Nếu click vào một nút Tag
						if (btn) {
							const menu = container.querySelector('.filter-dropdown-content');
							// Đóng tất cả các menu khác đang mở
							document.querySelectorAll('.filter-dropdown-content').forEach(m => m !== menu && m.classList.remove('active'));
							// Bật/Tắt menu của nút hiện tại
							menu.classList.toggle('active');
						}
						// 3. Nếu click ra ngoài (không phải nút, không phải menu) thì đóng hết
						else if (!e.target.closest('.filter-dropdown-content')) {
							document.querySelectorAll('.filter-dropdown-content').forEach(m => m.classList.remove('active'));
						}
					});
				</script>
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