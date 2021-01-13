<?php
//session_start();
//include "../inc/inc.library.php";
//include "../inc/token.php";
//include "../inc/koneksi.php";
/*require_once("dbcontroller.php");
$db_handle = new DBController();*/

$ip_ad = get_client_ip();

//$mac_ad = get_client_mac();
//echo $ip_ad;
$id_user = '';
if(!empty($_SESSION['id_user_pelanggan'])) {
 	$id_user=$_SESSION['id_user_pelanggan'];
 }else{
 	echo "<script type='text/javascript'>alert('Anda Belum login, Silahkan login..!');
	location.href = '?module=login';
	</script>";
}


    $item_total = 0;
?>	
<div class="content-space">
	<div class="container">
		<div class="cart-container">
			<div class="cart-list">
				<div class="row">
					<div class="col-xs-12">
						<div class="cart-list-container">
							<div class="row header">
								<div class="col-xs-12 p-a-0">
									<table class="table cellpadding="10" cellspacing="1" style="display: block;overflow-x: auto;white-space: nowrap;">
									<tbody>
									<tr>
									<th style="text-align:left;" width=5px><strong>No.</strong></th>
									<th style="text-align:left;" width=10px><strong>Tgl Pesanan</strong></th>
									<th style="text-align:left;" width=50px><strong>Penerima</strong></th>
									<th style="text-align:left;" width=20px><strong>Jumlah Tagihan</strong></th>
									<th style="text-align:center;" width=20px><strong>Via Kirim</strong></th>
									<th style="text-align:center;" width=20px><strong>Via Bayar</strong></th>
									<th style="text-align:center;" width=20px><strong>Status Bayar</strong></th>
									<th style="text-align:center;" width=20px><strong>Status Pesanan</strong></th>
									<th style="text-align:center;" width=20px><strong>Action</strong></th>
									</tr>	
									<?php		
										$no = 1;
										$sqlcart= "SELECT * FROM `order` WHERE id_user_pelanggan = '$id_user' ORDER BY tgl_order DESC";
										//echo $sqlcart;
										$qcart= mysqli_query($con,$sqlcart );
										while ($item = mysqli_fetch_array($qcart)){
											$id_order = $item['id_order'];
											$tgl_order = $item['tgl_order'];
											 $nama_pemesan = $item['nama'];
											 $nama_penerima = $item['nama_penerima'];
											 $no_telp = $item['no_telp'];
											 $provinsi = $item['provinsi'];
											 $kabupaten = $item['kabupaten'];
											 $kecamatan = $item['kecamatan'];
											 $kelurahan = $item['kelurahan'];
											 $alamat_tujuan = $item['alamat_tujuan'];
											 $biaya_handling = $item['biaya_handling'];
											 $ongkos = $item['ongkos'];
											 $total_bayar = $item['total_bayar'];
											 $via_bayar = $item['via_bayar'];
											 $via_kirim = $item['via_kirim'];
											 $sts_bayar = $item['sts_bayar'];
											 $sts_kirim = $item['sts_kirim'];
											 $sts_terima = $item['sts_terima'];
									?>
									 <tr>
									 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $no; ?></td>
									 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["tgl_order"]; ?></td>
									 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["nama_penerima"]; ?></td>
									 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php echo format_angka($item["total_bayar"]); ?></td>
									 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["via_kirim"]; ?></td>
									 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["via_bayar"]; ?></td>
									 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php 
										if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){
											if($sts_bayar !== '1'){ echo "COD";}else{ echo "Lunas";} 
										}else{
											if($sts_bayar !== '1'){ echo "Pending";}else{ echo "Lunas";}
										}
									 ?></td>
									 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php 

									 	date_default_timezone_set('Asia/Jakarta'); 
									    $waktu_awal  =strtotime($tgl_order);
									    $waktu_akhir = strtotime("now");
									    $diff    =$waktu_akhir - $waktu_awal;
									    $jam    = floor($diff / (60 * 60));
										//echo $jam." jam";	
									 	
									 	if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){
											if($item['sts_bayar'] !== '1' && $item['sts_kirim'] !== '1' && $item['sts_terima'] !== '1'){
								 				if($jam <= 24 ){
													echo "Menunggu Pengiriman";
												}else{
													echo "Batas waktu Proses Pengiriman sudah lewat 24 jam";
												}
												
											}elseif($item['sts_bayar'] == '1' && $item['sts_kirim'] !== '1' && $item['sts_terima'] !== '1'){
												echo "Menunggu Pengiriman";
											}elseif($item['sts_bayar'] == '1' && $item['sts_kirim'] == '1' && $item['sts_terima'] !== '1'){
												echo "Proses Pengiriman";
											}elseif($item['sts_bayar'] == '1' && $item['sts_kirim'] == '1'  && $item['sts_terima'] == '1'){
												echo "Pesanan Diterima";
											} 
										}else{

								 			if($item['sts_bayar'] !== '1' && $item['sts_kirim'] !== '1' && $item['sts_terima'] !== '1'){
								 				if($jam <= 24 ){
													echo "Menunggu Pembayaran";
												}else{
													echo "Batas waktu pembayaran sudah lewat 24 jam";
												}
												
											}elseif($item['sts_bayar'] == '1' && $item['sts_kirim'] == '1' && $item['sts_terima'] !== '1'){
												echo "Proses Pengiriman";
											}elseif($item['sts_bayar'] == '1' && $item['sts_kirim'] == '1'  && $item['sts_terima'] == '1'){
												echo "Pesanan Diterima";
											} 
										}


							 			?></td>
									 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="?module=order&id_order=<?php echo $id_order; ?>"><i class="fa fa-search-plus fa-2x"></i></a></td>
									 </tr>
									 <?php
									        $item_total += $item_total + $total_bayar;
									        $no++;
									 }
									 ?>

									<tr>
										<td colspan="6" align=right><strong>Total Belanja:</strong> <?php echo "Rp. ".format_angka($item_total); ?></td>
									</tr> 
									</tbody>
									</table>
								</div>	
							</div>	
						</div>	
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
