<?php

include "../../inc/inc.library.php";
 
$aksi="module/order/order_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../image/bayar/";

function umur($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }

      $selisih=$tahun." Thn ".$bulan." Bln ";
    return $selisih;
}

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER medik ------------------------- ----->	
		
<h3 class="box-title margin text-center">Data Pesanan</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Pesanan </h3>
		<a class="btn btn-default pull-right" href="?module=order&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Order</a>

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr class="text-green">
			<th class="col-sm-1">No.</th>
			<th class="col-sm-3">Tgl. Pesan</th>
			<th class="col-sm-3">Pemesan</th> 
			<th class="col-sm-3">Penerima</th> 
			<th class="col-sm-4">Alamat</th> 
			<th class="col-sm-3">Tagihan</th>
			<th class="col-sm-2">Sts Bayar</th>
			<th class="col-sm-2">Sts Pesanan</th>
			<th class="col-sm-1">Aksi</th>
		</tr>
	</thead>

<tbody>
<?php 
// Tampilkan data dari Database
	$sql = "SELECT *FROM
			`order`,
			user_pelanggan 
			where user_pelanggan.id_user_pelanggan = `order`.id_user_pelanggan 
			ORDER BY tgl_order DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_order'];
//echo $data['gambar'];
?>

				<tr 
				<?php 
					if($data['via_bayar']=="Tunai" && $data['via_kirim']='Ikomart kurir'){

						if($data['sts_kirim'] == '1' && $data['sts_terima'] !== '1'){

						echo 'style="background:#90EE90"'; // warna Light Green

						}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1'  && $data['sts_terima'] == '1'){

						//echo 'style="background:#CD5C5C"';  // warna Indian Red

						}
					}else{
						if($data['sts_bayar'] !== '1' && $data['sts_kirim'] !== '1' && $data['sts_terima'] !== '1'){

						//echo 'style="background:blue"';
						echo 'style="background:#CD5C5C"';  // warna Indian Red

						}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1' && $data['sts_terima'] !== '1'){

						echo 'style="background:#90EE90"'; // warna Light Green

						}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1'  && $data['sts_terima'] == '1'){

						//echo 'style="background:#CD5C5C"';  // warna Indian Red

						}
					}
				?>>
				<td><?php echo $no; ?></td>
				<td><?php echo $data['tgl_order']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['nama_penerima']; ?></td>
				<td><?php echo $data['alamat_tujuan']; ?></td>
				<td><?php echo format_angka($data['total_bayar']); ?></td>
				<td><?php 
					if($data['via_bayar']=="Tunai" && $data['via_kirim']='Ikomart kurir'){
						if($data['sts_bayar'] !== '1'){ echo "COD";}else{ echo "Lunas";} 
					}else{
						if($data['sts_bayar'] !== '1'){ echo "Pending";}else{ echo "Lunas";}
					}
					?></td>
				<td><?php 
				//echo $data['sts_bayar']."-".$data['sts_kirim']."-".$data['sts_terima'] ;
				if($data['via_bayar']=="Tunai" && $data['via_kirim']=='Ikomart kurir'){
					if($data['sts_kirim'] !== '1' && $data['sts_terima'] !== '1'){
						echo "Packing Pengiriman";
					}elseif( $data['sts_kirim'] == '1' && $data['sts_terima'] !== '1'){
						echo "Proses Pengiriman";
					}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1' && $data['sts_terima'] == '1'){
						echo "Pesanan Diterima";
					} 
				}else{

					if($data['sts_bayar'] !== '1' && $data['sts_kirim'] !== '1' && $data['sts_terima'] !== '1'){
						echo "Menunggu Pembayaran";
					}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] !== '1' && $data['sts_terima'] !== '1'){
						echo "Packing Pengiriman";
					}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1' && $data['sts_terima'] !== '1'){
						echo "Proses Pengiriman";
					}elseif($data['sts_bayar'] == '1' && $data['sts_kirim'] == '1' && $data['sts_terima'] == '1'){
						echo "Pesanan Diterima";
					}
				}
     			?></td>
				<td>
  <a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_order'];?>" href="?module=order&aksi=edit&id_order=<?php echo $data['id_order'];?>"><i class="glyphicon glyphicon-edit"></i></a>
  
				</td>
				<?php
  $no ++;
				}
				?>
				</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER medik ------------------------- ----->

