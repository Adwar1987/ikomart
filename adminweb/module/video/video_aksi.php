<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_video = $_POST['id_video'];
$judul = $_POST['judul'];
$sum = $_POST['sum'];
$sum = str_replace('<p>', '<p align="justify">', $sum);
$link = $_POST['link'];
$sumber = $_POST['sumber'];
if(isset($_POST["tanggal"])) {
    $tanggal = $_POST["tanggal"];
 	  $thn = substr($_POST["tanggal"],0,4);
	  $id_bln = substr($_POST["tanggal"],5,2);
	  $id_tgl = substr($_POST["tanggal"],-2,2);
    echo $thn.'-'.$id_bln.'-'.$id_tgl; 
     $id_hr = file_get_contents("http://www.rsstrokebkt.com/adminweb/inc/cek_idhari.php?tanggal=".$tanggal);
}
$id_usr= $_SESSION['id_usr'];



// HAPUS
if($module=='video' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_video WHERE id_video='".$_GET['id_video']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='video' AND $aksi=='edit' ){ 

$mysql="UPDATE mst_video SET				 				  				  				  
				  tanggal = '$tanggal',
				  id_hr = '$id_hr',
				  id_tgl = '$id_tgl',
				  id_bln = '$id_bln',
				  thn = '$thn',
				  judul = '$judul',	
				  sumber = '$sumber',
				  link = '$link',
				  sum = '$sum',
				  id_usr = '$id_usr'
				  WHERE id_video = '$id_video'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='video' AND $aksi=='tambah' ){ 



$mySql = "INSERT INTO `rsstroke_db_rs`.`mst_video` (`id_video`, `id_usr`, `judul`, `sumber`, `link`, `folder`, `id_tgl`, `id_hr`, `id_bln`, `thn`, `tanggal`, `img`, `sum`) 
VALUES ('{$id_video}','{$id_usr}', '{$judul}', '{$sumber}', '{$link}','-','{$id_tgl}','{$id_hr}', '{$id_bln }', '{$thn }','{$tanggal}','{$img}', '{$sum }')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}				  
header('location:../../index.php?module='.$module);
}
?>