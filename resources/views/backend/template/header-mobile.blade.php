<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a href="{{Auth::user()->roles == 'admin' ? route('dashboard.admin') : route('dashboard.user')}}">
                    <img src="{{ asset('frontend/assets/img/logo-pdam.png') }}" width="10%"  alt="PDAM Gowa" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            @if (auth()->user()->roles == 'admin')
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="{{ request()->is('backend/admin/dashboard*') ? 'active' : '' }}">
                        <a href="/backend/admin/dashboard">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('backend/admin/pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/admin/pelanggan">
                            <i class="fas fa-user"></i>Pelanggan</a>
                    </li>
                    <li class="{{ request()->is('backend/admin/pengaduan*') ? 'active' : '' }}">
                        <a href="{{ route('pengaduan.index') }}">
                            <i class="fa fa-bullhorn"></i>Pengaduan</a>
                    </li>
                </ul>
            @elseif (auth()->user()->roles == 'user')
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="{{ request()->is('backend/dashboard-pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/dashboard-pelanggan">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('backend/user/pengaduan*') ? 'active' : '' }}">
                        <a href="{{ route('pengaduan.index') }}">
                            <i class="fa fa-bullhorn"></i>Pengaduan</a>
                    </li>
                </ul>
            @endif
            </ul>
        </div>
    </nav>
</header>
