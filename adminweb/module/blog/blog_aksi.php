<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_blog = $_POST['id_blog'];
$nama_blog = $_POST['nama_blog'];
// HAPUS
if($module=='blog' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM `blog` WHERE id_blog='".$_GET['id_blog']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='blog' AND $aksi=='edit' ){ 
$sql = "UPDATE `blog`
		SET nama_blog = '$nama_blog'
		WHERE id_blog='$id_blog'";
//echo $sql;
$query = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='blog' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO `blog`  (id_blog, nama_blog) VALUES ('$id_blog', '$nama_blog')";
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>