{{-- ✅ Hiển thị thông báo thành công --}}
@if(session('success'))
    <div class="mb-0 alert alert-success alert-dismissible fade show py-2 px-3 d-flex align-items-center shadow-sm small position-relative" role="alert" style="border-left: 4px solid #198754;">
        <i class="bi bi-check-circle me-2 fs-5 text-success"></i>
        <div class="flex-grow-1">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-3" data-bs-dismiss="alert" aria-label="Đóng"></button>
    </div>
@endif


{{-- ⚠️ Hiển thị thông báo lỗi --}}
@if(session('error'))
    <div class="mb-0alert alert-danger alert-dismissible fade show py-2 px-3 d-flex align-items-center shadow-sm small position-relative" role="alert" style="border-left: 4px solid #dc3545;">
        <i class="bi bi-exclamation-triangle me-2 fs-5 text-danger"></i>
        <div class="flex-grow-1">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-3" data-bs-dismiss="alert" aria-label="Đóng"></button>
    </div>
@endif


{{-- 🚫 Hiển thị lỗi validate --}}
@if ($errors->any())
   <div class="mb-0 alert alert-danger alert-dismissible fade show py-2 px-3 d-flex align-items-center shadow-sm small position-relative" role="alert" style="border-left: 4px solid #dc3545;">
    <i class="bi bi-exclamation-circle me-2 fs-5 text-danger"></i>
    <div class="flex-grow-1">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@endif
