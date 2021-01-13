<?php
	function redirectTohttps() {
	if($_SERVER['HTTPS']!="on") {
		$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("Location:$redirect"); } 
	}
	redirectTohttps();

	include "../inc/koneksi.php";
	include "../inc/inc.library.php";
	include '../inc/cek_session2.php';
	if(isset($_POST['sts_setuju'])) {
		unset($_POST['sts_setuju']);
	}
	
	$ip_ad = get_client_ip();
	$id_user = '';
	if(!empty($_SESSION['id_user_pelanggan'])) {
	 	$id_user=$_SESSION['id_user_pelanggan'];
	 }
	//$id_session = $ip_ad.milliseconds();
	$id_session = milliseconds();
	//echo $id_session."<br>";
	if(empty( $_SESSION['e_token'])) {
		session_start();
		$_SESSION['e_token'] = $id_session;
	 }else{
	 	$id_session = $_SESSION['e_token'];
	 }
	// $id_session = gettoken();
	 $vb = 'm';
	
?> 


<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv='cache-control' content='no-cache'> 
<meta http-equiv='expires' content='0'> 
<meta http-equiv='pragma' content='no-cache'>
<head>
	<link rel="icon" type="image/png"  href="./img/ikomart.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ikomart - The Window of West Sumatera</title>
	<meta name="keywords" content="The Window of West Sumatera" />
	<meta name="description" content="The Window of West Sumatera"/>
	<meta name="author" content="Ikomart">
	<!-- <link rel="canonical" href="index.php" /> -->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="blog/rss">
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Ikomart - The Window of West Sumatera" />
	<meta property="og:description" content="The Window of West Sumatera" />
	<meta property="og:image" content="./img/ikomart.jpeg" />
	<mta property="og:site_name" content="ikomart.id" />
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;subset=latin" rel="stylesheet">
	<link rel="stylesheet" href="assets/vendor/semantic/semantic.min.css">
	<link rel="manifest" href="manifest.json">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="min/index8fc6.html?f=/assets/vendor/ikomartico/style.css&amp;20190517_1100"> -->
	<!-- <link rel="stylesheet" href="assets/vendor/bootstrap-star-rating-master/css/star-rating.min8246.css?20171012_2150"> -->
	<!-- Bootstrap 3.3.4 -->
	   <!-- <link href="../aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

	<link rel="stylesheet" type="text/css" href="../css/all7c10.css?20190313_1000">
	<link rel="stylesheet" href="assets/vendor/swiper/dist/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/all6a8a.css?20190319_1600">
	<link rel="stylesheet" type="text/css" href="css/ellipsis-text.css">
	<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>

</head>
<style>
	body > .skiptranslate {
	    display: none;
	}
