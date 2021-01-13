<?php
	$sts_mobile = './';
	if($vb == 'm') {
		$sts_mobile = '../';
	}
?>
<style>
    #star {
            float: left;
            padding-right: 20px;
        }

        #star span {
            padding: 3px;
            font-size: 20px;
        }

        .on {
            color: #f7d106
        }

        .off {
            color: #ddd;
        }
</style>
<div class="banner-container">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="image-container">
					<a href="#" class="mp-banner_link"><img src="<?php echo $sts_mobile; ?>banner/IkomartSlide1.png" title="Selamat Datang Di Ikomart" alt="Selamat Datang Di Ikomart" style="height:<?php if($vb == 'm') { echo "100px;";}else{echo "273px;";} ?>"/></a>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="image-container">
					<a href="#" class="mp-banner_link"><img src="<?php echo $sts_mobile; ?>banner/IkomartSlide2.png" title="Mengapa Belanja di Ikomart" alt="Mengapa Belanja di Ikomart" style="height:<?php if($vb == 'm') { echo "100px;";}else{echo "273px;";} ?>"/></a>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="image-container">
					<a href="#" class="mp-banner_link"><img src="<?php echo $sts_mobile; ?>banner/IkomartSlide3.png" title="Langkah belanja mudah" alt="Langkah belanja mudah" style="height:<?php if($vb == 'm') { echo "100px;";}else{echo "273px;";} ?>"/></a>
				</div>
			</div>
		</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
</div>

<div class="value-strip">
	<div class="container">
		<div class="row vertical-divider">
			<div class="col-xs-4 text-center">
				<div class="col-xs-2"><img src="<?php echo $sts_mobile; ?>img/icons-value-1-v21.png" title="Icon Dekat" alt="Icon Dekat"></div>
				<div class="col-xs-10">
					<div class="title">Dekat</div><br>
					<div class="desc">Aplikasi ditangan anda</div>
				</div>
			</div>
			<div class="col-xs-4 text-center">
				<div class="col-xs-2"><img src="<?php echo $sts_mobile; ?>img/icons-value-2-v21.png" title="Icon Hemat" alt="Icon Hemat"></div>
				<div class="col-xs-10">
					<div class="title">Hemat</div><br>
					<div class="desc">Harga yang ditawarkan kompetitif</div>
				</div>
			</div>
			<div class="col-xs-4 text-center">
				<div class="col-xs-2"><img src="<?php echo $sts_mobile; ?>img/icons-value-3-v21.png" title="Icon Terpercaya" alt="Icon Terpercaya"></div>
				<div class="col-xs-10">
					<div class="title">Terpercaya </div><br>
					<div class="desc">Kualitas barang terjamin</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container m-t-0">
	<div class="row border-b p-tb-12 m-b-20 m-lr-0">
		<div class="col-xs-6 p-a-0">
			<h2 class="top-item-title">Produk Pilihan Ikomart</h2>
		</div>
		<div class="col-xs-6 p-a-0 text-right">
			<span class="top-item-title-link ">
			<?php
				if($vb == 'm') {
			?>
				<a href="?module=produk2&sts_promo=1" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}else{
			?>
				<a href="?module=produk&sts_promo=1" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}
			?>
			</span>
		</div>
	</div>
	<div class="bg-white m-b-15">
		<div class="row">
			<div class="col-xs-12 p-r-0">
			<?php
				if($vb == 'm') {
			?>
				<div class="mainimg-item2 recommended-product">
			<?php
				}else{
			?>
				<div class="sideimg-item recommended-product">
			<?php
				}
			?>
					<div class="sw-product-list-container">
						<div class="swiper-container">
							<div class="swiper-wrapper">
							<?php
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
											produk.gambar,
											harga.harga_jual,
											harga.harga_pasar,
											harga.tgl_awal_promo,
											harga.tgl_akhir_promo
										FROM
											produk ,
											harga,
											kelompok,
											categories
										WHERE
											harga.id_produk = produk.id_produk AND
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											produk.sts_aktif = '1'  AND
											harga.sts_promo = '1'  AND
											( produk.gambar ='' or not ISNULL(produk.gambar)) AND
											(harga.sts_paket <> '1' OR ISNULL(harga.sts_paket) )AND
											( harga.tgl_awal_promo <= CURDATE()   AND	harga.tgl_akhir_promo >= CURDATE()  )
										ORDER BY harga.tgl_awal_promo DESC
										LIMIT 8";
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
								$harga_jual = $rproduk['harga_jual'];
								$harga_pasar = $rproduk['harga_pasar'];
								$tgl_awal_promo = $rproduk['tgl_awal_promo'];
								$tgl_akhir_promo = $rproduk['tgl_akhir_promo'];
								//echo $nama_kelompok;
						?>
								<div class="swiper-slide"  style="margin-right: 15px;">
									<div class="image-container ">
										<a href="?prd=iko&p=<?php echo $alias; ?>"  title="<?php echo $nama_produk; ?>">
											<img class="lazy" style="width:100%;height:282px;" src="
											<?php 
											if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
												echo $sts_mobile."img/wmark.png";
											}else{
												echo $sts_mobile."image/produk/".$gambar."?t=".milliseconds();
											}
											?>"  alt="<?php echo $nama_produk; ?>" />
											<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
										</a>
									</div>
									<div class="desc-container">
										<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
										<div class="item-name first-line item-wrapper" style="height:40px;">
										<a href="?prd=iko&p=<?php echo $alias; ?>"  title="<?php echo $nama_produk; ?>"><?php echo $nama_produk; ?></a>
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
										<div class="item-desc">Dikirim Oleh : <b><?php echo $dikirim; ?></b></div>
										<div class="item-date" style=""><input type="hidden" name="order_item_date" value="2020-07-24"></div>
										<div class="clearfix"></div>
										<div class="product-box-action-container">

										<input type="hidden" name="last_qty" value="0">
										<div class="buy-container ">
											<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php if($stok==0 || $stok==null){echo "Stok Kosong"; }else{echo "Beli Sekarang";} ?></button>
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
							<?php }?>
							</div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-4 p-l-0"><div class="overlay-bg side-image"><a href="product/lemonilo-kecap-manis-135-ml.html" class="mp-recommended_side_banner_link"><img class="lazy" src="./image/catalog/02-500x500.png?auto=format&amp;q=50&amp;w=410" data-original="./image/catalog/02-500x500.png?auto=format&q=50&w=410" alt="Side Banner" title="Side Banner"></a></div></div> -->
		</div>
	</div>


