<?php
include "../../../inc/koneksi.php";
$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_sk = $_POST['id_sk'];
$nm_sk = $_POST['nm_sk'];
$no_sk = $_POST['no_sk'];
$dokumen_lama = $_POST['dokumen_lama'];
$id_file ='';
$folder = "../../../files/peraturan/";

$temp = $_FILES['dokumen']['tmp_name'];
$name = $_FILES['dokumen']['name'];
$name = $no_sk."_".$name;
$size = $_FILES['dokumen']['size'];
$type = $_FILES['dokumen']['type'];

// HAPUS
if($module=='peraturan' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM peraturan WHERE id_sk='".$_GET['id_sk']."'";
$myQry = mysqli_query($con,$mySql);
header('location:../../index.php?module='.$module);
}
//edit
else if($module=='peraturan' AND $aksi=='edit' ){ 

// proses validasi
if ($size < 10240000 and $type =='application/pdf') {
    // upload Process
    // insert data ke database
     if( strlen($dokumen_lama) > 0 ){
		$id_file = $dokumen_lama ;
		echo "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'";
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{ 
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1; 

		echo "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ";
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");

	}
		//echo "Sukses Upload File";
	    move_uploaded_file($temp, $folder . $name);
    // menampikan informasi file yang di upload
	
 }else{ 
    echo "Gagal Upload File";
	$id_file = $dokumen_lama ;
	//break;
} 
	
//echo $id_file;
$query1 = mysqli_query($con,"UPDATE peraturan SET		
				  nm_sk = '$nm_sk',
				  no_sk = '$no_sk',
				  dokumen = '$id_file'
				  WHERE id_sk = '$id_sk'");	
header('location:../../index.php?module='.$module);				  
}
else if($module=='peraturan' AND $aksi=='tambah' ){ 

// proses validasi
if ($size < 10240000 and $type =='application/pdf') {
    // upload Process

    // insert data ke database
	if( strlen($dokumen_lama) > 0 ){
		$id_file = $dokumen_lama ;
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1;
		//echo $id_file;
		
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");
	}
	move_uploaded_file($temp, $folder . $name);
}else{
    echo "Gagal Upload File";
}


$mySql = "INSERT INTO peraturan  (id_sk, nm_sk, no_sk, dokumen) VALUES ( '{$id_sk}','{$nm_sk}','{$no_sk}', '{$id_file }')";
//echo $mySql;
$simpa = mysqli_query($con,$mySql);
				  
header('location:../../index.php?module='.$module);
}
?>