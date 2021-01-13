<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_group = $_POST['id_group'];
$nama_group = $_POST['nama_group'];
// HAPUS
if($module=='group' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `group` WHERE id_group='".$_GET['id_group']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='group' AND $aksi=='edit' ){ 
$sql = "UPDATE `group`
		SET nama_group = '$nama_group'
		WHERE id_group='$id_group'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='group' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `group`  (id_group, nama_group) VALUES ('$id_group', '$nama_group')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>