<?php
include "../../../inc/koneksi.php";
include '../../inc/cek_session.php';

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_galeri = $_POST['id_galeri'];
$judul = $_POST['judul'];
$ket = $_POST['ket'];
if(isset($_POST["tanggal"])) {
    $tanggal = $_POST["tanggal"];
 	  $thn = substr($_POST["tanggal"],0,4);
	  $id_bln = substr($_POST["tanggal"],5,2);
	  $id_tgl = substr($_POST["tanggal"],-2,2);
     // $tanggal = $thn.'-'.$bln.'-'.$tgl; 
	 $id_hr = file_get_contents("http://www.rsstrokebkt.com/adminweb/inc/cek_idhari.php?tanggal=".$tanggal);
}

$foto_kecil_lama = $_POST['foto_kecil_lama'];
$id_usr= $_SESSION['id_usr'];
$folder = "../../../img/galeri/";
$folder_galery= $_POST['folder'];
$folder_galery= str_replace(" ", "_", $folder_galery);
$folder_galery= str_replace("/", "_", $folder_galery);

if (!file_exists($folder_galery)) {
    mkdir($folder.$folder_galery);
} 

$temp = $_FILES['foto_kecil']['tmp_name'];
$name = $_FILES['foto_kecil']['name'];
$name = $id_galeri."_".$name;
$foto_kecil =$name;
$size = $_FILES['foto_kecil']['size'];
$type = $_FILES['foto_kecil']['type'];


// HAPUS Detail galeri
if($module=='galeri' AND $aksi=='hapus_detail' ){ 
$mySql = "DELETE FROM mst_galeri_foto WHERE id_galeri='".$_GET['id_galeri']."' AND id_galeri_foto='".$_GET['id_galeri_foto']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	
//header('location:../../index.php?module='.$module);
header('location:../../index.php?module='.$module.'&aksi=edit&id_galeri='.$_GET['id_galeri']);
}

// HAPUS
if($module=='galeri' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM mst_galeri_foto WHERE id_galeri='".$_GET['id_galeri']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	

$mySql = "DELETE FROM mst_galeri WHERE id_galeri='".$_GET['id_galeri']."'";
$myQry = mysqli_query($con,$mySql);
if (!$myQry)
{ exit("Hapus Gagal: " . $result);}	

header('location:../../index.php?module='.$module);
}

