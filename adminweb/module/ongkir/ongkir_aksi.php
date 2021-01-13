<?php
include "../../../inc/koneksi.php";
 
$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_ongkir = $_POST['id_ongkir'];
$id_kel = $_POST['id_kel'];
$id_kec = $_POST['id_kec'];
$id_kab = $_POST['id_kab'];
$id_prov = $_POST['id_prov'];
$nama = $_POST['nama'];
$ongkir = $_POST['ongkir'];
$id_kirim = $_POST['id_kirim'];
$waktu_kirim = $_POST['waktu_kirim'];
$sts_aktif = $_POST['sts_aktif'];
// HAPUS
if($module=='ongkir' AND $aksi=='hapus' ){ 
$mySql = "UPDATE `ongkir` SET sts_aktif='0' WHERE id_ongkir='".$_GET['id_ongkir']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='ongkir' AND $aksi=='edit' ){ 
$sql = "UPDATE `ongkir`
		SET id_prov = '$id_prov', id_kab = '$id_kab', id_kec = '$id_kec', id_kel = '$id_kel', nama = '$nama', ongkir = '$ongkir', id_kirim = '$id_kirim', sts_aktif = '$sts_aktif', waktu_kirim = '$waktu_kirim'
		WHERE id_ongkir='$id_ongkir'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='ongkir' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `ongkir`  (id_kab, nama, id_prov, id_kel, id_kec, ongkir, id_kirim, waktu_kirim, sts_aktif) VALUES ('$id_kab', '$nama', '$id_prov', '$id_kel', '$id_kec', '$ongkir', '$id_kirim', '$waktu_kirim', '1')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>