<?php
session_start();
unset($_SESSION['id_user_pelanggan']);
unset($_SESSION['admin']);
unset($_SESSION['email']);
unset($_SESSION['nama']);
unset($_SESSION['login']);
unset($_SESSION['apl']);
header("location: index.php");
?>