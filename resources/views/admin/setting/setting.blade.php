{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

@section('title', 'Cấu hình Website')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Thiết lập hệ thống</h3>
                        <div class="card-tools">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-save"></i> Lưu cài đặt
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Cột bên trái: Logo & Icon --}}
                            <div class="col-md-4 border-right">
                                <div class="form-group text-center">
                                    <label>Logo Website</label>
                                    <div class="mb-3">
                                        <img src="{{ asset(get_option('site_logo', 'assets/img/no-image.png')) }}" id="preview-logo" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                    <input type="file" name="site_logo" class="form-control" onchange="previewImage(this, 'preview-logo')">
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    <label>Favicon (Icon trình duyệt)</label>
                                    <div class="mb-3">
                                        <img src="{{ asset(get_option('site_favicon', 'assets/img/no-icon.png')) }}" id="preview-favicon" class="img-thumbnail" style="max-height: 50px;">
                                    </div>
                                    <input type="file" name="site_favicon" class="form-control" onchange="previewImage(this, 'preview-favicon')">
                                </div>
                            </div>

                            {{-- Cột bên phải: Thông tin chữ --}}
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>Tên Website</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ get_option('site_name') }}" placeholder="VD: My Ecommerce">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Slogan / Tiêu đề trang chủ</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ get_option('site_title') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email liên hệ</label>
                                    <input type="email" name="site_email" class="form-control" value="{{ get_option('site_email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Số điện thoại Hotline</label>
                                    <input type="text" name="site_phone" class="form-control" value="{{ get_option('site_phone') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Mô tả ngắn (SEO Meta Description)</label>
                                    <textarea name="site_description" class="form-control" rows="3">{{ get_option('site_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection