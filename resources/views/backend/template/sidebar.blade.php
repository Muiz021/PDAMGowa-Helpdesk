<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('frontend/assets/img/logo-pdam.png') }}" width="50px" />
        </a>
        @if (auth()->user()->roles == 'admin')
            <span style="margin-left: 10px">Admin</span>
        @elseif (auth()->user()->roles == 'user')
            <span style="margin-left: 10px">Pelanggan</span>
        @endif
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            @if (auth()->user()->roles == 'admin')
                <ul class="list-unstyled navbar__list">
                    <li class="{{ request()->is('backend/admin/dashboard*') ? 'active' : '' }}">
                        <a href="/backend/admin/dashboard">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('backend/admin/pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/admin/pelanggan">
                            <i class="fas fa-user"></i>Pelanggan</a>
                    </li>
                    <li class="{{ request()->is('backend/admin/pengaduan*') ? 'active' : '' }}">
                        <a href="{{route('pengaduan.admin.index')}}">
                            <i class="fa fa-bullhorn"></i>Pengaduan</a>
                    </li>
                </ul>
            @elseif (auth()->user()->roles == 'user')
                <ul class="list-unstyled navbar__list">
                    <li class="{{ request()->is('backend/user/dashboard-pelanggan*') ? 'active' : '' }}">
                        <a href="/backend/user/dashboard-pelanggan">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('backend/user/pengaduan*') ? 'active' : '' }}">
                        <a href="{{route('pengaduan.index')}}">
                            <i class="fa fa-bullhorn"></i>Pengaduan</a>
                    </li>
                </ul>
            @endif
        </nav>
    </div>
</aside>
