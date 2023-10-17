<!DOCTYPE html>
<html lang="en">

<head>

    @include('frontend.template.meta')

    <title>PDAM Gowa - Helpdeck</title>

    @include('frontend.template.style')

</head>

<body>

    @include('frontend.template.header')

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                    data-aos="fade-up">
                    <div>
                        <h1>PDAM Tirta Jeneberang Menjadi PDAM yang Mandiri.</h1>
                        <h2>Profesional dan Mengutamakan pelayanan Turut serta melaksanakan Pembangunan Daerah</h2>
                        <a href="{{url('/login')}}" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
                    <img src="{{ asset('frontend/assets/img/hero-img.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6" data-aos="zoom-in">
                        <img src="{{ asset('frontend/assets/img/profil.jpeg') }}" width="100%" class="img-fluid"
                            alt="">
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-contents-center" data-aos="fade-left">
                        <div class="content pt-4 pt-lg-0">
                            <h3>Sejarah</h3>
                            <p class="fst-italic fst-justify" style="text-align: justify">
                                Pada tahun 1980, Direktorat Jenderal Cipta Karya Departemen Pekerjaan Umum Cabang Dinas
                                Kabupaten Gowa mendirikan pengolahan air bersih dengan kapasitas produksi 10 Liter/Detik
                                untuk memenuhi kebutuhan air bersih masyarakat kota Sungguminasa dan Kabupaten Gowa.
                                Pada tahun 1981, pengolahan air ini mulai memenuhi kebutuhan air bersih kota
                                Sungguminasa. Pada tanggal 8 September 1982, pengelolaan air tersebut diserahkan kepada
                                Pemerintah Kabupaten Gowa. Dengan pertumbuhan Kabupaten Gowa, kapasitas 10 Ltr/Dtk tidak
                                lagi mencukupi, sehingga diusulkan penambahan kapasitas menjadi 20 Ltr/Dtk pada tahun
                                1985/1986. Namun, instalasi lama tidak berfungsi dengan baik setelah adanya instalasi
                                baru. Pada tahun 1988, didirikan Perusahaan Daerah Air Minum Kabupaten Gowa berdasarkan
                                Perda Nomor 2 tahun 1988. Pemerintah Kabupaten Gowa mengusulkan penyerahan pengelolaan
                                Badan Pengelolaan Air Minum (BPAM) kepada mereka, yang disahkan pada 23 Januari 1991,
                                menjadikannya Perusahaan Daerah Air Minum (PDAM) Kabupaten Gowa.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->



        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Pelayanan</h2>
                    <p>Tindakan atau upaya yang disediakan oleh individu, organisasi, atau entitas
                        dengan tujuan memenuhi kebutuhan atau keinginan pelanggan atau masyarakat secara umum. Pelayanan
                        ini dapat mencakup berbagai bentuk, seperti informasi, produk, atau layanan langsung, yang
                        ditujukan untuk memenuhi kepuasan atau pemenuhan keperluan pelanggan.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
                        <div class="icon-box icon-box-pink">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4 class="title"><a href="">Air Tidak Mengalir</a></h4>
                            <p class="description">Situasi di mana aliran air terhenti
                                atau tidak mengalir karena berbagai alasan, seperti penyumbatan atau kekurangan pasokan.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="icon-box icon-box-cyan">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4 class="title"><a href="">Air Keruh</a></h4>
                            <p class="description">Kondisi air yang memiliki kejernihan rendah dan
                                ditandai dengan partikel-partikel atau zat-zat tersuspensi yang menyebabkan penglihatan
                                di dalam air menjadi buram atau tidak jernih.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="icon-box icon-box-green">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4 class="title"><a href="">Keberatan Bayar</a></h4>
                            <p class="description">Tindakan atau proses yang dilakukan oleh
                                individu atau entitas untuk menolak atau mengajukan keberatan terhadap pembayaran yang
                                harus dilakukan, biasanya disertai dengan alasan atau klaim yang berkaitan.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="icon-box icon-box-blue">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4 class="title"><a href="">Pembenahan Sambungan</a></h4>
                            <p class="description">Tindakan atau proses yang dilakukan untuk
                                memperbaiki atau memperkuat hubungan atau koneksi antara dua atau lebih entitas,
                                komponen, atau elemen, biasanya dilakukan untuk meningkatkan kinerja atau keandalan
                                sistem.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Lokasi</h2>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.3085809170907!2d119.45384697594851!3d-5.214120352536307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee32f5dc78ec9%3A0x462bae6d8fd4a8f7!2sPDAM%20GOWA!5e0!3m2!1sid!2sid!4v1697434014725!5m2!1sid!2sid"
                        width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </section><!-- End Clients Section -->

    </main><!-- End #main -->

    @include('frontend.template.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('frontend.template.script')

</body>

</html>
