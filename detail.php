<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasar</title>
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.css" />
    <style>
        * {
            font-family: "Poppins" !important;
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
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container-fluid">
                <a href="data-pasar.php" class="navbar-brand ms-4 ms-lg-0">
                    <img src="img/icon/back-button.png" width="24px" height="24px" alt="">
                </a>
                <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex align-items-center">
                    <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                        <img src="img/icon/home.png" width="24px" height="24px" alt="">
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s" style="background-color: #ffffff;">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                require_once "connections/connections.php";

                if (!$conn) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                if (isset($_GET['id_pasar'])) {
                    $pasarId = $_GET['id_pasar'];

                    $queryFoto = "SELECT * FROM pasar WHERE id_pasar = $pasarId";
                    $resultFoto = $conn->query($queryFoto);

                    if ($resultFoto->num_rows > 0) {
                        $row = $resultFoto->fetch_assoc();

                        $fotoPath1 = "admin/uploads/pasar/" . $row['foto1'];
                        $fotoPath2 = "admin/uploads/pasar/" . $row['foto2'];
                        $fotoPath3 = "admin/uploads/pasar/" . $row['foto3'];

                        echo "<div class='carousel-item active'>";
                        echo "<div class='overlay'></div>";
                        echo "<img class='w-100 d-block' src='$fotoPath1' alt='Image'>";
                        echo "<div class='carousel-caption d-flex align-items-center justify-content-center'>";
                        echo "<div class='container'>";
                        echo "<div class='row justify-content-center'>";
                        echo "<div class='col-lg-7 text-center'>";
                        echo "<h1 class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 45px;'>{$row['nama']}</h1>";
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 20px;'>{$row['alamat']}</p>";
                        $jamBuka = isset($row['jam_buka']) ? $row['jam_buka'] : 'Belum ditentukan';
                        $jamTutup = isset($row['jam_tutup']) ? $row['jam_tutup'] : 'Belum ditentukan';
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 18px;'>$jamBuka - $jamTutup</p>";
                        echo '<a href="#map" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Lihat Lokasi</a>';
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='carousel-item'>";
                        echo "<div class='overlay'></div>";
                        echo "<img class='w-100 d-block' src='$fotoPath2' alt='Image'>";
                        echo "<div class='carousel-caption d-flex align-items-center justify-content-center'>";
                        echo "<div class='container'>";
                        echo "<div class='row justify-content-center'>";
                        echo "<div class='col-lg-7 text-center'>";
                        echo "<h1 class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 45px;'>{$row['nama']}</h1>";
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 20px;'>{$row['alamat']}</p>";
                        $jamBuka = isset($row['jam_buka']) ? $row['jam_buka'] : 'Belum ditentukan';
                        $jamTutup = isset($row['jam_tutup']) ? $row['jam_tutup'] : 'Belum ditentukan';
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 18px;'>$jamBuka - $jamTutup</p>";
                        echo '<a href="#map" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Lihat Lokasi</a>';
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='carousel-item'>";
                        echo "<div class='overlay'></div>";
                        echo "<img class='w-100 d-block' src='$fotoPath3' alt='Image'>";
                        echo "<div class='carousel-caption d-flex align-items-center justify-content-center'>";
                        echo "<div class='container'>";
                        echo "<div class='row justify-content-center'>";
                        echo "<div class='col-lg-7 text-center'>";
                        echo "<h1 class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 45px;'>{$row['nama']}</h1>";
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 20px;'>{$row['alamat']}</p>";
                        $jamBuka = isset($row['jam_buka']) ? $row['jam_buka'] : 'Belum ditentukan';
                        $jamTutup = isset($row['jam_tutup']) ? $row['jam_tutup'] : 'Belum ditentukan';
                        echo "<p class='display-2 mb-1 animated slideInDown' style='color: #fff; font-size: 18px;'>$jamBuka - $jamTutup</p>";
                        echo '<a href="#map" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Lihat Lokasi</a>';
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "Tidak ada data foto untuk pasar dengan ID: $pasarId";
                    }
                } else {
                    echo "<p>ID pasar tidak valid.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <section id="bahan-pokok">
            <div class="row">
                <h1 class="text-center">Bahan Pokok</h1>
                <?php
                $queryBahanPokok = "SELECT * FROM bahan_pokok WHERE id_pasar = $pasarId";
                $resultBahanPokok = $conn->query($queryBahanPokok);

                if ($resultBahanPokok->num_rows > 0) {
                    while ($rowBahanPokok = $resultBahanPokok->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='rounded-circle overflow-hidden mx-auto' style='width: 150px; height: 150px;'>";
                        echo "<img src='admin/uploads/bahan_pokok/{$rowBahanPokok['foto']}' alt='Bahan Pokok' class='img-fluid w-100 h-100'>";
                        echo "</div>";
                        echo "<h3 class='mt-3 text-center'>{$rowBahanPokok['nama_bahan']}</h3>";
                        echo "<p class='text-center'>Harga: Rp. {$rowBahanPokok['harga']}</p>";
                        echo "</div>";
                    }
                } else {
                    echo "Tidak ada data bahan pokok untuk pasar dengan ID: $pasarId";
                }
                ?>
            </div>
        </section>
    </div>

    <div class="container mt-5">
        <section id="fasilitas">
            <h2 class="text-center mb-4">Fasilitas</h2>
            <div class="row">
                <?php
                $queryFasilitas = "SELECT * FROM fasilitas WHERE id_pasar = $pasarId";
                $resultFasilitas = $conn->query($queryFasilitas);

                if ($resultFasilitas->num_rows > 0) {
                    while ($rowFasilitas = $resultFasilitas->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='rounded-circle overflow-hidden mx-auto' style='width: 150px; height: 150px;'>";
                        echo "<img src='admin/uploads/fasilitas/{$rowFasilitas['foto']}' alt='Fasilitas' class='img-fluid w-100 h-100'>";
                        echo "</div>";
                        echo "<h3 class='mt-3 text-center'>{$rowFasilitas['nama_fasilitas']}</h3>";
                        echo "</div>";
                    }
                } else {
                    echo "Tidak ada data fasilitas untuk pasar dengan ID: $pasarId";
                }
                ?>
            </div>
        </section>
    </div>

    <div class="container mt-5 mb-5">
        <button class="btn btn-primary ms-auto me-4" id="btnRoute">Rute</button>
        <div id="map" style="height: 400px;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myCarousel = new bootstrap.Carousel(document.getElementById('header-carousel'), {
                interval: 3000,
                wrap: true // Putar kembali ke awal
            });
        });
    </script>

    <script>
        var map = L.map('map').setView([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).addTo(map)
            .bindPopup('<b><?= $row['nama'] ?></b>')
            .openPopup();
    </script>

    <script>
        var routeControl = null;

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('btnRoute').addEventListener('click', function () {
                calculateAndDisplayRoute();
            });
        });

        function calculateAndDisplayRoute() {
            var startPoint;
            var endPoint = L.latLng(<?= $row['latitude'] ?>, <?= $row['longitude'] ?>);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    startPoint = L.latLng(position.coords.latitude, position.coords.longitude);

                    if (routeControl !== null) {
                        map.removeControl(routeControl);
                    }

                    routeControl = L.Routing.control({
                        waypoints: [
                            startPoint,
                            endPoint
                        ],
                        routeWhileDragging: true,
                        show: true, 
                        createMarker: function () { return null; },
                        lineOptions: {
                            styles: [{ color: '#0066ff', opacity: 0.7, weight: 5 }]
                        },
                        router: new L.Routing.osrmv1({
                            language: 'id',
                            profile: 'car',
                        }),
                        routeLine: function (route, options) {
                            var line = L.Routing.line(route, options);
                            map.fitBounds(line.getBounds());
                            return line;
                        },
                        collapsible: true,
                        showAlternatives: false,
                        altLineOptions: { styles: [{ color: '#FF0000', opacity: 0.15, weight: 9 }] },
                        summaryTemplate: '<div class="route-info">{name}<br>{distance}, {time}</div>',
                    }).addTo(map);
                }, function () {
                    handleLocationError(true);
                });
            } else {
                handleLocationError(false);
            }
        }

        function handleLocationError(browserHasGeolocation) {
            var errorInfo = browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.';
            alert(errorInfo);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
