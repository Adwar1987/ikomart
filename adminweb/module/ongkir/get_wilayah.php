<?php
include "../../../inc/koneksi.php";


if (isset($_GET['id_prov'])) {
	$id_prov=$_GET['id_prov'];
	//echo $keyword;
	/* $sql ="SELECT * from `kabupaten` where id_prov ='$id_prov'";
	  $hasil = mysqli_query($con,$sql);
	  $data = mysqli_fetch_array($hasil);
	  $nama = $data['nama'];*/
	//echo $nama."|";
	echo '<option data-value=" "> -- Wilayah -- </option>';
	$q = mysqli_query ($con,"select * from `kabupaten` where id_prov ='$id_prov'");
	while ($k = mysqli_fetch_array($q)){ 
		echo '<option value="'.$k['id_kab'].'" >'.$k['nama'].'</option>';
	}
}

if (isset($_GET['id_kab'])) {
	$id_kab=$_GET['id_kab'];
	/* $kabupaten=substr($_GET['kabupaten'],0,4);
	$kecamatan=substr($_GET['kecamatan'],0,6);
	$kelurahan=substr($_GET['kelurahan'],0,10); */
	//echo $keyword;
	 $sql ="SELECT *from `kabupaten` where id_kab ='$id_kab'";
	 //echo $sql;
	  $hasil = mysqli_query($con,$sql);
	  $data = mysqli_fetch_array($hasil);
	  $nama = $data['nama'];
	echo $nama."|";
	echo '<option data-value=" "> -- Wilayah -- </option>';
	$q = mysqli_query ($con,"select * from `kecamatan` where id_kab ='$id_kab'");
	while ($k = mysqli_fetch_array($q)){ 
		echo '<option value="'.$k['id_kec'].'" >'.$k['nama'].'</option>';
	}
}

if (isset($_GET['id_kec'])) {
	$id_kec=$_GET['id_kec'];
	//echo $keyword;
	$sql ="SELECT * from `kecamatan` where id_kec ='$id_kec'";
	  $hasil = mysqli_query($con,$sql);
	  $data = mysqli_fetch_array($hasil);
	  $nama = $data['nama'];
	echo $nama."|";
	echo '<option data-value=" "> -- Wilayah -- </option>';
	$q = mysqli_query ($con,"select * from `kelurahan` where id_kec ='$id_kec'");
	while ($k = mysqli_fetch_array($q)){ 
		echo '<option value="'.$k['id_kel'].'" >'.$k['nama'].'</option>';
	}
}

if (isset($_GET['id_kel'])) {
	$id_kel=$_GET['id_kel'];
	//echo $keyword;
	$sql ="SELECT * from `kelurahan` where id_kel ='$id_kel'";
	  $hasil = mysqli_query($con,$sql);
	  $data = mysqli_fetch_array($hasil);
	  $nama = $data['nama'];
	echo $nama."|";
}


?>