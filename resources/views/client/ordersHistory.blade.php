@extends('home')
@section('title', 'Lịch sử đơn hàng')

@section('content')
<style>
	.order-search button {
		display: inline-block;
		/* giữ nút nằm cùng hàng */
		white-space: nowrap;
		/* tránh chữ xuống dòng */
		height: 32px;
		/* chiều cao khớp với input-sm */
		line-height: 1.2;
		/* căn giữa chữ */
		padding: 0 12px;
		/* khoảng cách ngang */
		font-size: 14px;
		/* chữ vừa phải */
		border-radius: 4px;
		/* bo góc mềm mại */
		background-color: #f8db00ff;
		/* màu vàng Bootstrap warning */
		color: #fff;
		/* chữ trắng */
		border: none;
		/* bỏ viền mặc định */
		cursor: pointer;
		/* đổi con trỏ khi hover */
	}

	.order-search button:hover {
		background-color: #ec971f;
		/* màu vàng đậm hơn khi hover */
	}
</style>
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
						<a href="/" class="link"><span>Tài khoản</span></a>
						<span class="mr_lr">&nbsp;/&nbsp;</span>
					</li>

					<li><strong><span>Đơn hàng </span></strong></li>


				</ul>
			</div>
		</div>
	</div>
</section>
<h1 class="d-none">Đơn hàng của bạn</h1>
<section class="page_customer_account">
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
				<div class="order-wrapper">
					<div class="order-title">
						<h2 class="block-title mb-3 pb-0">@if(Auth::check()) Đơn hàng của tôi @else Đối với khách chưa đăng nhập vui lòng nhập mã đơn hàng để xem @endif</h2>
						<form action="{{ route('account.orders.indexClient') }}" method="get"
							class="order-search d-flex align-items-center gap-2">
							<div class="flex-grow-1">
								<input type="text" id="searchID" name="searchID"
									class="form-control form-control-sm"
									placeholder="Tìm kiếm theo mã đơn hàng"
									value="{{ request('searchID') }}">
							</div>
							<div>
								<button class="btn btn-outline btn-warning btn-sm px-2 mx-2" type="submit">
									🔍 Tìm kiếm
								</button>
							</div>
						</form>

						<div class="order-tabs">
							<button class="tab-btn active" data-status="all">Tất cả</button>
							<button class="tab-btn" data-status="pending">Đang xử lý</button>
							<button class="tab-btn" data-status="delivery">Đang vận chuyển</button>
							<button class="tab-btn" data-status="completed">Thành công</button>
							<button class="tab-btn" data-status="cancelled">Đã hủy</button>
						</div>
					</div>


					<div class="order-list">



						@if(isset($orders)&&!$orders->isEmpty())
						@foreach($orders as $order)

						<div class="order-card" data-status="{{ $order->status }}">
							<div class="order-header">
								<div class="order-code">
									<strong>#{{ $order->order_number  }}</strong>
									<a href="{{ route('account.orders.showClient', $order->order_id) }}" class="btn-link">Chi tiết</a>
								</div>
								<div class="order-info">
									<div class="info-left">
										<div class="order-date">Ngày đặt: <b>{{ $order->placed_at }}</b></div>
										<div class="order-status">
											@if($order->status == 'pending')
											<span class="badge unpaid">Đang xử lý</span>
											@elseif($order->status == 'delivery')
											<span class="badge waiting">Đang vận chuyển</span>
											@elseif($order->status == 'completed')
											<span class="badge paid">Thành công</span>
											@elseif($order->status == 'cancelled')
											<span class="badge cancelled">Đã hủy</span>
											@endif
										</div>
									</div>
									<div class="info-right">
										Tổng tiền ({{count($order->orderItems)}} sản phẩm): <strong>{{$order->total_amount_format}}</strong>
									</div>
								</div>
							</div>
							@foreach($order->orderItems as $item)
							<div class="order-body">

								<div class="order-product">
									<a target="_blank" href="/{{$item->product->slug}}"></a>
									<img src="//bizweb.dktcdn.net/thumb/large/100/329/122/products/laptop-lenovo-v14-g5-83hd0062va-01.jpg?v=1766398157960" alt="Laptop Lenovo V14 G5 83HD0062VA (i5-13420H, UHD Graphics, RAM 16GB DDR5, SSD 512GB, 14 Inch IPS FHD 60Hz, NoOS)">
									<div class="product-info">
										<div class="product-title">{{ $item->product->name }}</div>

										<div class="product-price">{{ $item->quantity }} x <b>{{ $item->line_total_format }}</b></div>
									</div>
								</div>

							</div>
							@endforeach
							<div class="order-footer d-none">
								<button type="button" class="btn btn-review">Đánh Giá</button>
								<button type="button" class="btn btn-cancel">Hủy Đơn</button>
							</div>
						</div>


						@endforeach


						@else
						<div class="container mt-4 mb-4 text-center">
							<p class="justify-content-center">Không tìm thấy đơn hàng nào.</p>
						</div>
						@endif


					</div>

					<div class="paginate-pages">

					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const buttons = document.querySelectorAll('.tab-btn');
		const cards = document.querySelectorAll('.order-card');

		buttons.forEach(btn => {
			btn.addEventListener('click', () => {
				document.querySelector('.tab-btn.active')?.classList.remove('active');
				btn.classList.add('active');

				const filter = btn.dataset.status;

				cards.forEach(card => {
					if (filter === 'all' || card.dataset.status === filter) {
						card.style.display = 'block';
					} else {
						card.style.display = 'none';
					}
				});
			});
		});
	});
</script>
@endsection