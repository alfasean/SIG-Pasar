<?php
require_once "../connections/connections.php";

if (isset($_POST['submit'])) {
    $id_pasar = $_POST['id_pasar']; 
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $query = "INSERT INTO tb_admin_pasar (id_pasar, nama_pasar, username, password) VALUES ('$id_pasar', (SELECT nama FROM pasar WHERE id_pasar = '$id_pasar'), '$username', '$password')";
    $result = mysqli_query($conn, $query);
}

header("Location: admin.php?page=admin_pasar");
exit();
?>
