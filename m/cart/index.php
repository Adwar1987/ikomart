<?php
//session_start();
include "../../inc/inc.library.php";
//include "../inc/token.php";
include "../../inc/koneksi.php";
/*require_once("dbcontroller.php");
$db_handle = new DBController();*/

$ip_ad = get_client_ip();

//$mac_ad = get_client_mac();
//echo $ip_ad;
$id_user = '';
if(!empty($_SESSION['id_user_pelanggan'])) {
 	$id_user=$_SESSION['id_user_pelanggan'];
 }
$id_session = '';
if(!empty($_POST['etoken'])) {
 	$id_session=$_POST['etoken'];
 	//settoken($id_session);
 }
 if(!empty($_SESSION['e_token'])) {
 	$id_session=$_SESSION['e_token'];
 }
$id_produk2='';
if(isset($_GET["id_produk"])) {
	$id_produk2 = $_GET["id_produk"];
}
if(isset($_POST["id_produk"])) {
	$id_produk2 = $_POST["id_produk"];
}
/*echo "<script> alert('".$id_produk."); </script>";*/
/* session_start();
$_SESSION['sts_order']= 1;
$_SESSION['etoken'] = $id_session;*/

//echo $_SESSION['etoken'];
if(!empty($_POST["action"])) {
switch($_POST["action"]) {

	case "addiko":
		if(!empty($_POST["quantity"])) {
			
			$jml = $_POST["quantity"];
			$sqlproduk= "SELECT
				  			produk.id_produk,
				  			produk.nama_produk,
				  			produk.alias,
				  			produk.deskripsi,
				  			produk.stok,
				  			produk.dijual,
				  			produk.dikirim,
				  			produk.views,
				  			produk.ukuran,
				  			produk.merk,
				  			harga.harga_jual,
							harga.harga_pasar
				  		FROM
				  			produk ,
				  			harga,
				  			kelompok,
				  			categories
				  		WHERE
				  			harga.id_produk = produk.id_produk AND
				  			( harga.tgl_awal_promo <= CURDATE()   AND
				   harga.tgl_akhir_promo >= CURDATE()  ) AND
				  			produk.id_produk='" . $id_produk2 . "'";
				 			//echo $sqlproduk;
			$qproduk= mysqli_query($con,$sqlproduk );
			while ($rproduk = mysqli_fetch_array($qproduk)){
				  $id_produk = $rproduk['id_produk'];
				  $nama_produk = $rproduk['nama_produk'];
				  $alias = $rproduk['alias'];
				  $deskripsi = $rproduk['deskripsi'];
				  
				  $stok = $rproduk['stok'];
				  $dijual = $rproduk['dijual'];
				  $dikirim = $rproduk['dikirim'];
				  $views = $rproduk['views'];
				  $ukuran = $rproduk['ukuran'];
				  $merk = $rproduk['merk'];
				  $harga_jual = $rproduk['harga_jual'];
				  $harga_pasar = $rproduk['harga_pasar'];
 			}
 			$cek = '0';
 			$jml = 1;
 			$mySqlcari = "SELECT '1' as cek, jml from `cart` WHERE id_session = '$id_session' AND id_produk = '$id_produk'";
			//echo $mySqlcari;
			$qcari = mysqli_query($con,$mySqlcari);
			while ($cari = mysqli_fetch_array($qcari)){
				$cek = $cari['cek'];
				$jml = $jml + $cari['jml'];
				$sub_harga = $jml * $harga_jual;
			}
			if($cek=='0'){
 				$mySql = "INSERT INTO `cart` ( `id_session`, `id_user`, `id_produk`, `nama_produk`, `jml`, `harga`)
					 VALUES 
					('{$id_session}','{$id_user}','{$id_produk}', '{$nama_produk}','{$jml }','{$harga_jual}')";
			}else{
				$mySql = "UPDATE`cart` SET  `jml` = '$jml', `harga` = '$harga_jual'
						  WHERE id_session = '$id_session' AND id_produk = '$id_produk'";
			}
			//echo $mySql;
			//printf($mySql);
			$simpa = mysqli_query($con,$mySql);
			if (!$simpa)
			{ exit("Simpan Gagal: " . $simpa);}
		}
	break;
	case "upiko":
		if(!empty($_POST["quantity"])) {
			
			$jml = $_POST["quantity"];
			$harga_jual = 0;
			$sqlproduk= "SELECT
				  			produk.id_produk,
				  			produk.nama_produk,
				  			produk.alias,
				  			produk.deskripsi,
				  			produk.stok,
				  			produk.dijual,
				  			produk.dikirim,
				  			produk.views,
				  			produk.ukuran,
				  			produk.merk,
				  			harga.harga_jual,
							harga.harga_pasar
				  		FROM
				  			produk ,
				  			harga,
				  			kelompok,
				  			categories
				  		WHERE
				  			harga.id_produk = produk.id_produk AND
				  			( harga.tgl_awal_promo <= CURDATE()   AND
				   harga.tgl_akhir_promo >= CURDATE()  ) AND
				  			produk.id_produk='" . $id_produk2 . "'";
				 			//echo $sqlproduk;
			$qproduk= mysqli_query($con,$sqlproduk );
			while ($rproduk = mysqli_fetch_array($qproduk)){
				  $id_produk = $rproduk['id_produk'];
				  $nama_produk = $rproduk['nama_produk'];
				  $alias = $rproduk['alias'];
				  $deskripsi = $rproduk['deskripsi'];
				  
				  $stok = $rproduk['stok'];
				  $dijual = $rproduk['dijual'];
				  $dikirim = $rproduk['dikirim'];
				  $views = $rproduk['views'];
				  $ukuran = $rproduk['ukuran'];
				  $merk = $rproduk['merk'];
				  $harga_jual = $rproduk['harga_jual'];
				  $harga_pasar = $rproduk['harga_pasar'];
 			}
 			
			$sub_harga = $jml * $harga_jual;
			
			$mySql = "UPDATE `cart` SET  `jml` = '$jml', `harga` = '$harga_jual'
						  WHERE id_session = '$id_session' AND id_produk = '$id_produk'";
			
			//echo $mySql;
			$simpa = mysqli_query($con,$mySql);
			if (!$simpa)
			{ exit("Simpan Gagal: " . $simpa);}
		}
	break;
	case "remove":
		//echo $_POST['id_produk'];
		if(isset($_POST['id_produk'])) {
			$id_produk = $_POST['id_produk'];
			$mySqldel = "DELETE FROM `cart` WHERE id_session = '$id_session' AND id_produk= '$id_produk'";

			//echo $mySqldel;
			$dele = mysqli_query($con,$mySqldel);
			if (!$dele)
			{ exit("Hapus Gagal: " . $dele);}
		}
	break;
	case "empty":
		
		$mySqldelall = "DELETE FROM `cart` WHERE id_session = '$id_session' ";
			//echo $mySqldelall;
			$deleall = mysqli_query($con,$mySqldelall);
			if (!$deleall)
			{ exit("Hapus Semua Gagal: " . $deleall);}

		session_start();
		unset($_SESSION['e_token']);
		break;	

	case "new":
		session_start();
		unset($_SESSION['e_token']);
		break;	
	}
}

    $item_total = 0;
