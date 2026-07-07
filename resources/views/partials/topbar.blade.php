<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom py-2 px-4" style="position: sticky; top: 0; z-index: 1020;">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left fs-4 me-3 cursor-pointer" id="menu-toggle" style="color: var(--primary-color); cursor: pointer;"></i>
        <h2 class="fs-5 m-0 font-weight-bold" style="color: var(--primary-color);">@yield('title', 'Sistem Keanggotaan')</h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-power-off me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>
    </div>
</nav>
<!-- /Topbar -->
