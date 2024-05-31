<?php
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$queryTotalPasar = "SELECT COUNT(*) as total_pasar FROM pasar";
$resultTotalPasar = $conn->query($queryTotalPasar);

if ($resultTotalPasar->num_rows > 0) {
    $rowTotalPasar = $resultTotalPasar->fetch_assoc();
    $totalPasar = $rowTotalPasar['total_pasar'];
} else {
    $totalPasar = 0;
}

$conn->close();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalPasar; ?></h3>
                            <p>Total Pasar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
