<?php
require_once "./../connections/connections.php";

error_reporting(0);

session_start();

mysqli_query($conn, "DELETE FROM tb_admin_pasar WHERE id_admin_pasar = '" . $_GET['menu_del'] . "'");

header("location:admin.php?page=admin_pasar");
?>
