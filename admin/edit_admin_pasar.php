<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin_pasar = $_GET['menu_upd'];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "UPDATE tb_admin_pasar SET username='$username', password='$password' WHERE id_admin_pasar=$id_admin_pasar";

    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "admin.php?page=admin_pasar";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['menu_upd'])) {
    $id_admin_pasar = $_GET['menu_upd'];

    $query = "SELECT * FROM tb_admin_pasar WHERE id_admin_pasar=$id_admin_pasar";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data admin pasar tidak ditemukan.";
        exit();
    }
} else {
    echo "ID admin pasar tidak disertakan dalam URL.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Pasar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container mt-5">
            <h2>Edit Admin Pasar</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