?>	
<table class="table" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;" width=120px><strong>Nama Produk</strong></th>
<th style="text-align:right;" width=50px><strong>Harga</strong></th>
<th style="text-align:right;" width=20px><strong>Jml</strong></th>
<th style="text-align:right;" width=50px><strong>Subtotal</strong></th>
<th style="text-align:center;" width=20px><strong>Action</strong></th>
</tr>	
<?php		
	$sqlcart= "SELECT * FROM cart WHERE id_session = '$id_session'";
	//echo $sqlcart;
	$qcart= mysqli_query($con,$sqlcart );
	while ($item = mysqli_fetch_array($qcart)){
		$id_produk = $item['id_produk'];
?>
 <tr>
 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["nama_produk"]; ?></strong></td>
 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo format_angka($item["harga"]); ?></td>
 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["jml"]; ?></td>
 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo format_angka($item["harga"] *  $item["jml"]); ?></td>
 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="javascript:void(0);" onclick="return delcart('<?php echo $item["id_produk"]; ?>');" >X</a></td>
 </tr>
 <?php
        $item_total += ($item["harga"]*$item["jml"]);
		}
		?>

<tr>
<td colspan="4" align=right><strong>Total:</strong> <?php echo "Rp. ".format_angka($item_total); ?></td>
</tr>
</tbody>
</table>	