<?php 
break;

case "tambah":
	
  $id_order = milliseconds();
 // echo $id_order;
  $negara = 'Indonesia';
?>


<h3 class="box-title margin text-center">Konfirmasi Data Pesanan</h3>
<hr/>

<form class="form-horizontal" id="loginForm" role="form" method="POST" action="?module=cart" onsubmit='disableButton()' autocomplete="off">
	<div class="box box-solid box-primary">
	<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-user-md"></i> Informasi Pesanan</h3>
			<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
		<i class="fa fa-minus"></i></a>
	</div>	
	<div class="box-body">
									<!-- <div class="cart-empty">Anda belum memasukkan barang apapun</div>-->
									<input type="hidden" name="id_user" id="id_user" readonly value="<?php echo $id_user; ?>">
									<input type="hidden" name="vb" id="vb" readonly value="<?php echo $vb; ?>">
									
									 <div class="form-group">
									    <label class="col-sm-2"><strong>Nomor Pemesanan</strong></label>
									    <div class="col-sm-2">
									      <input type="text" name="id_order"  class="form-control" readonly value="<?php echo $id_order; ?>">
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
									<div class="form-group"  >
									    <label class="col-sm-2">Nama Penerima</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="nama_penerima" id="nama_penerima"  value="<?php echo $nama_penerima; ?>">
									    </div>
									    <div class="col-md-2">
						                  	<button type="button" class="btn btn-info" onclick="pilih_alamat2()" ><b>Cari</b> <span class="fa fa-search"></span></button>
						                </div>
									  </div>
									  <div class="form-group"  >
									    <label class="col-sm-2">No. Telp</label>
									    <div class="col-sm-3">
									      <input type="text" class="form-control" required="required" name="no_telp" id="no_telp"  value="<?php echo $no_telp; ?>">
									    </div>
									  </div>


									 <div class="form-group"  >
									    <label class="col-sm-2">Negara</label>
									    <div class="col-sm-5">
									    	<select name="negara" id="negara"  onchange="ambildata_negara()" class="form-control">
									
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

									 <div class="form-group"  >
										<label class="col-sm-2">Provinsi</label>
										<div class="col-sm-4">
											<input list="listprovinsi" name="provinsi" id="provinsi" onchange="ambildata_prov2()" class="form-control" />
										
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
									  
									  <div class="form-group"  >
										<label for="kabupaten" class="col-sm-2">Kota / Kabupaten</label>
										<div class="col-sm-4">
											<input list="listkab" name="kabupaten" id="kabupaten" onchange="ambildata_kab2()" class="form-control">
										
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
												<a  class="btn btn-info" onclick="ambildata_prov2()" ><span class="fa fa-refresh"><b></b> </span></a>
												
											</div>
										</div>
										
										 <div class="form-group" id="group_kec" style="<?php echo $margin; ?> display: block;">
											<label class="col-sm-2">Kecamatan</label>
											<div class="col-sm-4">
												<input list="listkec" name="kecamatan" id="kecamatan"  onchange="ambildata_kec2()" class="form-control">
												
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
												<a  class="btn btn-info" onclick="ambildata_kab2()" ><span class="fa fa-refresh"><b></b> </span></a>
											</div>
										</div>
										<div class="form-group" id="group_kel" style="<?php echo $margin; ?> display: block;">
											<label class="col-sm-2">Kelurahan</label>
											<div class="col-sm-4">
												<input list="listkel" name="kelurahan" id="kelurahan" onchange="ambildata_kirim2()"  class="form-control">
												
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
												<a  class="btn btn-info" onclick="ambildata_kec2()" ><span class="fa fa-refresh"><b></b> </span></a>
												
											</div>
										</div> 
									<div class="form-group"  >
									    <label class="col-sm-2">Alamat Tujuan</label>
									    <div class="col-sm-8">
									      <textarea class="form-control" required="required" name="alamat_tujuan" id="alamat_tujuan"><?php echo $alamat_tujuan; ?></textarea>
									    </div>
									 </div>

									 <div class="form-group"  >
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
											<a  class="btn btn-info" onclick="ambildata_kirim2()" ><span class="fa fa-refresh"><b></b> </span></a>
											</div>
										<div class="col-sm-3">

									      	<input type="<?php echo $vis; ?>" class="form-control" required="required" name="via_kirim" id="via_kirim" value="<?php echo $via_kirim; ?>">

									    </div>
									  </div>

									 <div class="form-group">
										<label class="col-sm-2"><strong>Ringkasan Barang</strong></label>
									</div>
									<div class="form-group"  >
										<div class="col-sm-11">
											<a onclick="addrow2('tablecart')" class="btn btn-xs btn-info" href="javascript:void(0);"> <i class="fa fa-plus"> </i> Tambah</a>
	  										<a onclick="deleteRow('tablecart')" class="btn btn-xs btn-primary" href="javascript:void(0);"> <i class="fa fa-ban"> </i> Hapus</a>
											<table class="table table-bordered" id="tablecart" cellpadding="10" cellspacing="1" >
											
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
												   $sqlcart= "SELECT * FROM cart LEFT JOIN produk ON produk.id_produk = cart.id_produk WHERE id_session = '$id_order'";
													
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
												 <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="javascript:void(0);" onclick="return delcart2('.$item["id_produk"].');" >X</a></td>
												
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

	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
		oFReader.onload = function (oFREvent)
		 {
			document.getElementById("uploadPreview").src = oFREvent.target.result;
		}
	}
	function ambildata_produk() {
		var  nama_produk = $('#nama_produk').val();
		//alert(nama_produk);
        var abc = $("#listproduk option[value='" + $('#nama_produk').val() + "']").attr('data-id');
        $('#id_produk').val(abc)
        //alert(abc);
    }

    function show_produk(rowCount) {
    	var nama_produk=$("#nama_produk" + rowCount).val();
		//var etoken=$('#etoken').val();
		//alert(nama_produk);
		 if (nama_produk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'../module/get_produk.php',
				type:'GET',
				dataType:'html',
				data:{'action': 'show_produk','nama_produk': nama_produk},
				success:function (respons) {
					//alert(respons);
					var hasil = respons.split('|');
					//$("#container-iko").html(respons);
					//alert(hasil[0]);
					$("#berat2"+rowCount).val(hasil[0]);
					$("#harga"+rowCount).val(hasil[1]);
				}, 
			})  
		/*jml_cart();*/
		}
    }

	function Comma(Num) { //function to add commas to textboxes
        Num += '';
		Num = Num.replace(/[^\d]+/g, '');
        Num = Num.replace('.', ''); 
        x = Num.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        return x1 + x2;
    }

    function detail_bayar() {
		var keyword=$('#id_user').val();
		$('#myModalbayar').modal('show');
	}

	function set_bayar(){
		var checkBox = document.getElementById("sts_bayar");
		var today = new Date();
		var waktu = today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) + " " + ('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2) + ":" + ('0' + today.getSeconds()).slice(-2);
		$('#tgl_bayar').val(waktu);

	}

	function addrow2(tableID) {
			   var table = document.getElementById(tableID);
			   var rowCount = table.rows.length - 1;
			   var row = table.insertRow(rowCount);
			   //var row = table.insertRow(1);
			   var box_html = (rowCount);
			   
			   var box_html2 = ('<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><input list="listproduk'+rowCount+'" type="text" name="nama_produk" id="nama_produk'+rowCount+'" class="form-control" onchange="show_produk('+rowCount+')"/><datalist id="listproduk'+rowCount+'" ><?php $q = mysqli_query ($con,"SELECT * FROM `produk` Where sts_aktif='1' order by nama_produk");while ($k = mysqli_fetch_array($q)){ ?><option data-value="<?php echo $k['id_produk']; ?>" ><?php echo str_replace("'", " ", $k['nama_produk']); ?></option><?php	} ?></datalist></td>');
			   
			   var box_html3 = ('<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><input type="text" name="harga[]" id="harga'+rowCount+'"  style="width: 100px; text-align:right;" readonly value="<?php echo ($item["harga"]); ?>"></td>');
			   
			   var box_html4 = ('<td style="text-align:right;"><input type="number" name="jml[]" style="width: 60px;text-align:right;" onChange="hitung3('+ "'tablecart'" + ')" value="<?php echo $item["jml"]; ?>"></td>');
			   
			   var box_html5 = ('<td style="text-align:right;"><input type="hidden" name="berat[]" style="width: 60px;text-align:right;"  readonly value="<?php echo ($berat); ?>"><input type="text" name="berat2[]" id="berat2'+rowCount+'" style="width: 60px;text-align:right;"  readonly value="<?php echo format_angka($sberat); ?>"></td>');
			   
			   var box_html6 = ('<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><input type="text" style="width: 100px;text-align:right;" readonly value="<?php echo format_angka($item["harga"]*$item["jml"]); ?>"><input type="hidden" name="subtotal[]"  style="width: 100px;text-align:right;" readonly value="<?php echo ($item["harga"]*$item["jml"]); ?>"></td>');
			   
			   var box_html7 = ('<input name="chk" type="checkbox">');
			   
			   var cell1 = row.insertCell(0);
			   cell1.innerHTML = box_html;

			   var cell2 = row.insertCell(1);
			   cell2.innerHTML = box_html2;
			   
			   var cell3 = row.insertCell(2);
			   cell3.innerHTML = box_html3;
			   
			   var cell4 = row.insertCell(3);
			   cell4.innerHTML = box_html4;
			   
			   var cell5 = row.insertCell(4);
			   cell5.innerHTML = box_html5;
			   
			   var cell6 = row.insertCell(5);
			   cell6.innerHTML = box_html6;
			   
			   var cell7 = row.insertCell(6);
			   cell7.innerHTML = box_html7;
			  
		}

	function deleteRow(tableID) {
	   try {
	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;

	   for(var i=1; i<rowCount - 1; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[6].childNodes[0];
		//var cek = row.cells[7].innerHTML;
		//alert(chkbox.checked);
		if(null != chkbox && true == chkbox.checked) {
			table.deleteRow(i);
			rowCount--;
			i--;
		}

	   }
	   }catch(e) {
			alert(e);
	   }
	 }

function hitung3(tableID) {
		  try {
		   var table = document.getElementById(tableID);
		   var total2 = 0;
		   var tberat = 0;
		   var rowCount = table.rows.length;
		   //alert(rowCount);
		   for(var i=1; i<rowCount - 1; i++) {
			var row = table.rows[i];
			//alert(row);
			//var id_produk = row.cells[1].childNodes[1].value;
			//alert(id_produk);
			var harga = row.cells[2].childNodes[0].value;
			var jml = row.cells[3].childNodes[0].value;
			var berat = row.cells[4].childNodes[1].value;
			//var berat2 = row.cells[4].childNodes[3].value;
			//alert(berat);
			var total  = harga * jml;
			total2  = total2 +  total;

			var sberat  = berat * jml;
			tberat  = tberat + sberat;

			row.cells[4].childNodes[0].value= sberat.numberFormat(0, ',', '.');
			row.cells[5].childNodes[0].value= total.numberFormat(0, ',', '.');

			//upcart(id_produk,jml);
			//alert(tberat);
		   }
		   var bhandling = 0;
		   //if(tberat>5000){
		   	 bhandling = (Math.ceil(tberat/5000)) * 2500;
		   //}
		   
		   $('#total').val(total2);
		   $('#tberat').val(tberat.numberFormat(0, ',', '.'));
		   $('#biaya_handling').val(bhandling.numberFormat(0, ',', '.'));
			$('#total2').html("Rp. " + total2.numberFormat(0, ',', '.'));
			hitung_tagihan();
			
		   }catch(e) {
			alert(e);
		   }
	  }
	
</script>
	</div>
</form>

 <!-- Modal -->
        <div class="modal" id="myModalbayar" role="dialog" tabindex="-1" aria-labelledby="myModalLabelbayar" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelbayar">Bukti Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-hover ">
                        	<tbody>
						<?php
							if (!empty($bukti_bayar)){
								echo '<tr><td colspan=3><img border="0" style="width:100%;height:auto;" src="'.$folder.$bukti_bayar.'"></td></tr>';
							}
 
						?>
							
                            
                            </tbody>
						</table>     
                    </div>
                </div>
            </div>
        </div>
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
	 

 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;

case "edit":
$data=mysqli_query($con,"select * from `order` p where p.id_order='$_GET[id_order]'");
$edit=mysqli_fetch_array($data);
  $id_order = trim($edit['id_order']);
  $alamat_tujuan = trim($edit['alamat_tujuan']);
  $provinsi = $edit['provinsi'];
  $kabupaten = $edit['kabupaten'];
  $kecamatan = $edit['kecamatan'];
  $kelurahan = $edit['kelurahan'];
  $no_telp = $edit['no_telp'];
  $bukti_bayar = $edit['bukti_bayar'];

  $prov = mysqli_query ($con,"select * from provinsi where id_prov='$provinsi'");
  $dprov=mysqli_fetch_array($prov);
  $nama_prov = $dprov['nama'];

  $prov = mysqli_query ($con,"select * from `ongkir` where nama='$kabupaten'");
												$dprov=mysqli_fetch_array($prov);
												$id_kab = $dprov['id_kab'];
												$id_kec = $dprov['id_kec'];
												$id_kel = $dprov['id_kel'];

												$kab = mysqli_query ($con,"select * from kabupaten where id_kab='$id_kab'");
												$dkab=mysqli_fetch_array($kab);
												$daerah = $dkab['nama'];

												$kec = mysqli_query ($con,"select * from kecamatan where id_kec='$id_kec'");
												$dkec=mysqli_fetch_array($kec);
												$nama_kec = $dkec['nama'];

												$kel = mysqli_query ($con,"select * from kelurahan where id_kel='$id_kel'");
												$dkel=mysqli_fetch_array($kel);
												$nama_kel = $dkel['nama'];

												$wilayah = ((strlen($nama_kec)>1)? $nama_kec.". ":"").((strlen($nama_kel)>1)? $nama_kel:"");
?>


<h3 class="box-title margin text-center">Konfirmasi Data Pesanan</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=order&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
	<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-user-md"></i> Informasi Pesanan</h3>
			<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
		<i class="fa fa-minus"></i></a>
	</div>	
	<div class="box-body">
	  <div class="form-group">
		<label class="col-sm-2 control-label">No. Pesanan</label>
		<div class="col-sm-2">
		  <input type="text" class="form-control" required="required" name="id_order" readonly value="<?php echo $edit['id_order']; ?>">
		</div>
	  </div>

	 <div class="form-group">
		<label class="col-sm-2 control-label">Tgl. Pesanan </label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="tgl_order="tgl_order" readonly value="<?php echo $edit['tgl_order']; ?>">
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Nama Pemesan</label>
		<div class="col-sm-5">
			<?php
				$id_user_pelanggan = $edit['id_user_pelanggan'];
				//echo "select * from user_pelanggan p where p.id_user_pelanggan='$id_user_pelanggan'";
				$datapel=mysqli_query($con,"select * from user_pelanggan p where p.id_user_pelanggan='$id_user_pelanggan'");
				$editpel=mysqli_fetch_array($datapel);
			 ?>
			<input type="text" class="form-control" required="required" readonly name="user_pelanggan" id="user_pelanggan" value="<?php echo $editpel['nama']; ?>">
		</div>
		<div class="col-sm-2">
		  <input type="hidden" class="form-control" required="required" readonly name="id_user_pelanggan" id="id_user_pelanggan" value="<?php echo $edit['id_user_pelanggan']; ?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nama Penerima</label>
		<div class="col-sm-5">
		  <input type="text" class="form-control" required="required" name="nama_penerima" id="nama_penerima" readonly value="<?php
		   echo $edit['nama_penerima']; ?>" >
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Alamat</label>
		<div class="col-sm-5">
		  <textarea class="form-control"  rows=3 name="alamat_tujuan" id="alamat_tujuan" readonly ><?php echo nl2br($alamat_tujuan.". ".((strlen($wilayah)>1)? $wilayah.". ":"").((strlen($daerah)>1)? $daerah.". ":"").((strlen($provinsi)>1)? $provinsi.". ":"").$negara.((strlen($kode_pos)>1)? " (".$kode_pos.") ":"").$no_telp,FALSE ); 
    	?>
		  </textarea>
		</div>
	  </div>

	  <div class="form-group">
			<label class="col-sm-2 control-label"><strong>Ringkasan Barang</strong></label>
		</div>
									<div class="col-sm-10" style="margin-left: 30px;">
									 	<table class="table" cellpadding="10" cellspacing="1">
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
									 	<td colspan="2" style="text-align:right;"><span id="biaya_handling" name="biaya_handling"><?php echo "Rp. ".format_angka($edit['biaya_handling']); ?></span></td>
									 	</tr>
									 	<tr>
									 	<td colspan="3" style="text-align:right;">Ongkos Kirim </td>
									 	<td colspan="2" style="text-align:right;"><span id="ongkos" name="ongkos"><?php echo "Rp. ".format_angka($edit['ongkos']); ?></span></td>
									 	</tr>
									 	<tr>
									 	<td colspan="3" style="text-align:right;"><strong>Total Bayar</strong> </td>
									 	<td colspan="2" style="text-align:right;"><span id="total" name="total"><?php echo "Rp. ".format_angka($item_total + $edit['biaya_handling'] + $edit['ongkos']); ?></span></td>
									 	</tr>
									 	</tbody>
									 	</table>
								 	</div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Total Tagihan</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="total_bayar" id="total_bayar" readonly value="<?php echo format_angka($edit['total_bayar']); ?>" onkeyup = "javascript:this.value=Comma(this.value);">
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Metode Pengiriman</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="via_kirim" id="via_kirim" readonly value="<?php
		   echo $edit['via_kirim']; ?>" >
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Metode Pembayaran</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="via_bayar" id="via_bayar" readonly value="<?php
		   echo $edit['via_bayar']; ?>" >
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Bayar</label>
		<div class="col-sm-1">
			<?php if($edit['sts_bayar']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_bayar" id="sts_bayar" value="1" onclick="set_bayar()">
		</div>
		<div class="col-sm-2">
		  <input type="text"  name="tgl_bayar" id="tgl_bayar" value="<?php echo $edit['tgl_bayar']; ?>" class="form-control" >
		</div>
		<div class="col-sm-3">
			<button type="button" class="btn btn-info" onclick="detail_bayar()" ><b>Lihat Detail</b> <span class="fa fa-money"></span></button>
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Pengiriman</label>
		<div class="col-sm-3">
			<?php if($edit['sts_kirim']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_kirim" id="sts_kirim" value="1">
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Sampai Ke Pelanggan</label>
		<div class="col-sm-3">
			<?php if($edit['sts_terima']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_terima" id="sts_terima" value="1">
		</div>
	  </div>

	</div>  
</div>
	<div class="form-group">
		<label class="col-sm-2"></label>
		<div class="col-sm-5">
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
			<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
		</div>
	 </div> 
</form>

 <!-- Modal -->
        <div class="modal" id="myModalbayar" role="dialog" tabindex="-1" aria-labelledby="myModalLabelbayar" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelbayar">Bukti Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-hover ">
                        	<tbody>
						<?php
							if (!empty($bukti_bayar)){
								echo '<tr><td colspan=3><img border="0" style="width:100%;height:auto;" src="'.$folder.$bukti_bayar.'"></td></tr>';
							}
 
						?>
							
                            
                            </tbody>
						</table>     
                    </div>
                </div>
            </div>
        </div>
	 
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent)
	 {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
	}
	}
</script>
<script type="text/javascript">
	function ambildata_produk() {
		var  nama_produk = $('#nama_produk').val();
		//alert(nama_produk);
        var abc = $("#listproduk option[value='" + $('#nama_produk').val() + "']").attr('data-id');
        $('#id_produk').val(abc)
        //alert(abc);
    };
	function Comma(Num) { //function to add commas to textboxes
        Num += '';
		Num = Num.replace(/[^\d]+/g, '');
        Num = Num.replace('.', ''); 
        x = Num.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        return x1 + x2;
    }

    function detail_bayar() {
		var keyword=$('#id_user').val();
		$('#myModalbayar').modal('show');
	}

	function set_bayar(){
		var checkBox = document.getElementById("sts_bayar");
		var today = new Date();
		var waktu = today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2) + " " + ('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2) + ":" + ('0' + today.getSeconds()).slice(-2);
		$('#tgl_bayar').val(waktu);

	}
</script>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
