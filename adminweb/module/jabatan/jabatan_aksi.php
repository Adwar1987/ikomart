<?php
include "../../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_jabatan'];
$jabatan = $_POST['nm_jabatan'];
// HAPUS
if($module=='jabatan' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM jabatan WHERE id_jabatan='".$_GET['id_jabatan']."'";
$myQry = mysqli_query($connect, $mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='jabatan' AND $aksi=='edit' ){ 
$query = mysqli_query($connect, "UPDATE jabatan SET
				  nm_jabatan = '$jabatan'
				  WHERE id_jabatan = '$id'");
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='jabatan' AND $aksi=='tambah' ){ 
	header('location:../../index.php?module='.$module);
$sql = "INSERT INTO jabatan  (id_jabatan, nm_jabatan) VALUES ('$id', '$jabatan')";
$simpan = mysqli_query($connect, $sql);
}
else if($module=='jabatan' AND $aksi=='edit' ){ 
 
	header('location:../../index.php?module='.$module);
	}
?>