<?php
session_start();
session_destroy();
unset($_SESSION['email']);
$_SESSION['message']="Logout";
header("location:login.php");
?>