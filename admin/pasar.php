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
                                <h2><b>Data Pasar</b></h2>
                                <a href="admin.php?page=tambah_pasar" class="btn btn-success" tabindex="-1" role="button"
                                    aria-disabled="true"> <i class="fa fa-plus mr-1"></i>Tambah Data</a>
                            </div>
                        </div>
                    </div>

                    <?php
                    session_start();
                    require_once "./../connections/connections.php";

                    if (!$conn) {
                        die("Koneksi database gagal: " . mysqli_connect_error());
                    }

                    $no = 0;

                    $query = "SELECT * FROM pasar";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th style="width : 20px">Jam Operasional</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                $no++;
                                $jam_buka = date('H:i', strtotime($row['jam_buka']));
                                $jam_tutup = date('H:i', strtotime($row['jam_tutup']));
                                $jam_operasional = $jam_buka . ' - ' . $jam_tutup;
                            
                                echo '<tr>
                                        <td>' . $no . '</td>
                                        <td>' . $row['nama'] . '</td>
                                        <td>' . $row['alamat'] . '</td>
                                        <td>' . $jam_operasional . '</td>
                                        <td class="pasar-img-container">
                                            <div class="row">
                                                <div class="col-md-4"><img class="pasar-img" src="uploads/pasar/' . $row['foto1'] . '" alt="Foto Pasar 1"></div>
                                                <div class="col-md-4"><img class="pasar-img" src="uploads/pasar/' . $row['foto2'] . '" alt="Foto Pasar 2"></div>
                                                <div class="col-md-4"><img class="pasar-img" src="uploads/pasar/' . $row['foto3'] . '" alt="Foto Pasar 3"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><img class="pasar-img" src="uploads/pasar/' . $row['foto1'] . '" alt="Foto Pasar 1"></div>
                                                <div class="col-md-6"><img class="pasar-img" src="uploads/pasar/' . $row['foto2'] . '" alt="Foto Pasar 2"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <a style="color: #F2BE22;" href="admin.php?page=edit_pasar&menu_upd=' . $row['id_pasar'] . '"" class="edit"><i class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                            <a style="color: #CD1818;" href="deletePasar.php?menu_del=' . $row['id_pasar'] . '" class="delete"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
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
