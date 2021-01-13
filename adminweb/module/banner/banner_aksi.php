<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_banner = $_POST['id_banner'];
$judul = $_POST['judul'];
$sts_tampil = $_POST['sts_tampil'];
$tanggal = $_POST["tanggal"];

$foto_lama = $_POST['foto_lama'];
$id_usr= $_SESSION['id_usr'];
$folder = "../../../img/banner/";
$folder_galery= $_POST['folder'];
$folder_galery= str_replace(" ", "_", $folder_galery);
$folder_galery= str_replace("/", "_", $folder_galery);

if (!file_exists($folder_galery)) {
    mkdir($folder.$folder_galery);
} 

$temp = $_FILES['foto']['tmp_name'];
$name = $_FILES['foto']['name'];
$name = str_replace(" ", "_", $name);
$name = trim($id_banner)."_".$name;
$foto =$name;
$size = $_FILES['foto']['size'];
$type = $_FILES['foto']['type'];
//echo $size ;

// HAPUS
if($module=='banner' AND $aksi=='hapus' ){ 

$mySql = "DELETE FROM mst_banner WHERE id_banner='".$_GET['id_banner']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	

header('location:../../index.php?module='.$module);
}

//edit
else if($module=='banner' AND $aksi=='edit' ){ 

//echo "size : ".$size."<br> type : ".$type."<br>";
// proses validasi
if ( $size < 10240000 and ( $type =='image/jpeg' || $type =='image/jpg')) {
    // upload Process
	    move_uploaded_file($temp, $folder.$folder_galery."/".$name);
    // menampikan informasi file yang di upload
	
	
 }else{ 
    //echo "Gagal Upload File";
	$foto = $foto_lama ;
	//echo $foto ;
	//break;
} 

$mysql="UPDATE mst_banner SET				 				  				  				  
				  tanggal = '$tanggal',
				  judul = '$judul',	
				  sts_tampil = '$sts_tampil',	
			      foto = '$foto'
				  WHERE id_banner = '$id_banner'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}

header('location:../../index.php?module='.$module);
		  
}
else if($module=='banner' AND $aksi=='tambah' ){ 

// proses validasi
if ($size < 10240000 and ( $type =='image/jpeg' || $type =='image/jpg')) {
    // upload Process
	move_uploaded_file($temp, $folder.$folder_galery."/".$name);
	
}else{
    //echo "Gagal Upload File";
	$foto = $foto_lama ;
}



$mySql = "INSERT INTO `mst_banner`(`id_banner`,`judul`,`foto`,`tanggal`,`sts_tampil`) 
VALUES ('{$id_banner}','{$judul}','{$foto}','{$tanggal}','{$sts_tampil}')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}		

header('location:../../index.php?module='.$module);
}
?>