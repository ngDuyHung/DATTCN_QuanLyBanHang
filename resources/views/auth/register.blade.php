  @extends('home')
  @section('content')
 


  <!-- register -->
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

                      <li><strong><span>Đăng ký tài khoản</span></strong></li>

                  </ul>
              </div>
          </div>
      </div>
  </section>
  <section class="section">
      <div class="container margin-bottom-20 card py-2">
          <div class="wrap_background_aside margin-bottom-40 page_login">
              <div class='heading-bar text-center'>
                  <h1 class="title_page mb-0">Đăng ký tài khoản</h1>
                  <span class="or">Bạn đã có tài khoản ? Đăng nhập
                      <a href="/account/login" style="text-decoration: underline;"
                          class="btn-link-style  btn-style margin-right-0">tại đây</a></span>

              </div>
              <div class="row">
                  <div class="col-12 col-md-6 col-lg-5 offset-md-3 py-3 mx-auto">
                      <div class="page-login py-3 ">
                          <div id="login">
                              <h2 class="text-center">
                                  Thông tin cá nhân
                              </h2>
                              <form method="post" action="{{ route('register') }}" id="customer_register"
                                  accept-charset="UTF-8">
                                  @csrf
                                  <div class="form-signup " style="color:red;">
                                  </div>
                                  <div class="form-signup clearfix">
                                      <div class="row">
                                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                              <fieldset class="form-group">
                                                  <label>Họ và tên <span class="required">*</span></label>
                                                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                  @error('name')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </fieldset>
                                          </div>

                                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                              <fieldset class="form-group">
                                                  <label>Số điện thoại <span class="required">*</span></label>
                                                  <input placeholder="Số điện thoại" type="text" pattern="\d+"
                                                      id="phone"
                                                      class="form-control @error('phone') is-invalid @enderror form-control-comment form-control-lg"
                                                      name="phone" value="{{ old('phone') }}" required>
                                                  @error('phone')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </fieldset>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                              <fieldset class="form-group">
                                                  <label>Email <span class="required">*</span></label>
                                                  <input type="email"
                                                      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                                      class="form-control @error('email') is-invalid @enderror form-control-lg" value="{{ old('email') }}" name="email"
                                                      id="email" placeholder="Email" required>
                                                  @error('email')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </fieldset>
                                          </div>
                                          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                              <fieldset class="form-group">
                                                  <label>Mật khẩu <span class="required">*</span> </label>
                                                  <input type="password" class="form-control @error('password') is-invalid @enderror form-control-lg" value=""
                                                      name="password" id="password" placeholder="Mật khẩu" required>
                                                  @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </fieldset>
                                              <fieldset class="form-group"></fieldset>
                                              <label>Nhập lại mật khẩu <span class="required">*</span> </label>
                                              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg"
                                                  value="" name="password_confirmation"
                                                  id="password_confirmation" placeholder="Nhập lại mật khẩu"
                                                  required>
                                              @error('password_confirmation')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="section margin-top-10 button_bottom mt-3">
                                          <button type="submit" value="Đăng ký"
                                              class="btn  btn-style  btn_register btn-block">Đăng ký</button>

                                      </div>
                                  </div>
                              </form>
                              <div class="block social-login--facebooks text-center">
                                  <p class="a-center text-secondary">
                                      Hoặc đăng nhập bằng
                                  </p>
                                  <script>
                                    //   function loginFacebook() {
                                    //       var a = {
                                    //               client_id: "947410958642584",
                                    //               redirect_uri: "https://store.mysapo.net/account/facebook_account_callback",
                                    //               state: JSON.stringify({
                                    //                   redirect_url: window.location.href
                                    //               }),
                                    //               scope: "email",
                                    //               response_type: "code"
                                    //           },
                                    //           b = "https://www.facebook.com/v3.2/dialog/oauth" + encodeURIParams(a, !0);
                                    //       window.location.href = b
                                    //   }

                                    //   function loginGoogle() {
                                    //       var a = {
                                    //               client_id: "997675985899-pu3vhvc2rngfcuqgh5ddgt7mpibgrasr.apps.googleusercontent.com",
                                    //               redirect_uri: "https://store.mysapo.net/account/google_account_callback",
                                    //               scope: "email profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
                                    //               access_type: "online",
                                    //               state: JSON.stringify({
                                    //                   redirect_url: window.location.href
                                    //               }),
                                    //               response_type: "code"
                                    //           },
                                    //           b = "https://accounts.google.com/o/oauth2/v2/auth" + encodeURIParams(a, !0);
                                    //       window.location.href = b
                                    //   }

                                    //   function encodeURIParams(a, b) {
                                    //       var c = [];
                                    //       for (var d in a)
                                    //           if (a.hasOwnProperty(d)) {
                                    //               var e = a[d];
                                    //               null != e && c.push(encodeURIComponent(d) + "=" + encodeURIComponent(e))
                                    //           } return 0 == c.length ? "" : (b ? "?" : "") + c.join("&")
                                    //   }
                                  </script>
                                  <a href="javascript:void(0)" class="social-login--facebook"
                                      onclick="loginFacebook()"><img width="129px" height="37px"
                                          alt="facebook-login-button"
                                          src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg"></a>
                                  <a href="javascript:void(0)" class="social-login--google"
                                      onclick="loginGoogle()"><img width="129px" height="37px"
                                          alt="google-login-button"
                                          src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg"></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- end register -->

  @endsection