<?php
session_start();
unset($_SESSION['id_user_pelanggan']);
unset($_SESSION['admin']);
unset($_SESSION['id_usr']);
unset($_SESSION['id_lvl']);
unset($_SESSION['id']);
unset($_SESSION['usernm']);
unset($_SESSION['passuser']);
unset($_SESSION['level']);
unset($_SESSION['nama']);
unset($_SESSION['dev']);
unset($_SESSION['login']);
unset($_SESSION['apl']);
header("location: index.php");
?>