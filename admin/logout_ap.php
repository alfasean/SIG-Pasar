<?php 
session_start();
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";
session_destroy();
header("location:admin_pasar_login.php");
?>
