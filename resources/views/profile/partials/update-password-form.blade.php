<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password Baru</label>
            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
            <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-key me-1"></i> Ganti Password</button>

            @if (session('status') === 'password-updated')
                <span class="text-success fw-semibold small"
                      x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2000)">
                    <i class="fas fa-check-circle me-1"></i> Tersimpan.
                </span>
            @endif
        </div>
    </form>
</section>
