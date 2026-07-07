@extends('layouts.app')
@section('title', 'Manajemen Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);">
            <i class="fas fa-user-shield me-2"></i>Manajemen Admin
        </h4>
        <small class="text-muted">Kelola akun admin dan super admin</small>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Admin
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle border-bottom" style="font-size:0.9rem;">
                <thead>
                    <tr style="background: var(--primary-light); color: var(--primary-color);">
                        <th width="5%">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                    <tr>
                        <td class="text-muted">{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                    style="width:36px;height:36px;background:var(--primary-color);font-size:0.85rem;flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    @if($user->id === auth()->id())
                                        <small class="text-muted">(Anda)</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                @if($role->name === 'super_admin')
                                    <span class="badge rounded-pill" style="background:var(--primary-color);">Super Admin</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary">Admin</span>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn btn-sm btn-light text-warning rounded-circle shadow-sm"
                                   style="width:32px;height:32px;padding:5px;"
                                   title="Edit" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <button onclick="hapusAdmin({{ $user->id }}, '{{ $user->name }}')"
                                        class="btn btn-sm btn-light text-danger rounded-circle shadow-sm"
                                        style="width:32px;height:32px;padding:5px;"
                                        title="Hapus" data-bs-toggle="tooltip">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data admin.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function hapusAdmin(id, nama) {
    Swal.fire({
        title: 'Hapus Admin?',
        text: `Anda yakin ingin menghapus admin "${nama}"? Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(`/admin/users/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message
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
        }
    });
}
</script>
@endpush
