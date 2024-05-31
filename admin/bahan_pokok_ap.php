<?php
session_start();
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$no = 0;

$id_pasar_login = $_SESSION['id_pasar_login']; 
$query = "SELECT bahan_pokok.*, pasar.nama AS nama_pasar FROM bahan_pokok INNER JOIN pasar ON bahan_pokok.id_pasar = pasar.id_pasar WHERE bahan_pokok.id_pasar = '$id_pasar_login'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    td {
        font-size: 16px;
    }

    .pasar-img-container {
        display: flex;
        align-items: center;
    }

    .pasar-img {
        max-width: 100%;
        max-height: 100px;
    }
</style>

<body>
    <div class="content-wrapper">
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper mt-5">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <h2><b>Data Bahan Pokok</b></h2>
                                <a href="admin_pasar_page.php?page=tambah_bahan_pokok_admin_pasar" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true"> <i class="fa fa-plus mr-1"></i>Tambah Data</a>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasar</th>
                                    <th>Nama Bahan Pokok</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            $no++;
                            echo '<tr>
                                <td>' . $no . '</td>
                                <td>' . $row['nama_pasar'] . '</td>
                                <td>' . $row['nama_bahan'] . '</td>
                                <td>' . $row['harga'] . '</td>
                                <td><img class="pasar-img" src="uploads/bahan_pokok/' . $row['foto'] . '" alt="Foto Pasar"></td>
                                <td>
                                <a style="color: #F2BE22;" href="admin_pasar_page.php?page=edit_bahan_pokok_admin_pasar&menu_upd=' . $row['id_bahan_pokok'] . '"" class="edit"><i class="material-icons" data-toggle="tooltip"
                                title="Edit">&#xE254;</i></a>
                                    <a style="color: #CD1818;" href="delete_bahan_pokok_ap.php?menu_del=' . $row['id_bahan_pokok'] . '" class="delete"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
                                </td>
                            </tr>';
                        }

                        echo '</table>';
                    } else {
                        echo 'Tidak ada data.';
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
