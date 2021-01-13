<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION['login']==0){
  //header('location:logout2.php');
}
?>