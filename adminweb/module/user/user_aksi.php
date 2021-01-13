<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$user = $_POST['user'];
$pass = md5($_POST['pass']);
$nama = $_POST['nama'];
$id_unit_krj = $_POST['id_unit_krj'];
$level = $_POST['level'];
$no_hp = $_POST['no_hp'];

// HAPUS
if($module=='user' AND $aksi=='no' ){ 
$sql = "UPDATE user SET blokir='N' WHERE id_user = '".$_GET['id_user']."'";
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='user' AND $aksi=='yes' ){ 
$sql = "UPDATE user SET blokir='Y' WHERE id_user = '".$_GET['id_user']."'";
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='user' AND $aksi=='tambah' ){ 
	
$sql = "INSERT INTO user  (user, pass, nama, id_unit_krj, level, no_hp, blokir ) 
	VALUES ('$user', '$pass', '$nama', 'id_unit_krj', '$level','$no_hp', 'N')";
$simpan = mysqli_query($con,$sql);
}
header('location:../../index.php?module='.$module);
?>