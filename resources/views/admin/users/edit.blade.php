@extends('layouts.app')
@section('title', 'Edit Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);">
            <i class="fas fa-user-edit me-2"></i>Edit Admin
        </h4>
        <small class="text-muted">Perbarui data: {{ $user->name }}</small>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <form id="formEditAdmin">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name === 'super_admin' ? 'Super Admin' : 'Admin' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru <span class="text-muted fw-normal">(kosongkan jika tidak ingin diubah)</span></label>
                <input type="password" name="password" class="form-control" minlength="8" placeholder="••••••••">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" minlength="8" placeholder="••••••••">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('formEditAdmin').addEventListener('submit', function(e) {
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

    fetch('{{ route("admin.users.update", $user->id) }}', {
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
