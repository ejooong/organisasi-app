<!-- Sidebar -->
<div id="sidebar-wrapper">
    <div class="text-center border-bottom" style="padding: 24px 10px; display: flex; justify-content: center; align-items: center; min-height: 120px;">
        <img src="/images/logo.png" alt="Gerakan Indonesia Makmur" 
             style="max-width: 90%; max-height: 120px; object-fit: contain;">
    </div>
    <div class="list-group list-group-flush my-3">

        @auth
            {{-- Menu untuk Admin & Super Admin --}}
            @if(auth()->user()->hasAnyRole(['admin', 'super_admin']))
                <a href="{{ route('admin.dashboard') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>

                <a href="{{ route('admin.anggota.index') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('admin.anggota.index') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> Data Anggota
                </a>

                <a href="{{ route('admin.anggota.create') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('admin.anggota.create') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i> Tambah Anggota
                </a>
            @endif

            {{-- Menu HANYA untuk Super Admin --}}
            @if(auth()->user()->hasRole('super_admin'))
                <div class="list-group-item bg-transparent py-1 px-3 mt-2" style="font-size:0.7rem; color: rgba(155,47,81,0.6); font-weight:700; text-transform:uppercase; letter-spacing:1px;">
                    Super Admin
                </div>

                <a href="{{ route('admin.layout.index') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('admin.layout.*') ? 'active' : '' }}">
                    <i class="fas fa-id-card"></i> Layout Kartu
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i> Manajemen Admin
                </a>
            @endif

            {{-- Menu Anggota --}}
            @if(auth()->user()->hasRole('anggota'))
                <a href="{{ route('anggota.profil') }}"
                   class="list-group-item list-group-item-action bg-transparent {{ request()->routeIs('anggota.profil') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
            @endif
        @endauth

        @guest
            <a href="{{ route('login') }}" class="list-group-item list-group-item-action bg-transparent">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        @endguest

    </div>
</div>
<!-- /#sidebar-wrapper -->
