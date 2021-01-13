<!-- <script type="text/javascript">
 mixpanel.track_links(".mp-nav_link", "Click Nav Link", { "User Identity" : "guest" });
  function mixpanelRemoveCart(name, qty, price){
   mixpanel.track("Remove Product From Cart", {"User Identity" : user_identity,"Product Name" : name,"Qty" : qty,"Price" : price,}); return false; 
    mixpanel.track_links(".mp-contact_link", "Click to Contact Lemonilo", {"User Identity" : "guest" });
</script>
<script type="text/javascript">var original_cart = [];</script>  -->
<style type="text/css">
	@media print {tr.vendorListHeading {
                background-color: #1a4567 !important;
                -webkit-print-color-adjust: exact; 
    }}
@media print {.vendorListHeading th {
    color: white !important;
    }}
    /* Container holding the image and the text */
.container-header {
  position: relative;
  text-align: center;
  color: black;
}

/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

/* Top left text */
.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

/* Top right text */
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.centered-left {
  position: absolute;
  top: 50%;
  left: 80px;
  transform: translate(-50%, -50%);
}
</style>
<?php 

include "head.php";
include "../inc/koneksi.php";
include "../inc/inc.library.php";

	//$ip_ad = get_client_ip();
	$id_order = '';
	if(isset($_GET['id_order'])) {
		$id_order = $_GET['id_order'];
		$sqlproduk= "SELECT * FROM `order`, `user_pelanggan`
					where `order`.id_user_pelanggan = `user_pelanggan`.id_user_pelanggan and
					 	id_order = '$id_order'";
		//echo $sqlproduk;
		$qproduk= mysqli_query($con,$sqlproduk );
		while ($rproduk = mysqli_fetch_array($qproduk)){
			 $id_user = $rproduk['id_user_pelanggan'];
			 $tgl_order = $rproduk['tgl_order'];
			 $nama_pemesan = $rproduk['nama'];
			 $nama_penerima = $rproduk['nama_penerima'];
			 $no_telp = $rproduk['no_telp'];
			 $negara = $rproduk['negara'];
			 $provinsi = $rproduk['provinsi'];
			 $kabupaten = $rproduk['kabupaten'];
			 $kecamatan = $rproduk['kecamatan'];
			 $kelurahan = $rproduk['kelurahan'];
			 $kode_pos = $rproduk['kode_pos'];
			 $alamat_tujuan = $rproduk['alamat_tujuan'];
			 $biaya_handling = $rproduk['biaya_handling'];
			 $ongkos = $rproduk['ongkos'];
			 $total_bayar = $rproduk['total_bayar'];
			 $via_bayar = $rproduk['via_bayar'];
			 $via_kirim = $rproduk['via_kirim'];
			 $sts_bayar = $rproduk['sts_bayar'];
			 $sts_kirim = $rproduk['sts_kirim'];
			 $sts_terima = $rproduk['sts_terima'];
			 $tgl_bayar = $rproduk['tgl_bayar'];
			 $bukti_bayar = $rproduk['bukti_bayar'];
			 //echo $provinsi;
			}
	}

	$item_total = 0;
?>	
<br>
<div class="content-space">
	<div class="container">
		<div class="cart-container">
			<div class="cart-list">
				<div class="row">
					<div class="col-xs-12">
						<div class="cart-list-container">
							<div class="row header">
								<center>
									<img src="../img/ikomart.jpeg" style="width: 200px;" title="ikomart.id" alt="ikomart.id" />
									<h5>Yuk Belanja Online, Anda Pesan kami antar</h5>
									 <div class="container-header">
									  <img src="bg.png" alt="Snow" style="width:100%; height: 39px;">
									  <div class="centered">
									  	<h3><?php 
							 			if($sts_bayar <> '1'){
							 				echo "KONFIRMASI PESANAN";
							 			}else{
							 				echo "INVOICE";
							 			}
								 		?></h3>
								 	  </div>
									</div> 
								
								<!-- style="background-color: #f39c12;" -->
							 	<!-- <table class="table" width="97%" cellpadding="100" cellspacing="10" >
							 		<tr >
							 			<td width="40px">
							 				<div class="container-header">
							 					<img src="bg.png" alt="" border=3 height=100% width=auto></img>
							 					<div class="centered-left">
								 					
								 					<strong>Status Pesanan</strong>
							 					</div>
							 				</div>
							 			</td>
							 			<td width="60px">
							 				<div class="container-header">
							 					<img src="bg.png" alt="" border=3 height=100% width=auto></img>
							 					<div class="centered-left">
								 					<?php 
										 			if($sts_bayar <> '1' && $sts_kirim <> '1'){
										 				 echo "Menunggu Pembayaran";
										 			}elseif($sts_bayar = '1' && $sts_kirim <> '1'){
										 				echo "Proses Pengiriman";
										 			}elseif($sts_bayar = '1' && $sts_kirim = '1'){
										 				echo "Selesai Pengiriman";
										 			} 
										 			?>
									 			</div>
									 		</div>
									 	</td>
							 		<tr>

							 	</table>  -->
							 	</center>
							 <div class="col-xs-12 p-a-0">
							<!--  <form class="form-horizontal" id="loginForm" role="form" method="POST" action="?module=cart" onsubmit='disableButton()'> -->
							 	<!-- <div class="cart-empty">Anda belum memasukkan barang apapun</div>-->
							 	<div class="form-horizontal">
							 	<input type="hidden" name="id_user" id="id_user" readonly value="<?php echo $id_user; ?>">
							 	<table width="100%" cellpadding="10" cellspacing="1">
							 		<tr>
							 			<td width="40px"><strong>Nomor Pemesanan</strong></td>
							 			<td width="10px">:</td>
							 			<td width="50px"><?php echo $id_order; ?></td>
							 		<tr>
							 		<tr>
							 			<td width="40px"><strong>ID Member</strong></td>
							 			<td width="10px">:</td>
							 			<td width="50px"><?php echo $id_user; ?></td>
							 		<tr>
							 		<tr>
							 			<td width="40px"><strong>Nama Pemesan</strong></td>
							 			<td width="10px">:</td>
							 			<td width="50px"><?php echo $nama_pemesan; ?></td>
							 		<tr>
							 		<tr>
							 			<td width="40px"><strong>Metode Pengiriman</strong></td>
							 			<td width="10px">:</td>
							 			<td width="50px"><?php echo $via_kirim; ?></td>
							 		<tr>

							 	</table>
								 
								<label >Alamat Pengiriman</label>
								<br>
								<p style="margin-left: 30px;">
									   <!--  <label class="col-sm-8"> -->
									    	<?php
														$wilayah = ((strlen($kelurahan)>1)? $kelurahan.". ":"").((strlen($kecamatan)>1)? $kecamatan:"");
														//echo "select * from 'ongkir' where nama='$kabupaten' <br>select * from kabupaten where id_kab='$id_kab'<br>";
														
														echo $nama_penerima."<br>".$alamat_tujuan.". ".((strlen($wilayah)>1)? $wilayah.". ":"")."<br>".((strlen($kabupaten)>1)? $kabupaten.". ":"").((strlen($provinsi)>1)? $provinsi.".<br>":"").$negara." (".$kode_pos.")<br>".$no_telp;  
											?>
											<!-- </label> -->
									  </p>
								 	 
								 	  
								 	<label >Ringkasan Barang</label>
									<br>
									<div class="form-group" style="margin-left: 30px;">
									 	<table  width="90%" cellpadding="10" cellspacing="1">
									 	<tbody>
									 	<tr>
									 	<th style="text-align:left;" width="5%"><strong>No</strong></th>
									 	<th style="text-align:left;" width="40%"><strong>Nama Produk</strong></th>
									 	<th style="text-align:center;" width="20%"><strong>Harga</strong></th>
									 	<th style="text-align:center;" width="10%"><strong>Jml</strong></th>
									 	<th style="text-align:right;" width="20%"><strong>Subtotal</strong></th>
									 	
									 	</tr>	
									 	<?php	
									 		$no= 1;	
									 		$sqlcart= "SELECT * FROM cart WHERE id_session = '$id_order'";
									 		//echo $sqlcart;
									 		$qcart= mysqli_query($con,$sqlcart );
									 		while ($item = mysqli_fetch_array($qcart)){
									 			$id_produk = $item['id_produk'];
									 	?>
									 	 <tr>
									 	 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $no; ?>
									 	 </td>
									 	 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo strtolower($item["nama_produk"]); ?>
									 	 </td>
									 	 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
									 	 	<?php echo format_angka($item["harga"]); ?>
									 	 	
									 	 </td>
									 	 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php echo $item["jml"]; ?>
									 	 </td>
									 	 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo format_angka($item["harga"]*$item["jml"]); ?>
									 	 </td>
									 	 </tr>
									 	 <?php
									 	        $item_total += ($item["harga"]*$item["jml"]);
									 	        $no++;
									 			}
									 	 ?>
									 	<tr>
									 	<td colspan="3" style="text-align:right;"><strong>Total Belanja</strong> </td>
									 	<td colspan="2"  style="text-align:right;"><span id="item_total" name="item_total"><?php echo "Rp. ".format_angka($item_total); ?></span></td>
									 	</tr>
									 	<tr>
									 	<td colspan="3" style="text-align:right;">Biaya Handling</td>
									 	<td colspan="2" style="text-align:right;"><span id="biaya_handling" name="biaya_handling"><?php echo "Rp. ".format_angka($biaya_handling); ?></span></td>
									 	</tr>
									 	<tr>
									 	<td colspan="3" style="text-align:right;">Ongkos Kirim </td>
									 	<td colspan="2" style="text-align:right;"><span id="ongkos" name="ongkos"><?php echo "Rp. ".format_angka($ongkos); ?></span></td>
									 	</tr>
									 	<tr>
									 	<td colspan="3" style="text-align:right;"><strong>Total Bayar</strong> </td>
									 	<td colspan="2" style="text-align:right;"><span id="total" name="total"><?php echo "Rp. ".format_angka($item_total+$biaya_handling+$ongkos); ?></span></td>
									 	</tr>
									 	</tbody>
									 	</table>
								 	</div>

								 	
									<label >Informasi Tagihan</label>
									<br>

								 	<div class="form-group" style="margin-left: 30px;">
								 		<table width="80%" cellpadding="10" cellspacing="1">
									 		<tr>
									 			<td width="20px"><strong>Tanggal Pesanan</strong></td>
									 			<td width="10px">:</td>
									 			<td width="60px"><?php echo $tgl_order; ?></td>
									 		<tr>
									 		<tr>
									 			<td width="20px"><strong>Metode Pembayaran</strong></td>
									 			<td width="10px">:</td>
									 			<td width="50px"><?php echo $via_bayar; ?></td>
									 		<tr>
									 		<tr>
									 			<td width="20px"><strong>Status Pembayaran</strong></td>
									 			<td width="10px">:</td>
									 			<td width="50px"><?php 
									 				if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){
														   		if($sts_bayar <> '1'){ echo "COD";}else{ echo "Lunas";} 
														   	}else{
														   		if($sts_bayar <> '1'){ echo "Pending";}else{ echo "Lunas";}
														   	}
									 			?></td>
									 		<tr>
									 		<tr>
									 			<td width="20px"><strong>Total Tagihan</strong></td>
									 			<td width="10px">:</td>
									 			<td width="50px"><?php echo "Rp. ".format_angka($total_bayar); ?></td>
									 		<tr>

									 	</table>
								 	  </div>
								 	  
								 	<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 
<script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<?php
//include "tail.php";?>