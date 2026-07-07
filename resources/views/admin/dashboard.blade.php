@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
/* Stat Cards */
.stat-card {
    border-radius: 18px;
    border: none;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(155, 47, 81, 0.18) !important;
}
.stat-card .stat-icon {
    width: 58px;
    height: 58px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.stat-card .stat-bg-decoration {
    position: absolute;
    right: -15px;
    bottom: -15px;
    font-size: 6rem;
    opacity: 0.07;
    line-height: 1;
}
.stat-number {
    font-size: 2.4rem;
    font-weight: 700;
    line-height: 1.1;
}
.stat-label {
    font-size: 0.85rem;
    font-weight: 500;
    opacity: 0.75;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.stat-trend {
    font-size: 0.8rem;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 20px;
}

/* Quick Action Cards */
.action-card {
    border-radius: 14px;
    border: 1.5px solid rgba(155, 47, 81, 0.1);
    transition: all 0.3s ease;
    text-decoration: none;
}
.action-card:hover {
    border-color: var(--primary-color);
    background-color: var(--primary-light);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(155, 47, 81, 0.12);
}
.action-card .action-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--primary-color);
    transition: all 0.3s;
}
.action-card:hover .action-icon {
    background: var(--primary-color);
    color: white;
}

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, var(--primary-color) 0%, #c0395f 60%, #d4547a 100%);
    border-radius: 20px;
    color: white;
    padding: 2rem 2.5rem;
    position: relative;
    overflow: hidden;
}
.welcome-banner::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
}
.welcome-banner::after {
    content: '';
    position: absolute;
    bottom: -60px;
    right: 60px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

.section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}
</style>
@endpush

@section('content')

@php
    $totalAnggota = \App\Models\Anggota::count();
    $anggotaAktif = \App\Models\Anggota::active()->count();
    $totalLaki = \App\Models\Anggota::where('jenis_kelamin', 'L')->count();
    $totalPerempuan = \App\Models\Anggota::where('jenis_kelamin', 'P')->count();
    $pctLaki = $totalAnggota > 0 ? round(($totalLaki / $totalAnggota) * 100) : 0;
    $pctPerempuan = $totalAnggota > 0 ? round(($totalPerempuan / $totalAnggota) * 100) : 0;
    $bulanIni = \App\Models\Anggota::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
    $bulanLalu = \App\Models\Anggota::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();
    $trendPersen = $bulanLalu > 0 ? round((($bulanIni - $bulanLalu) / $bulanLalu) * 100) : ($bulanIni > 0 ? 100 : 0);
@endphp

<!-- Welcome Banner -->
<div class="welcome-banner mb-4 shadow">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-2">
                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    👋
                </div>
                <div>
                    <h2 class="mb-0 fw-bold" style="color: white;">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <small style="color: rgba(255,255,255,0.8);">{{ now()->isoFormat('dddd, D MMMM Y') }} &mdash; Sistem Keanggotaan</small>
                </div>
            </div>
            <p class="mb-0 mt-2" style="color: rgba(255,255,255,0.85); font-size: 0.95rem;">Pantau dan kelola data anggota organisasi dari panel ini. Semua data selalu ter-update secara real-time.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block" style="z-index: 1;">
            <div style="font-size: 5rem; opacity: 0.15; position: absolute; right: 20px; top: 10px; pointer-events:none;">🏛️</div>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <!-- Total Anggota -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #9b2f51, #c0395f);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <span class="stat-trend" style="background: rgba(255,255,255,0.2); color: white;">Total</span>
                </div>
                <div class="stat-number text-white">{{ number_format($totalAnggota) }}</div>
                <div class="stat-label text-white mt-1">Total Anggota</div>
                <div class="stat-bg-decoration text-white"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>

    <!-- Anggota Aktif -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #1a9c5a, #22c872);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                    <span class="stat-trend" style="background: rgba(255,255,255,0.2); color: white;">Aktif</span>
                </div>
                <div class="stat-number text-white">{{ number_format($anggotaAktif) }}</div>
                <div class="stat-label text-white mt-1">Anggota Aktif</div>
                <div class="stat-bg-decoration text-white"><i class="fas fa-user-check"></i></div>
            </div>
        </div>
    </div>

    <!-- Persentase Jenis Kelamin -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #6f42c1, #9b59b6);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-venus-mars text-white"></i>
                    </div>
                    <span class="stat-trend" style="background: rgba(255,255,255,0.2); color: white;">L / P</span>
                </div>
                <div class="stat-number text-white" style="font-size: 1.8rem;">{{ $pctLaki }}% / {{ $pctPerempuan }}%</div>
                <div class="d-flex gap-3 mt-1">
                    <small style="color: rgba(255,255,255,0.8);"><i class="fas fa-male"></i> {{ number_format($totalLaki) }} L</small>
                    <small style="color: rgba(255,255,255,0.8);"><i class="fas fa-female"></i> {{ number_format($totalPerempuan) }} P</small>
                </div>
                <div class="stat-bg-decoration text-white"><i class="fas fa-venus-mars"></i></div>
            </div>
        </div>
    </div>

    <!-- Bulan Ini -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #1a5faf, #2980e8);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-calendar-plus text-white"></i>
                    </div>
                    <span class="stat-trend" style="background: rgba(255,255,255,0.2); color: white;">
                        {{ $trendPersen >= 0 ? '+' : '' }}{{ $trendPersen }}%
                    </span>
                </div>
                <div class="stat-number text-white">{{ number_format($bulanIni) }}</div>
                <div class="stat-label text-white mt-1">Daftar Bulan Ini</div>
                <div class="stat-bg-decoration text-white"><i class="fas fa-calendar"></i></div>
            </div>
        </div>
    </div>
