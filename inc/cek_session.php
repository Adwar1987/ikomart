<?php
session_start();
error_reporting(0);
include "../timeout.php";

if($_SESSION['dev']==0){
  header('location:../logout.php');
}
?>