@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profil Anggota -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user"></i> Detail Anggota
                    </h6>
                    <div>
                        <button onclick="cetakKartu({{ $anggota->id }})" class="btn btn-success btn-sm">
                            <i class="fas fa-id-card"></i> Cetak Kartu
                        </button>
                        <a href="{{ route('admin.anggota.edit', $anggota->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- No Kartu -->
                    <div class="text-center mb-4">
                        <h4 class="text-primary">No. Kartu: {{ $anggota->no_kartu }}</h4>
                        <span class="badge bg-{{ $anggota->is_active ? 'success' : 'danger' }}">
                            {{ $anggota->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </div>
                    
                    <hr>
                    
                    <!-- Data Pribadi -->
                    <h5 class="text-primary mb-3">A. Data Pribadi</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">NIK</th>
                            <td>{{ $anggota->nik_formatted }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $anggota->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $anggota->ktp_kota_name }}, {{ $anggota->tanggal_lahir->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $anggota->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $anggota->agama }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan</th>
                            <td>{{ $anggota->pendidikan_terakhir }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $anggota->pekerjaan }}</td>
                        </tr>
                    </table>
                    
                    <!-- Alamat KTP -->
                    <h5 class="text-primary mb-3 mt-4">B. Alamat KTP</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Provinsi</th>
                            <td>{{ $anggota->ktp_provinsi_name }}</td>
                        </tr>
                        <tr>
                            <th>Kota/Kabupaten</th>
                            <td>{{ $anggota->ktp_kota_name }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $anggota->ktp_kecamatan_name }}</td>
                        </tr>
                        <tr>
                            <th>Kelurahan/Desa</th>
                            <td>{{ $anggota->ktp_kelurahan_name }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>{{ $anggota->ktp_rt_rw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Detail</th>
                            <td>{{ $anggota->ktp_alamat_detail }}</td>
                        </tr>
                    </table>
                    
                    <!-- Alamat Domisili -->
                    <h5 class="text-primary mb-3 mt-4">C. Alamat Domisili</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Provinsi</th>
                            <td>{{ $anggota->domisili_provinsi_name }}</td>
                        </tr>
                        <tr>
                            <th>Kota/Kabupaten</th>
                            <td>{{ $anggota->domisili_kota_name }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $anggota->domisili_kecamatan_name }}</td>
                        </tr>
                        <tr>
                            <th>Kelurahan/Desa</th>
                            <td>{{ $anggota->domisili_kelurahan_name }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>{{ $anggota->domisili_rt_rw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Detail</th>
                            <td>{{ $anggota->domisili_alamat_detail }}</td>
                        </tr>
                    </table>
                    
                    <!-- Kontak & Keluarga -->
                    <h5 class="text-primary mb-3 mt-4">D. Kontak & Keluarga</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">No. WhatsApp</th>
                            <td>{{ $anggota->no_wa }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $anggota->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Keluarga Inti</th>
                            <td>{{ $anggota->jml_keluarga_inti }} orang</td>
                        </tr>
                        <tr>
                            <th>Jumlah Keluarga Serumah</th>
                            <td>{{ $anggota->jml_keluarga_serumah }} orang</td>
                        </tr>
                    </table>
                    
                    <!-- Ketertarikan -->
                    @if($anggota->ketertarikan)
                    <h5 class="text-primary mb-3 mt-4">E. Ketertarikan</h5>
                    <div>
                        @foreach(json_decode($anggota->ketertarikan, true) ?? $anggota->ketertarikan as $item)
                            <span class="badge bg-info me-1 mb-1">{{ $item }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Info Pendaftaran -->
                    <h5 class="text-primary mb-3 mt-4">F. Informasi Pendaftaran</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Tanggal Daftar</th>
                            <td>{{ $anggota->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Didaftarkan Oleh</th>
                            <td>{{ $anggota->registeredBy->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Preview Kartu -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-id-card"></i> Preview Kartu Anggota
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="border p-3 mb-3">
                        <h5>{{ $anggota->nama_lengkap }}</h5>
                        <p class="mb-1"><strong>{{ $anggota->no_kartu }}</strong></p>
                        <small class="text-muted">{{ $anggota->domisili_kota_name }}</small>
                    </div>
                    <button onclick="previewKartu({{ $anggota->id }})" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Lihat Full
                    </button>
                    <button onclick="cetakKartu({{ $anggota->id }})" class="btn btn-success btn-sm">
                        <i class="fas fa-download"></i> Download PDF
                    </button>
                </div>
            </div>
            
            <!-- QR Code -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-qrcode"></i> QR Code Verifikasi
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
// Generate QR Code
new QRCode(document.getElementById("qrcode"), {
    text: JSON.stringify({
        no_kartu: '{{ $anggota->no_kartu }}',
        nama: '{{ $anggota->nama_lengkap }}',
        nik: '{{ $anggota->nik }}'
    }),
    width: 150,
    height: 150
});
</script>
@endpush
@endsection