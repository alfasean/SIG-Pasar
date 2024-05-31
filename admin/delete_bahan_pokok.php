<?php
require_once "./../connections/connections.php";

error_reporting(0);

session_start();

mysqli_query($conn, "DELETE FROM bahan_pokok WHERE id_bahan_pokok = '" . $_GET['menu_del'] . "'");

header("location:admin.php?page=bahan_pokok");
?>
