
<?php
	$sts_mobile = './';
	if($vb == 'm') {
		$sts_mobile = '../';
	}

	$id_group='';
	if(isset($_GET['id_group'])){
		$id_group = $_GET['id_group'];
	}

	$id_kelompok='';
	if(isset($_GET['id_kelompok'])){
		$id_kelompok = $_GET['id_kelompok'];
	}

	$id_kategori='';
	if(isset($_GET['id_kategori'])){
		$id_kategori = $_GET['id_kategori'];
	}

	$sts_promo='';
	if(isset($_GET['sts_promo'])){
		$sts_promo = " AND produk.id_produk IN (( SELECT id_produk FROM harga WHERE sts_promo = '1')) ";
	}

	$sts_paket='';
	if(isset($_GET['sts_paket'])){
		$sts_paket = " AND produk.id_produk IN (( SELECT id_produk FROM harga WHERE sts_paket = '1')) ";
	}

	$search_input='';
	if(isset($_POST['search_input'])){
		$search_input = $_POST['search_input'];
	}
	if(isset($_GET['search_input'])){
		$search_input = $_GET['search_input'];
	}
	unset($_POST);
	//echo $search_input;

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
<input type="hidden" id="total-product" value="234">
<input type="hidden" id="category-slug" value="Produk">
<div class="bg-darkgrey">
	<div class="category-banner only-text">
		<div class="banner-main banner-middle">
			<div class="banner-title"><div class="title">Produk</div></div>
		</div>
	</div>
