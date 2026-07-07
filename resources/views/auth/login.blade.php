@php
    // Standalone login page - does not use x-guest-layout
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk &mdash; Gerakan Indonesia Makmur</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600&family=Plus+Jakarta+Sans:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1" rel="stylesheet"/>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary":          "#86113c",
                        "primary-container":"#a62d53",
                        "on-primary":       "#ffffff",
                        "surface":          "#fdf9f0",
                        "surface-bright":   "#fdf9f0",
                        "surface-lowest":   "#ffffff",
                        "surface-container-low": "#f7f3ea",
                        "on-surface":       "#1c1c17",
                        "on-surface-variant":"#574145",
                        "outline":          "#8a7175",
                        "outline-variant":  "#ddbfc4",
                        "secondary":        "#944a00",
                        "tertiary":         "#1e4e1c",
                        "background":       "#fdf9f0",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans", "sans-serif"],
                        "body":     ["Be Vietnam Pro", "sans-serif"],
                    }
                }
            }
        };
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
            font-size: 20px;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }
        .glass-panel {
            background: rgba(253, 249, 240, 0.90);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow: 0 12px 48px -8px rgba(134, 17, 60, 0.18), 0 2px 8px rgba(0,0,0,0.06);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.55s cubic-bezier(.22,.68,0,1.2) both;
        }
        .bg-hero {
            background-image: url('/images/login-bg.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: right center;
        }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col font-body overflow-x-hidden">

<main class="flex-grow flex items-center justify-center relative w-full min-h-screen">

    <!-- Background Layer -->
    <div class="absolute inset-0 z-0">
        <div class="bg-hero w-full h-full opacity-35 mix-blend-multiply"></div>
        <!-- Gradient Overlay: light on left, transparent on right -->
        <div class="absolute inset-0 bg-gradient-to-r from-surface-bright/95 via-surface-bright/75 to-transparent"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-5 md:px-16 flex items-center min-h-screen py-10">
        <div class="flex flex-col lg:flex-row w-full items-center justify-center lg:justify-start gap-10">

            <!-- ─── Login Card ─────────────────────────────────────────── -->
            <div class="w-full max-w-md glass-panel rounded-2xl p-8 md:p-10 flex flex-col gap-5 animate-fade-in-up">

                <!-- Header -->
                <div class="mb-1">
                    <div class="flex justify-center mb-6">
                        <img src="/images/logo.png" alt="Gerakan Indonesia Makmur" class="h-28 object-contain">
                    </div>
                    <h1 class="font-headline font-bold text-primary mb-1" style="font-size: 28px; line-height: 36px;">Selamat Datang Kembali</h1>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Masuk untuk mengelola data keanggotaan Gerakan Indonesia Makmur.</p>
                </div>

                <!-- Session Status / Errors -->
                @if(session('status'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-red-500 mt-0.5" style="font-size:16px;">error</span>
                            <div>
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-on-surface" for="email">Alamat Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="contoh@email.com"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-outline-variant bg-white/80 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all duration-200 @error('email') border-red-400 @enderror"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-semibold text-on-surface" for="password">Kata Sandi</label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-secondary hover:text-primary transition-colors">
                                    Lupa Kata Sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-11 py-3 rounded-xl border border-outline-variant bg-white/80 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all duration-200 @error('password') border-red-400 @enderror"
                            />
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors">
                                <span class="material-symbols-outlined" id="eyeIcon">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary/30">
                        <label for="remember_me" class="text-sm text-on-surface-variant cursor-pointer">Ingat saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition-all duration-300 active:scale-95 mt-1"
                        style="background: #9b2f51; box-shadow: 0 6px 20px rgba(155,47,81,0.3);"
                        onmouseover="this.style.background='#7a2540'"
                        onmouseout="this.style.background='#9b2f51'"
                    >
                        Masuk ke Sistem
                        <span class="material-symbols-outlined" style="font-size:18px;">arrow_forward</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-3">
                    <div class="flex-grow border-t border-outline-variant"></div>
                    <span class="text-xs text-on-surface-variant font-medium">Gerakan Indonesia Makmur</span>
                    <div class="flex-grow border-t border-outline-variant"></div>
                </div>

                <!-- Stats pills -->
                <div class="flex gap-3 justify-center">
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-outline-variant/60 bg-surface-container-low text-xs font-semibold text-on-surface">
                        <span class="material-symbols-outlined text-secondary" style="font-size:15px;">group</span>
                        Terkelola Terpusat
                    </div>
                    <!-- <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-outline-variant/60 bg-surface-container-low text-xs font-semibold text-on-surface">
                        <span class="material-symbols-outlined text-tertiary" style="font-size:15px;">verified</span>
                        Aman & Terpercaya
                    </div> -->
                </div>
            </div>

            <!-- ─── Branding Area (Desktop only) ──────────────────────── -->
            <div class="hidden lg:flex flex-col justify-center items-start pl-10 max-w-lg">
                <p class="text-sm font-semibold uppercase tracking-widest mb-4" style="color: rgba(155,47,81,0.6);">Gerakan Indonesia Makmur</p>
                <h2 class="font-headline font-bold leading-tight mb-5" style="font-size: 52px; line-height: 62px; color: #86113c;">
                    Bersama<br/>Membangun<br/>Bangsa
                </h2>
                <p class="text-on-surface-variant text-lg leading-relaxed mb-8 max-w-sm">
                    Platform terpusat untuk mengelola keanggotaan, mencetak kartu anggota, dan memantau sebaran wilayah secara real-time.
                </p>
                <!-- Feature chips -->
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 bg-surface-container-low/80 backdrop-blur-sm px-5 py-3 rounded-xl border border-outline-variant/30 w-fit">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(155,47,81,0.12);">
                            <span class="material-symbols-outlined" style="color:#9b2f51; font-size:18px;">badge</span>
                        </div>
                        <span class="text-sm font-semibold text-on-surface">Cetak Kartu Anggota Digital</span>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-low/80 backdrop-blur-sm px-5 py-3 rounded-xl border border-outline-variant/30 w-fit">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(30,78,28,0.12);">
                            <span class="material-symbols-outlined" style="color:#1e4e1c; font-size:18px;">map</span>
                        </div>
                        <span class="text-sm font-semibold text-on-surface">Sebaran Wilayah Nasional</span>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-low/80 backdrop-blur-sm px-5 py-3 rounded-xl border border-outline-variant/30 w-fit">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(148,74,0,0.12);">
                            <span class="material-symbols-outlined" style="color:#944a00; font-size:18px;">analytics</span>
                        </div>
                        <span class="text-sm font-semibold text-on-surface">Dashboard Statistik Real-time</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility_off';
            }
        });
    }
});
</script>

</body>
</html>
