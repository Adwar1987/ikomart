<?php
include "../../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_judul'];
$judul = $_POST['nm_judul'];
// HAPUS
if($module=='judul' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM judul WHERE id_judul='".$_GET['id_judul']."'";
$myQry = mysqli_query($connect, $mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='judul' AND $aksi=='edit' ){ 
$query = mysqli_query($connect, "UPDATE judul SET
				  nm_judul = '$judul'
				  WHERE id_judul = '$id'");
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='judul' AND $aksi=='tambah' ){ 
	header('location:../../index.php?module='.$module);
$sql = "INSERT INTO judul  (id_judul, nm_judul) VALUES ('$id', '$judul')";
$simpan = mysqli_query($connect, $sql);
}
else if($module=='judul' AND $aksi=='edit' ){ 
 
	header('location:../../index.php?module='.$module);
	}
?>