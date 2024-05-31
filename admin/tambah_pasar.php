<?php
session_start();
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    
    $queryPasar = "INSERT INTO pasar (nama, alamat, latitude, longitude, jam_buka, jam_tutup) VALUES ('$nama', '$alamat', '$latitude', '$longitude', '$jam_buka', '$jam_tutup')";

    if ($conn->query($queryPasar) === TRUE) {
        $lastInsertedId = $conn->insert_id;
    
        for ($i = 1; $i <= 3; $i++) {
            if ($_FILES["foto{$i}"]["error"] == UPLOAD_ERR_OK) {
                
                $extension = pathinfo($_FILES["foto{$i}"]["name"], PATHINFO_EXTENSION);          
                $uniqueFileName = uniqid("foto_") . ".$extension";
         
                $uploadDir = "uploads/pasar/";
                $uploadFile = $uploadDir . $uniqueFileName;
                if (move_uploaded_file($_FILES["foto{$i}"]["tmp_name"], $uploadFile)) {
                    
                    $fieldName = "foto{$i}"; 
                    $queryFoto = "UPDATE pasar SET $fieldName = '$uniqueFileName' WHERE id_pasar = '$lastInsertedId'";
                    if (!$conn->query($queryFoto)) {
                        echo "Error: " . $queryFoto . "<br>" . $conn->error;
                    }
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah foto {$i}.";
                }
            }
        }

        echo '<script>window.location.href = "admin.php?page=pasar";</script>';
        exit();
    } else {
        echo "Error: " . $queryPasar . "<br>" . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama Pasar:</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" class="form-control" name="latitude" required>
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" class="form-control" name="longitude" required>
                </div>

                <div class="form-group">
                    <label for="jam_buka">Jam Buka:</label>
                    <input type="time" class="form-control" name="jam_buka" required>
                </div>

                <div class="form-group">
                    <label for="jam_tutup">Jam Tutup:</label>
                    <input type="time" class="form-control" name="jam_tutup" required>
                </div>

                <div class="form-group">
                    <label for="foto1">Foto 1:</label>
                    <input type="file" class="form-control" name="foto1" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="foto2">Foto 2:</label>
                    <input type="file" class="form-control" name="foto2" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="foto3">Foto 3:</label>
                    <input type="file" class="form-control" name="foto3" accept="image/*">
                </div>

                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
