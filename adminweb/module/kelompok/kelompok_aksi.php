<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_kelompok = $_POST['id_kelompok'];
$nama_kelompok = $_POST['nama_kelompok'];
$deskripsi_kelompok = $_POST['deskripsi_kelompok'];
// HAPUS
if($module=='kelompok' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `kelompok` WHERE id_kelompok='".$_GET['id_kelompok']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='kelompok' AND $aksi=='edit' ){ 
$sql = "UPDATE `kelompok`
		SET nama_kelompok = '$nama_kelompok',
			deskripsi_kelompok = '$deskripsi_kelompok'
		WHERE id_kelompok='$id_kelompok'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='kelompok' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `kelompok`  (id_kelompok, nama_kelompok, deskripsi_kelompok) VALUES ('$id_kelompok', '$nama_kelompok', '$deskripsi_kelompok')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>