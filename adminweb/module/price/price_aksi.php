<?php
include "../../../inc/koneksi.php";
include '../../../inc/cek_session.php';
include "../../../inc/compres_img.php";


$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_harga = $_POST['id_harga'];
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga_jual = $_POST['harga_jual'];
$harga_jual = str_replace(".", "", $harga_jual);
$harga_pasar = $_POST['harga_pasar'];
$harga_pasar = str_replace(".", "", $harga_pasar);
$sts_promo = $_POST['sts_promo'];
$tgl_awal_promo = $_POST['tgl_awal_promo'];
$tgl_akhir_promo = $_POST['tgl_akhir_promo'];
$sts_paket = $_POST['sts_paket'];
//$id_price= $_SESSION['id_price'];


// HAPUS
if($module=='price' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM harga WHERE id_harga='".$_GET['id_harga']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $myQry);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='price' AND $aksi=='edit' ){ 

$mysql="UPDATE harga SET				 				  				  				  
				  id_produk = '$id_produk',
				  nama_produk = '$nama_produk',
				  harga_jual = '$harga_jual',
				  harga_pasar = '$harga_pasar',
				  tgl_awal_promo = '$tgl_awal_promo',
				  tgl_akhir_promo = '$tgl_akhir_promo',	
				  sts_promo = '$sts_promo',
				  sts_paket = '$sts_paket'
				  WHERE id_harga = '$id_harga'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $query1);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='price' AND $aksi=='tambah' ){ 
	
$mySql = "INSERT INTO `harga` (`id_produk`, `nama_produk`, `harga_jual`, `harga_pasar`, `tgl_awal_promo`, `tgl_akhir_promo`, `sts_promo`,`sts_paket`) VALUES 
		('{$id_produk}','{$nama_produk}', '{$harga_jual}','{$harga_pasar}','{$tgl_awal_promo}', '{$tgl_akhir_promo}','{$sts_promo }','{$sts_paket }')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $simpa);}				  
header('location:../../index.php?module='.$module);
}
?>