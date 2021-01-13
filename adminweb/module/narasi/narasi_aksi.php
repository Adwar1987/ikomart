<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_narasi = $_POST['id_narasi'];
$judul = $_POST['judul'];
$tanggal = $_POST["tanggal"];

// HAPUS
if($module=='narasi' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_narasi WHERE id_narasi='".$_GET['id_narasi']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='narasi' AND $aksi=='edit' ){ 

$mysql="UPDATE mst_narasi SET				 				  				  				  
				  tanggal = '$tanggal',
				  judul = '$judul',	
				  id_usr = '$id_usr'
				  WHERE id_narasi = '$id_narasi'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='narasi' AND $aksi=='tambah' ){ 

$mySql = "INSERT INTO `mst_narasi` (`id_narasi`, `id_usr`, `judul`,`tanggal`) VALUES ('{$id_narasi}','{$id_usr}', '{$judul}','{$tanggal}')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}				  
header('location:../../index.php?module='.$module);
}
?>