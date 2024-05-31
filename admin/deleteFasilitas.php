<?php
require_once "./../connections/connections.php";

error_reporting(0);

session_start();

mysqli_query($conn, "DELETE FROM fasilitas WHERE id_fasilitas = '" . $_GET['menu_del'] . "'");

header("location:admin.php?page=fasilitas");
?>
