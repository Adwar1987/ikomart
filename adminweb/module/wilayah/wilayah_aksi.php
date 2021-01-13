<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_kab = $_POST['id_kab'];
$id_prov = $_POST['id_prov'];
$nama = $_POST['nama'];
// HAPUS
if($module=='wilayah' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `kabupaten` WHERE id_kab='".$_GET['id_kab']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='wilayah' AND $aksi=='edit' ){ 
$sql = "UPDATE `kabupaten`
		SET id_prov = '$id_prov', nama = '$nama'
		WHERE id_kab='$id_kab'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='wilayah' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `kabupaten`  (id_kab, nama, id_prov) VALUES ('$id_kab', '$nama', '$id_prov')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?> 