<?php
session_start();
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $nama_bahan = $_POST['nama_bahan'];
    $harga = $_POST['harga'];
    $id_pasar = $_POST['id_pasar'];
    $foto = uploadFoto();

    if ($foto !== false) {    
        $queryBahan = "INSERT INTO bahan_pokok (nama_bahan, harga, foto, id_pasar) VALUES ('$nama_bahan', '$harga', '$foto', '$id_pasar')";

        if ($conn->query($queryBahan) === TRUE) {
            echo '<script>window.location.href = "admin_pasar_page.php?page=bahan_pokok_admin_pasar";</script>';
            exit();
        } else {
            echo "Error: " . $queryBahan . "<br>" . $conn->error;
        }
    }
}


function uploadFoto()
{
    $target_dir = "uploads/bahan_pokok/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
   
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }
  
    if ($_FILES["foto"]["size"] > 500000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Maaf, file tidak terunggah.";
        return false;
    
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            return basename($_FILES["foto"]["name"]);
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
            return false;
        }
    }
}


$conn->close();
?>