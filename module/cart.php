

<?php 
	$sts_mobile = './';
	if($vb == 'm') {
		$sts_mobile = '../';
	}

	//$ip_ad = get_client_ip();
	$id_user = '';
	$nama_penerima = '';
	$tgl_order = '';
	$negara = 'Indonesia';
	$provinsi = '';
	$kabupaten = '';
	$kecamatan = '';
	$kelurahan = '';
	$alamat_tujuan = '';
	$biaya_handling = 0;
	$ongkos = 0;
	$total_bayar = 0;
	$via_kirim = '';
	//echo $_POST['sts_setuju'].' - '.$_POST['setuju'];;
	if(isset($_POST['setuju'])) {
		$sts_setuju = $_POST['setuju'];
		if($sts_setuju == '1'){
			$id_order = $_POST['id_order'];
			$id_user = $_POST['id_user'];
			//$nama_penerima = mysql_real_escape_string($_POST['nama_penerima']);
			$nama_penerima = mysqli_real_escape_string($con, $_POST['nama_penerima']);
			$no_telp = $_POST['no_telp'];
			$tgl_order = date ("Y-m-d H:i:s",strtotime($_POST['tgl_order']));
			$negara = $_POST['negara'];
			$provinsi = $_POST['provinsi'];
			$kabupaten = $_POST['kabupaten'];
			$kecamatan = $_POST['kecamatan'];
			$kelurahan = $_POST['kelurahan'];
			$kode_pos = $_POST['kode_pos'];
			$alamat_tujuan = mysqli_real_escape_string($con, $_POST['alamat_tujuan']);
			$biaya_handling = $_POST['biaya_handling'];
			$biaya_handling = str_replace(".", "", $biaya_handling);
			$ongkos = $_POST['ongkos'];
			$ongkos = str_replace(".", "", $ongkos);
			$total_bayar = $_POST['total_bayar'];
			$via_kirim = $_POST['via_kirim'];
			$via_bayar = $_POST['via_bayar'];
			//echo $via_bayar." - ".$via_kirim ;
			if( $ongkos > 0 ){
				if($via_bayar =='Tunai' && $via_kirim !== 'Ikomart kurir' ){
					echo "<script type='text/javascript'>alert('Pembayaran Tunai hanya untuk Ikomart kurir..!');
					$('#via_bayar').focus();
					</script>";
				}else{
					 // hitung jumlah produk pesanan
					$num = count($_POST['id_produk']);
					//echo $num ;
					for ($j = 0; $j < $num; $j++) {
						$id_produk = $_POST['id_produk'][$j];
						$jml = $_POST['jml'][$j];
						$harga = $_POST['harga'][$j];
					
						$mySql = "UPDATE `cart` SET  `jml` = '$jml', `harga` = '$harga'
									  WHERE id_session = '$id_order' AND id_produk = '$id_produk'";
						
						//echo $mySql;
						$simpa = mysqli_query($con,$mySql);
						 if (!$simpa)
						{ exit("Simpan Gagal: " . $simpa);}
					}  
	 			
					$data2=mysqli_query($con,"select '1' as cek  from `order` p where p.id_order='$id_order'");
					$edit2=mysqli_fetch_array($data2);
					$cek = $edit2['cek'];
					if($cek=='1'){
						$mySqlsimpan = "UPDATE  `order`
										 SET `nama_penerima` = '$nama_penerima',
										     `no_telp`='$no_telp',
										     `negara`='$negara',
										 	 `provinsi`='$provinsi',
										 	 `kabupaten` = '$kabupaten' ,
										 	 `kecamatan` = '$kecamatan',
										 	 `kelurahan`= '$kelurahan',
										 	 `kode_pos`= '$kode_pos',
										 	 `alamat_tujuan` = '$alamat_tujuan',
										 	 `nama_penerima` = '$nama_penerima',
										 	 `biaya_handling` = '$biaya_handling',
										 	 `ongkos` = '$ongkos',
										 	 `total_bayar` = '$total_bayar',
										 	 `tgl_order` = '$tgl_order',
										 	 `via_bayar` = '$via_bayar',
										 	 `via_kirim` = '$via_kirim'
										WHERE `id_order` = '$id_order'";
					}else{
						$mySqlsimpan = "INSERT INTO  `order` (`id_order`, `id_user_pelanggan`, `tgl_order`, `nama_penerima`, `no_telp`, `negara`, `provinsi`, `Kabupaten`, `kecamatan`, `kelurahan`, `kode_pos`, `alamat_tujuan`, `biaya_handling`, `ongkos`, `total_bayar`, `via_kirim`, `via_bayar`, `sts_setuju`) 
								 VALUES 
								('{$id_order}', '{$id_user}','{$tgl_order}','{$nama_penerima}','{$no_telp}','{$negara}','{$provinsi}', '{$kabupaten}','{$kecamatan }','{$kelurahan}','{$kode_pos}','{$alamat_tujuan}','{$biaya_handling}', '{$ongkos }', '{$total_bayar }', '{$via_kirim }', '{$via_bayar }', '{$sts_setuju }')";
					}

					//echo $mySqlsimpan;
					$simpa = mysqli_query($con,$mySqlsimpan);
					if (!$simpa)
						{ exit("Simpan Gagal: " . $simpa);}				  
					header('location:?module=order&id_order='.$id_order); 
				}
			}else{
				echo "<script type='text/javascript'>alert('Tarif ongkir tidak ada, Silahkan pilih pengiriman laen..!');
					$('#id_kirim').focus();
					</script>";
			}
		}
	}
	//$id_order='';
	if(isset($_GET['id_order'])) {
		$id_order = $_GET['id_order'];
		$sqlproduk= "SELECT * FROM `order`, `user_pelanggan`
					where `order`.id_user_pelanggan = `user_pelanggan`.id_user_pelanggan and
					 	id_order = '$id_order'";
		//echo $sqlproduk;
		$qproduk= mysqli_query($con,$sqlproduk );
		while ($rproduk = mysqli_fetch_array($qproduk)){
			 $tgl_order = $rproduk['tgl_order'];
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
			 //echo $via_kirim;
			}
	}
	if(!empty($_SESSION['id_user_pelanggan'])) {
		$id_user=$_SESSION['id_user_pelanggan'];
		$data=mysqli_query($con,"select '1' as cek  from cart p where p.id_session='$id_session'");
		$edit=mysqli_fetch_array($data);
		$cek = $edit['cek'];
		if($cek=='1'){
			$mySql = "UPDATE `cart` SET  `id_user` = '$id_user'
						  WHERE id_session = '$id_session'";
			//echo $mySql;
			$update = mysqli_query($con,$mySql);
			if (!$update)
			{ exit("Simpan Gagal2: " . $update);}
		}
	}elseif(isset($_POST['id_user'])) {
		if($_POST['id_user']==''){
			echo "<script type='text/javascript'>alert('Anda Belum login, Silahkan login..!');
			location.href = '?module=login&do=cart';
			</script>";
		}
		
	}

	$id_session='';
	if(!empty($_SESSION['e_token'])) {
		$id_session=$_SESSION['e_token'];
	}
		/*$id_session = $ip_ad.$id_user;*/
	$item_total = 0;
	
	$margin = 'margin-left: 30px;';
	if($vb == 'm') {
		$margin = 'margin-left: 5px;';
	}

	$margin2 = 'margin-left: 37px;';
	if($vb == 'm') {
		$margin2 = 'margin-left: 5px;';
	}
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
								<div class="col-xs-12 p-a-0">
								<form class="form-horizontal" id="loginForm" role="form" method="POST" action="?module=cart" onsubmit='disableButton()' autocomplete="off">
									<!-- <div class="cart-empty">Anda belum memasukkan barang apapun</div>-->
									<input type="hidden" name="id_user" id="id_user" readonly value="<?php echo $id_user; ?>">
									<input type="hidden" name="vb" id="vb" readonly value="<?php echo $vb; ?>">
									<?php
										if(!empty($id_user) || !empty($_GET['id_order'])){
									?>
									 <div class="form-group">
									    <label class="col-sm-2"><strong>Nomor Pemesanan</strong></label>
									    <div class="col-sm-2">
									      <input type="text" name="id_order"  class="form-control" readonly value="<?php 
									      if(isset($_GET['id_order'])) {
									      	$id_order = $_GET['id_order'];
									      	echo $id_order;
									      }else{
									      	echo $id_session;
									      }
									      ?>">
									    </div>
									  </div>

									 <div class="form-group">
									    <label class="col-sm-2"><strong>ID Member</strong></label>
									    <div class="col-sm-2">
									      <input type="text" class="form-control" readonly value="<?php echo $id_user; ?>">
									    </div>
									  </div>

									 
									 <div class="form-group">
										<label class="col-sm-2"><strong>Alamat Pengiriman</strong></label>
									 </div>
									<div class="form-group" style="<?php echo $margin; ?>">
									    <label class="col-sm-2">Nama Penerima</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="nama_penerima" id="nama_penerima"  value="<?php echo $nama_penerima; ?>">
									    </div>
									    <div class="col-md-2">
						                  <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"  ><b>Cari</b> <span class="fa fa-search"></span></button> -->
						                 
						                  <?php 
											if($vb == 'm') {
												echo ' <button type="button" class="btn btn-info" onclick="pilih_alamat2()" ><b>Cari</b> <span class="fa fa-search"></span></button>';
											}else{
												echo ' <button type="button" class="btn btn-info" onclick="pilih_alamat()" ><b>Cari</b> <span class="fa fa-search"></span></button>';
											}
										?>
						                </div>
									  </div>
									  <div class="form-group" style="<?php echo $margin; ?>">
									    <label class="col-sm-2">No. Telp</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="no_telp" id="no_telp"  value="<?php echo $no_telp; ?>">
									    </div>
									  </div>


									 <div class="form-group" style="<?php echo $margin; ?>">
									    <label class="col-sm-2">Negara</label>
									    <div class="col-sm-5">
										<?php 
											if($vb == 'm') {
												echo '<select name="negara" id="negara"  onchange="ambildata_negara2()" class="form-control">';
											}else{
												echo '<select name="negara" id="negara"  onchange="ambildata_negara()" class="form-control">';
											}
										?>
									    		<option value=" "> -- negara -- </option>
													<?php $q = mysqli_query ($con,"select * from negara");
													while ($k = mysqli_fetch_array($q)){ ?>
												
												<option 
												<?php if($negara == $k['nm_negara']){ echo " selected ";} ?>
												value="<?php echo $k['nm_negara']; ?>" 
													<?php (@$h['nm_negara']==$k['nm_negara'])?print(" "):print(""); ?>> <?php  echo $k['nm_negara']; ?>
												</option> <?php	} ?>
											</select>
										</div>
									  </div>

									 <div class="form-group" style="<?php echo $margin; ?>">
										<label class="col-sm-2">Provinsi</label>
										<div class="col-sm-4">
										<?php 
											if($vb == 'm') {
												echo '<input list="listprovinsi" name="provinsi" id="provinsi" value="'.$provinsi.'" onchange="ambildata_prov2()" class="form-control" />';
											}else{
												echo '<input list="listprovinsi" name="provinsi" id="provinsi" value="'.$provinsi.'" onchange="ambildata_prov()" class="form-control" />';
											}
										?> 
											<datalist id="listprovinsi" >
												<option data-value=" "> -- provinsi -- </option>
													<?php $q = mysqli_query ($con,"SELECT
																		provinsi.id_prov,
																		provinsi.nama
																		FROM
																		provinsi
																		ORDER BY provinsi.nama");
													while ($k = mysqli_fetch_array($q)){ ?>
												<option 
												<?php if($provinsi == $k['id_prov']){ echo " selected ";} ?>
												data-value="<?php echo $k['id_prov']; ?>" 
													<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
												</option> <?php	} ?>
											</datalist>
											<p>Klik tombol refresh untuk provinsi lain</p>
										</div>
										<div class="col-sm-1">
											<a  class="btn btn-info" onclick="kosong_prov()" ><span class="fa fa-refresh"><b></b> </span></a>
										</div>
									  </div>
									  
									  <div class="form-group" style="<?php echo $margin; ?>">
										<label for="kabupaten" class="col-sm-2">Kota / Kabupaten</label>
										<div class="col-sm-4">
										<?php 
											if($vb == 'm') {
												echo '<input list="listkab" name="kabupaten" id="kabupaten" value="'.$kabupaten.'" onchange="ambildata_kab2()" class="form-control">';
											}else{
												echo '<input list="listkab" name="kabupaten" id="kabupaten" value="'.$kabupaten.'" onchange="ambildata_kab()" class="form-control">';
											}
										?>
										<!-- <input list="listkab" name="kabupaten" id="kabupaten" value="<?php echo $kabupaten; ?>" class="form-control"> -->
												<datalist id="listkab" >
													<?php $q = mysqli_query ($con,"select * from kabupaten where id_kab='$kabupaten'");
									 				while ($k = mysqli_fetch_array($q)){ ?>
									 				<option 
									 				<?php if($kabupaten == $k['id_kab']){ echo " selected ";} ?>
									 				 data-value="<?php echo $k['id_kab']; ?>" 
									 					<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
									 				</option> <?php	} ?>
												</datalist>
												<p>Klik tombol refresh untuk Kota / Kabupaten lain</p>
											</div>
											<div class="col-sm-1">
												<?php 
													if($vb == 'm') {
														echo '<a  class="btn btn-info" onclick="ambildata_prov2()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}else{
														echo '<a  class="btn btn-info" onclick="ambildata_prov()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}
												?>
											</div>
										</div>
										
										 <div class="form-group" id="group_kec" style="<?php echo $margin; ?> display: block;">
											<label class="col-sm-2">Kecamatan</label>
											<div class="col-sm-4">
												<?php 
													if($vb == 'm') {
														echo '<input list="listkec" name="kecamatan" id="kecamatan"  onchange="ambildata_kec2()" 
													  value="'.$kecamatan.'" class="form-control">';
													}else{
														echo '<input list="listkec" name="kecamatan" id="kecamatan"  onchange="ambildata_kec()" 
													  value="'.$kecamatan.'" class="form-control">';
													}
												?>
													<!-- <input list="listkec" name="kecamatan" id="kecamatan"  onchange="ambildata_kec()" 
													class="form-control"> -->
													<datalist id="listkec" >
														<?php $q = mysqli_query ($con,"select * from kecamatan where id_kec='$kecamatan'");
										 				while ($k = mysqli_fetch_array($q)){ ?>
										 				<option 
										 				<?php if($kecamatan == $k['id_kec']){ echo " selected ";} ?>
										 				 data-value="<?php echo $k['id_kec']; ?>" 
										 					<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
										 				</option> <?php	} ?>
													</datalist>
													<p>Klik tombol refresh untuk Kecamatan lain</p>
											</div>
											<div class="col-sm-1">
												<?php 
													if($vb == 'm') {
														echo '<a  class="btn btn-info" onclick="ambildata_kab2()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}else{
														echo '<a  class="btn btn-info" onclick="ambildata_kab()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}
												?>
											</div>
										</div>
										<div class="form-group" id="group_kel" style="<?php echo $margin; ?> display: block;">
											<label class="col-sm-2">Kelurahan</label>
											<div class="col-sm-4">
												<?php 
													if($vb == 'm') {
														echo '<input list="listkel" name="kelurahan" id="kelurahan" onchange="ambildata_kirim2()" 
													value="'.$kelurahan.'"  class="form-control">';
													}else{
														echo '<input list="listkel" name="kelurahan" id="kelurahan" onchange="ambildata_kirim()" 
													value="'.$kelurahan.'"  class="form-control">';
													}
												?>
												<!-- <input list="listkel" name="kelurahan" id="kelurahan" onchange="ambildata_kirim()" class="form-control"> -->
												<datalist id="listkel" >
														<?php $q = mysqli_query ($con,"select * from kelurahan where id_kel='$kelurahan'");
							 					while ($k = mysqli_fetch_array($q)){ ?>
									 				<option 
									 				<?php if($kelurahan == $k['id_kel']){ echo " selected ";} ?>
									 				 data-value="<?php echo $k['id_kel']; ?>" 
									 					<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
									 				</option> <?php	} ?>
												</datalist>
												<p>Klik tombol refresh untuk Kelurahan lain</p>
											</div>
											<div class="col-sm-1">
												<?php 
													if($vb == 'm') {
														echo '<a  class="btn btn-info" onclick="ambildata_kec2()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}else{
														echo '<a  class="btn btn-info" onclick="ambildata_kec()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}
												?>
											</div>
										</div> 
									<div class="form-group" style="<?php echo $margin; ?>">
									    <label class="col-sm-2">Alamat Tujuan</label>
									    <div class="col-sm-8">
									      <textarea class="form-control" required="required" name="alamat_tujuan" id="alamat_tujuan"><?php echo $alamat_tujuan; ?></textarea>
									    </div>
									 </div>

									 <div class="form-group" style="<?php echo $margin; ?>">
									    <label class="col-sm-2">Kode Pos</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="kode_pos" id="kode_pos"  value="<?php echo $kode_pos; ?>">
									    </div>
									  </div>
									<div class="form-group">
									    <label class="col-sm-2"><strong>Metode Pengiriman</strong></label>
									    <div class="col-sm-4" style="<?php echo $margin2; ?>">
									    	<?php 
													if($vb == 'm') {
														echo '<select name="id_kirim" id="id_kirim" onchange="ambildata_ongkos2()" class="form-control">';
													}else{
														echo '<select name="id_kirim" id="id_kirim" onchange="ambildata_ongkos()" class="form-control">';
													}
												?>
											<!-- <select name="id_kirim" id="id_kirim"  class="form-control"> -->
									    		<option value="" data-id_kirim="0"> -- Pilih Pengiriman -- </option>
												<?php
													$vis ="hidden";
													if(!empty($via_kirim)){
														$query="SELECT *FROM mst_kirim Where nama_kirim = '$via_kirim'";
														$ekskirim=mysqli_query($con,$query);
														$dakirim=mysqli_fetch_array($ekskirim);
														$id_kirim = $dakirim['id_kirim'];
														echo '<option value="'.$id_kirim.'" data-id_kirim="'.$id_kirim .'" selected> '.$via_kirim.'</option>';

													}
													//$q = mysqli_query ($con,"select * from mst_kirim");
													//while ($k = mysqli_fetch_array($q)){ ?>
												<!-- <option  -->
												<?php //if($via_kirim == $k['nama_kirim']){ echo " selected ";} ?>
												<!-- value="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>" 
													<?php (@$h['nama_kirim']==$k['nama_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']; ?>
												</option>  -->
												//<?php	
												//	}
													
													/* $cek = "0";
													 $cekkirim = mysqli_query ($con,"select '1' as cek from mst_kirim where nama_kirim='$via_kirim'");
													 $hcek = mysqli_fetch_array($cekkirim);
													 $cek = $hcek['cek'];
													 if($cek=="1"){
													 	echo '<option value="-"> -- Pilihan Lainnya -- </option>';
													 	$vis ="hidden";
													 }else{
													 	if(strlen($via_kirim)>1){
														 	echo '<option value="-" selected> -- Pilihan Lainnya -- </option>';
														 	$vis ="text";
														 }else{
														 	echo '<option value="-"> -- Pilihan Lainnya -- </option>';
														 	$vis ="hidden";
														 }
													 }*/
												?>
												
											</select>
										</div>
										<div class="col-sm-1">
												<?php 
													if($vb == 'm') {
														echo '<a  class="btn btn-info" onclick="ambildata_kirim2()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}else{
														echo '<a  class="btn btn-info" onclick="ambildata_kirim()" ><span class="fa fa-refresh"><b></b> </span></a>';
													}
												?>
											</div>
										<div class="col-sm-3">

									      	<input type="<?php echo $vis; ?>" class="form-control" required="required" name="via_kirim" id="via_kirim" value="<?php echo $via_kirim; ?>">

									    </div>
									  </div>

									 <?php
										}
									 ?>
									 <div class="form-group">
										<label class="col-sm-2"><strong>Ringkasan Barang</strong></label>
									</div>
									<div class="form-group" style="<?php echo $margin; ?>">
										<div class="col-sm-11">
											<?php 
													if($vb == 'm') {
														echo '<table class="table" id="tablecart" cellpadding="10" cellspacing="1" style="display: block;overflow-x: auto;white-space: nowrap;"';
													}else{
														echo '<table class="table" id="tablecart" cellpadding="10" cellspacing="1"';
													}
												?>
											> 
												<tbody>
												<tr>
												<th style="text-align:left;" width=10px><strong>No.</strong></th>
												<th style="text-align:left;" width=120px><strong>Nama Produk</strong></th>
												<th style="text-align:right;" width=50px><strong>Harga</strong></th>
												<th style="text-align:right;" width=20px><strong>Jml</strong></th>
												<th style="text-align:right;" width=20px><strong>Berat<br>(gram atau ml)</strong></th>
												<th style="text-align:right;" width=50px><strong>Subtotal</strong></th>
												<th style="text-align:center;" width=20px><strong>Action</strong></th>
												</tr>	
												<?php		
													$no=1;
												     if(isset($_GET['id_order'])) {
												      	$id_order = $_GET['id_order'];
												      	//echo $id_order;
												      	$sqlcart= "SELECT * FROM cart LEFT JOIN produk ON produk.id_produk = cart.id_produk WHERE id_session = '$id_order'";
												     }else{
												      	//echo $id_session;
												      	$sqlcart= "SELECT * FROM cart LEFT JOIN produk ON produk.id_produk = cart.id_produk WHERE id_session = '$id_session'";
												     }
									     
													
													//echo $sqlcart;
													$qcart= mysqli_query($con,$sqlcart );
													while ($item = mysqli_fetch_array($qcart)){
														$id_produk = $item['id_produk'];
														$jml = $item['jml'];
														$berat = $item['berat'];
														$sberat = $jml * $berat;

												?>
												 <tr>
												 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $no; ?>
												 </td>
												 <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["nama_produk"]; ?>
												 <input type="hidden" name="id_produk[]" style="width: 100px;
												 	text-align:right;" readonly value="<?php echo ($item["id_produk"]); ?>">
												 </td>
												 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;">
												 	<?php echo format_angka($item["harga"]); ?>
												 	<input type="hidden" name="harga[]"  style="width: 100px;
												 	text-align:right;" readonly value="<?php echo ($item["harga"]); ?>">
												 </td>
												 <td style="text-align:right;">
												 	<input type="number" name="jml[]" style="width: 60px;text-align:right;" onChange="hitung2('tablecart')" value="<?php echo $item["jml"]; ?>">
												 </td>
												 <td style="text-align:right;">
												 	<input type="hidden" name="berat[]" style="width: 60px;text-align:right;"  readonly value="<?php echo ($berat); ?>"> 
												 	<input type="text" name="berat2[]"  style="width: 60px;text-align:right;"  readonly value="<?php echo format_angka($sberat); ?>"> 
												 </td>
												 <td style="text-align:right;border-bottom:#F0F0F0 1px solid;">
												 	<input type="text" style="width: 100px;text-align:right;" readonly value="<?php echo format_angka($item["harga"]*$item["jml"]); ?>">
												 	<input type="hidden" name="subtotal[]"  style="width: 100px;text-align:right;" readonly value="<?php echo ($item["harga"]*$item["jml"]); ?>">
												 </td>
												 <?php 
													if($vb == 'm') {
														echo '<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="javascript:void(0);" onclick="return delcart2('.$item["id_produk"].');" >X</a></td>';
													}else{
														echo '<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="javascript:void(0);" onclick="return delcart('.$item["id_produk"].');" >X</a></td>';
													}
												?>
												 <!--<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="javascript:void(0);" onclick="return delcart2('<?php echo $item["id_produk"]; ?>');" >X</a></td> -->
												 </tr>
												 <?php
												        $item_total += ($item["harga"]*$item["jml"]);
												        $tberat = $tberat + $sberat;
												        //if($tberat > 1000){
												        	$biaya_handling = (ceil($tberat/5000))*2500;
												        //}
												        $no ++;
														}
												 ?>
												<tr>
												<td colspan="5" align=right><strong>Total Belanja</strong></td>
												<td align=right>
													<input type="hidden" name="total" id="total" style="width: 100px;text-align:right;" readonly value="<?php echo ($item_total); ?>">
													<span  name="total2" id="total2"><?php echo "Rp. ".format_angka($item_total); ?></span>
												</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
									<?php
										if(!empty($id_user) || !empty($_GET['id_order'])){
									?>
									 <div class="form-group">
									    <label class="col-sm-2">Total Berat (gram atau ml)</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" name="tberat" id="tberat" readonly value="<?php echo format_angka($tberat); ?>">
									    </div>
									  </div>
									 <div class="form-group">
									    <label class="col-sm-2">Biaya Handling</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" name="biaya_handling" id="biaya_handling" onChange="hitung_tagihan()" readonly value="<?php echo format_angka($biaya_handling); ?>">
									    </div>
									  </div>
									  <?php
									  	$ongkir = 0;
									  	$kab = mysqli_query ($con,"select * from kabupaten where nama='$kabupaten'");
										$dkab=mysqli_fetch_array($kab);
										$ongkir = $dkab['ongkir'];

										if($ongkir==0 or is_null($ongkir)==1 ){
											$neg = mysqli_query ($con,"select * from negara where nm_negara='$kabupaten'");
											$dneg=mysqli_fetch_array($neg);
											$ongkir = $dneg['tarif'];

										}

									  ?>
									 <div class="form-group" id="group_ongkos" style="display: block;">
									    <label class="col-sm-2">Ongkos Kirim</label>
									    <div class="col-sm-3">
									    	<input type="hidden" class="form-control" required="required" name="songkos" id="songkos" readonly value="<?php echo format_angka($ongkir); ?>">
									      <input type="text" class="form-control" required="required" name="ongkos" id="ongkos" onChange="hitung_tagihan()" readonly value="<?php echo format_angka($ongkos); ?>">
									    </div>
									  </div>
									  <div class="form-group" id="group_tagihan" style="display: block;">
									    <label class="col-sm-2">Total Tagihan</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control"  name="total_bayar2" id="total_bayar2" readonly value="<?php echo format_angka($item_total + $biaya_handling +  $ongkos); ?>">
									      <input type="hidden" class="form-control"  name="total_bayar" id="total_bayar" readonly value="<?php echo ($item_total + $biaya_handling +  $ongkos); ?>">
									    </div>
									  </div>
									  <div class="form-group">
									    <label class="col-sm-2">Metode Pembayaran</label>
									    <div class="col-sm-3">
									      	<select name="via_bayar" id="via_bayar"  class="form-control">
													<?php $q = mysqli_query ($con,"select * from mst_bayar");
													while ($k = mysqli_fetch_array($q)){ ?>
												<option 
												<?php if($via_bayar == $k['nama_bayar']){ echo " selected ";} ?>
												value="<?php echo $k['nama_bayar']; ?>" 
													<?php (@$h['nama_bayar']==$k['nama_bayar'])?print(" "):print(""); ?>> <?php  echo $k['nama_bayar']; ?>
												</option> <?php	} ?>
											</select>
									    </div>
									  </div>
									  <div class="form-group">
									    <label class="col-sm-2">Waktu Order</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="tgl_order" readonly value="<?php date_default_timezone_set('Asia/Jakarta'); 
									      	if( !empty($tgl_order)){
									     		echo $tgl_order;
									     	}else{
									     		echo date('d-m-Y H:i:s');
									     	} ?>">
									    </div>
									  </div>
									  <div class="form-group">
									    <label class="col-sm-2">Persetujuan Order</label>
									    <div class="col-sm-1">
									       <input type="checkbox" name="setuju" required="required" value="1">
									    </div>
									  </div>
									<?php
										}
									?>
									<hr>
									<div class="form-group">
										<div class="col-xs-8 col-xs-offset-5">
											<button type="submit" id="btnsimpan" class="btn btn-primary"> Order Sekarang </button>
											<!-- <a class="btn btn-link" href="password/reset.html"> Forgot Your Password? </a> -->
										</div>
									</div>
									<script language="javascript">
										function disableButton() {
									        var btn = document.getElementById('btnsimpan');
									        btn.disabled = true;
									        btn.innerText = 'Posting...'
									    }
									</script>
								</form>
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
        <div class="modal" id="myModal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Lookup Lokasi Order</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped" style="display: block;overflow-x: auto;white-space: nowrap">
							<thead>
								<tr>
									<th>Penerima</th>
									<th>Alamat</th>
									<th>No.Telp</th>
									<th>Wilayah</th>
								</tr>
							</thead>
							<tbody>
                            
                            </tbody>
						</table>     
                    </div>
                </div>
            </div>
        </div>
 
<!-- <script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
<script type="text/javascript">
	
    $(document).on('click', '.pilih', function (e) {
        document.getElementById("nama_penerima").value = $(this).attr('data-nama_penerima');
		document.getElementById("no_telp").value = $(this).attr('data-no_telp');
		document.getElementById("negara").value = $(this).attr('data-negara');
		if($(this).attr('data-vb')=='m'){
			//ambiltarif_kab2();
			ambildata_negara2();
		}else{
			//ambiltarif_kab();
			ambildata_negara();
		}
		document.getElementById("provinsi").value = $(this).attr('data-provinsi');
		document.getElementById("kabupaten").value = $(this).attr('data-kabupaten');
/*		if($(this).attr('data-vb')=='vb'){
			//ambiltarif_kab2();
			ambildata_kab2();
		}else{
			//ambiltarif_kab();
			ambildata_kab();
		}*/
		
		document.getElementById("kecamatan").value = $(this).attr('data-kecamatan');
		document.getElementById("kelurahan").value = $(this).attr('data-kelurahan');
		//alert($(this).attr('data-vb'));
		if($(this).attr('data-vb')=='m'){
			//ambiltarif_kab2();
			ambildata_kirim2();
			//ambildata_ongkos2();
		}else{
			//ambiltarif_kab();
			ambildata_kirim();
			//ambildata_ongkos();
		}
		document.getElementById("alamat_tujuan").value = $(this).attr('data-alamat_tujuan');
		document.getElementById("kode_pos").value = $(this).attr('data-kode_pos');
		//alert($(this).attr('data-kecamatan'));
		
       	$('#myModal').modal('hide');
       	document.getElementById("group_ongkos").style.display = "none"
       	document.getElementById("group_tagihan").style.display = "none"
    });
    
			
		// js untuk ganti key enter jadi tab untuk objek input
			document.addEventListener('keydown', function (event) {
			  if (event.keyCode === 13 && event.target.nodeName === 'INPUT') {
				var form = event.target.form;
				var index = Array.prototype.indexOf.call(form, event.target);
				form.elements[index + 1].focus();
				event.preventDefault();
			  }
			});

</script>