<!DOCTYPE html>
<html lang="id">

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

        input,
        select {
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
            <form action="form_fasilitas_ap.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_fasilitas">Nama Fasilitas:</label>
                    <input type="text" class="form-control" name="nama_fasilitas" required>
                </div>

                <div class="form-group">
                    <label for="id_pasar">Nama Pasar:</label>
                    <select name="id_pasar" class="form-control" required>
                        <?php
                        session_start();
                        require_once "./../connections/connections.php";
                        
                        $id_pasar_login = $_SESSION['id_pasar_login'];
                        
                        $queryPasar = "SELECT id_pasar, nama FROM pasar WHERE id_pasar = $id_pasar_login";
                        $resultPasar = $conn->query($queryPasar);

                        if ($resultPasar->num_rows > 0) {
                            while ($rowPasar = $resultPasar->fetch_assoc()) {
                                echo "<option value='{$rowPasar['id_pasar']}' selected>{$rowPasar['nama']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No pasar available</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="form-control" name="foto" accept="image/*" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
