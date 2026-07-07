@extends('layouts.app')
@section('title', 'Profil Akun')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);">
            <i class="fas fa-user-circle me-2"></i>Pengaturan Profil
        </h4>
        <small class="text-muted">Kelola informasi akun dan pengaturan keamanan Anda</small>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="m-0 fw-bold" style="color: var(--primary-color);">Informasi Profil</h6>
                <small class="text-muted">Perbarui nama dan alamat email akun Anda.</small>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="m-0 fw-bold" style="color: var(--primary-color);">Ubah Password</h6>
                <small class="text-muted">Pastikan akun Anda menggunakan password yang panjang dan acak.</small>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="m-0 fw-bold text-danger">Hapus Akun</h6>
                <small class="text-muted">Setelah dihapus, semua sumber daya dan data akan dihapus secara permanen.</small>
            </div>
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
