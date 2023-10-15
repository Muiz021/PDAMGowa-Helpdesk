<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('frontend/assets/img/logo-pdam.png') }}" width="50px" />
        </a>
        <span style="margin-left: 10px">Admin</span>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            @if (auth()->user()->roles == 'admin')
                <ul class="list-unstyled navbar__list">
                    <li class="{{ request()->is('backend/dashboard*') ? 'active' : '' }}">
                        <a href="/backend/dashboard">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('backend/pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/pelanggan">
                            <i class="fas fa-user"></i>Pelanggan</a>
                    </li>
                </ul>
            @elseif (auth()->user()->roles == 'user')
                <ul class="list-unstyled navbar__list">
                    <li class="{{ request()->is('backend/dashboard-pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/dashboard">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                </ul>
            @endif
        </nav>
    </div>
</aside>
