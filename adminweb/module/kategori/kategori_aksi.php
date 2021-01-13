<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_kategori = $_POST['id_kategori'];
$nama = $_POST['nama'];
$id_kelompok = $_POST['id_kelompok'];
// HAPUS
if($module=='kategori' AND $aksi=='hapus' ){ 
	$mySql = "DELETE FROM categories WHERE id_kategori='".$_GET['id_kategori']."'";
	$myQry = mysqli_query($con,$mySql);
	header('location:../../index.php?module='.$module);
}
// EDIT
elseif($module=='kategori' AND $aksi=='edit' ){ 
	$sql = "UPDATE categories
			SET nama = '$nama',
				id_kelompok = '$id_kelompok'
			WHERE id_kategori='$id_kategori'";
	//echo $sql;
	$query = mysqli_query($con,$sql);
	header('location:../../index.php?module='.$module);
}
//Tambah
elseif($module=='kategori' AND $aksi=='tambah' ){ 	
	$sql = "INSERT INTO categories  (id_kategori, nama, id_kelompok) VALUES ('$id_kategori', '$nama', '$id_kelompok')";
	$simpan = mysqli_query($con,$sql);
	header('location:../../index.php?module='.$module);
}
?>