<div class="row border-b p-tb-12 m-b-20 m-lr-0">
	<div class="col-xs-6 p-a-0"><h2 class="top-item-title">Terbaru Di Ikomart</h2></div>
	<div class="col-xs-6 p-a-0 text-right">
		<span class="top-item-title-link ">
			<?php
				if($vb == 'm') {
			?>
				<a href="?module=produk2" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}else{
			?>
				<a href="?module=produk" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}
			?>
		</span>
	</div>
</div>
<div class="bg-white m-b-15">
	<div class="row">
			<div class="col-xs-12 p-r-0">
				<?php
					if($vb == 'm') {
				?>
					<div class="mainimg-item2 recommended-product">
				<?php
					}else{
				?>
					<div class="sideimg-item recommended-product">
				<?php
					}
				?>
					<div class="sw-product-list-container">
						<div class="swiper-container">
							<div class="swiper-wrapper">
							<?php
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
											produk.gambar,
											harga.harga_jual,
											harga.harga_pasar,
											harga.tgl_awal_promo,
											harga.tgl_akhir_promo
										FROM
											produk ,
											harga,
											kelompok,
											categories
										WHERE (harga.sts_paket <> '1' OR ISNULL(harga.sts_paket) )AND
											produk.sts_aktif = '1'  AND
											harga.id_produk = produk.id_produk AND
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											( produk.gambar ='' or not ISNULL(produk.gambar)) AND
											( harga.tgl_awal_promo <= CURDATE()   AND	harga.tgl_akhir_promo >= CURDATE()  )
										ORDER BY harga.tgl_awal_promo DESC
										LIMIT 8";
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
								$harga_jual = $rproduk['harga_jual'];
								$harga_pasar = $rproduk['harga_pasar'];
								$tgl_awal_promo = $rproduk['tgl_awal_promo'];
								$tgl_akhir_promo = $rproduk['tgl_akhir_promo'];
								//echo $nama_kelompok;
						?>
								<div class="swiper-slide"  style="margin-right: 15px;">
									<div class="image-container ">
										<!-- <div class="flag-container">
											<img class="icon-delivery" src="./img/icons-value-3-v2.png?w=80&amp;auto=format" title="Dikirim oleh ikomart" alt="Dikirim oleh ikomart">
										</div> -->
										<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>">
											<img class="lazy" style="width:100%;height:282px;" src="
											<?php 
											if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
												echo $sts_mobile."img/wmark.png";
											}else{
												echo $sts_mobile."image/produk/".$gambar."?t=".milliseconds();
											}
											?>"  alt="<?php echo $nama_produk; ?>" />
											<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
										</a>
									</div>
									<div class="desc-container">
										<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
										<div class="item-merchant">
											<a href="" title="ikomart">ikomart</a>
										</div>
										<div class="item-name first-line item-wrapper" style="height:40px;">
											<a href="?prd=iko&p=<?php echo $alias; ?>"  title="<?php echo $nama_produk; ?>"><?php echo $nama_produk; ?></a>
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
										<div class="item-desc">Dikirim Oleh : <b><?php echo $dikirim; ?></b></div>
										<div class="item-date" style=""><input type="hidden" name="order_item_date" value="2020-07-24"></div>
										<div class="clearfix"></div>

										<input type="hidden" name="last_qty" value="0">
										<div class="buy-container ">
											<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php if($stok==0 || $stok==null){echo "Stok Kosong"; }else{echo "Beli Sekarang";} ?></button>
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
							<?php }?>
							</div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-4 p-l-0"><div class="overlay-bg side-image"><a href="product/lemonilo-kecap-manis-135-ml.html" class="mp-recommended_side_banner_link"><img class="lazy" src="./image/catalog/02-500x500.png?auto=format&amp;q=50&amp;w=410" data-original="./image/catalog/02-500x500.png?auto=format&q=50&w=410" alt="Side Banner" title="Side Banner"></a></div></div> -->
	</div>
