<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="backend/css/font-face.css" rel="stylesheet" media="all">
    <link href="backend/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="backend/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="backend/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="backend/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="backend/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"
        media="all">
    <link href="backend/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="backend/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="backend/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="backend/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="backend/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="backend/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div>
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="margin-top: 50px; margin-bottom:30px;">
                        <div class="login-logo">
                            <a href="#">
                                <img src="frontend/assets/img/logo-pdam.png" width="70px" alt="CoolAdmin">
                            </a>
                        </div>
                        @if (session('pesan-danger'))
                            <p class="alert alert-danger">{{ session('pesan-danger') }}</p>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $err)
                                <p class="alert alert-danger">{{ $err }}</p>
                            @endforeach
                        @endif
                        <div class="login-form">
                            <form action="/register" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" type="text" name="nama"
                                        placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label>No. Sambungan</label>
                                    <input class="au-input au-input--full" type="text" name="nosamb"
                                        placeholder="Masukkan No. Sambungan">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input class="au-input au-input--full" type="text" name="no_hp"
                                        placeholder="Masukkan No. HP">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="au-input au-input--full" name="alamat" id="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username"
                                        placeholder="Masukkan Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="Masukkan Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20 mt-4" type="submit">Register</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Sudah Mempunyai Akun?
                                    <a href="/login">Log In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="backend/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="backend/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="backend/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="backend/vendor/slick/slick.min.js"></script>
    <script src="backend/vendor/wow/wow.min.js"></script>
    <script src="backend/vendor/animsition/animsition.min.js"></script>
    <script src="backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="backend/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="backend/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="backend/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="backend/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="backend/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="backend/vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="backend/js/main.js"></script>

</body>

</html>
<!-- end document-->
