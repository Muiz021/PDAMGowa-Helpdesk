<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo me-auto">
            <h1><a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/img/logo-pdam.png') }}" width="100%" alt=""></a>
            </h1>

        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>

                <li><a class="nav-link scrollto" href="#about">Sejarah</a></li>
                <li><a class="nav-link scrollto" href="#services">Pelayanan</a></li>
                <li><a class="nav-link scrollto" href="#clients">Lokasi</a></li>
                <li><a class="nav-link scrollto" href="{{url('login')}}">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <div class="header-social-links d-flex align-items-center">
            <a href="https://www.facebook.com/tirtajeneberang/" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.instagram.com/" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://linkedin.com/" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>

    </div>
</header><!-- End Header -->
