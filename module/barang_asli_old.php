
<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="min/index8fc6.html?f=/assets/vendor/Ikomartico/style.css&amp;20190517_1100"> -->
<link rel="stylesheet" href="../assets/vendor/bootstrap-star-rating-master/css/star-rating.min.css">
<link rel="stylesheet" href="../assets/vendor/swiper/css/swiper.min.css">

<!-- Bootstrap 3.3.4 -->
    <link href="../aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
    <link href="../aset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/all7c10.css?20190313_1000">
<link rel="stylesheet" type="text/css" href="../css/ellipsis-text.css">
<script src="../assets/vendor/jquery/jquery-3.1.0.min.js"></script>
</head>
<?php 
	include "../inc/koneksi.php";
	include "../inc/inc.library.php";
	include '../inc/cek_session2.php';
	
	$ip_ad = get_client_ip();
	$id_user = '';
	if(!empty($_SESSION['id_user_pelanggan'])) {
	 	$id_user=$_SESSION['id_user_pelanggan'];
	 }
	$id_session = $ip_ad.milliseconds();
	//echo $id_session."<br>";
	if(empty( $_SESSION['e_token'])) {
		session_start();
		$_SESSION['e_token'] = $id_session;
	 }else{
	 	$id_session = $_SESSION['e_token'];
	 }
	// $id_session = gettoken();
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

	$id_produk='';
	if(isset($_GET['id_produk'])){
		$id_produk = $_GET['id_produk'];
	}

	$alias='';
	if(isset($_GET['alias'])){
		$alias = $_GET['alias'];
	}
	
?>  
<input type="hidden" name="etoken" id="etoken" value="<?php echo $id_session; ?>">
<input type="hidden" name="id_produk"  id="id_produk" class="form-control" value="<?php echo $id_produk; ?>" >
<input type="hidden" name="alias"  id="alias" class="form-control" value="<?php echo $alias; ?>" >
<script type="text/javascript"> 

window.onload=function(){
	var id_produk=$('#id_produk').val();
	var alias=$('#alias').val();
	//alert(alias);
	//location.href='http://localhost/ikomart.id2/product/p.php/'+ alias;
	/*window.history.pushState(null,null, 'http://localhost/ikomart.id2/product.php/'+ alias);
	window.history.pushState(null,null, 'https://localhost/ikomart.id2/product.php/'+ alias);*/
	//history.pushState('http://localhost/ikomart.id2/?module=barang&alias='+alias+'&id_produk='+id_produk,null, 'http://localhost/ikomart.id2/product/p.php/'+ alias);
	//history.pushState('https://localhost/ikomart.id2/?module=barang&alias=beras_kuriak_kusuik_kamang&id_produk=1',null, 'http://localhost/ikomart.id2/product/p.php/'+ alias);
}
//window.location.reload(true);

/* mixpanel.track_links(".mp-nav_link", "Click Nav Link", { "User Identity" : "guest" }); 
function mixpanelRemoveCart(name, qty, price){ mixpanel.track("Remove Product From Cart", {"User Identity" : user_identity,"Product Name" : name,"Qty" : qty,"Price" : price,}); return false; } 
mixpanel.track_links(".mp-contact_link", "Click to Contact ikomart", {"User Identity" : "guest" });
 */
</script>

