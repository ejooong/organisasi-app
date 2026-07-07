<section class="space-y-6">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="fas fa-trash-alt me-1"></i> Hapus Akun
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title fw-bold text-danger" id="confirmUserDeletionModalLabel">Apakah Anda yakin ingin menghapus akun Anda?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <p class="text-muted">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                        
                        <div class="mt-3">
                            <label for="password_delete" class="form-label visually-hidden">Password</label>
                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password_delete" name="password" placeholder="Masukkan password Anda">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt me-1"></i> Hapus Akun Secara Permanen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($errors->userDeletion->isNotEmpty())
    @push('scripts')
        <script>
            // Tampilkan modal jika ada error validasi
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                myModal.show();
            });
        </script>
    @endpush
@endif
