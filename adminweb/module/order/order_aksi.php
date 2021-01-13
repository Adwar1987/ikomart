<?php
include "../../../inc/koneksi.php";
include '../../../inc/cek_session.php';
include "../../../inc/compres_img.php";


$module=$_GET['module'];
$aksi=$_GET['aksi'];
$id_order = $_POST['id_order'];
$sts_bayar = $_POST['sts_bayar'];
$sts_kirim = $_POST['sts_kirim'];
$sts_terima = $_POST['sts_terima'];
$tgl_bayar = $_POST['tgl_bayar'];
//$id_price= $_SESSION['id_price'];


// HAPUS
 if($module=='order' AND $aksi=='edit' ){ 

 	if($sts_kirim=='1'){
	  	// hitung jumlah produk pesanan
		$num = count($_POST['id_produk']);
						//echo $num ;
		for ($j = 0; $j < $num; $j++) {
			$id_produk = $_POST['id_produk'][$j];
			$jml = $_POST['jml'][$j];
			$harga = $_POST['harga'][$j];
			$mySql = "UPDATE `produk` SET  `stok` = `stok` - '$jml'
						WHERE  id_produk = '$id_produk'";
			//echo $mySql;
			$simpa = mysqli_query($con,$mySql);
			 if (!$simpa)
				{ exit("Simpan Gagal: " . $simpa);}
		}  
	}

	$mysql="UPDATE `order` SET				 				  				  				  
				  tgl_bayar = '$tgl_bayar',
				  sts_bayar = '$sts_bayar',
				  sts_kirim = '$sts_kirim',
				  sts_terima = '$sts_terima'
				  WHERE id_order = '$id_order'";
	//echo $mysql;
	$query1 = mysqli_query($con,$mysql);	
	if (!$query1)
	{ exit("Update Gagal: " . $result);}
	header('location:../../index.php?module='.$module);				  
}

?>