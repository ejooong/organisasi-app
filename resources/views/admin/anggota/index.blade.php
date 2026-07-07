@extends('layouts.app')

@section('title', 'Manajemen Anggota')

@push('styles')
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users"></i> Data Anggota
            </h6>
            <div>
                <button class="btn btn-success btn-sm" onclick="importExcel()">
                    <i class="fas fa-file-excel"></i> Import Excel
                </button>
                <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Filter Section (Modern Layout) -->
            <div class="row mb-4 bg-light p-3 rounded" style="background-color: var(--primary-light) !important; border: 1px dashed rgba(155, 47, 81, 0.2);">
                <div class="col-12 mb-2">
                    <span class="text-primary fw-bold"><i class="fas fa-filter"></i> Filter Data</span>
                </div>
                <div class="col-md-3 mb-2">
                    <select id="filterProvinsi" class="form-select form-select-sm select2">
                        <option value="">Semua Provinsi</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select id="filterPekerjaan" class="form-select form-select-sm">
                        <option value="">Semua Pekerjaan</option>
                        @php
                            $pekerjaan = [
                                'Tidak Bekerja', 'Pelajar', 'Mahasiswa', 'Ibu Rumah Tangga',
                                'Karyawan Swasta/BUMN/BUMD', 'Pegawai Negeri Sipil/PPPK',
                                'Jabatan Publik', 'Petani/Nelayan', 'Guru/Dosen',
                                'Wirausaha', 'Buruh Harian Lepas'
                            ];
                        @endphp
                        @foreach($pekerjaan as $p)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <select id="filterStatus" class="form-select form-select-sm">
                        <option value="all">Status: Semua</option>
                        <option value="1" selected>Status: Aktif</option>
                        <option value="0">Status: Non-Aktif</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2 d-flex gap-2">
                    <button class="btn btn-primary btn-sm w-100" onclick="reloadTable()">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <button class="btn btn-outline-secondary btn-sm w-100 bg-white" onclick="resetFilter()">
                        <i class="fas fa-sync"></i> Reset
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table id="anggotaTable" class="table table-hover align-middle border-bottom" style="font-size: 0.9rem;" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No. Kartu</th>
                            <th width="15%">Nama Lengkap</th>
                            <th width="10%">NIK</th>
                            <th width="7%">JK</th>
                            <th width="10%">Tgl Lahir</th>
                            <th width="5%">Umur</th>
                            <th width="10%">Pekerjaan</th>
                            <th width="10%">Kota</th>
                            <th width="6%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="importForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-info" style="font-size: 0.85rem;">
                        <h6 class="alert-heading fw-bold"><i class="fas fa-info-circle"></i> Petunjuk Format Excel</h6>
                        <p class="mb-1">Pastikan file Excel (.xlsx / .xls) Anda memiliki kolom-kolom berikut pada baris pertama (Header):</p>
                        <div class="table-responsive bg-white mt-2">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>nik</th>
                                        <th>nama_lengkap</th>
                                        <th>tanggal_lahir</th>
                                        <th>jenis_kelamin</th>
                                        <th>agama</th>
                                        <th>pekerjaan</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>32760...</td>
                                        <td>Budi Santoso</td>
                                        <td>1990-01-01</td>
                                        <td>L</td>
                                        <td>Islam</td>
                                        <td>Wirausaha</td>
                                        <td>...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mt-2 mb-0 text-muted"><em>* Anda dapat mengunduh template Excel di bawah ini untuk melihat format lengkapnya.</em></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih File Excel</label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('admin.anggota.export') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Download Template Excel
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Load filter provinsi
    loadFilterProvinsi();
    
    // Initialize DataTable
    const table = $('#anggotaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.anggota.datatable") }}',
            data: function(d) {
                d.provinsi = $('#filterProvinsi').val();
                d.pekerjaan = $('#filterPekerjaan').val();
                d.status = $('#filterStatus').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'no_kartu', name: 'no_kartu' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'nik', name: 'nik' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'umur', name: 'umur' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'domisili_kota_name', name: 'domisili_kota_name' },
            { data: 'status', name: 'is_active', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }
    });
    
    window.reloadTable = function() {
        table.ajax.reload();
    };
});

function loadFilterProvinsi() {
    $.get('/api/wilayah/provinsi', function(response) {
        const select = $('#filterProvinsi');
        response.data.forEach(function(item) {
            select.append(`<option value="${item.code}">${item.name}</option>`);
        });
    });
}

function resetFilter() {
    $('#filterProvinsi').val('').trigger('change');
    $('#filterPekerjaan').val('');
    $('#filterStatus').val('1');
    reloadTable();
}

function importExcel() {
    $('#importModal').modal('show');
}

$('#importForm').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    $.ajax({
        url: '{{ route("admin.anggota.import") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#importModal').modal('hide');
            Swal.fire('Sukses!', response.message, 'success');
            reloadTable();
        },
        error: function(xhr) {
            Swal.fire('Error!', xhr.responseJSON.message, 'error');
        }
    });
});

function cetakKartu(id) {
    window.open(`{{ url("admin/kartu") }}/${id}/download`, '_blank');
}

function previewKartu(id) {
    window.open(`{{ url("admin/kartu") }}/${id}/preview`, '_blank');
}

function hapusAnggota(id) {
    Swal.fire({
        title: 'Yakin?',
        text: "Data anggota akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url("admin/anggota") }}/${id}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Terhapus!', response.message, 'success');
                    reloadTable();
                }
            });
        }
    });
}
</script>
@endpush
@endsection