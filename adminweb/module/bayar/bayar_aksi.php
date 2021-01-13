<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_bayar = $_POST['id_bayar'];
$nama_bayar = $_POST['nama_bayar'];
// HAPUS
if($module=='bayar' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `mst_bayar` WHERE id_bayar='".$_GET['id_bayar']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='bayar' AND $aksi=='edit' ){ 
$sql = "UPDATE `mst_bayar`
		SET nama_bayar = '$nama_bayar'
		WHERE id_bayar='$id_bayar'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='bayar' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `mst_bayar`  (id_bayar, nama_bayar) VALUES ('$id_bayar', '$nama_bayar')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>