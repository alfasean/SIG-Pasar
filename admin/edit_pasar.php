<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $jam_buka = $_POST["jam_buka"];
    $jam_tutup = $_POST["jam_tutup"];

    $foto1 = uploadFoto("foto1");
    $foto2 = uploadFoto("foto2");
    $foto3 = uploadFoto("foto3");

    $sql = "UPDATE pasar SET nama='$nama', alamat='$alamat', latitude='$latitude', longitude='$longitude', jam_buka='$jam_buka', jam_tutup='$jam_tutup'";
    
    if ($foto1 !== null) {
        $sql .= ", foto1='$foto1'";
    }
    if ($foto2 !== null) {
        $sql .= ", foto2='$foto2'";
    }
    if ($foto3 !== null) {
        $sql .= ", foto3='$foto3'";
    }
    
    $sql .= " WHERE id_pasar='$_GET[menu_upd]'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        echo '<script>window.location.href = "admin.php?page=pasar";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function uploadFoto($fieldName)
{
    if (!empty($_FILES[$fieldName]['name'])) {
        $target_dir = "uploads/pasar/";
        $target_file = $target_dir . basename($_FILES[$fieldName]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES[$fieldName]["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        if ($_FILES[$fieldName]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            $uniqueFileName = uniqid("foto_") . ".$imageFileType";
            $uploadFile = $target_dir . $uniqueFileName;
            if (move_uploaded_file($_FILES[$fieldName]["tmp_name"], $uploadFile)) {
                return $uniqueFileName;
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
                return null;
            }
        } else {
            echo "Maaf, file tidak terunggah.";
            return null;
        }
    } else {
        return null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasar</title>
    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once "./../connections/connections.php";

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if (isset($_GET['menu_upd'])) {
        $id_pasar = $_GET['menu_upd'];

        $sql = "SELECT * FROM pasar WHERE id_pasar='$id_pasar'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Invalid request.";
        exit();
    }
    ?>

    <div class="form-container mt-2">
        <h2>Edit Pasar</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" value="<?php echo $row['nama']; ?>" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" value="<?php echo $row['alamat']; ?>" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" value="<?php echo $row['latitude']; ?>" name="latitude" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" value="<?php echo $row['longitude']; ?>" name="longitude" required>
            </div>
            <div class="form-group">
                <label for="jam_buka">Jam Buka:</label>
                <input type="time" id="jam_buka" value="<?php echo $row['jam_buka']; ?>" name="jam_buka" required>
            </div>
            <div class="form-group">
                <label for="jam_tutup">Jam Tutup:</label>
                <input type="time" id="jam_tutup" value="<?php echo $row['jam_tutup']; ?>" name="jam_tutup" required>
            </div>
            <div class="form-group">
    <label for="foto1">Foto 1:</label>
    <img src="uploads/pasar/<?php echo $row['foto1']; ?>" alt="Foto 1" width="100">
    <input type="file" name="foto1" accept="image/*">
</div>
<div class="form-group">
    <label for="foto2">Foto 2:</label>
    <img src="uploads/pasar/<?php echo $row['foto2']; ?>" alt="Foto 2" width="100">
    <input type="file" name="foto2" accept="image/*">
</div>
<div class="form-group">
    <label for="foto3">Foto 3:</label>
    <img src="uploads/pasar/<?php echo $row['foto3']; ?>" alt="Foto 3" width="100">
    <input type="file" name="foto3" accept="image/*">
</div>

            <div class="form-group submit-button">
                <button class="btn btn-success" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
