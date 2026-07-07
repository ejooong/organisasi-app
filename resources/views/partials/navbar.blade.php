<nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-users"></i> Sistem Keanggotaan
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.dashboard') ? 'active' : '' }}" 
                       href="{{ route('public.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                
                @auth
                    @if(auth()->user()->hasRole('admin|super_admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i> Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.anggota.index') }}">
                                        <i class="fas fa-users"></i> Manajemen Anggota
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.anggota.create') }}">
                                        <i class="fas fa-user-plus"></i> Tambah Anggota
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.layout.index') }}">
                                        <i class="fas fa-id-card"></i> Layout Kartu
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    
                    @if(auth()->user()->hasRole('anggota'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('anggota.profil') }}">
                                <i class="fas fa-user"></i> Profil Saya
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>