</div>
<div class="row border-b p-tb-12 m-b-20 m-lr-0">
	<div class="col-xs-6 p-a-0"><h2 class="top-item-title">IkomartBOX</h2></div>
	<div class="col-xs-6 p-a-0 text-right">
		<span class="top-item-title-link ">
			<?php
				if($vb == 'm') {
			?>
				<a href="?module=produk2&sts_paket=1" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}else{
			?>
				<a href="?module=produk&sts_paket=1" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
			<?php
				}
			?>
		</span>
	</div>
</div>
<div class="bg-white m-b-15">
	<div class="row">
			<div class="col-xs-12 p-r-0">
				<?php
					if($vb == 'm') {
				?>
					<div class="mainimg-item2 recommended-product">
				<?php
					}else{
				?>
					<div class="sideimg-item recommended-product">
				<?php
					}
				?>
					<div class="sw-product-list-container">
						<div class="swiper-container">
							<div class="swiper-wrapper">
							<?php
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
											produk.gambar,
											harga.harga_jual,
											harga.harga_pasar,
											harga.tgl_awal_promo,
											harga.tgl_akhir_promo
										FROM
											produk ,
											harga,
											kelompok,
											categories
										WHERE
											produk.sts_aktif = '1'  AND
											harga.sts_paket = '1' AND
											harga.id_produk = produk.id_produk AND
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											( harga.tgl_awal_promo <= CURDATE()   AND	harga.tgl_akhir_promo >= CURDATE()  )
										ORDER BY harga.tgl_awal_promo DESC
										LIMIT 8";
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
								$harga_jual = $rproduk['harga_jual'];
								$harga_pasar = $rproduk['harga_pasar'];
								$tgl_awal_promo = $rproduk['tgl_awal_promo'];
								$tgl_akhir_promo = $rproduk['tgl_akhir_promo'];
								//echo $nama_kelompok;
						?>
								<div class="swiper-slide"  style="margin-right: 15px;">
									<div class="image-container ">
										<!-- <div class="flag-container">
											<img class="icon-delivery" src="./img/icons-value-3-v2.png?w=80&amp;auto=format" title="Dikirim oleh ikomart" alt="Dikirim oleh ikomart">
										</div> -->
										<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>">
											<img class="lazy" style="width:100%;height:282px;" src="
											<?php 
											if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
												echo $sts_mobile."img/wmark.png";
											}else{
												echo $sts_mobile."image/produk/".$gambar."?t=".milliseconds();
											}
											?>"  alt="<?php echo $nama_produk; ?>" />
											<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
										</a>
									</div>
									<div class="desc-container">
										<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
										<div class="item-merchant">
											<a href="" title="ikomart">ikomart</a>
										</div>
										<div class="item-name first-line item-wrapper" style="height:40px;">
											<a href="?prd=iko&p=<?php echo $alias; ?>"  title="<?php echo $nama_produk; ?>"><?php echo $nama_produk; ?></a>
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
										<div class="item-desc">Dikirim Oleh : <b><?php echo $dikirim; ?></b></div>
										<div class="item-date" style=""><input type="hidden" name="order_item_date" value="2020-07-24"></div>
										<div class="clearfix"></div>

										<input type="hidden" name="last_qty" value="0">
										<div class="buy-container ">
											<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php if($stok==0 || $stok==null){echo "Stok Kosong"; }else{echo "Beli Sekarang";} ?></button>
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
							<?php }?>
							</div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-4 p-l-0"><div class="overlay-bg side-image"><a href="product/lemonilo-kecap-manis-135-ml.html" class="mp-recommended_side_banner_link"><img class="lazy" src="./image/catalog/02-500x500.png?auto=format&amp;q=50&amp;w=410" data-original="./image/catalog/02-500x500.png?auto=format&q=50&w=410" alt="Side Banner" title="Side Banner"></a></div></div> -->
	</div>
