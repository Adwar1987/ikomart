<?php
include "../../../inc/koneksi.php";


if (isset($_GET['id_prov'])) {
	$id_prov=$_GET['id_prov'];
	/* $kabupaten=substr($_GET['kabupaten'],0,4);
	$kecamatan=substr($_GET['kecamatan'],0,6);
	$kelurahan=substr($_GET['kelurahan'],0,10); */
	//echo $keyword;
	 $sql ="SELECT max(id_kab) as terakhir from `kabupaten` where id_prov ='$id_prov'";
	  $hasil = mysqli_query($con,$sql);
	  $data = mysqli_fetch_array($hasil);
	  $lastID = $data['terakhir'];
	  $nextID = $lastID + 1;;
	echo $nextID."|";
}

?>