</div>
<!-- Quick Actions -->
<div class="row g-3 mt-1">
    <div class="col-12">
        <div class="section-title"><i class="fas fa-bolt me-1"></i> Akses Cepat</div>
    </div>

    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.anggota.index') }}" class="card action-card p-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                <div class="action-icon"><i class="fas fa-users"></i></div>
                <div>
                    <div class="fw-bold" style="color: var(--text-main); font-size: 0.95rem;">Data Anggota</div>
                    <small class="text-muted">Lihat semua anggota</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.anggota.create') }}" class="card action-card p-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                <div class="action-icon"><i class="fas fa-user-plus"></i></div>
                <div>
                    <div class="fw-bold" style="color: var(--text-main); font-size: 0.95rem;">Tambah Anggota</div>
                    <small class="text-muted">Daftarkan anggota baru</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.layout.index') }}" class="card action-card p-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                <div class="action-icon"><i class="fas fa-id-card"></i></div>
                <div>
                    <div class="fw-bold" style="color: var(--text-main); font-size: 0.95rem;">Layout Kartu</div>
                    <small class="text-muted">Atur desain kartu</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-md-3">
        <a href="{{ route('profile.edit') }}" class="card action-card p-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                <div class="action-icon"><i class="fas fa-user-cog"></i></div>
                <div>
                    <div class="fw-bold" style="color: var(--text-main); font-size: 0.95rem;">Profil Saya</div>
                    <small class="text-muted">Kelola akun admin</small>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- Charts Row 1 -->
<div class="row mb-4">
    <!-- Pertumbuhan Anggota (full width) -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-chart-line"></i> Pertumbuhan Anggota {{ now()->year }}
                </h6>
            </div>
            <div class="card-body">
                <canvas id="pertumbuhanChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="row mb-4">
    <!-- Distribusi Agama -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 fw-bold text-primary">
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
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-chart-bar"></i> Distribusi Pekerjaan
                </h6>
            </div>
            <div class="card-body">
                <canvas id="pekerjaanChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 3 -->
<div class="row mb-4">
    <!-- Sebaran Wilayah Provinsi -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-map-marker-alt"></i> Sebaran Wilayah (Provinsi)
                </h6>
            </div>
            <div class="card-body">
                <canvas id="provinsiChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const themeColor = '#9b2f51';
    const colors = [
        '#9b2f51', '#1a9c5a', '#1a5faf', '#e0a020', '#6f42c1',
        '#36b9cc', '#fd7e14', '#e74a3b', '#20c997', '#e83e8c'
    ];

    // ─── 1. Line Chart: Pertumbuhan Anggota ─────────────────────────────
    @php
        $pertumbuhanData = [];
        for ($i = 1; $i <= 12; $i++) {
            $pertumbuhanData[] = \App\Models\Anggota::whereMonth('created_at', $i)
                ->whereYear('created_at', now()->year)
                ->count();
        }
    @endphp

    const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    new Chart(document.getElementById('pertumbuhanChart'), {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Anggota Baru',
                data: @json($pertumbuhanData),
                fill: true,
                backgroundColor: 'rgba(155, 47, 81, 0.08)',
                borderColor: themeColor,
                borderWidth: 2.5,
                pointBackgroundColor: themeColor,
                pointRadius: 4,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0, color: '#aaa' }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { ticks: { color: '#888' }, grid: { display: false } }
            }
        }
    });

    // ─── 3. Doughnut Chart: Distribusi Agama ────────────────────────────
    @php
        $agamaData = \App\Models\Anggota::selectRaw('agama, count(*) as total')
            ->groupBy('agama')->orderByDesc('total')->get();
    @endphp
    new Chart(document.getElementById('agamaChart'), {
        type: 'doughnut',
        data: {
            labels: @json($agamaData->pluck('agama')),
            datasets: [{
                data: @json($agamaData->pluck('total')),
                backgroundColor: colors.slice(0, {{ $agamaData->count() }}),
                borderWidth: 3,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // ─── 4. Horizontal Bar Chart: Distribusi Pekerjaan ──────────────────
    @php
        $pekerjaanData = \App\Models\Anggota::selectRaw('pekerjaan, count(*) as total')
            ->groupBy('pekerjaan')->orderByDesc('total')->limit(8)->get();
    @endphp
    new Chart(document.getElementById('pekerjaanChart'), {
        type: 'bar',
        data: {
            labels: @json($pekerjaanData->pluck('pekerjaan')),
            datasets: [{
                label: 'Jumlah Anggota',
                data: @json($pekerjaanData->pluck('total')),
                backgroundColor: colors,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { precision: 0, color: '#aaa' }, grid: { color: 'rgba(0,0,0,0.04)' } },
                y: { ticks: { color: '#666' }, grid: { display: false } }
            }
        }
    });

    // ─── 5. Bar Chart: Sebaran Wilayah Provinsi ─────────────────────────
    @php
        $provinsiData = \App\Models\Anggota::selectRaw('domisili_provinsi_name, count(*) as total')
            ->whereNotNull('domisili_provinsi_name')
            ->groupBy('domisili_provinsi_name')
            ->orderByDesc('total')
            ->limit(15)
            ->get();
    @endphp
    new Chart(document.getElementById('provinsiChart'), {
        type: 'bar',
        data: {
            labels: @json($provinsiData->pluck('domisili_provinsi_name')),
            datasets: [{
                label: 'Jumlah Anggota',
                data: @json($provinsiData->pluck('total')),
                backgroundColor: 'rgba(155, 47, 81, 0.15)',
                borderColor: '#9b2f51',
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(155, 47, 81, 0.35)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0, color: '#aaa' }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { ticks: { color: '#666', maxRotation: 35, minRotation: 20 }, grid: { display: false } }
            }
        }
    });

});
</script>
@endpush