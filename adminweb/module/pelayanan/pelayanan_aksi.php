<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_profil = $_POST['id_profil'];
$keterangan = $_POST['keterangan'];
$isi = $_POST['isi'];
$isi = str_replace('<p>', '<p align="justify">', $isi);

$folder = "../../../img/profil/";

$temp = $_FILES['img']['tmp_name'];
$name = $_FILES['img']['name'];
$name = $id_berita."_".$name;
$img =$name;
$size = $_FILES['img']['size'];
$type = $_FILES['img']['type'];

// HAPUS
if($module=='profil' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_profil WHERE id_profil='".$_GET['id_profil']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='profil' AND $aksi=='edit' ){ 
/* 
echo "size : ".$size."<br> type : ".$type."<br>";
// proses validasi
if ($size < 10240000 and $type =='image/jpeg') {
    // upload Process
    // insert data ke database
      if( strlen($gbr_lama) > 0 ){
		$id_file = $gbr_lama ;
		echo "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'";
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{ 
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1; 

		echo "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ";
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");

	} 
		echo "Sukses Upload File";
	    move_uploaded_file($temp, $folder . $name);
    // menampikan informasi file yang di upload
	$gbr = $img ;
	
 }else{ 
    echo "Gagal Upload File";
	$img = $img_lama ;
	$gbr = $img ;
	//break;
}  */

$mysql="UPDATE mst_profil SET				 				  				  				  
				  id_profil = '$id_profil',
				  keterangan = '$keterangan',	
				  isi = '$isi'
				  WHERE id_profil = '$id_profil'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}
header('location:../../index.php?module='.$module);				  
}
else if($module=='profil' AND $aksi=='tambah' ){ 

/* 
// proses validasi
if ($size < 10240000 and $type =='image/jpeg') {
    // upload Process

    // insert data ke database
	 if( strlen($gbr_lama) > 0 ){
		$id_file = $gbr_lama ;
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1;
		//echo $id_file;
		
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");
	} 
	move_uploaded_file($temp, $folder . $name);
	
	$gbr = $img ;
}else{
    echo "Gagal Upload File";
	$gbr = $img ;
}
 */

$mySql = "INSERT INTO `rsstroke_db_rs`.`mst_profil` (`id_profil`,`keterangan`, `isi`) VALUES ('{$id_profil}','{$keterangan}','{$isi}')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}				  
header('location:../../index.php?module='.$module);
}
?>