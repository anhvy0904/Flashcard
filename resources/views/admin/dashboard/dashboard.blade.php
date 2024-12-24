@extends('admin.data')
@section('homebody')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Trang chủ</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tổng Người dùng</p>
                                <h4 class="card-title">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tổng thẻ nhớ được tạo</p>
                                <h4 class="card-title">{{ $totalSetCards }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Tổng bài kiểm tra đã thực hiện</p>
                                <h4 class="card-title">{{ $totalTestResults}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">User Statistics</div>
                        <div class="card-tools">
                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-label-info btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const monthlyRegistrations = @json($monthlyRegistrations);
        const labels = Object.keys(monthlyRegistrations).map(month => `Tháng ${month}`);
        const value = Object.values(monthlyRegistrations);
        const data = {
            labels: labels,
            datasets: [{
                label: 'Số người dùng đăng ký',
                data: value,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Màu nền
                borderColor: 'rgba(75, 192, 192, 1)',       // Màu đường viền
                borderWidth: 1
            }]
        };
    
        // Cấu hình Chart.js
        const config = {
            type: 'line', // Loại biểu đồ: line, bar, pie, etc.
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // Hiển thị chú thích
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // Bắt đầu từ 0 trên trục Y
                    }
                }
            }
        };
    
        // Khởi tạo biểu đồ
        const ctx = document.getElementById('statisticsChart').getContext('2d');
        const statisticsChart = new Chart(ctx, config);
    </script>
    
</div>
@stop()