<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_kirim = $_POST['id_kirim'];
$nama_kirim = $_POST['nama_kirim'];
// HAPUS
if($module=='kirim' AND $aksi=='hapus' ){ 
$mySql = "DELETE from `mst_kirim` WHERE id_kirim='".$_GET['id_kirim']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='kirim' AND $aksi=='edit' ){ 
$sql = "UPDATE `mst_kirim`
		SET nama_kirim = '$nama_kirim'
		WHERE id_kirim='$id_kirim'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='kirim' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `mst_kirim`  (id_kirim, nama_kirim) VALUES ('$id_kirim', '$nama_kirim')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>