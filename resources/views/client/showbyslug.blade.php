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
					@endif

				</div>
			</div>
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