<!DOCTYPE html>
<html lang="en">
<head>
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
    <style>
        #map {
            height: 400px;
            border-radius: 10px;
            overflow: hidden; 
        }

        #tabel-pasar {
            margin-top: 5px;
        }

        .btn-detail {
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
        }

        .col-lg-6 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid fixed-top px-0 wow fadeIn mb-5" data-wow-delay="0.1s">
<nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
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

<div class="container-xxl py-5 mt-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div id="map"></div>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div id="tabel-pasar">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasar</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "connections/connections.php";
                            $limit = 5;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($page - 1) * $limit;

                            if (!$conn) {
                                die("Koneksi database gagal: " . mysqli_connect_error());
                            }

                            $queryTabel = "SELECT * FROM pasar LIMIT $start, $limit";
                            $resultTabel = $conn->query($queryTabel);

                            if ($resultTabel->num_rows > 0) {
                                $counter = $start + 1; 
                                while ($rowTabel = $resultTabel->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$counter}</td>";
                                    echo "<td>{$rowTabel['nama']}</td>";
                                    echo "<td>{$rowTabel['alamat']}</td>";
                                    echo "<td><a href='detail.php?id_pasar={$rowTabel['id_pasar']}' class='btn btn-detail btn-primary'>Detail</a></td>";
                                    echo "</tr>";
                                    $counter++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                    <?php
                    $queryTotal = "SELECT COUNT(*) AS total FROM pasar";
                    $resultTotal = $conn->query($queryTotal);
                    $rowTotal = $resultTotal->fetch_assoc();
                    $totalPages = ceil($rowTotal['total'] / $limit);

                    echo "<ul class='pagination justify-content-center'>";
                    if ($page > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?page=".($page - 1)."'><i class='fas fa-angle-left'></i></a></li>";
                    }
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
                    }
                    if ($page < $totalPages) {
                        echo "<li class='page-item'><a class='page-link' href='?page=".($page + 1)."'><i class='fas fa-angle-right'></i></a></li>";
                    }
                    echo "</ul>";

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>>
<script src="js/main.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="js/custom-map.js?v=2"></script>
</body>
</html>
