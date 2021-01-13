<?php
include "../inc/koneksi.php";
include "../inc/inc.library.php";
include "../inc/compres_img.php";

session_start();
$id_user = '';
	if(!empty($_SESSION['id_user_pelanggan'])) {
	 	$id_user=$_SESSION['id_user_pelanggan'];
	 }else{
	 	echo "<script type='text/javascript'>alert('Anda Belum login, Silahkan login..!');
		location.href = '../?module=login';
		</script>";
	}
$ipuser='';	
$id_produk ='';
$ulasan = '';
$id_order = '';
if (isset($_POST['ipuser'])){
	$ipuser = ($_POST['ipuser']);
}
if (isset($_POST['id_produk2'])){
	$id_produk = ($_POST['id_produk2']);
}
if (isset($_POST['ulasan'])){
	$ulasan = ($_POST['ulasan']);
}
if (isset($_POST['id_order'])){
	$id_order = ($_POST['id_order']);
}

date_default_timezone_set('Asia/Jakarta'); 
$tgl_rate= date('Y-m-d');


if (isset($_POST['rating']) && is_numeric($_POST['rating'])) {
    $rate = $con->real_escape_string($_POST['rating']);

    //cek apakah user telah memberi penilaian
	
	$sqlproduk = "SELECT * FROM `rating` WHERE id_user_pelanggan = '" . $id_user . "' AND id_produk = '" . $id_produk . "'";
	$result= mysqli_query($con,$sqlproduk );
	//echo $sqlproduk;
    //hitung row
	$row_cnt = mysqli_num_rows($result);
    if ($row_cnt > 0) {
        //lakukan update jika user sudah pernah menilai
		$mySql = "UPDATE `rating` SET `rate` = '" . $rate . "',`ulasan` = '" . $ulasan . "',`tgl_rate` = '" . $tgl_rate . "' WHERE `id_user_pelanggan` = '" . $id_user . "' AND id_produk = '" . $id_produk . "'";
    } else {
        //simpan jika user belum pernah menilai
		$mySql = "INSERT INTO `rating` (`ipuser`,`rate`,`id_user_pelanggan`,`id_produk`,`ulasan`, `tgl_rate`) VALUES ('" . $ipuser . "', '" . $rate . "', '" . $id_user . "', '" . $id_produk . "', '" . $ulasan . "', '" . $tgl_rate . "')";
    }
	//echo $mySql;
	$simpa = mysqli_query($con,$mySql);

    //hitung rata-rata
	$data=mysqli_query($con,"SELECT AVG(rate) AS jml FROM rating WHERE id_produk = '" . $id_produk . "'");
	$q=mysqli_fetch_array($data);

    echo $rate . '|' . ceil($q['jml']) . '|';
    for ($i = 0; $i < ceil($q['jml']); $i++) {
        echo '<span class="on"><i class="fa fa-star"></i></span>';
    }
    for ($i = 5; $i > ceil($q['jml']); $i--) {
        echo '<span class="off"><i class="fa fa-star"></i></span>';
    }
    $sqlproduk2 = "SELECT * FROM `rating` WHERE id_produk = '" . $id_produk . "'";
	$result2= mysqli_query($con,$sqlproduk2 );
	//echo $sqlproduk;
    //hitung row
	$row_cnt2 = mysqli_num_rows($result2);
	echo '|' . $row_cnt2;


	 $sqlrating= "SELECT
	 			rating.rate,
	 			rating.ulasan,
	 			rating.tgl_rate,
	 			user_pelanggan.nama
	 			FROM
	 			user_pelanggan,
	 			rating 
	 			WHERE
	 			user_pelanggan.id_user_pelanggan = rating.id_user_pelanggan AND
	 			rating.id_produk = '$id_produk'
	 			ORDER BY rating.tgl_rate DESC";
	 //echo $sqlrating;
	 $qrating= mysqli_query($con,$sqlrating );
	 while ($rrating = mysqli_fetch_array($qrating))
	 {
	 	$rate = $rrating['rate'];
	 	$ulasan = $rrating['ulasan'];
	 	$tgl_rate = $rrating['tgl_rate'];
	 	$nama_pelanggan = $rrating['nama'];
	 	//echo $nama_pelanggan;
		echo '|<div class="col-xs-10 col-xs-offset-1"><div class="top-review-list m-b-20"><div id="star" class="col-xs-12 text-center">';
		for ($i = 0; $i < $rate; $i++) {
			 echo '<span class="on"><i class="fa fa-star"></i></span>';
		}

		 for ($i = 5; $i > $rate; $i--) {
			echo '<span class="off"><i class="fa fa-star"></i></span>';
		}
		echo '</div><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">'.$nama_pelanggan.'</strong> on <span itemprop="datePublished">'.Indonesia2Tgl($tgl_rate).'</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">'.$ulasan.'</p></div></div><hr style="clear: both;">';
	}
}
if (isset($_FILES['uploadImage'])) {
	//echo "Upload Sukses". "|" ;
	$temp = $_FILES['uploadImage']['tmp_name'];
	$name = $_FILES['uploadImage']['name'];
	$type2  = getimagesize($temp);
	//$name = $ipuser."_".$name;
	$name = $id_order.".jpeg";
	$img =$name;
	$type = $_FILES['uploadImage']['type'];
	$size = $_FILES['uploadImage']['size'];
	$DOCS_SIZE = getimagesize($_FILES['uploadImage']['tmp_name']);
	$folder = "../image/bayar/";

	date_default_timezone_set('Asia/Jakarta'); 
	$tgl_bayar = date('Y-m-d H:i:s');
	echo $tgl_bayar."|";
	if ( $type== "image/gif" OR $type== "image/png" OR $type== "image/jpeg" OR $type== "image/JPEG" OR $type== "image/jpg" OR $type== "image/PNG" OR $type== "image/GIF") {
	    // upload Process
			// move_uploaded_file($temp, $folder . $name);
			 $file='uploadImage'; //name pada inputan type file
			 $width=410;//satuan dalam pixel / px
			 $src_width = $DOCS_SIZE[0];
			 $src_height = $DOCS_SIZE[1];
			 $height = ($width/$src_width)*$src_height;
			resize($name, $_FILES["uploadImage"], $folder, $width, $height);
	    // menampikan informasi file yang di upload
		

		$mySqlsimpan = "UPDATE  `order`
								 SET `bukti_bayar` = '$img',
								     `tgl_bayar`='$tgl_bayar',
								     `sts_bayar`='1'
								WHERE `id_order` = '$id_order'";
		//echo $mySqlsimpan;
		$simpa = mysqli_query($con,$mySqlsimpan);
			if (!$simpa)
				{ exit("Simpan Gagal: " . $simpa);}	
		echo "Upload Sukses"."|none|Lunas";
	 }else{ 
	    echo "Upload Gagal"."|block|Pending";
	} 
}
