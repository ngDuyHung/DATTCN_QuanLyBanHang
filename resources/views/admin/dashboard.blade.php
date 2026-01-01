{{-- Kế thừa từ file layout admin --}}
@extends('layouts.admin')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Bảng quản trị')
@section('title_cache', 'Xóa cache hệ thống')
@section('link_cache', route('admin.home.clearCache'))
@push('styles')
<style>
.info-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
.info-box-icon {
    font-size: 2.5rem;
    transition: all 0.3s ease;
}
.info-box:hover .info-box-icon {
    transform: scale(1.1);
}
.card {
    transition: box-shadow 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}
.elevation-2 {
    box-shadow: 0 2px 4px rgba(0,0,0,.08);
}
.products-list .item:hover {
    background-color: rgba(0,0,0,.02);
    transition: background-color 0.2s ease;
}
</style>
@endpush

{{-- Đặt nội dung cho trang --}}
@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon text-bg-primary elevation-2">
                    <i class="bi bi-cart-check-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng đơn hàng</span>
                    <span class="info-box-number">
                        {{ number_format($totalOrders) }}
                    </span>
                    <div class="progress m-0 p-0" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: {{ $totalOrders > 0 ? 100 : 0 }}%"></div>
                    </div>
                    <span class="progress-description text-muted small">
                        Hoàn thành: {{ number_format($ordersCompleted) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon text-bg-success elevation-2">
                    <i class="bi bi-box-seam-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Sản phẩm</span>
                    <span class="info-box-number">{{ number_format($totalProducts) }}</span>
                    <div class="progress m-0 p-0" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalProducts > 0 ? ($productsActive / $totalProducts * 100) : 0 }}%"></div>
                    </div>
                    <span class="progress-description text-muted small">
                        Đang hoạt động: {{ number_format($productsActive) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon text-bg-warning elevation-2">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Khách hàng</span>
                    <span class="info-box-number">{{ number_format($totalCustomers) }}</span>
                    <div class="progress m-0 p-0" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: {{ $totalCustomers > 0 ? 100 : 0 }}%"></div>
                    </div>
                    <span class="progress-description text-muted small">
                        Tổng số tài khoản
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
                <span class="info-box-icon text-bg-danger elevation-2">
                    <i class="bi bi-currency-dollar"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Doanh thu</span>
                    <span class="info-box-number">{{ number_format($totalRevenue / 1000000, 1) }}M đ</span>
                    <div class="progress m-0 p-0" style="height: 4px;">
                        <div class="progress-bar bg-danger" style="width: {{ $totalRevenue > 0 ? 100 : 0 }}%"></div>
                    </div>
                    <span class="progress-description text-muted small">
                        Tổng: {{ number_format($totalRevenue, 0, ',', '.') }} đ
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

<!--begin::Row-->
<div class="row">
    <!-- Biểu đồ doanh thu -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header border-transparent">
                <h3 class="card-title">
                    <i class="bi bi-graph-up me-2"></i>
                    Biểu đồ doanh thu theo tháng
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative" style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ trạng thái đơn hàng -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-pie-chart me-2"></i>
                    Trạng thái đơn hàng
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative" style="height: 200px;">
                    <canvas id="orderStatusChart"></canvas>
                </div>
                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="bi bi-circle-fill text-success me-2"></i>Hoàn thành</span>
                        <strong>{{ number_format($ordersCompleted) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="bi bi-circle-fill text-warning me-2"></i>Chờ xử lý</span>
                        <strong>{{ number_format($ordersPending) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-circle-fill text-danger me-2"></i>Đã hủy</span>
                        <strong>{{ number_format($ordersCancelled) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- Hàng thứ 2: Đơn hàng mới & Cảnh báo kho -->
<div class="row mt-4">
    <!-- Left col -->
    <div class="col-md-8">
        <!-- TABLE: LATEST ORDERS -->
        <div class="card shadow-sm">
            <div class="card-header border-transparent">
                <h3 class="card-title">
                    <i class="bi bi-bag-check me-2"></i>
                    Đơn hàng mới nhất
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td><a href="{{ route('admin.order.index') }}">{{ $order->order_number ?? $order->order_id }}</a></td>
                                <td>{{ $order->full_name ?? ($order->user->name ?? 'Khách lẻ') }}</td>
                                <td>
                                    @if($order->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                    @elseif($order->status == 'pending')
                                    <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                    @elseif($order->status == 'delivery')
                                    <span class="badge bg-primary">Đang giao hàng</span>
                                    @else
                                    <span class="badge bg-info">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{ number_format($order->total_amount, 0, ',', '.') }} đ</div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->placed_at)->format('d/m H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Chưa có đơn hàng nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary float-end">Xem tất cả đơn hàng</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
        <!-- PRODUCT LIST -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Cảnh báo kho hàng
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @forelse($lowStockProducts as $inventory)
                    <li class="item d-flex align-items-center py-2 border-bottom">
                        {{-- Hình ảnh --}}
                        <div class="me-3">
                            <img src="{{ $inventory->product->main_img_url ? asset('storage/' . $inventory->product->main_img_url) : asset('assets/admin/img/default-150x150.png') }}"
                                alt="Product Image" class="img-size-50 rounded">
                        </div>

                        {{-- Thông tin sản phẩm --}}
                        <div class="flex-grow-1">
                            <a href="{{ route('admin.inventory.edit', $inventory) }}" class="fw-bold">
                                Sản phẩm #{{ $inventory->product_id }}
                                <span class="badge bg-danger ms-3">{{ $inventory->quantity_in_stock }}</span>
                            </a>
                            <div class="text-muted small mt-1">
                                SKU: {{ $inventory->product->sku ?? 'N/A' }} | Min: {{ $inventory->min_alert_quantity }}
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="item text-center py-2">
                        <span class="text-muted">Kho hàng ổn định</span>
                    </li>
                    @endforelse
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('admin.inventory.index') }}" class="uppercase">Xem tất cả kho hàng</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dữ liệu doanh thu theo tháng từ backend
    const monthlyData = @json($monthlyRevenue);
    
    // Chuẩn bị dữ liệu cho biểu đồ doanh thu
    const monthNames = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];
    const labels = monthlyData.map(item => monthNames[item.month - 1] + '/' + item.year.toString().substr(-2));
    const revenueData = monthlyData.map(item => item.total / 1000000); // Chuyển sang triệu
    const orderCountData = monthlyData.map(item => item.order_count);

    // Biểu đồ doanh thu (Line Chart với 2 trục)
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Doanh thu (triệu đ)',
                        data: revenueData,
                        borderColor: 'rgb(13, 110, 253)',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y',
                        pointBackgroundColor: 'rgb(13, 110, 253)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Số đơn hàng',
                        data: orderCountData,
                        borderColor: 'rgb(25, 135, 84)',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1',
                        pointBackgroundColor: 'rgb(25, 135, 84)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    if (context.datasetIndex === 0) {
                                        label += new Intl.NumberFormat('vi-VN').format(context.parsed.y) + ' triệu đ';
                                    } else {
                                        label += context.parsed.y + ' đơn';
                                    }
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Doanh thu (triệu đ)',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            drawOnChartArea: true,
                        },
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('vi-VN').format(value) + 'M';
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Số đơn hàng',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Biểu đồ trạng thái đơn hàng (Doughnut Chart)
    const orderStatusCtx = document.getElementById('orderStatusChart');
    if (orderStatusCtx) {
        const completedOrders = {{ $ordersCompleted }};
        const pendingOrders = {{ $ordersPending }};
        const cancelledOrders = {{ $ordersCancelled }};
        
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hoàn thành', 'Chờ xử lý', 'Đã hủy'],
                datasets: [{
                    data: [completedOrders, pendingOrders, cancelledOrders],
                    backgroundColor: [
                        'rgba(25, 135, 84, 0.8)',   // Success
                        'rgba(255, 193, 7, 0.8)',   // Warning
                        'rgba(220, 53, 69, 0.8)'    // Danger
                    ],
                    borderColor: [
                        'rgb(25, 135, 84)',
                        'rgb(255, 193, 7)',
                        'rgb(220, 53, 69)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });
    }
});
</script>
@endpush