</div>

<div class="row border-b p-tb-12 m-b-20 m-lr-0">
	<div class="col-xs-6 p-a-0">
		<h2 class="top-item-title">Artikel Terbaru</h2>
	</div>
	<div class="col-xs-6 p-a-0 text-right">
		<span class="top-item-title-link">
			<a href="?module=blog" title="Lihat Semua">Lihat Semua <i class="fa fa-angle-right m-l-5"></i></a>
		</span>
	</div>
</div>
<div class="row">
	<div class="top-items-no articles">
		<?php
						$sqlberita = "SELECT
												mst_berita.id_berita,
												mst_berita.judul,
												mst_berita.isi,
												mst_berita.sumber,
												mst_berita.link,
												mst_berita.gbr,
												mst_berita.tanggal,
												mst_berita.img,
												mst_berita.sum,
												mst_berita.id_blog,
												mst_berita.alias,
												blog.nama_blog
											FROM
												mst_berita
												LEFT JOIN blog ON blog.id_blog = mst_berita.id_blog
											ORDER BY mst_berita.tanggal desc LIMIT 3 ";
						
						//echo $sqlberita;
						$qberita = mysqli_query($con,$sqlberita );
						while ($rberita = mysqli_fetch_array($qberita))
						{
							$judul = $rberita['judul'];	
							$id_berita = $rberita['id_berita'];	
							$alias = $rberita['alias'];	
							$tanggal = $rberita['tanggal'];	
							$sumber = $rberita['sumber'];	
							$sum = $rberita['sum'];	
							$nama_blog = $rberita['nama_blog'];	
							$img = $rberita['img'];	
							//echo $id_berita;

						if($vb == 'm') {
					?>
						<div class="col-xs-12 item-container m-b-20">
					<?php
						}else{
					?>
						<div class="col-xs-4 item-container m-b-20">
					<?php
						}
					?>
							<div class="image-container">
								<a href="?module=blog&id_berita=<?php echo $id_berita; ?>"><img class="lazy" style="width: 100%;height: 240px;" src="<?php echo $sts_mobile."image/blog/".$img;?>?w=400&amp;auto=format&amp;q=50" data-original="<?php echo $sts_mobile."image/blog/".$img;?>?w=400&auto=format&q=50" title="<?php echo $judul;?>" /></a>
							</div>
							<div class="desc-container ">
								<!-- <div class="item-logo"><span class="icon icon-tips"></span></div> -->
								<div class="item-category"><?php echo $nama_blog;?></div>
								<div class="item-name item-wrapper m-b-5">
									<a href="?module=blog&id_berita=<?php echo $id_berita; ?>">
										<div><?php echo $judul;?></div>
									</a>
								</div>
								<hr>
								<div class="item-desc">
									<div><?php echo substr(strval($sum),0,150)."..." ;?></div>
									<div class="row m-t-20">
										<div class="col-xs-7">
											<div class="item-location text-left"><?php echo $sumber; ?></div>
										</div>
										<div class="col-xs-5"><div class="item-date text-right"><?php echo Indonesia2Tgl($tanggal); ?></div></div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
						
	</div>
</div>
</div>
