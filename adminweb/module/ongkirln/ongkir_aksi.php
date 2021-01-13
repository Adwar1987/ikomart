<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_negara = $_POST['id_negara'];
$nm_negara = $_POST['nm_negara'];
$tarif = $_POST['tarif'];
// HAPUS
if($module=='ongkirln' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `negara` WHERE id_negara='".$_GET['id_negara']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='ongkirln' AND $aksi=='edit' ){ 
$sql = "UPDATE `negara`
		SET nm_negara = '$nm_negara', tarif = '$tarif'
		WHERE id_negara='$id_negara'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='ongkirln' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `negara`  (id_negara, nm_negara, tarif) VALUES ('$id_negara', '$nm_negara', '$tarif')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>