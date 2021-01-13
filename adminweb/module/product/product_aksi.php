<?php
include "../../../inc/koneksi.php";
include '../../../inc/cek_session.php';
include "../../../inc/compres_img.php";


$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_produk = $_POST['id_produk'];
$id_penjual = $_POST['id_penjual'];
$nama_produk = mysqli_real_escape_string($con,$_POST['nama_produk']);
$merk = mysqli_real_escape_string($con,$_POST['merk']);
$ukuran = mysqli_real_escape_string($con,$_POST['ukuran']);
$berat = $_POST['berat'];
$stok = $_POST['stok'];
$dijual = $_POST['dijual'];
$dikirim = $_POST['dikirim'];
$alias = $_POST['alias'];
//$id_group = $_POST['id_group'];
$id_kelompok = $_POST['id_kelompok'];
$id_kategori = $_POST['id_kategori'];
$sts_aktif = $_POST['sts_aktif'];
$deskripsi = $_POST['deskripsi'];
$deskripsi = str_replace('<p>', '<p align="justify">', $deskripsi);
$gambar_lama = $_POST['gambar_lama'];
//$id_upload= $_SESSION['id_upload'];

$folder = "../../../image/produk/";

$type = '';
$img = '';
if(!empty($_FILES['gambar']['tmp_name'])){
	$temp = $_FILES['gambar']['tmp_name'];
	$names = $_FILES['gambar']['name'];
	$arraynames = explode('.', $_FILES['gambar']['name']);
	$extension = end($arraynames);
	$name = $alias."_".$id_produk.".".$extension ;
	$img =$name;
	$size = $_FILES['gambar']['size'];
	$type = $_FILES['gambar']['type'];
}
$id_group="";
if(isset($_POST['baris'])){
	$num = count($_POST['baris']);
	//echo $num ;
	for ($j = 0; $j < $num; $j++) {
		$id_akses = $_POST['baris'][$j];
		$cek_indi = $id_akses ;
		if($cek_indi!=""){
		$id_group=$cek_indi.",".$id_group;}
		//echo $id ."-".$cek_indi;echo "<br>";
	}
}

// HAPUS
if($module=='product' AND $aksi=='hapus' ){ 
$mySql = "UPDATE produk SET sts_aktif='0' WHERE id_produk='".$_GET['id_produk']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='product' AND $aksi=='edit' ){ 

//echo "size : ".$size."<br> type : ".$type."<br>";
// proses validasi
//if ($size < 10240000 and ( $type== "image/gif" OR $type== "image/png" OR $type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/PNG" OR $type== "image/GIF")) {
if ( $type== "image/gif" OR $type== "image/png"  OR $type== "image/jpeg" OR $type== "image/jpg" OR $type== "image/JPEG" OR $type== "image/PNG" OR $type== "image/GIF") {
    // upload Process
		// move_uploaded_file($temp, $folder . $name);
		 $file='gambar'; //name pada inputan type file
		 $width=410;//satuan dalam pixel / px
 		 if($type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/jpg" ){
			UploadImageResizejpeg($name,$file,$folder,$width);
		 }elseif($type== "image/png" OR $type== "image/PNG" ){
			UploadImageResizepng($name,$file,$folder,$width);
		 }elseif($type== "image/gif" OR $type== "image/GIF" ){
			UploadImageResizegif($name,$file,$folder,$width);
		 }  
		//resize($name, $_FILES["gambar"], $folder, $width, $width);
    // menampikan informasi file yang di upload
	$gbr = $img ;
	//echo "Sukses Upload File";
 }else{ 
   
	$img = $gambar_lama ;
	$gbr = $img ;
	 //echo "Gagal Upload File";
	//break;
} 

$mysql="UPDATE produk SET				 				  				  				  
				  nama_produk = '$nama_produk',
				  deskripsi = '$deskripsi',
				  ukuran = '$ukuran',
				  merk = '$merk',
				  deskripsi = '$deskripsi',
				  id_group = '$id_group',	
				  id_kelompok = '$id_kelompok',
				  id_kategori = '$id_kategori',
				  alias = '$alias',
				  berat = '$berat',
				  stok = '$stok',
				  dijual = '$dijual',
				  dikirim = '$dikirim',
				  sts_aktif = '$sts_aktif',
				  gambar = '$gbr',
				  id_penjual = '$id_penjual'
				  WHERE id_produk = '$id_produk'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $query1);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='product' AND $aksi=='tambah' ){ 

// proses validasi
if ( $type== "image/gif" OR $type== "image/png" OR $type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/jpg" OR $type== "image/PNG" OR $type== "image/GIF") {
    // upload Process
		// move_uploaded_file($temp, $folder . $name);
		 $file='gambar'; //name pada inputan type file
		 $width=410;//satuan dalam pixel / px
 		 if($type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/jpg"){
			UploadImageResizejpeg($name,$file,$folder,$width);
		 }elseif($type== "image/png" OR $type== "image/PNG" ){
			UploadImageResizepng($name,$file,$folder,$width);
		 }elseif($type== "image/gif" OR $type== "image/GIF" ){
			UploadImageResizegif($name,$file,$folder,$width);
		 }
		 //resize($name, $_FILES["gambar"], $folder, $width, $width);
	
	//$img = "/img/product/".$img ;
	$gbr = $img ;
	//echo "Sukses Upload File";
	
}else{
    //echo "Gagal Upload File";
	$img = $gambar_lama ;
	$gbr = $img ;
}

$mySql = "INSERT INTO `produk` (`nama_produk`, `deskripsi`, `ukuran`, `berat`, `id_group`, `id_kelompok`, `id_kategori`, `merk`, `gambar`, `alias`, `stok`, `dijual`, `dikirim`,`id_penjual`,`sts_aktif`)
		 VALUES 
		('{$nama_produk}', '{$deskripsi}','{$ukuran}','{$berat}','{$id_group}', '{$id_kelompok}','{$id_kategori }','{$merk}','{$gbr}', '{$alias }', '{$stok }', '{$dijual }', '{$dikirim }', '{$id_penjual }', '{$sts_aktif }')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $simpa);}

header('location:../../index.php?module='.$module);
}
?>