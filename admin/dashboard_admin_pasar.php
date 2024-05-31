<?php
session_start();
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id_pasar_login = $_SESSION['id_pasar_login'];

$queryTotalBahanPokok = "SELECT COUNT(*) as total_bahan_pokok FROM bahan_pokok WHERE id_pasar = $id_pasar_login";
$resultTotalBahanPokok = $conn->query($queryTotalBahanPokok);

if ($resultTotalBahanPokok->num_rows > 0) {
    $rowTotalBahanPokok = $resultTotalBahanPokok->fetch_assoc();
    $totalBahanPokok = $rowTotalBahanPokok['total_bahan_pokok'];
} else {
    $totalBahanPokok = 0;
}

$queryTotalFasilitas = "SELECT COUNT(*) as total_fasilitas FROM fasilitas WHERE id_pasar = $id_pasar_login";
$resultTotalFasilitas = $conn->query($queryTotalFasilitas);

if ($resultTotalFasilitas->num_rows > 0) {
    $rowTotalFasilitas = $resultTotalFasilitas->fetch_assoc();
    $totalFasilitas = $rowTotalFasilitas['total_fasilitas'];
} else {
    $totalFasilitas = 0;
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
                            <h3><?php echo $totalBahanPokok; ?></h3>
                            <p>Total Bahan Pokok</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalFasilitas; ?></h3>
                            <p>Total Fasilitas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
