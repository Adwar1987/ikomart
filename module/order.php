

<?php 
	
	$id_user = '';
	if(!empty($_SESSION['id_user_pelanggan'])) {
	 	$id_user=$_SESSION['id_user_pelanggan'];
	 }else{
	 	echo "<script type='text/javascript'>alert('Anda Belum login, Silahkan login..!');
		location.href = '?module=login';
		</script>";
	}
	$folder = "./image/bayar/";
	$folderbank = "./image/bank/";
	$sts_mobile = './';
	if($vb == 'm') {
		$folder = "../image/bayar/";
		$folderbank = "../image/bank/";
		$sts_mobile = '../';
	}
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
			 //echo $sts_bayar."-".$sts_kirim."-".$sts_terima;
			}
	}

	$item_total = 0;
?>	
	<div class="content-space">
		<div class="container">
			<div class="row">
				<div class="col-xs-3">
					<ol class="breadcrumb">
						<li ><a href="#"><span>Home</span></a></li>
						<li class=active><a href="?module=cart"><span>Keranjang</span></a></li>
					</ol>
				</div>
				<div class="col-xs-6 m-b-15 text-center"><h1 class="top-item-title">Keranjang Saya</h1></div>
			</div>
			<div class="cart-container">
				<div class="cart-list">
					<div class="row">
						<div class="col-xs-12">
							<div class="cart-list-container">
								<div class="row header">
									<table class="table" style="background-color: #f39c12;" width="97%" cellpadding="100" cellspacing="10" >
										<tr >
											<td width="40px"><strong>Status Pesanan</strong></td>
											<td width="60px"><?php 
											if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){
												if($sts_kirim !== '1' && $sts_terima !== '1'){
													 echo "Packing Pengiriman";
												}elseif( $sts_kirim == '1' && $sts_terima !== '1'){
													echo "Proses Pengiriman";
												}elseif($sts_bayar == '1' && $sts_kirim == '1' && $sts_terima == '1'){
													echo "Pesanan Diterima";
												} 
											}else{
												if($sts_bayar !== '1' && $sts_kirim !== '1' && $sts_terima !== '1'){
													 echo "Menunggu Pembayaran";
												}elseif($sts_bayar == '1' && $sts_kirim !== '1' && $sts_terima !== '1'){
													echo "Packing Pengiriman";
												}elseif($sts_bayar == '1' && $sts_kirim == '1' && $sts_terima !== '1'){
													echo "Proses Pengiriman";
												}elseif($sts_bayar == '1' && $sts_kirim == '1' && $sts_terima == '1'){
													echo "Pesanan Diterima";
												} 
											}
											?></td>
										</tr>

									</table>
									<div class="col-xs-12 p-a-0">
									<!--  <form class="form-horizontal" id="loginForm" role="form" method="POST" action="?module=cart" onsubmit='disableButton()'> -->
									<!-- <div class="cart-empty">Anda belum memasukkan barang apapun</div>-->
										<div class="form-horizontal">
											<input type="hidden" name="id_user" id="id_user" readonly value="<?php echo $id_user; ?>">
											<div class="form-group">
												<label class="col-sm-2">Nomor Pemesanan</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" readonly name="id_order" id="id_order" value="<?php echo $id_order; ?>">
												</div>
											</div>
											<div class="form-group">
													<label class="col-sm-2">ID Member</label>
													<div class="col-sm-3">
													  <input type="text" class="form-control" readonly value="<?php echo $id_user; ?>">
													</div>
											 </div>
											 <div class="form-group">
												<label class="col-sm-2">Nama Pemesan</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" readonly name="nama_pemesan" value="<?php echo $nama_pemesan; ?>">
												</div>
											</div>
										  
											<div class="form-group">
													<label class="col-sm-2">Metode Pengiriman</label>
													<div class="col-sm-3">
													  <input type="text" class="form-control" readonly name="via_kirim" value="<?php echo $via_kirim; ?>">
													</div>
											</div>
											<div class="form-group">
													<label class="col-sm-2"><strong>Alamat Pengiriman</strong></label>
											</div>
											<div class="form-group" style="margin-left: 30px;">
												<label class="col-sm-8">
													<?php
														$wilayah = ((strlen($kelurahan)>1)? $kelurahan.". ":"").((strlen($kecamatan)>1)? $kecamatan:"");
														//echo "select * from 'ongkir' where nama='$kabupaten' <br>select * from kabupaten where id_kab='$id_kab'<br>";
														
														echo $nama_penerima."<br>".$alamat_tujuan.". ".((strlen($wilayah)>1)? $wilayah.". ":"")."<br>".((strlen($kabupaten)>1)? $kabupaten.". ":"").((strlen($provinsi)>1)? $provinsi.".<br>":"").$negara." (".$kode_pos.")<br>".$no_telp;  
													?>
												</label>
											</div>
										  
											 
											  
											<br>
											<div class="form-group">
												<label class="col-sm-2"><strong>Ringkasan Barang</strong></label>
											</div>
											<div class="form-group" style="margin-left: 30px;">
												<table class="table col-sm-10" cellpadding="10" cellspacing="1">
												<tbody>
												<tr>
												<th style="text-align:left; width="5%"><strong>No</strong></th>
												<th style="text-align:left; width="40%"><strong>Nama Produk</strong></th>
												<th style="text-align:center; width="20%"><strong>Harga</strong></th>
												<th style="text-align:center; width="10%"><strong>Jml</strong></th>
												<th style="text-align:right; width="20%"><strong>Subtotal</strong></th>
												
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
												 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["nama_produk"]; ?>
												 <input type="hidden" name="id_produk[]" id="id_produk" style="width: 100px;
													text-align:right;" readonly value="<?php echo ($item["id_produk"]); ?>">
												 </td>
												 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
													<?php echo format_angka($item["harga"]); ?>
													<input type="hidden" name="harga[]" id="harga" style="width: 100px;
													text-align:right;" readonly value="<?php echo ($item["harga"]); ?>">
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
												<td colspan="2" style="text-align:right;"><span id="item_total" name="item_total"><?php echo "Rp. ".format_angka($item_total); ?></span></td>
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
											<div class="form-group">
												<label class="col-sm-2"><strong>Informasi Tagihan</strong></label>
											</div>
													 <div class="form-group" style="margin-left: 30px;">
														<label class="col-sm-2">Tanggal Pesanan</label>
														<div class="col-sm-3">
														  <input type="text" class="form-control" readonly name="tgl_order" value="<?php echo $tgl_order; ?>">
														</div>
													  </div>
													  <div class="form-group" style="margin-left: 30px;">
														<label class="col-sm-2">Metode Pembayaran</label>
														<div class="col-sm-3">
														  <input type="text" class="form-control" readonly name="via_bayar" value="<?php echo $via_bayar; ?>">
														</div>
														 <div class="col-sm-3">
														<?php 
															if($vb == 'm') {
																echo '<button type="button" class="btn btn-info" onclick="detail_bayar2()" ><b>Lihat Detail</b> <span class="fa fa-money"></span></button>';
															}else{
																echo '<button type="button" class="btn btn-info" onclick="detail_bayar()" ><b>Lihat Detail</b> <span class="fa fa-money"></span></button>';
															}
														?>
														 </div>
													  </div>

													  <!-- Modal -->
        <div id="myModalbayar2" role="dialog" tabindex="-1" style="display: none">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" onclick="tutup_detail_bayar()"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelbayar">Cara Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                    	<?php
                    		$sbayar= "select * from mst_bayar where nama_bayar='$via_bayar'";
							$ebayar = mysqli_query ($con,$sbayar);
							//echo $sbayar; 
							$rbayar=mysqli_fetch_array($ebayar);
							$nama_bayar = $rbayar['nama_bayar'];
							$nama_bank = $rbayar['nama_bank'];
							$no_rek = $rbayar['no_rek'];
							$kode_bank = $rbayar['kode_bank'];
							$qris = $rbayar['qris'];
						?>
                        <table id="lookup" class="table table-hover ">
                        	<tbody>
								<tr><td>Metode Pembayaran</td><td>:</td><td><?php echo $nama_bayar; ?></td></tr>
								<tr><td>Kode Bank</td><td>:</td><td><?php echo $kode_bank; ?></td></tr>
								<tr><td>Atas Nama</td><td>:</td><td><?php echo $nama_bank; ?></td></tr>
								<tr><td>No. Rekening</td><td>:</td><td><?php echo $no_rek; ?></td></tr>
						<?php
							if (!empty($qris)){
								echo '<tr><td colspan=3><img border="0" style="width:100%;height:auto;" src="'.$folderbank.$qris.'"></td></tr>';
							}
 
						?>
							
                            
                            </tbody>
						</table>     
                    </div>
                </div>
            </div>
        </div>
        
													  <div class="form-group" style="margin-left: 30px;">
														<label class="col-sm-2">Status Pembayaran</label>
														<div class="col-sm-3">
														  <input type="text" class="form-control" readonly name="sts_bayar" value="<?php
														  	if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){
														   		if($sts_bayar !== '1'){ echo "COD";}else{ echo "Lunas";} 
														   	}else{
														   		if($sts_bayar !== '1'){ echo "Pending";}else{ echo "Lunas";}
														   	}

														   ?>">
														</div>
													  </div>
														<div class="form-group" style="margin-left: 30px;">
															<label class="col-sm-2">Total Tagihan</label>
															<div class="col-sm-3">
															  <input type="text" class="form-control" readonly name="total_bayar" value="<?php echo "Rp. ".format_angka($item_total+$biaya_handling+$ongkos); ?>">
															</div>
														  </div> 
											<hr>

											<div class="form-group">
												<label class="col-sm-2"><strong>Konfirmasi Pembayaran</strong></label>
											</div>
											<div class="form-group" style="margin-left: 30px;">
												<label class="col-sm-2">Tanggal Bayar</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" readonly name="tgl_bayar" id="tgl_bayar" value="<?php echo $tgl_bayar; ?>">
												</div>
											  </div>
											  <?php
											  	if($via_bayar=="Tunai" && $via_kirim='Ikomart kurir'){

											  	}else{
											  ?>
											  <div class="form-group" style="margin-left: 30px;">
												<label class="col-sm-2">Bukti Pembayaran</label>
												<div class="col-sm-4">
													<?php 
														date_default_timezone_set('Asia/Jakarta'); 
														$waktu_awal  =strtotime($tgl_order);
														$waktu_akhir = strtotime("now");
														$diff    =$waktu_akhir - $waktu_awal;
														$jam    = floor($diff / (60 * 60));
														//echo $jam." jam";	
														if( $jam <= 24 ){
													?>
													<input type="file" name="bukti_bayar" id="uploadImage" class="form-control" style="width:50%;" value="<?php echo $folder.$bukti_bayar;?>"  onchange="PreviewImage();">
													<p class="help-block">Kosongkan jika tidak ingin diganti.</p>
													<input type="hidden" class="form-control" name="img_lama" value="<?php echo $bukti_bayar;?>">
													<?php 
														}else{
															if($sts_bayar !== '1'){
													?>
														<input type="text" class="form-control" readonly  value="Batas waktu pembayaran sudah lewat 24 jam">
													<?php
															}
														}
													?>
													<!-- <img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Gambar" /> -->
													<img border="0" style="width:100%;height:auto;" id="uploadPreview" src="<?php echo $folder.$bukti_bayar."?t=".milliseconds(); ?>">
													<?php 
														if($vb == 'm') {
															echo '<a id="btnupload" class="btn btn-primary" style="display:none;"onclick="return saveImage2();" target="_blank" > Upload</a>';
														}else{
															echo '<a id="btnupload" class="btn btn-primary" style="display:none;"onclick="return saveImage();" target="_blank" > Upload</a>';
														}
													?>
													
												</div>	
											  </div>
											<?php } ?>
											<hr>
											<div class="form-group">
												<div class="col-xs-8 col-xs-offset-4">
												<?php 
													if(($sts_bayar !== '1' || $sts_kirim !== '1') and $jam <= 24){
												?>
													<a id="btnedit" class="btn btn-primary" href="?module=cart&id_order=<?php echo $id_order;?>" onclick="disableButton()"> Edit Order</a>
												<?php 
													}
												?>
													<a id="btnsimpan" class="btn btn-primary" href="<?php echo $sts_mobile; ?>cetak/cetak_order.php?id_order=<?php echo $id_order;?>" target="_blank" > Preview Order</a>

													<a id="btnselesai" class="btn btn-primary"  onclick="return newcart();"> Order Selesai</a>
													<a id="btnlistorder" class="btn btn-primary"  href="?module=listorder"> Riwayat Order</a>
												</div>
											</div>
											<script language="javascript">
												function disableButton() {
													var btn = document.getElementById('btnedit');
													btn.disabled = true;
													btn.innerText = 'Posting...'
												}
												function disableButton2() {
													var btn = document.getElementById('btnselesai');
													btn.disabled = true;
													btn.innerText = 'Posting...'
												}
											</script>
										<!--  </form> -->
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
        <div class="modal" id="myModalbayar" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelbayar">Cara Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                    	<?php
                    		$sbayar= "select * from mst_bayar where nama_bayar='$via_bayar'";
							$ebayar = mysqli_query ($con,$sbayar);
							//echo $sbayar; 
							$rbayar=mysqli_fetch_array($ebayar);
							$nama_bayar = $rbayar['nama_bayar'];
							$nama_bank = $rbayar['nama_bank'];
							$no_rek = $rbayar['no_rek'];
							$kode_bank = $rbayar['kode_bank'];
							$qris = $rbayar['qris'];
						?>
                        <table id="lookup" class="table table-hover ">
                        	<tbody>
								<tr><td>Metode Pembayaran</td><td>:</td><td><?php echo $nama_bayar; ?></td></tr>
								<tr><td>Kode Bank</td><td>:</td><td><?php echo $kode_bank; ?></td></tr>
								<tr><td>Atas Nama</td><td>:</td><td><?php echo $nama_bank; ?></td></tr>
								<tr><td>No. Rekening</td><td>:</td><td><?php echo $no_rek; ?></td></tr>
						<?php
							if (!empty($qris)){
								echo '<tr><td colspan=3><img border="0" style="width:100%;height:auto;" src="'.$folderbank.$qris.'"></td></tr>';
							}
 
						?>
							
                            
                            </tbody>
						</table>     
                    </div>
                </div>
            </div>
        </div>

        
	</div>
  
 