<div class="content-space p-b-0" itemscope itemtype="http://schema.org/Product">
	<div class="product-background">
		<div class="container product-item">
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
											kelompok.id_kelompok,
											kelompok.nama_kelompok,
											categories.id_kategori,
											categories.nama,
											produk.id_group
										FROM
											produk ,
											kelompok,
											categories
										WHERE
											kelompok.id_kelompok = produk.id_kelompok AND
											categories.id_kategori = produk.id_kategori AND
											produk.id_produk = '$id_produk'";
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
								$id_group = $rproduk['id_group'];
								$id_kelompok = $rproduk['id_kelompok'];
								$nama_kelompok = $rproduk['nama_kelompok'];
								$id_kategori2 = $rproduk['id_kategori'];
								$nama = $rproduk['nama'];
								
								$sqltarif= "select*from harga where id_produk='$id_produk' AND ( tgl_awal_promo <= CURDATE()   AND	 tgl_akhir_promo >= CURDATE()  )";
								$datatarif = mysqli_query($con, $sqltarif);
								$tarif=mysqli_fetch_array($datatarif);
								$harga_jual = $tarif['harga_jual'];
								$harga_pasar = $tarif['harga_pasar'];
								//echo $nama_kelompok;
							}
						?>
			<div class="row">
				<div class="col-xs-12">
					<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a  itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name">Home</span></a><meta itemprop="position" content="1"></li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama_kelompok)); ?></span></a><meta itemprop="position" content="2"></li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a  itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama)); ?></span></a><meta itemprop="position" content="3"></li>
						<li class=active itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama_produk)); ?></span></a><meta itemprop="position" content="4"></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="row">
						<div class="col-xs-10">
							<div class="image-container ">
								<div class="flag-container">
									<img class="icon-delivery big" src="../img/icons-value-3-v2.png?w=120&amp;auto=format" title="Dikirim oleh <?php echo $dikirim; ?>" alt="Dikirim oleh <?php echo $dikirim; ?>">
								</div>
								<img itemprop="image" class="thumb-main product-zoom" src="<?php 
										if($gambar=='' || $gambar==null || !file_exists("../image/produk/".$gambar)){
											echo "../img/ikomart.jpg?w=300&amp;auto=format&amp;q=50";
										}else{
											echo "../image/produk/".$gambar."?w=300&amp;auto=format&amp;q=50";
										}
										?>?auto=format&amp;q=50&amp;w=560" data-zoom-image="<?php 
										if($gambar=='' || $gambar==null || !file_exists("../image/produk/".$gambar)){
											echo "../img/ikomart.jpg?w=300&amp;auto=format&amp;q=50";
										}else{
											echo "../image/produk/".$gambar."?w=300&amp;auto=format&amp;q=50";
										}
										?>" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
								<div class="sold-overlay hidden" title="<?php echo $nama_produk; ?>">
									<div class="sold-text">Sold Out</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<form action="#" id="cartForm" method="post">
						<div class="desc-container">
							<div class="item-merchant"><a href="#" class="mp-merchant_link" title="<?php echo $dijual; ?>" ><?php echo $dijual; ?></a></div>
							<div class="item-desc m-b-10"><?php echo $ukuran; ?></div>
							<div itemprop="name" class="item-name"><?php echo $nama_produk; ?></div>
							<hr class="m-t-10 m-b-10">
							<div class="item-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<sup itemprop="priceCurrency" content="Rp">Rp </sup><span class="bprice"><?php echo format_angka($harga_pasar); ?></span>&nbsp;<span itemprop="price" content="<?php echo format_angka($harga_jual); ?>"><?php echo format_angka($harga_jual); ?></span>
							</div>
							<div class="item-point">lebih murah <sup class='pricing'>Rp</sup> <?php echo format_angka($harga_pasar-$harga_jual); ?></div>
							<div class="item-rating m-b-15">
								<div class="rating-star-wrapper">
									<a href="javascript:void(0);" class="go-to-product-review"></a><input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="4.77">
								</div>
								<!--<div class="item-review-link m-l-10">
									<a href="javascript:void(0);" class="go-to-product-review" title="13 Ulasan">13 Ulasan</a> | <a href="../login.html" title="Berikan Ulasan" rel="nofollow">Berikan Ulasan</a>
								</div>
								-->
							</div>
						</div>
						<div class="action-container m-t-15 m-b-15">
							<div class="loading-container hidden">
								<div class="btn btn-primary btn-block" disabled><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></div>
							</div>
							<div class="btn-container " id="buy-link-container">
								<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart2('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php if($stok==0 || $stok==null){echo "Stok Kosong"; }else{echo "Beli Sekarang";} ?></button>
										</div>
							</div>
							<div class="row hidden" id="update-now">
								<div class="qty-container" data-qty-min="0" data-qty-max="20383" data-step="1" data-is-pre-order="0" data-availability-type="limited_stock">
									<div class="col-xs-3">
										<button type="button" class="btn btn-minus" id="qty-min" disabled><i class="fa fa-minus" aria-hidden="true"></i></button>
									</div>
									<div class="col-xs-6 p-a-0">
										<input type="text" pattern="\d*" class="form-control qty-number" id="order-qty" name="order_qty" value="1" placeholder="Jumlah" maxlength="6" data-qty-min="1" data-qty-max="999999" onkeypress="return check_qty_format_valid(event,this)">
									</div>
									<div class="col-xs-3">
										<button type="button" class="btn btn-plus" id="qty-plus" ><i class="fa fa-plus" aria-hidden="true"></i></button>
									</div>
								</div>
								<input type="hidden" name="order_item_date" value="2020-07-24"><input type="hidden" name="order_item_product_type" value="non"><input type="hidden" name="order_item_product_uuid" value="2775494b-6ec3-586d-8bf0-306fbf6cfbc5"><input type="hidden" name="order_item_product_slug" value="paket-komplit-chimi-keripik-ubi">
								<input type="hidden" name="product_quantity" value="20383"><input type="hidden" name="min_date" value="2020-07-24">
								<input type="hidden" name="last_qty" value="0"><input type="hidden" name="_token" value="cYqjFZwpm3CzRV4PuqsDLxo23SzTmpFyx8T0wRKa">
							</div>
						</div>
						<hr>
						<!--<div class="promo-free-shipping"><i class="icon icon-shop"></i><p>Dikirim oleh ikomart (Kota Jakarta Barat)</p></div>
						<div class="promo-free-shipping "><i class="icon icon-free-shipping"></i><p>Gratis ongkir s/d <sup class='pricing'>Rp</sup> 20.000 dengan min.order <sup class='pricing'>Rp</sup> 150.000 ke seluruh Indonesia untuk produk berlogo Dikirim ikomart!</p></div> -->
						<hr class="m-t-15">
						<div class="share-product">
							<div class="row">
								<div class="col-xs-5"><div class="label-share">Share Produk Ini</div></div>
								<div class="col-xs-7">
									<div class="menu-list-icon text-right">
										<ul class="nav">
											<li><a href="https://facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.ikomart.com%2Fproduct%2Fpaket-komplit-chimi-keripik-ubi" title="Share Facebook" target="_blank" data-href="http://www.ikomart.com/product/paket-komplit-chimi-keripik-ubi" data-layout="button_count" rel="nofollow"><div class="socmed sm-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
											<li><a href="../../twitter.com/sharea109.html?url=http%3A%2F%2Fwww.ikomart.com%2Fproduct%2Fpaket-komplit-chimi-keripik-ubi&amp;via=ikomart&amp;hashtags=PaketKomplitChimiKeripikUbi%2Clemonilo" title="Share Twitter" target="_blank" rel="nofollow"><div class="socmed sm-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
											<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Fwww.ikomart.com%2Fproduct%2Fpaket-komplit-chimi-keripik-ubi" title="Share Linkedin" target="_blank" rel="nofollow"><div class="socmed sm-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="product-desc m-b-15">
		<div class="container">
			<div class="row">
				<div class="col-xs-7">
					<!--<div class="row border-bs">
						<div class="col-xs-3">
							<div class="desc-left-label">Catatan Dari Pembuat</div>
						</div>
						<div class="col-xs-9">
							<div itemprop="description" class="desc-right-value">
								<span style="font-weight: bold;">Sekarang ngemil bakal bebas rasa bersalah karena ada camilan alami dan bebas micin ikomart Chimi Keripik Ubi!&nbsp;</span>Camilan berupa keripik renyah yang terbuat dari ubi madu dan ubi ungu pilihan hasil panen petani lokal ini tinggi serat dan juga bebas gluten, lho. Dengan taburan bumbu jagung bakar dan jagung balado ikomart yang lezat tanpa penguat rasa, pengawet, dan pewarna sintetis bikin ikomart Chimi Keripik Ubi sebagai pilihan tepat untuk camilan sehat yang bisa dikonsumsi siapa pun, kapan pun, dan di mana pun.
								<div><br></div>
								<div>Untung banget nih, sekarang ada paket komplit bagi kamu yang suka ikomart Chimi Keripik Ubi Rasa Jagung Bakar dan ikomart Chimi Keripik Ubi Rasa Jagung Balado.</div>
							</div>
						</div>
					</div>
					-->
					<div class="row border-bs">
						<div class="col-xs-3">
							<div class="desc-left-label">Keterangan Produk</div>
						</div>
						<div class="col-xs-9">
							<div class="desc-right-value">
								<div><span style="font-weight: "><?php echo $deskripsi; ?></span></div>
							</div>
						</div>
					</div>
					<!--<div class="row" itemprop="brand" itemscope itemtype="../../schema.org/Brand.html">
						<div class="col-xs-3"><div class="desc-left-label">Tentang Pembuat</div></div>
						<div class="col-xs-3">
							<div class="desc-right-image-container"><a class="mp-merchant_link" href="#" title="ikomart" ><img itemprop="image" src="../../ikomart.imgix.net/vendor/25cb59aba505a73243e8300934c32a9d051c.jpg?w=160&amp;auto=format&amp;q=50" title="ikomart" alt="ikomart"></a></div>
						</div>
						<div class="col-xs-6">
							<div class="desc-right-merchant-container"><div itemprop="name" class="merchant-name to-merchant"><a class="mp-merchant_link" href="#" title="ikomart" >ikomart</a></div><div class="merchant-location"><i class="fa fa-map-marker m-r-3" aria-hidden="true"></i> Kota jakarta barat, DKI Jakarta</div><div itemprop="description" class="merchant-desc"> ikomart adalah healthy lifestyle ecosystem yang menghadirkan berbagai produk alami dan terjangkau untuk segala kebutuhan yang be...</div><div class="merchant-link"><a class="mp-merchant_link" href="#" title="Lihat Semua Produk" ><span class="tag">Lihat Semua Produk <i class="fa fa-caret-right m-l-5"></i></span></a></div></div>
						</div>
					</div>
					-->
				</div>
				<div class="col-xs-5"></div>
			</div>
		</div>
	</div>
	<!--
	<div class="product-review-container bg-white p-b-30" \>
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 text-center">
					<div class="top-item-title m-t-30 m-b-10">Ulasan - Paket Komplit Chimi Keripik Ubi</div>
					<div itemprop="aggregateRating" itemscope itemtype="../../schema.org/AggregateRating-2.html">
						<div class="m-b-15">
							<div style="display: inline-block;">
								<input class="rating" data-show-clear="false" data-show-caption="false" data-size="sm" data-display-only="true" value="4.77">
							</div>
							<div class="m-l-5" style="display: inline-block; vertical-align: super;"><span itemprop="reviewCount">13</span> Ulasan</div>
							<div><span itemprop="ratingValue">4.77</span> dari <span itemprop="bestRating">5</span> bintang</div>
						</div>
						<div class="row">
							<div class="col-xs-4 text-right"><label>5 bintang</label></div>
							<div class="col-xs-4 p-lr-0">
								<div class="progress" style="width: 100%;">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="11" aria-valuemax="13" style="width:84.615384615385%"></div>
								</div>
							</div>
							<div class="col-xs-4 text-left"><label>84.62%</label></div>
						</div>
						<div class="row"><div class="col-xs-4 text-right"><label>4 bintang</label></div><div class="col-xs-4 p-lr-0"><div class="progress" style="width: 100%;"><div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="1" aria-valuemax="13" style="width:7.6923076923077%"></div></div></div><div class="col-xs-4 text-left"><label>7.69%</label></div></div>
						<div class="row"><div class="col-xs-4 text-right"><label>3 bintang</label></div><div class="col-xs-4 p-lr-0"><div class="progress" style="width: 100%;"><div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="1" aria-valuemax="13" style="width:7.6923076923077%"></div></div></div><div class="col-xs-4 text-left"><label>7.69%</label></div></div>
						<div class="row"><div class="col-xs-4 text-right"><label>2 bintang</label></div><div class="col-xs-4 p-lr-0"><div class="progress" style="width: 100%;"><div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="13" style="width:0%"></div></div></div><div class="col-xs-4 text-left"><label>0.00%</label></div></div>
						<div class="row"><div class="col-xs-4 text-right"><label>1 bintang</label></div><div class="col-xs-4 p-lr-0"><div class="progress" style="width: 100%;"><div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="13" style="width:0%"></div></div></div><div class="col-xs-4 text-left"><label>0.00%</label></div></div>
						<div class="m-t-15"><a href="paket-komplit-chimi-keripik-ubi/reviews.html" class="text-warning" title="Lihat semua ulasan">Lihat semua ulasan <i class="fa fa-angle-right"></i></a></div>
					</div>
					<div class="m-t-15"><a href="../login.html" class="btn btn-primary text-uppercase" title="Berikan Ulasan" rel="nofollow">Berikan Ulasan</a></div>
				</div>
				<div class="col-xs-10 col-xs-offset-1">
					<hr class="bold">
					<div itemprop="review" itemscope itemtype="../../schema.org/Review-2.html">
						<div class="col-xs-10 col-xs-offset-1">
							<div class="top-review-list m-b-20">
								<input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="5"><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">Agus Wijiyantho</strong> on <span itemprop="datePublished" content="23 Juli 2020">23 Juli 2020</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">Untuk pilihan rasa ini cukup enak dan anak-anak saya sangat menyukainya</p>
							</div>
						</div>
						<hr style="clear: both;">
					</div>
					<div itemprop="review" itemscope itemtype="../../schema.org/Review-2.html"><div class="col-xs-10 col-xs-offset-1"><div class="top-review-list m-b-20"><input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="5"><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">Jemima Heronia</strong> on <span itemprop="datePublished" content="22 Juli 2020">22 Juli 2020</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">Have you ever heard love at the first eat? Yes, that’s what I feel when I first ate this!</p></div></div><hr style="clear: both;"></div>
					<div itemprop="review" itemscope itemtype="../../schema.org/Review-2.html"><div class="col-xs-10 col-xs-offset-1"><div class="top-review-list m-b-20"><input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="5"><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">Ghina Amalia</strong> on <span itemprop="datePublished" content="22 Juli 2020">22 Juli 2020</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">Kalo untuk rasa udh gak perlu ditanya lagi. This is my favorite. Tapi dari harga kurang ekonomis karena kalo beli 2 promo Buy 2 Get 1 sebenernya lbh murah dari ini.</p></div></div><hr style="clear: both;"></div>
					<div itemprop="review" itemscope itemtype="../../schema.org/Review-2.html"><div class="col-xs-10 col-xs-offset-1"><div class="top-review-list m-b-20"><input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="5"><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">Triyana Hidayanti</strong> on <span itemprop="datePublished" content="22 Juli 2020">22 Juli 2020</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">Sudah sampai. Terima kasih 👍🏻</p></div></div><hr style="clear: both;"></div>
					<div itemprop="review" itemscope itemtype="../../schema.org/Review-2.html"><div class="col-xs-10 col-xs-offset-1"><div class="top-review-list m-b-20"><input class="rating" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="5"><div itemprop="name" class="review-title-message"></div><div class="m-b-5"><strong itemprop="author">Jemy Lorasponelsar</strong> on <span itemprop="datePublished" content="21 Juli 2020">21 Juli 2020</span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span></div><p itemprop="description">Paket telah diterima dengan baik dan sangat cepat!</p></div></div><hr style="clear: both;"></div>
					<div class="text-center"><a href="paket-komplit-chimi-keripik-ubi/reviews.html" class="btn btn-warning-reverse" title="Baca Selengkapnya">Baca Selengkapnya <i class="fa fa-angle-right m-l-5"></i></a></div>
				</div>
			</div>
		</div>
	</div>
	-->
</div>
<script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>			
<script src="../js/cart.js" type="text/javascript"></script>