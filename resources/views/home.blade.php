@include('layouts.partials.client.header')

<body id="template-index">


  <div class="opacity_menu"></div>
  <!-- <div class="container">
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
      defer=""></script>
    <div class="google-translate text-right">
      <div class="ggtrans">
        <div id="google_translate_element"></div>
      </div>
    </div>
    <script type="text/javascript" defer="">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'vi', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL }, 'google_translate_element');
      }
    </script>
  </div> -->
  <div class="topbar-slider swiper-container">
    <div class="swiper-wrapper">

    </div>
  </div>
  <script>
    var swiperbannertop = new Swiper(".topbar-slider", {
      autoplay: {
        delay: 4000,
        disableOnInteraction: true,
      },
      speed: 500,
      effect: 'fade'
    });
  </script>
  <header class="header header_menu">
    <div class="mid-header wid_100 d-flex align-items-center">
      <div class="container ">
        <div class="row align-items-center">
          <div class="col-2 col-sm-3 header-right d-lg-none d-block">
            <div class="toggle-nav btn menu-bar mr-4 ml-0 p-0  d-lg-none d-flex text-white">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
            </div>
          </div>
          <div class="col-6 col-lg-2 col-xl-3 header-left">

            <a href="/" class="logo-wrapper " title='MemoryZone by SieuToc'>
              <img loading="lazy" class="img-fluid"
                src="https://upanhnhanh.com/76ceccbf4688ed0f74dd4c0a6de3101a"
                alt="logo DuyhungZone by Nguyễn Duy Hùng" width="248" height="56">
            </a>

            <div class="toogle-nav-wrapper w-100 ">
              <div class=" d-flex align-items-center" style="height: 52px; font-size: 1rem; font-weight: 500">
                <div class="icon-bar btn menu-bar mr-3 ml-0 p-0 d-inline-flex">
                  <span class="bar"></span>
                  <span class="bar"></span>
                  <span class="bar"></span>
                </div>
                Danh mục sản phẩm
              </div>

              <div class="navigation-wrapper">

                <nav class="h-100">
                  <ul class="navigation list-group list-group-flush scroll">

                
                    @foreach($categories_sidebar as $category)
                    <li class="menu-item list-group-item">
                      <a href="/{{ $category->slug }}" class="menu-item__link" title="{{ $category->name }}">
                        <img width="24" height="24" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAeAAAAHgCAMAAABKCk6nAAAAA1BMVEXr6+uInxNMAAAA9UlEQVR42u3BgQAAAADDoPtTH2TVAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADghg0AAVGLwCwAAAAASUVORK5CYII=" alt="{{ $category->name }}">
                        <span>{{ $category->name }}</span>

                        <i class="float-right" data-toggle-submenu="">


                          <svg class="icon">
                            <use xlink:href="#icon-arrow"></use>
                          </svg>
                        </i>
                      </a>

                      <!-- <div class="submenu scroll">
                        <div class="toggle-submenu d-lg-none d-xl-none">
                          <i class="mr-3">


                            <svg class="icon" style="transform: rotate(180deg)">
                              <use xlink:href="#icon-arrow"></use>
                            </svg>
                          </i>
                          <span>Chuột-Bàn phím-Tai nghe </span>
                        </div>
                        <ul class="submenu__list">

                          <li class="submenu__col">
                            <span class="submenu__item submenu__item--main">
                              <a class="link" href="/chuot-gaming-van-phong" title="Chuột">Chuột</a>
                            </span>

                          

                          </li>

                        </ul>
                      </div> -->
                    </li>
                    @endforeach
                 
                  </ul>
                </nav>

              </div>

            </div>

          </div>
          <div class="col-lg-6 col-12 header-center pl-lg-0" id="search-header">
            <ae-widget hydrate="load" component="AeSmartSearchInput" api="https://memoryzone.aecomapp.com/api/"
              api-key="2">
              <form action="/search" method="get" class="input-group search-bar custom-input-group " role="search">
                <input type="text" name="query" value="" autocomplete="off"
                  class="input-group-field auto-search form-control " required=""
                  data-placeholder="Tìm tên sản phẩm, SKU,...;Giao hàng Siêu Tốc 2H chỉ 19K;Miễn phí giao hàng toàn quốc;">
                <input type="hidden" name="type" value="product">
                <span class="input-group-btn btn-action">
                  <button type="submit" aria-label="search" class="btn text-white icon-fallback-text h-100">
                    <svg class="icon">
                      <use xlink:href="#icon-search" />
                    </svg> </button>
                </span>

              </form>
            </ae-widget>


            <div class="search-dropdow">
              <ul class="search__list pl-0 d-flex list-unstyled mb-0 flex-wrap">
                <li class="mr-2">
                  <a id="filter-search-ban-phim-keychron"
                    href="/search?query=b%C3%A0n+ph%C3%ADm+keychron&type=product">bàn phím keychron</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-msi-cyborg-15" href="/search?query=MSI+Cyborg+15&type=product">MSI Cyborg 15</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-asus-oled" href="/search?query=ASUS+OLED&type=product">ASUS OLED</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-pc-gaming" href="/search?query=PC+Gaming&type=product">PC Gaming</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-razer-pro-click" href="/search?query=razer+pro+click&type=product">razer pro
                    click</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-the-nho" href="/search?query=Th%E1%BA%BB+nh%E1%BB%9B&type=product">Thẻ nhớ</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-usb" href="/search?query=USB&type=product">USB</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-loa" href="/search?query=Loa&type=product">Loa</a>
                </li>
                <li class="mr-2">
                  <a id="filter-search-" href="/search?query=&type=product"></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-4 col-sm-3 col-lg-6 col-xl-3 pl-0">
            <ul class="header-right mb-0 list-unstyled d-flex align-items-center">
              @if(Auth::check() && Auth::user()->role_id == 2)
              <a href="{{ route('admin.dashboard') }}">Quản trị</a>
              @endif
              <li class='ml-4 mr-4 mr-md-0 ml-md-3 media d-lg-flex d-none'>
                <img loading="lazy"
                  src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/account-icon.png?1762606819649" width="24"
                  height="24" alt="account_icon" class="mr-1 align-self-center" />
                @guest
                @if(Route::has('login'))
                <div class="media-body d-md-flex flex-column d-none ">
                  <a rel="nofollow" href="{{ route('login') }}" class="d-block" title="Tài khoản">
                    Đăng nhập
                  </a>
                  <small>
                    <a href="{{ route('register') }}" title="Đăng ký" class="font-weight: light">
                      Đăng ký
                    </a>
                  </small>
                </div>
                @endif
                @else
                <div class="media-body d-md-flex flex-column d-none ">
                  <a rel="nofollow" href="" class="d-block" title="Tài khoản">
                    {{ Str::limit(Auth::user()->name, 10) }}
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

              </li>

              <li class='d-lg-none'>
                <a href="/so-sanh" class='position-relative d-block' title="So sánh sản phẩm">
                  <img loading="lazy"
                    src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/compare-icon.png?1762606819649"
                    width="24" height="24" class="align-self-center" alt="compare-icon" />
                  <span class='compare-product__header-count position-absolute d-block'>0</span>
                </a>
              </li>

              <li class="cartgroup ml-3">
                <div class="mini-cart text-xs-center">
                  <a class="img_hover_cart" href="{{route('cart')}}" title="Giỏ hàng">
                    <img loading="lazy"
                      src="//bizweb.dktcdn.net/100/329/122/themes/1038963/assets/cart-icon.png?1762606819649" width="24"
                      height="24" alt="cart_icon" />
                    <span class='ml-2 d-xl-block d-none'>Giỏ hàng</span>
                    <span class="count_item count_item_pr"> {{ $cart ? (is_array($cart) ? array_sum(array_column($cart, 'quantity')) : $cart->cartItems->sum('quantity')) : 0 }}</span>
                  </a>
                  <!-- <div class="top-cart-content card ">
                    <ul id="cart-sidebar" class="mini-products-list count_li list-unstyled">
                      <li class="list-item">
                        <ul></ul>
                      </li>
                      <li class="action">

                      </li>
                    </ul>
                  </div> -->
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </header>

  @include('layouts.partials.client.navbar')


  <aside class="bottom">

    <div class="container">

    </div>

  </aside>
  <h1 class="d-none"></h1>

  @yield('content')



  @include('layouts.partials.client.footer')
</body>

</html>