<!-- <script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
<script type="text/javascript">
	function newcart(){
		var etoken=$('#etoken').val();
	/*alert('tes2'); */
		//alert(id_produk); 
		$.ajax({
			url:'cart/index.php',
			type:'POST',
			dataType:'html',
			data:{'action': "new",'etoken': etoken},
			success:function (respons) {
				//alert(respons);
				//$('#data_cart').html(respons);
			}, 
		})  
		jml_cart();
		location.href = "?module=home";

	}

	function PreviewImage() {
		var btn = document.getElementById('btnupload');
		btn.style.display = 'block';
	  	var oFReader = new FileReader();
	  	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	  	oFReader.onload = function (oFREvent)
	  	 {
	  		document.getElementById("uploadPreview").src = oFREvent.target.result;
	  	}
	}

	function saveImage() {
		var btn = document.getElementById('btnupload');
		var btn2 = document.getElementById('btnedit');
		btn.style.display = 'none';
		var id_order = $('#id_order').val();
		var myFormData = new FormData();
		myFormData.append('uploadImage', $('#uploadImage').prop('files')[0]);
		myFormData.append('id_order', id_order);
		//alert(etoken);
		$.ajax({
		    url: "module/proses.php",
		    method: "POST",
		    processData: false,
    		contentType: false,
		    data: myFormData,
		    success: function(respon) {
				//alert(respon);
				var obj = respon.split('|');
		        alert(obj[1]);
		        $('#tgl_bayar').val(obj[0]);
		        $('#sts_bayar').val(obj[3]);
		        //btn2.style.display = 'none';
		        // $("#cart-container").load("?module=order&id_order=" + id_order);
		         location.reload(true);
		    }
		});
	}
	
		function saveImage2() {
		var btn = document.getElementById('btnupload');
		var btn2 = document.getElementById('btnedit');
		btn.style.display = 'none';
		var id_order = $('#id_order').val();
		var myFormData = new FormData();
		myFormData.append('uploadImage', $('#uploadImage').prop('files')[0]);
		myFormData.append('id_order', id_order);
		//alert(etoken);
		$.ajax({
		    url: "../module/proses.php",
		    method: "POST",
		    processData: false,
    		contentType: false,
		    data: myFormData,
		    success: function(respon) {
				//alert(respon);
				var obj = respon.split('|');
		        alert(obj[1]);
		        $('#tgl_bayar').val(obj[0]);
		        $('#sts_bayar').val(obj[3]);
		        //btn2.style.display = 'none';
		        // $("#cart-container").load("?module=order&id_order=" + id_order);
		         location.reload(true);
		    }
		});
	}
</script>