<?php
include "../inc/koneksi.php";
include "../inc/inc.library.php";
 
if(!empty($_GET["action"])) {
switch($_GET["action"]) {

	case "filproduk":
		$id_group=($_GET['id_group']);
		$id_kelompok=($_GET['id_kelompok']);
		$id_kategori=($_GET['id_kategori']);

		echo '<div class="row">';
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
											produk.gambar
										FROM
											produk ,
											kelompok,
											categories
										WHERE produk.sts_aktif = '1'  AND
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											produk.id_group LIKE '%$id_group%'   And
											produk.id_kelompok LIKE '%$id_kelompok%' And
											produk.id_kategori LIKE '%$id_kategori%' LIMIT 50";
							
							//echo $sqlproduk;
							$qproduk= mysqli_query($con,$sqlproduk );
							while ($rproduk = mysqli_fetch_array($qproduk))
							{
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
								$gambar = $rproduk['gambar'];
								$harga_jual = 0;
								$sqltarif= "select*from harga where id_produk='$id_produk' AND ( tgl_awal_promo <= CURDATE()   AND	 tgl_akhir_promo >= CURDATE()  )";
								$datatarif = mysqli_query($con, $sqltarif);
								$tarif=mysqli_fetch_array($datatarif);
								$harga_jual = $tarif['harga_jual'];
								$harga_pasar = $tarif['harga_pasar'];
								$tgl_awal_promo = $tarif['tgl_awal_promo'];
								$tgl_akhir_promo = $tarif['tgl_akhir_promo'];
								//echo $gambar;
						?>
						<div class="product-box-container" data-fulfillment="1" data-uuid=<?php echo $id_produk; ?>" data-type="non">
							<div class="col-xs-4 item-container m-b-20">
								<div class="image-container ">
									<!-- <div class="flag-container">
										<img class="icon-delivery" src="./img/icons-value-3-v2.png?w=80&amp;auto=format" title="Dikirim oleh ikomart" alt="Dikirim oleh ikomart">
									</div> -->
									<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>">
										<img class="lazy" style="width:100%;height:282px;" src="
										<?php 
										if($gambar=='' || $gambar==null || !file_exists("../image/produk/".$gambar)){
											echo "./img/wmark.png?t=".milliseconds();
										}else{
											echo "./image/produk/".$gambar."?t=".milliseconds();
										}
										?>" data-original="<?php echo $gambar; ?>?w=300&h=300&auto=format&q=50" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
										<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
									</a>
								</div>
								<div class="desc-container">
									<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
									<div class="item-name first-line item-wrapper">
										<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>"><?php echo $nama_produk; ?></a>
									</div>
									<div class="item-desc"><?php echo $ukuran; ?></div>
									<div class="item-rating">
											<div class="item-rating-wrapper"><input class="rating" data-min="0" data-max="5" data-step="1" data-show-clear="false" data-show-caption="false" data-size="xxs" data-display-only="true" value="<?php
											$data=mysqli_query($con,"SELECT AVG(rate) AS jml FROM rating WHERE id_produk = '" . $id_produk . "'");
											$q=mysqli_fetch_array($data);
											$hasil  = ceil($q['jml']);
										    echo "Rating ".ceil($q['jml']) ;
										    ?>"><span class="item-rating-total"><?php
									        		$sqlproduk = "SELECT * FROM `rating` WHERE id_produk = '" . $id_produk . "'";
													$result= mysqli_query($con,$sqlproduk );
													//echo $sqlproduk;
												    //hitung row
													$row_cnt = mysqli_num_rows($result);
													echo $row_cnt." ulasan"; 
												?></span>
												<div id="star" class="col-xs-12 text-center">
									                <?php
									                for ($i = 0; $i < $hasil; $i++) {
									                    echo '<span class="on"><i class="fa fa-star"></i></span>';
									                }

									                for ($i = 5; $i > $hasil; $i--) {
									                    echo '<span class="off"><i class="fa fa-star"></i></span>';
									                }
									                ?>
									        	</div>
											</div>
										</div>
									<div class="item-listprice">
										<div style="min-height: 20px;">
											<div class="item-bprice"><sup class='pricing'>Rp </sup><?php echo format_angka($harga_pasar); ?></div>
											<div class="item-save">diskon <sup class='pricing'>Rp </sup><?php echo format_angka($harga_pasar-$harga_jual); ?></div>
										</div>
										<div class="item-price" style="min-height: 20px;"><sup class='pricing'>Rp </sup> <?php echo format_angka($harga_jual); ?></div>
									</div>
									<div class="item-desc">Tersedia : <b><?php echo $stok; ?></b></div>
									<div class="item-desc">Dijual Oleh : <b><?php echo $dijual; ?></b></div>
									<div class="item-desc">Dikirim Oleh: <b><?php echo $dikirim; ?></b></div>
									<div class="item-date" style=""><input type="hidden" name="order_item_date" value="2020-07-24"></div>
									<div class="clearfix"></div>
								</div>
								<div class="product-box-action-container">
									<input type="hidden" name="last_qty" value="0">
									<div class="loading-container">
										<div class="btn btn-primary btn-block btn-rectangular" disabled><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></div>
									</div>
									<div class="buy-container ">
										<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null || $harga_jual < 1){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null || $harga_jual < 1){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php
										 	if($stok==0 || $stok==null){
										 		echo "Stok Kosong"; 
										 	}else{
										 		if($harga_jual >0){
										 		 	echo "Beli Sekarang"; 
										 		 }else{ 
										 		 	echo "Harga Belum Ada"; 
										 		 }
										 	} 
										 	?></button>
									</div>
									<div class="qty-container hidden" data-qty-min="0" data-qty-max="20383" data-step="1" data-is-pre-order="0" data-availability-type="limited_stock">
										<div class="col-xs-2 p-a-0">
											<button type="button" class="btn btn-minus qty-min"><i class="fa fa-minus" aria-hidden="true"></i></button>
										</div>
										<div class="col-xs-8 p-a-0">
											<input type="text" pattern="\d*" class="form-control qty-number" name="order_qty" value="0" placeholder="Jumlah" maxlength="6" data-qty-min="1" data-qty-max="999999" onkeypress="return check_qty_format_valid(event,this)">
										</div>
										<div class="col-xs-2 p-a-0">
											<button type="button" class="btn btn-plus qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
						</div>
					</div>
	<?php
	break;

	case "filmerk":
		$merk=($_GET['merk']);

		echo '<div class="row">';
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
											produk.gambar
										FROM
											produk ,
											kelompok,
											categories
										WHERE
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											produk.merk LIKE '%$merk%' LIMIT 50";
							
							//echo $sqlproduk;
							$qproduk= mysqli_query($con,$sqlproduk );
							while ($rproduk = mysqli_fetch_array($qproduk))
							{
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
								$gambar = $rproduk['gambar'];
								
								$sqltarif= "select*from harga where id_produk='$id_produk' AND ( tgl_awal_promo <= CURDATE()   AND	 tgl_akhir_promo >= CURDATE()  )";
								$datatarif = mysqli_query($con, $sqltarif);
								$tarif=mysqli_fetch_array($datatarif);
								$harga_jual = $tarif['harga_jual'];
								$harga_pasar = $tarif['harga_pasar'];
								$tgl_awal_promo = $tarif['tgl_awal_promo'];
								$tgl_akhir_promo = $tarif['tgl_akhir_promo'];
								//echo $gambar;
						?>
						<div class="product-box-container" data-fulfillment="1" data-uuid=<?php echo $id_produk; ?>" data-type="non">
							<div class="col-xs-4 item-container m-b-20">
								<div class="image-container ">
									<!-- <div class="flag-container">
										<img class="icon-delivery" src="./img/icons-value-3-v2.png?w=80&amp;auto=format" title="Dikirim oleh ikomart" alt="Dikirim oleh ikomart">
									</div> -->
									<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>">
										<img class="lazy" style="width:100%;height:282px;" src="
										<?php 
										if($gambar=='' || $gambar==null || !file_exists("../image/produk/".$gambar)){
											echo "./img/wmark.png?t=".milliseconds();
										}else{
											echo "./image/produk/".$gambar."?t=".milliseconds();
										}
										?>" data-original="<?php echo $gambar; ?>?w=300&h=300&auto=format&q=50" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
										<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
									</a>
								</div>
								<div class="desc-container">
									<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
									<div class="item-name first-line item-wrapper">
										<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>"><?php echo $nama_produk; ?></a>
									</div>
									<div class="item-desc"><?php echo $ukuran; ?></div>
									<div class="item-rating">
											<div class="item-rating-wrapper"><input class="rating" data-min="0" data-max="5" data-step="1" data-show-clear="false" data-show-caption="false" data-size="xxs" data-display-only="true" value="<?php
											$data=mysqli_query($con,"SELECT AVG(rate) AS jml FROM rating WHERE id_produk = '" . $id_produk . "'");
											$q=mysqli_fetch_array($data);
											$hasil  = ceil($q['jml']);
										    echo "Rating ".ceil($q['jml']) ;
										    ?>"><span class="item-rating-total"><?php
									        		$sqlproduk = "SELECT * FROM `rating` WHERE id_produk = '" . $id_produk . "'";
													$result= mysqli_query($con,$sqlproduk );
													//echo $sqlproduk;
												    //hitung row
													$row_cnt = mysqli_num_rows($result);
													echo $row_cnt." ulasan"; 
												?></span>
												<div id="star" class="col-xs-12 text-center">
									                <?php
									                for ($i = 0; $i < $hasil; $i++) {
									                    echo '<span class="on"><i class="fa fa-star"></i></span>';
									                }

									                for ($i = 5; $i > $hasil; $i--) {
									                    echo '<span class="off"><i class="fa fa-star"></i></span>';
									                }
									                ?>
									        	</div>
											</div>
										</div>
									<div class="item-listprice">
										<div style="min-height: 20px;">
											<div class="item-bprice"><sup class='pricing'>Rp </sup><?php echo format_angka($harga_pasar); ?></div>
											<div class="item-save">diskon <sup class='pricing'>Rp </sup><?php echo format_angka($harga_pasar-$harga_jual); ?></div>
										</div>
										<div class="item-price" style="min-height: 20px;"><sup class='pricing'>Rp </sup> <?php echo format_angka($harga_jual); ?></div>
									</div>
									<div class="item-desc">Tersedia : <b><?php echo $stok; ?></b></div>
									<div class="item-desc">Dijual Oleh : <b><?php echo $dijual; ?></b></div>
									<div class="item-desc">Dikirim Oleh: <b><?php echo $dikirim; ?></b></div>
									<div class="item-date" style=""><input type="hidden" name="order_item_date" value="2020-07-24"></div>
									<div class="clearfix"></div>
								</div>
								<div class="product-box-action-container">
									<input type="hidden" name="last_qty" value="0">
									<div class="loading-container">
										<div class="btn btn-primary btn-block btn-rectangular" disabled><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></div>
									</div>
									<div class="buy-container ">
										<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null || $harga_jual < 1){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null || $harga_jual < 1){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php
										 	if($stok==0 || $stok==null){
										 		echo "Stok Kosong"; 
										 	}else{
										 		if($harga_jual >0){
										 		 	echo "Beli Sekarang"; 
										 		 }else{ 
										 		 	echo "Harga Belum Ada"; 
										 		 }
										 	} 
										 	?></button>
									</div>>
									<div class="qty-container hidden" data-qty-min="0" data-qty-max="20383" data-step="1" data-is-pre-order="0" data-availability-type="limited_stock">
										<div class="col-xs-2 p-a-0">
											<button type="button" class="btn btn-minus qty-min"><i class="fa fa-minus" aria-hidden="true"></i></button>
										</div>
										<div class="col-xs-8 p-a-0">
											<input type="text" pattern="\d*" class="form-control qty-number" name="order_qty" value="0" placeholder="Jumlah" maxlength="6" data-qty-min="1" data-qty-max="999999" onkeypress="return check_qty_format_valid(event,this)">
										</div>
										<div class="col-xs-2 p-a-0">
											<button type="button" class="btn btn-plus qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
						</div>
					</div>
	<?php
		break;

	case "show_produk":
		$nama_produk=($_GET['nama_produk']);
		//echo $nama_produk;
		$query="SELECT *FROM produk
			Where nama_produk = '$nama_produk'";
		//echo $query;
		$qproduk=mysqli_query($con,$query);
		$rproduk=mysqli_fetch_array($qproduk);
		$id_produk = $rproduk['id_produk']; 
		$berat = $rproduk['berat'];
		echo $berat.'|';

		$sqltarif= "select*from harga where id_produk='$id_produk' AND ( tgl_awal_promo <= CURDATE()   AND	 tgl_akhir_promo >= CURDATE()  )";
		$datatarif = mysqli_query($con, $sqltarif);
		$tarif=mysqli_fetch_array($datatarif);
		$harga_jual = $tarif['harga_jual'];
		echo $harga_jual;						
		

		break;
	}
}
?>