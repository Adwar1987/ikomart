<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_jns_kontrak = $_POST['id_jns_kontrak'];
$jns_kontrak = $_POST['jns_kontrak'];
// HAPUS
if($module=='mst_kontrak' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_kontrak WHERE id_jns_kontrak='".$_GET['id_jns_kontrak']."'";
//echo $mySql ;
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='mst_kontrak' AND $aksi=='edit' ){ 	
$sql = "UPDATE mst_kontrak SET
				  jns_kontrak = '$jns_kontrak'
				  WHERE id_jns_kontrak = '$id_jns_kontrak'";
//echo $sql;
$query = mysqli_query($con,$sql);
				  
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='mst_kontrak' AND $aksi=='tambah' ){ 	
$sql = "INSERT INTO mst_kontrak  (id_jns_kontrak, jns_kontrak) VALUES ('$id_jns_kontrak', '$jns_kontrak')";
//echo $sql;
$simpan = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
?>