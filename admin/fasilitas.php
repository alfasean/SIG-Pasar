<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    td {
        font-size: 16px;
    }

    .fasilitas-img-container {
        display: flex;
        align-items: center;
    }

    .fasilitas-img {
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
                                <h2><b>Data Fasilitas</b></h2>
                                <a href="admin.php?page=tambah_fasilitas" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true"> <i class="fa fa-plus mr-1"></i>Tambah Data</a>
                            </div>
                            <div class="col-sm-6">
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari nama pasar" name="search">
                                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                    </div>
                                </form>
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

                    if(isset($_POST['search'])){
                        $search = $_POST['search'];
                        $query = "SELECT fasilitas.*, pasar.nama AS nama_pasar FROM fasilitas INNER JOIN pasar ON fasilitas.id_pasar = pasar.id_pasar WHERE pasar.nama LIKE '%$search%'";
                    } else {
                        $query = "SELECT fasilitas.*, pasar.nama AS nama_pasar FROM fasilitas INNER JOIN pasar ON fasilitas.id_pasar = pasar.id_pasar";
                    }

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasar</th>
                                        <th>Nama Fasilitas</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            $no++;
                            echo '<tr>
                                    <td>' . $no . '</td>
                                    <td>' . $row['nama_pasar'] . '</td>
                                    <td>' . $row['nama_fasilitas'] . '</td>
                                    <td><img class="fasilitas-img" src="uploads/fasilitas/' . $row['foto'] . '" alt="Foto Fasilitas"></td>
                                    <td>
                                    <a style="color: #F2BE22;" href="admin.php?page=edit_fasilitas&menu_upd=' . $row['id_fasilitas'] . '"" class="edit"><i class="material-icons" data-toggle="tooltip"
                                title="Edit">&#xE254;</i></a>
                                        <a style="color: #CD1818;" href="deleteFasilitas.php?menu_del=' . $row['id_fasilitas'] . '" class="delete"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
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
