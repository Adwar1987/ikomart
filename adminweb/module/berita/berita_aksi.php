<?php
include "../../../inc/koneksi.php";
include '../../../inc/cek_session.php';
include "../../../inc/compres_img.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_berita = $_POST['id_berita'];
$judul = mysqli_real_escape_string($con,$_POST['judul']);
$sum = mysqli_real_escape_string($con,$_POST['sum']);
$id_blog = $_POST['id_blog'];
$alias = mysqli_real_escape_string($con,$_POST['alias']);
$sum = str_replace("<p>", "", $sum);
$sum = str_replace("</p>", "", $sum);
$link = $_POST['link'];
$sumber = mysqli_real_escape_string($con,$_POST['sumber']);
$tanggal = $_POST["tanggal"];
$isi = mysqli_real_escape_string($con,$_POST['isi']);
$isi = str_replace('<p>', '<p align="justify">', $isi);
$img_lama = $_POST['img_lama'];
$iduser= $_SESSION['id'];

$folder = "../../../image/blog/";

$type = '';
$img = '';
if(!empty($_FILES['img']['tmp_name'])){
	$temp = $_FILES['img']['tmp_name'];
	$name = $_FILES['img']['name'];
	$name = $id_berita."_".$name;
	$img =$name;
	$size = $_FILES['img']['size'];
	$type = $_FILES['img']['type'];
	$DOCS_SIZE = getimagesize($_FILES['img']['tmp_name']);
}

// HAPUS
if($module=='berita' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_berita WHERE id_berita='".$_GET['id_berita']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='berita' AND $aksi=='edit' ){ 

//echo "size : ".$size."<br> type : ".$type."<br>";
// proses validasi
if ( $type== "image/gif" OR $type== "image/png" OR $type== "image/jpg" OR $type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/PNG" OR $type== "image/GIF") {
    // upload Process
		// move_uploaded_file($temp, $folder . $name);
		 $file='img'; //name pada inputan type file
		 $width=410;//satuan dalam pixel / px
		 $src_width = $DOCS_SIZE[0];
		 $src_height = $DOCS_SIZE[1];
		 $height = ($width/$src_width)*$src_height;
 		/* if($type== "image/jpeg" OR $type== "image/JPEG" ){
			// echo $folder.$name;
			UploadImageResizejpeg($name,$file,$folder,$width);
		 }elseif($type== "image/png" OR $type== "image/PNG" ){
			UploadImageResizepng($name,$file,$folder,$width);
		 }elseif($type== "image/gif" OR $type== "image/GIF" ){
			UploadImageResizegif($name,$file,$folder,$width);
		 } */ 
		resize($name, $_FILES["img"], $folder, $width, $height);
    // menampikan informasi file yang di upload
	$gbr = $img ;
	
 }else{ 
   // echo "Gagal Upload File";
	$img = $img_lama ;
	$gbr = $img ;
	//break;
} 

$mysql="UPDATE mst_berita SET				 				  				  				  
				  tanggal = '$tanggal',
				  judul = '$judul',	
				  sumber = '$sumber',
				  id_blog = '$id_blog',
				  alias = '$alias',
				  isi = '$isi',
				  link = '$link',
				  sum = '$sum',
				  gbr = '$gbr',
				  img = '$img',
				  iduser = '$iduser'
				  WHERE id_berita = '$id_berita'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='berita' AND $aksi=='tambah' ){ 

// proses validasi
if ( $type== "image/gif" OR $type== "image/png" OR $type== "image/jpg" OR $type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/PNG" OR $type== "image/GIF") {
    // upload Process
		// move_uploaded_file($temp, $folder . $name);
		 $file='img'; //name pada inputan type file
		 $width=410;//satuan dalam pixel / px
 	/*	 if($type== "image/jpeg" OR $type== "image/JPEG" ){
			UploadImageResizejpeg($name,$file,$folder,$width);
		 }elseif($type== "image/png" OR $type== "image/PNG" ){
			UploadImageResizepng($name,$file,$folder,$width);
		 }elseif($type== "image/gif" OR $type== "image/GIF" ){
			UploadImageResizegif($name,$file,$folder,$width);
		 }  */
		resize($name, $_FILES["img"], $folder, $width, $width);
	$gbr = $img ;
}else{
    //echo "Gagal Upload File";
	$gbr = $img ;
}


$mySql = "INSERT INTO `mst_berita` ( `iduser`, `judul`, `id_blog`, `alias`, `isi`, `sumber`, `link`, `folder`, `gbr`, `tanggal`, `img`, `sum`) VALUES ('{$iduser}', '{$judul}','{$id_blog}','{$alias}','{$isi}','{$sumber}', '{$link}','-', '{$gbr }','{$tanggal}','{$img}', '{$sum }')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}				  
header('location:../../index.php?module='.$module);
}
?>