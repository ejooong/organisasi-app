@extends('layouts.app')

@section('title', 'Profil Anggota')

@section('content')
<div class="container">
    <h2>Profil Saya</h2>
    
    @if($anggota)
        <div class="card">
            <div class="card-body">
                <h4>{{ $anggota->nama_lengkap }}</h4>
                <p><strong>No. Kartu:</strong> {{ $anggota->no_kartu }}</p>
                <p><strong>NIK:</strong> {{ $anggota->nik }}</p>
                <p><strong>Alamat:</strong> {{ $anggota->domisili_alamat_detail }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Data anggota belum tersedia. Silakan hubungi admin.
        </div>
    @endif
</div>
@endsection