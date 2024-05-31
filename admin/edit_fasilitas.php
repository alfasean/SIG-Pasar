<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_fasilitas = $_GET['menu_upd'];
    $nama_fasilitas = $_POST["nama_fasilitas"];
    $id_pasar = $_POST["id_pasar"];

    
    if (!empty($_FILES['foto']['name'])) {
        
        $foto = uploadFoto();
        
        if ($foto !== null) {
            $sql = "UPDATE fasilitas SET nama_fasilitas='$nama_fasilitas', foto='$foto', id_pasar='$id_pasar' WHERE id_fasilitas=$id_fasilitas";
        } else {
            echo "Terjadi kesalahan saat mengunggah foto.";
            exit();
        }
    } else {
        
        $sql = "UPDATE fasilitas SET nama_fasilitas='$nama_fasilitas', id_pasar='$id_pasar' WHERE id_fasilitas=$id_fasilitas";
    }

    
    if ($conn->query($sql) === TRUE) {
        
        echo '<script>window.location.href = "admin.php?page=fasilitas";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['menu_upd'])) {
    $id_fasilitas = $_GET['menu_upd'];

    $query = "SELECT * FROM fasilitas WHERE id_fasilitas=$id_fasilitas";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data fasilitas tidak ditemukan.";
        exit();
    }
} else {
    echo "ID fasilitas tidak disertakan dalam URL.";
    exit();
}


function uploadFoto()
{
    $target_dir = "uploads/fasilitas/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
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

    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Maaf, file tidak terunggah.";
        return null;
    
    } else {
        $temp = explode(".", $_FILES["foto"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newfilename)) {
            return $newfilename;
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
            return null;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fasilitas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container mt-5">
            <h2>Edit Fasilitas</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_fasilitas">Nama Fasilitas:</label>
                    <input type="text" class="form-control" name="nama_fasilitas" value="<?php echo $row['nama_fasilitas']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <img src="uploads/fasilitas/<?php echo $row['foto']; ?>" alt="Foto" width="100">
                    <input type="file" class="form-control" name="foto" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="id_pasar">Nama Pasar:</label>
                    <select name="id_pasar" class="form-control" required>
                        <?php
                        require_once "./../connections/connections.php";
                        $queryPasar = "SELECT id_pasar, nama FROM pasar";
                        $resultPasar = $conn->query($queryPasar);

                        if ($resultPasar->num_rows > 0) {
                            while ($rowPasar = $resultPasar->fetch_assoc()) {
                                
                                $selected = ($rowPasar['id_pasar'] == $row['id_pasar']) ? "selected" : "";
                                echo "<option value='{$rowPasar['id_pasar']}' $selected>{$rowPasar['nama']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No pasar available</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
