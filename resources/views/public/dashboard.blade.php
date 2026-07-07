@extends('layouts.app')

@section('title', 'Dashboard Keanggotaan')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="bg-primary text-white p-5 rounded-3 mb-4">
        <h1 class="display-4 fw-bold">Sistem Informasi Keanggotaan</h1>
        <p class="lead">Dashboard publik untuk melihat informasi dan statistik anggota organisasi</p>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Anggota</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($stats['total_anggota']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Anggota Laki-laki</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($stats['total_laki']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Anggota Perempuan</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($stats['total_perempuan']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Persentase L/P</div>
                            <div class="h5 mb-0 font-weight-bold">
                                @if($stats['total_anggota'] > 0)
                                    {{ round(($stats['total_laki'] / $stats['total_anggota']) * 100) }}% / 
                                    {{ round(($stats['total_perempuan'] / $stats['total_anggota']) * 100) }}%
                                @else
                                    0% / 0%
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Distribusi Agama -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie"></i> Distribusi Agama
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="agamaChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Distribusi Pekerjaan -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar"></i> Distribusi Pekerjaan
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="pekerjaanChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Distribusi Provinsi -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-map-marker-alt"></i> Sebaran Wilayah (Provinsi)
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="provinsiChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Pertumbuhan Anggota -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-line"></i> Pertumbuhan Anggota {{ date('Y') }}
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="pertumbuhanChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colors = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
    ];

    // 1. Pie Chart - Agama
    const agamaData = @json($agamaChart);
    new Chart(document.getElementById('agamaChart'), {
        type: 'doughnut',
        data: {
            labels: agamaData.map(item => item.agama),
            datasets: [{
                data: agamaData.map(item => item.total),
                backgroundColor: colors.slice(0, agamaData.length),
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // 2. Bar Chart - Pekerjaan
    const pekerjaanData = @json($pekerjaanChart);
    new Chart(document.getElementById('pekerjaanChart'), {
        type: 'bar',
        data: {
            labels: pekerjaanData.map(item => item.pekerjaan),
            datasets: [{
                label: 'Jumlah Anggota',
                data: pekerjaanData.map(item => item.total),
                backgroundColor: colors,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 3. Bar Chart - Provinsi
    const provinsiData = @json($provinsiChart);
    new Chart(document.getElementById('provinsiChart'), {
        type: 'bar',
        data: {
            labels: provinsiData.map(item => item.domisili_provinsi_name),
            datasets: [{
                label: 'Jumlah Anggota',
                data: provinsiData.map(item => item.total),
                backgroundColor: '#4e73df',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 4. Line Chart - Pertumbuhan
    const pertumbuhanData = @json($pertumbuhan);
    const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const dataPerBulan = Array(12).fill(0);
    pertumbuhanData.forEach(item => {
        dataPerBulan[item.bulan - 1] = item.total;
    });

    new Chart(document.getElementById('pertumbuhanChart'), {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Anggota Baru',
                data: dataPerBulan,
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: '#4e73df',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
});
</script>
@endpush
@endsection