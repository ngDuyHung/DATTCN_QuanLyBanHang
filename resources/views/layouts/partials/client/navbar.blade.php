  <!-- subheader == mobile nav -->
  <div class="subheader ">
    <div class="container">
      @if (!isset($home))
      <div class="toogle-nav-wrapper">
        <div class="icon-bar btn menu-bar mr-2 p-0 d-inline-flex">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <strong>DANH MỤC SẢN PHẨM</strong>
        <div class="navigation-wrapper ">

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
                    <span>Chuột-Bàn phím-Tai nghe2 </span>
                  </div>
                  <ul class="submenu__list">

                    <li class="submenu__col">
                      <span class="submenu__item submenu__item--main">
                        <a class="link" href="/chuot-gaming-van-phong" title="Chuột">Chuột</a>
                      </span>

                      <span class="submenu__item submenu__item">
                        <a class="link" href="/chuot-razer" title="Razer">Razer</a>
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
      @endif
      <ul class="shop-policises list-unstyled d-flex align-items-center flex-wrap m-0 pr-0">
        <li class="">
          <a class="link" href="{{ route('home') }}" title="TRANG CHỦ">
            TRANG CHỦ
          </a>
        </li>

        <li class="">
          <a class="link" href="/laptop" title="LAP TOP">
            LAP TOP
          </a>
        </li>
        <li class="">
          <a class="link" href="/pcmaybo" title="PC MÁY BỘ">
            PC MÁY BỘ
          </a>
        </li>
        <li class="">
          <a class="link" href="#" title=" LIÊN HỆ ">
            LIÊN HỆ 
          </a>
        </li>
      </ul>
    </div>
  </div>