</style>
<body>

	<div class="clearfix"></div>
	<div class="content-space">
		<div style="height:120px;"></div>
		<input type="hidden" name="etoken" id="etoken" value="<?php echo $id_session; ?>">
		<?php 
			$vb = 'm';
			include "../isi.php";
		?>   
	</div>
	
	<footer id="site-footer">
		<hr class="line-title" />
		<div class="ui grid container">
			<div class="sixteen wide column">
				<div class="ui header">
					<div class="ui center aligned basic segment">Ikuti Kami</div>
				</div>
			</div>
		</div>
		<div class="socmed-container">
			<div class="ui small horizontal list">
				<div class="item"><a href="https://www.facebook.com/ikomart.id/" target="_blank">
					<div class="socmed sm-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>
				</div>
				<div class="item"><a href="https://www.instagram.com/ikomart.id/" target="_blank">
					<div class="socmed sm-insta"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>
				</div>
				<!-- <div class="item"><a href="../twitter.com/ikomart.html" target="_blank">
					<div class="socmed sm-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></div></a>
				</div>
				<div class="item"><a href="../www.linkedin.com/company/ikomart.html" target="_blank">
					<div class="socmed sm-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a>
				</div>
				<div class="item"><a href="../www.youtube.com/channel/UCmS2waBQIWaltQm4BG3BV4Q.html" target="_blank">
					<div class="socmed sm-youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></div></a>
				</div> -->
			</div>
		</div>
		<div class="info-container">
			<div class="ui list menu-info-list">
				<div class="item">
					<div class="content">
						<span style="display:inline-block; width: 20px; text-align: center;"><i class="fa fa-phone"></i></span>
						<a href="tel:081213149001">0812 1314 9001</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<span style="display:inline-block; width: 20px; text-align: center;"><i class="fa fa-whatsapp"></i></span>
						<a href="tel:081808975266">0818 0897 5266</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<span style="display:inline-block; width: 20px; text-align: center;"><i class="fa fa-envelope"></i></span>
						<a href="mailto:cs.uranglapau@ikomart.id">cs.uranglapau@ikomart.id</a>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<div class="image"><i class="fa fa-map-o"></i></div>
						<div class="text"><strong>PT. Iko Minang Ritel <br> ( Ikomart )</strong><br/>Jalan Mr. Asa’ad No. 9, Sanjai Bukittinggi. Sumatera Barat
						</div>
					</div>
				</div>
			</div>
			<div class="image-container"><img src="../img/ikomart.jpeg" title="ikomart.id" alt="ikomart.id"></div>
			<div class="footer-bottom">Copyright © 2020 PT. Iko Minang Ritel (Ikomart.id). <br />All rights reserved.</div>
	</footer>
	<div canvas="nav" class="ui top fixed header-nav menu" id="sticky-mainmenu">
		<a href="javascript:void(0);" class="js-toggle-left-slidebar">
			<div class="toggle-container">
				<div class="strips">
					<div class="strip"></div>
					<div class="strip"></div>
					<div class="strip"></div>
				</div>
			</div>
		</a>

		
 		<div id="google_translate_element" style="position: absolute; margin-left: 70px" ></div>
		<div style="display: block; background-color: white; position: absolute; width: 200px; height: 40px; margin-top: 25px;  margin-left: 70px;">&emsp;</div>
		<div class="logo-container">
			<div class="image">
				 <a href="?module=home" title="ikomart.id"><img src="../img/ikomart.jpeg" title="ikomart.id" alt="ikomart.id" style="position: relative; display: block; width: 50%; margin-left: 55px;" /></a>
							
				 <span style="display:block; width: 100%; overflow: hidden;text-align: right;vertical-align: middle;">
				 	
				 	<h5><?php 
				 		session_start();
						if($_SESSION['login']==1 && $_SESSION['dev'] == "0" && $_SESSION['apl'] == "ikomart"){
							echo $_SESSION['nama'];
						} 
					?>
					</h5>
				<span>
							
			</div>
		</div>
		 <div class="cart-container">
				<a href="?module=cart" title="Cart">
					<span class="icon-trolley"><span class="cart_sum" id="cart_sum">
					<?php 
						include "./cart/jml_cart.php";
					?>
					</span><input type="hidden" name="cur_qty" value="0"></span>
					<i class="fa fa-cart-plus fa-3x"></i>
				</a>
		</div>
				 <div class="search-container" >
				 	<form class="form" method="get" action="?module=produk2" itemprop="potentialAction">
				 		<div class="ui search">
				 			<div class="ui icon input">
				 				<input itemprop="query-input" class="toggle-search-slidebar" id="search-placeholder" type="text" name="search" value="" placeholder="Cari Produk" readonly><i class="search icon grey"></i>
				 			</div>
				 		</div> 
				 	</form>
				 </div>


	</div>
	<div off-canvas="left-slidebar left overlay" class="sb-width-full sb-transparent">
				<div id="menu" class="slinky-menu smenu-side" style="width: 320px;">
					<ul>
						<div class="personal-nav last-no-border-dashed">
							<li class="title-nav"><a href="?module=home" class="icon mp-nav_link" title="Beranda"><span >Beranda</span></a></li>

						<?php
							session_start();
							if($_SESSION['login']==1 && $_SESSION['dev'] == "0" && $_SESSION['apl'] == "ikomart"){
						?>
							<li class="title-nav"><a href="javascript:void();" title="Masuk/Daftar Akun"><span ><?php echo $_SESSION['nama']; ?></span></a>
								<ul>
									<div class="last-no-border-dashed custom-last-list">
										<li><a href="../logout2.php" onclick="return newcart();" class="mp-nav_link" title="Keluar"><span class="link-text">Keluar</span></a></li>
									</div>
								</ul>
						<?php  }else{ ?>
							<li class="title-nav"><a href="javascript:void();" title="Masuk/Daftar Akun"><span >Masuk/Daftar Akun</span></a>
								<ul>
									<div class="last-no-border-dashed custom-last-list">
										<li><a href="?module=login" class="mp-nav_link" title="Masuk"><span class="link-text">Masuk</span></a></li>
										<li><a href="?module=register" class="mp-nav_link" title="Daftar"><span class="link-text">Daftar</span></a></li>
									</div>
								</ul>
							</li>
						<?php } ?>
							<li class="title-nav"><a href="javascript:void();" title="Keranjang"><span >Keranjang Saya</span></a>
								<ul>
									<div class="last-no-border-dashed custom-last-list">
										<li><a id="btnEmpty" href="?module=home" onclick="return delallcart();"class="mp-nav_link" title="Kosongkan Keranjang"><span class="link-text">Kosongkan Keranjang</span></a></li>
										<li id="data_cart">
											<?php  include "./cart/index.php"  ?>
										</li>
										
									</div>
								</ul>
							</li>
							<li class="title-nav"><a href="?module=listorder" class="icon mp-nav_link" title="Riwayat Pesanan"><span >Riwayat Pesanan</span></a></li>
							
						</div>

						<div class="category-nav last-no-border-dashed">
							<li class="title-nav"><a href="javascript:void();" title="Kategori">Kategori</a></li>
							<?php
							$qhome = mysqli_query($con, "SELECT*FROM `group` ");
							while ($rhome = mysqli_fetch_array($qhome))
							{
								$id_group = $rhome['id_group'];
								$nama_group = $rhome['nama_group'];
							
							?>
								<li><a href="javascript:void();" title="<?php echo $nama_group;?>"><span class="link-text"><?php echo $nama_group;?></span></a>
									<ul><div class="last-no-border-dashed custom-last-list">

									<?php
										$sqlkategori = "SELECT
												produk.id_group,
												produk.id_kelompok,
												produk.id_kategori,
												kelompok.nama_kelompok,
												kelompok.deskripsi_kelompok
												FROM
												produk,
												kelompok
												WHERE kelompok.id_kelompok = produk.id_kelompok And
												produk.id_group LIKE '%$id_group%'
												GROUP BY
												produk.id_kelompok";
										//echo $sqlkategori;
										$qkategori = mysqli_query($con,$sqlkategori );
										while ($rkategori = mysqli_fetch_array($qkategori))
										{
											$id_kelompok = $rkategori['id_kelompok'];
											$nama_kelompok = $rkategori['nama_kelompok'];	
											$deskripsi_kelompok = $rkategori['deskripsi_kelompok'];	
											//echo $deskripsi_kelompok;
											$id_kelompok = $rkategori['id_kelompok'];
										?>

										<li><a href="javascript:void();" title="<?php echo ucfirst(strtolower($nama_kelompok)); ?>"><span class="link-text"><?php echo ucfirst(strtolower($nama_kelompok)); ?></span></a>

										<?php 
												//echo $id_kelompok; 
											$no=1;
											$sqlkelompok = "SELECT
																	produk.id_group,
																	produk.id_kelompok,
																	produk.id_kategori,
																	kelompok.nama_kelompok,
																	kelompok.deskripsi_kelompok,
																	categories.nama
																FROM
																	produk ,
																	kelompok,
																	categories
																WHERE
																	kelompok.id_kelompok = produk.id_kelompok AND
																	categories.id_kategori = produk.id_kategori AND
																	produk.id_group LIKE '%$id_group%' And
																	produk.id_kelompok = '$id_kelompok'
																GROUP BY
																	produk.id_kategori	
																ORDER BY produk.id_kelompok,categories.id_kategori ";
												//echo $sqlkelompok;
										?>
											<ul>
												<div class="last-no-border-dashed custom-last-list">
													<li>
														<a href="?module=produk2&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok; ?>" class="mp-nav_link" title="<?php echo "lihat semua ".ucfirst(strtolower($nama_kelompok)); ?>"><span class="link-text"><?php echo "lihat semua ".ucfirst(strtolower($nama_kelompok)); ?></span></a>
													</li>
												<?php
													//echo $sqlkelompok;
													$qkelompok = mysqli_query($con,$sqlkelompok );
													while ($rkelompok = mysqli_fetch_array($qkelompok))
													{
														$nama = $rkelompok['nama'];	
														$id_kategori = $rkelompok['id_kategori'];	
														//echo $nama_kelompok;
												?>
													<li>
														<a href="?module=produk2&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok."&id_kategori=".$id_kategori; ?>" class="mp-nav_link" title="<?php echo ucfirst(strtolower($nama)); ?>"><span class="link-text"><?php echo ucfirst(strtolower($nama)); ?></span></a>
													</li>
												<?php
													}
												?>	
												</div>
											</ul>
										</li>
									<?php
										}
									?>
									</div>
									</ul>
								</li>
							<?php
								}
							?>
						</div>

						<!-- <div class="company-nav"> -->
						<div class="category-nav last-no-border-dashed">
							<!-- <li class="title-nav"><a href="brand.html" class="mp-nav_link" title="Brand">Brand</a></li>
							<li><a href="stores.html" class="mp-nav_link" title="Find A Store"><span class="link-text">Find A Store</span></a></li>
							<li><a href="promo.html" class="mp-nav_link" title="Promo"><span class="link-text">Promo</span></a></li> -->
							<li class="title-nav" ><a href="?module=blog" class="mp-nav_link" title="Blog">Blog</a></li>
							<li class="title-nav"><a href="?module=about" class="mp-nav_link" title="Tentang Kami">Tentang Kami</a></li>
							<li class="title-nav"><a href="?module=info" class="mp-nav_link" title="Info Pengiriman">Info Pengiriman</a></li>
						</div>
							
					</ul>
				</div>
				<a href="javascript:void(0);" class="canvas-overlay"><i class="icon icon-close"></i></a>
	</div>

	<!-- <script type="text/javascript"> mixpanel.track_links(".mp-nav_link", "Click Nav Link", { "User Identity" : "guest", });</script> -->

	<div off-canvas="search-slidebar right overlay" class="sidebar-search sb-width-full sb-fade-opacity">
		<div class="search-nav">
			<div class="search-container">
				<form class="form" method="post" action="?module=produk2">
					<div class="ui icon input clearable-input">
						<input type="text" id="search_input" name="search_input" value="" placeholder="Cari Produk" autofocus="autofocus" autocomplete="off"><span id="clearable-button" data-clear-input> &times; </span>
						<button type="submit" class="btn btn-default search-inner-button" id="search-button"><i class="search link icon m-b-0"></i></button>
						<div class="search-cancel-link">
							<a href="javascript:void(0)" class="toggle-search-slidebar" title="Cancel">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">var user_identity = "guest";</script><script type="text/javascript">/* <![CDATA[ */var google_conversion_id = 821424117;var google_custom_params = window.google_tag_params;var google_remarketing_only = true;/* ]]> */</script>
	<!-- <script type="text/javascript" src="../www.googleadservices.com/pagead/f.txt"></script> -->
	<!-- <noscript><div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="../googleads.g.doubleclick.net/pagead/viewthroughconversion/821424117/index17c7.html?guid=ON&amp;script=0"/></div></noscript> -->
	<script defer src="assets/vendor/semantic/semantic.min.js"></script>
	<script defer src="assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
	<script defer src="min/index503d.html?f=/assets/vendor/slinky/assets/js/jquery.slinky.js&amp;20180104_1500"></script>
	<!-- <script defer src="assets/vendor/bootstrap-star-rating-master/js/star-rating.min8246.js?20171012_2150"></script> -->
	<script async src="min/index8139.html?f=/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js&amp;20171009_2000"></script>
	<script defer src="min/indexde56.html?f=/assets/vendor/slidebars/dist/slidebars.min.js"></script>
	<!-- <script async src="assets/vendor/webui-popover-master/jquery.webui-popover.min.js"></script> -->
	<!-- <script async src="min/index6cd2.html?f=/assets/js/general_message.js&amp;20171108_1300"></script>
	<script async src="min/indexc79b.html?f=/assets/js/pages/product-box.js&amp;20181114_1500"></script>
	 <script defer src="min/index473e.html?f=/assets/js/custom.js&amp;20190402_1400"></script> -->
	<script defer src="assets/js/custom.js"></script>
	<script src="../assets/js/custom.js"></script>
	<script src="assets/vendor/swiper/dist/js/swiper.min.js"></script>
	<!-- <script defer src="min/indexe067.html?f=/assets/js/pages/home.js&amp;20181221_1400"></script> -->
	<script src="../aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/pages/home.js"></script>
	<script src="../assets/js/pages/home.js"></script> 
	<script src="../js/cart.js?t=<?php echo milliseconds(); ?>" type="text/javascript"></script>
	<script type="text/javascript">
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
		}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
<!-- Mirrored from m.ikomart.id/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Jul 2020 16:59:28 GMT -->
</html>