//edit
else if($module=='galeri' AND $aksi=='edit' ){ 

//echo "size : ".$size."<br> type : ".$type."<br>";
// proses validasi
if ($size < 10240000 and $type =='image/jpeg') {
    // upload Process
    // insert data ke database
   /*   if( strlen($gbr_lama) > 0 ){
		$id_file = $gbr_lama ;
		echo "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'";
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{ 
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1; 

		echo "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ";
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");

	} */
		echo "Sukses Upload File";
	    move_uploaded_file($temp, $folder.$folder_galery."/".$name);
    // menampikan informasi file yang di upload
	
	
 }else{ 
    //echo "Gagal Upload File";
	$foto_kecil = $foto_kecil_lama ;
	//break;
} 

$mysql="UPDATE mst_galeri SET				 				  				  				  
				  tanggal = '$tanggal',
				  id_hr = '$id_hr',
				  id_tgl = '$id_tgl',
				  id_bln = '$id_bln',
				  thn = '$thn',
				  judul = '$judul',	
				  ket = '$ket',
			      foto_kecil = '$foto_kecil',
				  folder = '$folder_galery'
				  WHERE id_galeri = '$id_galeri'";
//echo $mysql;
$query1 = mysqli_query($con,$mysql);	
if (!$query1)
{ exit("Update Gagal: " . $result);}


$num = count($_POST['add_id_galeri_foto']);
//echo $num ."<br>";
for ($j = 0; $j < $num; $j++) {
	
	$temp = $_FILES['foto_kecil3']['tmp_name'][$j];
	$name = $_FILES['foto_kecil3']['name'][$j];
	$name = $id_galeri."_".$name;
	$foto_kecil2 =$name;
	$foto =$name;
	$size = $_FILES['foto_kecil3']['size'][$j];
	$type = $_FILES['foto_kecil3']['type'][$j];
	
	move_uploaded_file($temp, $folder.$folder_galery."/".$name);
	$mySql = "INSERT INTO `mst_galeri_foto`  (`id_galeri`, `foto_kecil`, `foto`)VALUES ( '{$id_galeri}', '{$foto_kecil2 }' ,'{$foto}')";
		echo $mySql;
	
	mysqli_query($con,$mySql) or die(mysqli_error());	
	
}


$num = count($_POST['id_galeri_foto']);
//echo $num ."<br>";
for ($j = 0; $j < $num; $j++) {
	$id_galeri_foto = $_POST['id_galeri_foto'][$j];
	$foto_kecil_lama2 = $_POST['foto_kecil_lama2'][$j];
	
	$temp = $_FILES['foto_kecil2']['tmp_name'][$j];
	$name = $_FILES['foto_kecil2']['name'][$j];
	$name = $id_galeri."_".$name;
	$foto_kecil2 =$name;
	$foto =$name;
	$size = $_FILES['foto_kecil2']['size'][$j];
	$type = $_FILES['foto_kecil2']['type'][$j];
	//echo $j."<br>";
	echo $foto_kecil_lama2;
	if (strlen($foto_kecil2) > 3){
		move_uploaded_file($temp, $folder.$folder_galery."/".$name);
		$mySql = "UPDATE `mst_galeri_foto`  SET `id_galeri` = '{$id_galeri}',  `foto_kecil` = '{$foto_kecil2 }' , `foto` = '{$foto}' WHERE `id_galeri_foto` = '{$id_galeri_foto}' ";
		//echo $mySql;
		mysqli_query($con,$mySql) or die(mysqli_error());	
	}
	
	
	
	
}

header('location:../../index.php?module='.$module);
		  
}
else if($module=='galeri' AND $aksi=='tambah' ){ 

// proses validasi
if ($size < 10240000 and $type =='image/jpeg') {
    // upload Process

    // insert data ke database
	/* if( strlen($gbr_lama) > 0 ){
		$id_file = $gbr_lama ;
		$datafile = mysqli_query($con, "Update file_dok set judul='$name',cover='$name',ukuran_file='$size' where id = '$id_file'");
	}else{
		$datafile = mysqli_query($con, "select max(id) as lastid from file_dok");
		$edit=mysqli_fetch_array($datafile);
		$id_file = $edit['lastid'] + 1;
		//echo $id_file;
		
		mysqli_query($con, "insert into file_dok (id,judul,cover,ukuran_file) values('$id_file','$name','$name','$size') ");
	} */
	move_uploaded_file($temp, $folder. $name);
	
}else{
    echo "Gagal Upload File";
	$foto_kecil = $foto_kecil_lama ;
}



$mySql = "INSERT INTO `rsstroke_db_rs`.`mst_galeri`(`id_galeri`,`judul`,`ket`,`folder`,`foto_kecil`,`id_hr`,`id_tgl`,`id_bln`,`thn`,`tanggal`) 
VALUES ('{$id_galeri}','{$judul}','{$ket}','{$folder_galery}','{$foto_kecil}','{$id_hr}','{$id_tgl}','{$id_bln}','{$thn}','{$tanggal}')";

//echo $mySql;
$simpa = mysqli_query($con,$mySql);
if (!$simpa)
{ exit("Simpan Gagal: " . $result);}	


$num = count($_POST['add_id_galeri_foto']);
for ($j = 0; $j < $num; $j++) {
$temp = $_FILES['foto_kecil2']['tmp_name'][$j];
$name = $_FILES['foto_kecil2']['name'][$j];
$name = $id_galeri."_".$name;
$foto_kecil2 =$name;
$foto =$name;
$size = $_FILES['foto_kecil2']['size'][$j];
$type = $_FILES['foto_kecil2']['type'][$j];

move_uploaded_file($temp, $folder.$folder_galery."/".$name);

$mySql = "INSERT INTO `mst_galeri_foto`  (`id_galeri`, `foto_kecil`, `foto`) 
       VALUES ( '{$id_galeri}', '{$foto_kecil2 }' ,'{$foto}')";
//echo $mySql;
mysqli_query($con,$mySql) or die(mysqli_error());	
}			  
header('location:../../index.php?module='.$module);
}
?>