</div>
<div class="content-space">
	<div class="container top-item snacks">
		<div class="row border-b p-tb-10 m-lr-0">
			<div class="col-xs-12 p-a-0">
				<div class="top-item-title">Shop The Products</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3 filter-box">
				<div class="panel-group panel-group-side m-t-15" role="tablist" aria-multiselectable="true">
					<div class="panel panel-sidemenu">
						<div class="panel-heading panel-dashed" id="heading-category-slider" role="button" data-toggle="collapse" href="#collapse-category-slider" aria-expanded="true" aria-controls="collapse-category-slider">
							<div class="row">
								<div class="col-xs-10">	
									<div class="panel-title">Kategori</div>
								</div>
								<div class="col-xs-2">
									<a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-category-slider" aria-expanded="true" aria-controls="collapse-category-slider"></a>
								</div>
							</div>
						</div>
						<div id="collapse-category-slider" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-category-slider" data-key ="review">
							<div class="panel-body">
								<div class="list-group list-group-root">
									<?php
										$jmltotal =0;
										if ($search_input==''){
											$sqlgroup = "SELECT count(produk.id_produk) as jmltotal
																FROM
																	produk ,
																	kelompok,
																	categories
																WHERE produk.sts_aktif = '1'  AND
																	kelompok.id_kelompok = produk.id_kelompok AND
																	categories.id_kategori = produk.id_kategori AND
																	produk.id_group LIKE '%$id_group%'  And
																	produk.id_kelompok LIKE '%$id_kelompok%' ".$sts_promo.$sts_paket."
																LIMIT 50";
										}else{
											$sqlgroup = "SELECT count(produk.id_produk) as jmltotal
																FROM
																	produk ,
																	kelompok,
																	categories
																WHERE produk.sts_aktif = '1'  AND
																	kelompok.id_kelompok = produk.id_kelompok AND
																	categories.id_kategori = produk.id_kategori AND
																	produk.nama_produk LIKE '%$search_input%'  
																LIMIT 50";
										}
											//echo $sqlgroup;
											$qgroup = mysqli_query($con,$sqlgroup );
											while ($rgroup = mysqli_fetch_array($qgroup))
											{
												$jmltotal = $rgroup['jmltotal'];
												//echo $jmltotal;
											}
										?>
									<div class="list-group-item list-group-title"><a href="?module=produk&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok; ?>" class="list-group-item " title="Produk (<?php echo $jmltotal; ?>)">Produk (<?php echo $jmltotal; ?>)</a></div>
									<div class="list-group">
										<?php
											if ($search_input==''){
												$sqlkelompok = "SELECT
																	max(produk.id_group) as id_group,
																	max(produk.id_kelompok) as id_kelompok,
																	max(produk.id_kategori) as id_kategori,
																	max(kelompok.nama_kelompok) as nama_kelompok,
																	max(kelompok.deskripsi_kelompok) as deskripsi_kelompok,
																	max(categories.nama) as nama,
																	count(produk.id_produk) as jml
																FROM
																	produk ,
																	kelompok,
																	categories
																WHERE produk.sts_aktif = '1'  AND
																	kelompok.id_kelompok = produk.id_kelompok AND
																	categories.id_kategori = produk.id_kategori AND
																	produk.id_group LIKE '%$id_group%'  And
																	produk.id_kelompok LIKE '%$id_kelompok%' ".$sts_promo.$sts_paket."GROUP BY
																	produk.id_kategori	
																ORDER BY categories.nama";
											}else{
												$sqlkelompok = "SELECT
																	max(produk.id_group) as id_group,
																	max(produk.id_kelompok) as id_kelompok,
																	max(produk.id_kategori) as id_kategori,
																	max(kelompok.nama_kelompok) as nama_kelompok,
																	max(kelompok.deskripsi_kelompok) as deskripsi_kelompok,
																	max(categories.nama) as nama,
																	count(produk.id_produk) as jml
																FROM
																	produk ,
																	kelompok,
																	categories
																WHERE produk.sts_aktif = '1'  AND
																	kelompok.id_kelompok = produk.id_kelompok AND
																	categories.id_kategori = produk.id_kategori AND
																	produk.nama_produk LIKE '%$search_input%' 
																GROUP BY
																	produk.id_kategori	
																ORDER BY categories.nama LIMIT 50 ";
											}
											//echo $sqlkelompok;
											$qkelompok = mysqli_query($con,$sqlkelompok );
											while ($rkelompok = mysqli_fetch_array($qkelompok))
											{
												$nama = $rkelompok['nama'];	
												$id_kelompok2 = $rkelompok['id_kelompok'];	
												$id_kategori2 = $rkelompok['id_kategori'];	
												$jml = $rkelompok['jml'];
												//echo $nama_kelompok;
										?>
										
										<a onclick="return filproduk('<?php echo $id_group; ?>','<?php echo $id_kelompok2; ?>', '<?php echo $id_kategori2; ?>');" href="javascript:void(0);" class="list-group-item " title="<?php echo ucfirst(strtolower($nama)); ?>"><?php echo ucfirst(strtolower($nama)).' ('.$jml.')'; ?></a>
										<!-- <a href="./?module=produk&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok2."&id_kategori=".$id_kategori2; ?>" class="list-group-item " title="<?php echo ucfirst(strtolower($nama)); ?>"><?php echo ucfirst(strtolower($nama)).' ('.$jml.')'; ?></a> -->
										
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="panel panel-sidemenu"><div class="panel-heading panel-dashed" id="heading-0" role="button" data-toggle="collapse" href="#collapse-0" aria-expanded="true" aria-controls="collapse-0"><div class="row"><div class="col-xs-10"><div class="panel-title">Manfaat Produk</div></div><div class="col-xs-2"><a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-0" aria-expanded="true" aria-controls="collapse-0"></a></div></div></div><div id="collapse-0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-0" data-key ="product_tag"><div class="panel-body panel-overflow"><form><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="rendah-kalori" > Rendah Kalori (116)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="tanpa-tambahan-gula" > Tanpa Tambahan Gula (106)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="rendah-gula" > Rendah Gula (84)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="organik" > Organik (17)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="bebas-gluten" > Bebas Gluten (104)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="ibu-hamil-menyusui" > Ibu Hamil &amp; Menyusui (41)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="tumbuh-kembang-anak" > Produk Ramah Anak (40)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="langsung-dari-petani" > Langsung Dari Petani (18)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="pemberdayaan-wanita" > Pemberdayaan Wanita (12)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="ramah-lingkungan" > Ramah Lingkungan (176)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="usaha-kecil-menengah" > Usaha Kecil &amp; Menengah (189)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="buatan-lokal" > Buatan Lokal (198)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="sertifikat-halal-mui" > Sertifikat Halal MUI (53)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="dinyatakan-halal-oleh-produsen" > Dinyatakan Halal Oleh Produsen (215)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="vegetarian" > Vegetarian (78)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="rendah-lemak" > Rendah Lemak (5)</label></div><div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="rendah-sodium" > Rendah Sodium (17)</label></div></form></div></div></div> -->
					<div class="panel panel-sidemenu">
						<div class="panel-heading panel-dashed" id="heading-1" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
							<div class="row">
								<div class="col-xs-10">
									<div class="panel-title">Merk Kami</div>
								</div>
								<div class="col-xs-2">
									<a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1"></a>
								</div>
							</div>
						</div>
						<div id="collapse-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-1" data-key ="merchant">
							<div class="panel-body panel-overflow">
								<!-- <div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="semua_merk" > Semua Merk</label></div> -->
								<div class="checkbox">
									<input type="radio" id="merk<?php echo $no; ?>" name="merk" onclick="return filmerk('%');" href="javascript:void(0);" value="semua_merk">
	  								<label for="merk<?php echo $no; ?>">semua_merk</label>
	  							</div>
									<?php
										$no = 1;
										if ($search_input==''){
											$sqlmerk = "SELECT
															max(produk.id_group) AS id_group,
															max(produk.id_kelompok) AS id_kelompok,
															max(produk.merk) AS merk,
															count(produk.id_produk) AS jml
														FROM
															produk
														WHERE produk.sts_aktif = '1'  AND
														 produk.id_group LIKE '%$id_group%' 
														AND produk.id_kelompok LIKE '%$id_kelompok%' 
														AND not ISNULL(produk.merk) ".$sts_promo.$sts_paket."GROUP BY
															produk.merk
														ORDER BY
															produk.merk LIMIT 50";
										}else{
											$sqlmerk = "SELECT
															max(produk.id_group) AS id_group,
															max(produk.id_kelompok) AS id_kelompok,
															max(produk.merk) AS merk,
															count(produk.id_produk) AS jml
														FROM
															produk
														WHERE produk.sts_aktif = '1'  AND
															produk.nama_produk LIKE '%$search_input%' 
														AND not ISNULL(produk.merk)
														GROUP BY
															produk.merk
														ORDER BY
															produk.merk";
										}
										//echo $sqlkelompok;
										$qmerk = mysqli_query($con,$sqlmerk );
										while ($rmerk= mysqli_fetch_array($qmerk))
										{
											$merk = $rmerk['merk'];	
											$jml = $rmerk['jml'];
											//echo $nama_kelompok;
									?>
							 		<!--<div class="checkbox">
										 <label>
											<a onclick="return filmerk('<?php echo $merk; ?>');" href="javascript:void(0);" class="list-group-item " title="<?php echo ucfirst(strtolower($merk)); ?>"><?php echo ucfirst(strtolower($merk)); ?></a>
											 <input type="checkbox" class="checkbox-filter" data-slug="<?php echo ucfirst(strtolower($merk)); ?>" >
										<?php echo ucfirst(strtolower($merk)); ?> 
										</label> 
										
									</div> -->
									<div class="checkbox">
										<input type="radio" id="merk<?php echo $no; ?>" name="merk" onclick="return filmerk('<?php echo $merk; ?>');" href="javascript:void(0);" value="<?php echo ucfirst(strtolower($merk)); ?>">
  										<label for="merk<?php echo $no; ?>"><?php echo ucfirst(strtolower($merk)); ?></label>
  									</div>
											
									<?php
										$no ++;
									}
									?>
									
								
							</div>
						</div>
					</div>
					<div class="panel panel-sidemenu">
						<div class="panel-heading panel-dashed" id="heading-2" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
							<div class="row">
								<div class="col-xs-10">
									<div class="panel-title">Dikirim Oleh</div>
								</div>
								<div class="col-xs-2">
									<a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2"></a>
								</div>
							</div>
						</div>
						<div id="collapse-2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-2" data-key ="seller">
							<div class="panel-body panel-overflow">
								<form>
									<div class="checkbox"><label><input type="checkbox" class="checkbox-filter" data-slug="ikomart" > ikomart </label></div>
								</form>
							</div>
						</div>
					</div>
					<div class="panel panel-sidemenu"></div>
					<!--<div class="panel panel-sidemenu"><div class="panel-heading panel-dashed" id="heading-review-slider" role="button" data-toggle="collapse" href="#collapse-review-slider" aria-expanded="true" aria-controls="collapse-review-slider"><div class="row"><div class="col-xs-10"><div class="panel-title">Ulasan</div></div><div class="col-xs-2"><a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-review-slider" aria-expanded="true" aria-controls="collapse-review-slider"></a></div></div></div><div id="collapse-review-slider" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-review-slider" data-key ="review"><div class="panel-body"><div class="item-review-slider"><form><input id="item-review-range" type="text" class="span2" data-slider-orientation="vertical" data-slider-reversed="true" data-slider-ticks="[0, 1, 2, 3, 4, 5]" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="[0,5]" data-slider-ticks-labels='["<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=0>", "<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=1>", "<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=2>", "<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=3>", "<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=4>", "<input class=rating data-min=0 data-max=5 data-step=1 data-show-clear=false data-show-caption=false data-size=xxxs data-display-only=true data-class=rating-style value=5>"]' style="width: 100%;" /></form></div></div></div></div>
					<div class="panel-heading panel-dashed" id="heading-slider" role="button" data-toggle="collapse" href="#collapse-slider" aria-expanded="true" aria-controls="collapse-slider"><div class="row"><div class="col-xs-10"><div class="panel-title">Harga</div></div><div class="col-xs-2"><a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse-slider" aria-expanded="true" aria-controls="collapse-slider"></a></div></div></div>
					<div id="collapse-slider" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-slider" data-key ="price"><div class="panel-body"><div class="item-price-slider"><form><input id="item-price-range" type="text" class="span2" value="" data-slider-min="7500" data-slider-max="380000" data-slider-step="7450" data-slider-value="[7500,380000]" style="width: 100%;" /></form><div class="row m-t-15"><div class="col-xs-6"><span class="slider-value" id="sliderValMin"><sup class='pricing'>Rp</sup> 7.500</span></div><div class="col-xs-6 text-right"><span class="slider-value" id="sliderValMax"><sup class='pricing'>Rp</sup> 380.000</span></div></div></div></div></div>-->
				</div>
			</div>
			<div class="col-xs-9 m-t-15">
				<div class="top-items-no">
					<div class="container-iko" >
						<div class="row">
						<?php
							if ($search_input==''){
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
											produk.id_kategori LIKE '%$id_kategori%' ".$sts_promo.$sts_paket." LIMIT 50";
							}else{
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
											produk.nama_produk LIKE '%$search_input%'
										LIMIT 50 ";
								
							}
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
								//echo $nama_kelompok;
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
										if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
											echo $sts_mobile."img/wmark.png?t=".milliseconds();
										}else{
											echo $sts_mobile."image/produk/".$gambar."?t=".milliseconds();
										}
										?>" data-original="<?php echo $gambar; ?>?w=300&h=300&auto=format&q=50" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
										<div class="sold-overlay <?php if($stok>0){echo "hidden"; } ?> "><div class="sold-text">Sold Out</div></div>
									</a>
								</div>
								<div class="desc-container">
									<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
									<div class="item-name first-line item-wrapper" style="height: 40px;">
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
				</div>
				<!-- <div class="pagination-wrap">
					<div class="pagination">
						<div class="pagination-previous disabled list-inline-pagination"><i class="fa fa-angle-left"></i></div>
						<a href="?module=produk" class="list-inline-pagination current">1</a></li>
						<a href="#" class="list-inline-pagination ">2</a></li>
						<a href="#" class="list-inline-pagination ">3</a></li>
						<a href="#" class="list-inline-pagination ">4</a></li>
						<a href="#" class="list-inline-pagination ">5</a></li>
						<div class="pagination-next list-inline-pagination">
							<a href="#"><i class="fa fa-angle-right"></i></a>
						</div>
						<div class="form-inline sort-box m-l-15" style="display: inline-block;">
							<div class="form-group">
								<label>Tampilkan</label>
								<select class="form-control select-limit">
									<option value="30" selected>30</option>
									<option value="60" >60</option>
									<option value="120" >120</option>
								</select>
							</div>
						</div>
					</div>
				</div> -->
			</div>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="./js/jquery.min.js"></script>
	<script type="text/javascript" >
      (function($) {
		var pagify = {
			items: {},
			container: null,
			totalPages: 1,
			perPage: 3,
			currentPage: 0,
			createNavigation: function() {
				this.totalPages = Math.ceil(this.items.length / this.perPage);

				$('.pagination', this.container.parent()).remove();
				var pagination = $('<div class="pagination" style="padding-left: 10px;"></div>').append('<a class="pagination-previous nav prev disabled list-inline-pagination" data-next="false"><</a>');

				for (var i = 0; i < this.totalPages; i++) {
					var pageElClass = "page";
					if (!i)
						pageElClass = "page current";
					var pageEl = '<a class="' + pageElClass + '" data-page="' + (
					i + 1) + '"> ' + (
					i + 1) + "</a>";
					pagination.append(pageEl);
				}
				pagination.append('<a href="javascript:void(0);" class="pagination-next nav next list-inline-pagination" data-next="true">></a>');

				this.container.after(pagination);

				var that = this;
				$("body").off("click", ".nav");
				this.navigator = $("body").on("click", ".nav", function() {
					var el = $(this);
					that.navigate(el.data("next"));
				});

				$("body").off("click", ".page");
				this.pageNavigator = $("body").on("click", ".page", function() {
					var el = $(this);
					that.goToPage(el.data("page"));
				});
			},
			navigate: function(next) {
				// default perPage to 5
				if (isNaN(next) || next === undefined) {
					next = true;
				}
				$(".pagination .nav").removeClass("disabled");
				if (next) {
					this.currentPage++;
					if (this.currentPage > (this.totalPages - 1))
						this.currentPage = (this.totalPages - 1);
					if (this.currentPage == (this.totalPages - 1))
						$(".pagination .nav.next").addClass("disabled");
					}
				else {
					this.currentPage--;
					if (this.currentPage < 0)
						this.currentPage = 0;
					if (this.currentPage == 0)
						$(".pagination .nav.prev").addClass("disabled");
					}

				this.showItems();
			},
			updateNavigation: function() {

				var pages = $(".pagination .page");
				pages.removeClass("current");
				$('.pagination .page[data-page="' + (
				this.currentPage + 1) + '"]').addClass("current");
			},
			goToPage: function(page) {

				this.currentPage = page - 1;

				$(".pagination .nav").removeClass("disabled");
				if (this.currentPage == (this.totalPages - 1))
					$(".pagination .nav.next").addClass("disabled");

				if (this.currentPage == 0)
					$(".pagination .nav.prev").addClass("disabled");
				this.showItems();
			},
			showItems: function() {
				this.items.hide();
				var base = this.perPage * this.currentPage;
				this.items.slice(base, base + this.perPage).show();

				this.updateNavigation();
			},
			init: function(container, items, perPage) {
				this.container = container;
				this.currentPage = 0;
				this.totalPages = 1;
				this.perPage = perPage;
				this.items = items;
				this.createNavigation();
				this.showItems();
			}
		};

		// stuff it all into a jQuery method!
		$.fn.pagify = function(perPage, itemSelector) {
			var el = $(this);
			var items = $(itemSelector, el);

			// default perPage to 5
			if (isNaN(perPage) || perPage === undefined) {
				perPage = 3;
			}

			// don't fire if fewer items than perPage
			if (items.length <= perPage) {
				return true;
			}

			pagify.init(el, items, perPage);
		};
	})(jQuery);

	$(".container-iko").pagify(6, ".product-box-container");

    </script>
		</div>
	</div>
</div>
<div class="loading-overlay hidden"><div class="loading-img spin"></div></div>
<script type="text/javascript">
	/* mixpanel.track("View Product List", {"User Identity" : "guest","Page Category" : "Produk",}); */
</script>
