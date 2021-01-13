<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_adu = $_POST['id_adu'];
$tanggal = $_POST['tanggal'];
$nm = $_POST['nm'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$isi = $_POST['isi'];
$isi = str_replace('<p>', '<p align="justify">', $isi);
$id_usr = $_SESSION['id_usr'];
$folder = "../../../img/profil/";

// HAPUS
if($module=='adu' AND $aksi=='hapus_item' ){ 
$id_adu_item = $_GET['id_adu_item'];
$id_adu= $_GET['id_adu'];
$mySql = "DELETE FROM trs_adu_item WHERE id_adu_item='$id_adu_item'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module.'&aksi=edit&id_adu='.$id_adu);
}
//edit

else if($module=='adu' AND $aksi=='edit' ){ 

$num = count($_POST['id_adu_item']);
echo $num ."<br>";
for ($j = 0; $j < $num; $j++) {
$id_adu_item = $_POST['id_adu_item'][$j];
if(isset($_POST['tanggal2'][$j])) {
    $tanggal2 = $_POST['tanggal2'][$j];
 	  $thn = substr($_POST['tanggal2'][$j],0,4);
	  $id_bln = substr($_POST['tanggal2'][$j],5,2);
	  $id_tgl = substr($_POST['tanggal2'][$j],-2,2);
}
$isi2 = $_POST['isi2'][$j];
//echo $id_alat ;
$cek = "0" ;
$qery1 = "select '1' as cek from trs_adu_item where id_adu='".$id_adu."' AND id_adu_item='".$id_adu_item."'";
echo $qery1."<br>"; 
$q = mysqli_query ($con,$qery1 );

while ($k = mysqli_fetch_array($q)){
	$cek = $k['cek'];
}
	echo $cek ."<br>"; 
	if ( $cek	 == '1' ) {	
		$quer2 = "UPDATE `trs_adu_item` SET `isi`='{$isi2}', `tanggal`='{$tanggal2}'
					WHERE `id_adu`='{$id_adu}' AND id_adu_item='{$id_adu_item}'";
			// echo $quer2 ."<br>";  
			$simpan = mysqli_query($con,"UPDATE `trs_adu_item` SET `isi`='{$isi2}', `tanggal`='{$tanggal2}'
					WHERE `id_adu`='{$id_adu}' AND id_adu_item='{$id_adu_item}'");
	}else{
		$mySql = "INSERT INTO `trs_adu_item` (`id_adu_item`,`id_adu`,`id_usr_tgp`, `isi`,`tanggal`, `id_tgl`, `id_bln`, `thn`) 
		VALUES ('','{$id_adu}','{$id_usr}','{$isi2}','{$tanggal2}', '{$id_tgl}', '{$id_bln}', '{$thn}')";
		 //echo $mySql ."<br>"; 
		 $simpan = mysqli_query($con,"INSERT INTO `trs_adu_item` (`id_adu_item`,`id_adu`,`id_usr_tgp`, `isi`,`tanggal`, `id_tgl`, `id_bln`, `thn`) 
		VALUES ('','{$id_adu}','{$id_usr}','{$isi2}','{$tanggal2}', '{$id_tgl}', '{$id_bln}', '{$thn}')");
	}
					
}

//echo $mysql;

header('location:../../index.php?module='.$module);				  
}
?>