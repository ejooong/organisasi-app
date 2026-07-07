@extends('layouts.app')
@section('title', 'Tambah Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);">
            <i class="fas fa-user-plus me-2"></i>Tambah Admin Baru
        </h4>
        <small class="text-muted">Buat akun admin atau super admin</small>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <form id="formTambahAdmin">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required placeholder="Nama admin">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="email@domain.com">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name === 'super_admin' ? 'Super Admin' : 'Admin' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" required minlength="8">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required minlength="8">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('formTambahAdmin').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    Swal.fire({
        title: 'Menyimpan...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('{{ route("admin.users.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    })
    .then(r => r.json().then(data => ({ status: r.status, body: data })))
    .then(res => {
        if (res.body.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: res.body.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '{{ route("admin.users.index") }}';
            });
        } else {
            let errorMsg = res.body.message || 'Terjadi kesalahan sistem.';
            if (res.status === 422 && res.body.errors) {
                errorMsg = Object.values(res.body.errors).map(e => e.join('<br>')).join('<br>');
            }
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: errorMsg
            });
        }
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan jaringan!'
        });
    });
});
</script>
@endpush
