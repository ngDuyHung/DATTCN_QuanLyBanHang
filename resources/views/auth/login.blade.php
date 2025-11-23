  @extends('home')
  @section('content')

  <!-- login -->
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

                      <li><strong><span>Đăng nhập tài khoản</span></strong></li>

                  </ul>
              </div>
          </div>
      </div>
  </section>
  <section class="section">
      <div class="container margin-bottom-20 card py-20">
          <div class="wrap_background_aside margin-bottom-40 page_login">
              <div class="heading-bar text-center">
                  <h1 class="title_page mb-0">Đăng nhập tài khoản</h1>
                  <p class="mb-0">Bạn chưa có tài khoản ?
                      <a href="/account/register" class="btn-link-style btn-register"
                          style="text-decoration: underline; "> Đăng ký tại đây</a>
                  </p>
              </div>
              <div class="row">
                  <div class="col-12 col-md-6 col-lg-5 offset-md-3 py-3 mx-auto">

                      <div class="page-login ">
                          <div id="login">
                              <form method="post" action="{{ route('login') }}" id="customer_login" accept-charset="UTF-8">
                                  @csrf
                                  <input name="FormType" type="hidden" value="customer_login" /><input name="utf8"
                                      type="hidden" value="true" />
                                  <div class="form-signup margin-bottom-15" style="color:red;">

                                  </div>
                                  <div class="form-signup clearfix">
                                      <fieldset class="form-group">
                                          <label>Email <span class="required">*</span></label>
                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </fieldset>
                                      <fieldset class="form-group">
                                          <label>Mật khẩu <span class="required">*</span> </label>
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                          <small class="d-block my-2">Quên mật khẩu? Nhấn vào<a href="{{ route('password.request') }}"
                                                  class="btn-link-style text-primary"
                                                  onclick=""> đây </a></small>
                                      </fieldset>
                                      <div class="pull-xs-left button_bottom a-center  mb-3">
                                          <button class="btn btn-block btn-style  btn-login" type="submit"
                                              value="Đăng nhập">Đăng nhập</button>

                                      </div>

                                  </div>
                              </form>
                          </div>

                          <div id="recover-password" style="display:none;" class="form-signup page-login text-center">
                              <h2>
                                  Đặt lại mật khẩu
                              </h2>
                              <p>
                                  Chúng tôi sẽ gửi cho bạn một email để kích hoạt việc đặt lại mật khẩu.
                              </p>
                              <form method="post" action="/account/recover" id="form-recover-password"
                                  accept-charset="UTF-8"><input name="FormType" type="hidden"
                                      value="recover_customer_password" /><input name="utf8" type="hidden"
                                      value="true" />
                                  <div class="form-signup" style="color: red;">

                                  </div>
                                  <div class="form-signup clearfix">
                                      <fieldset class="form-group">
                                          <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                              class="form-control form-control-lg" value="" name="Email"
                                              id="recover-email" placeholder="Email" Required>
                                      </fieldset>
                                  </div>

                                  <div class="action_bottom my-3">
                                      <input id="btn-recover-submit" class="btn btn-style btn-recover btn-block"
                                          type="submit" value="Lấy lại mật khẩu" />
                                      <a href="#" class="btn btn-style link btn-style-active "
                                          onclick="hideRecoverPasswordForm();return false;">Quay lại</a>

                                  </div>
                              </form>
                          </div>
                      </div>
                      <div class="block social-login--facebooks margin-top-20 text-center">
                          <p class="a-center text-secondary">
                              Hoặc đăng nhập bằng
                          </p>
                          <script>
                              function loginFacebook() {
                                  var a = {
                                          client_id: "947410958642584",
                                          redirect_uri: "https://store.mysapo.net/account/facebook_account_callback",
                                          state: JSON.stringify({
                                              redirect_url: window.location.href
                                          }),
                                          scope: "email",
                                          response_type: "code"
                                      },
                                      b = "https://www.facebook.com/v3.2/dialog/oauth" + encodeURIParams(a, !0);
                                  window.location.href = b
                              }

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
                          <a href="javascript:void(0)" class="social-login--facebook" onclick="loginFacebook()"><img
                                  width="129px" height="37px" alt="facebook-login-button"
                                  src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg"></a>
                          <a href="javascript:void(0)" class="social-login--google" onclick="loginGoogle()"><img
                                  width="129px" height="37px" alt="google-login-button"
                                  src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg"></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End login -->


  @endsection