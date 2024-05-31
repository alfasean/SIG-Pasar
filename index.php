<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIG Pasar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        * {
            font-family : "Poppins" !important;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>

    <!-- <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="text-primary m-0">SIG PASAR</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div> -->

    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" style="background-color: #ffffff;">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="overlay"></div>
                    <img class="w-100" src="img/carousel.jpeg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <h1 class="display-2 mb-1 animated slideInDown"
                                        style="color: #fff; font-size: 45px;">Sistem Informasi
                                        Geografis Pasar Tradisional</h1>
                                    <p class="text-white">Temukan Pasar Tradisional Terbaik dengan Lebih Mudah melalui Sistem Informasi Geografis Pasar Kami</p>
                                    <a href="data-pasar.php" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Kunjungi
                                        Peta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 
        <div class="container mt-5">
            <h1 class="text-center mb-3">Galeri Pasar</h1>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 1">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 2">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 3">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 5">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 6">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 7">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 8">
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 9">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="img/galery/pasar.jpeg" class="img-fluid" alt="Market 10">
                </div>
            </div>
        </div>

    </div> -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
