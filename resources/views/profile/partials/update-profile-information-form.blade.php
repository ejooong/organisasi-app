<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-warning">
                    <small>
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </small>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-success small fw-semibold">
                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan</button>

            @if (session('status') === 'profile-updated')
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
