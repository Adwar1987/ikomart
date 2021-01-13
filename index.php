<?php
	function redirectTohttps() {
	if($_SERVER['HTTPS']!="on") {
	$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect"); } }
	redirectTohttps();


	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	{
		//jika menggunakan browser versi mobile maka alihkan ke file web versi mobile anda

		header("location:m/index.php");
	} 

	include "./inc/koneksi.php";
	include "./inc/inc.library.php";
	include './inc/cek_session2.php';
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
	
?> 
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv='cache-control' content='no-cache'> 
<meta http-equiv='expires' content='0'> 
<meta http-equiv='pragma' content='no-cache'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ikomart - The Window of West Sumatera</title>
	<meta name="keywords" content="The Window of West Sumatera" />
	<meta name="description" content="The Window of West Sumatera"/>
	<meta name="author" content="Ikomart">
	<link rel="canonical" href="index.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="blog/rss">
	<!-- <link rel="alternate" media="only screen and (max-width: 640px)" href="../m/index.php" / -->
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Ikomart - The Window of West Sumatera" />
	<meta property="og:description" content="The Window of West Sumatera" />
	<meta property="og:image" content="./img/ikomart.jpeg" />
	<meta property="og:site_name" content="ikomart.id" />
	<link rel="icon" type="image/png"  href="./img/ikomart.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<!--<link rel="manifest" href="manifest.json"> -->
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="min/index8fc6.html?f=/assets/vendor/Ikomartico/style.css&amp;20190517_1100"> -->
	<!-- <link rel="stylesheet" href="assets/vendor/bootstrap-star-rating-master/css/star-rating.min.css"> -->
	<link rel="stylesheet" href="assets/vendor/swiper/css/swiper.min.css">

	<!-- Bootstrap 3.3.4 -->
	<!--    <link href="./aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
	<!-- Theme style -->
	<!-- <link href="./aset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" /> -->
	<link rel="stylesheet" type="text/css" href="css/all7c10.css?20190313_1000">
	<link rel="stylesheet" type="text/css" href="css/ellipsis-text.css">
	<script src="assets/vendor/jquery/jquery-3.1.0.min.js"></script>
</head>
<style>
	body > .skiptranslate {
	    display: none;
	}
</style>
<body class="unresponsive">
 
<input type="hidden" name="etoken" id="etoken" value="<?php echo $id_session; ?>">
<header id="site-header">
	<div class="top-header">
		<div class="container">
			<div id="google_translate_element" style="position: absolute; height:15px;width: inherit; margin-left: 250px; z-index: 1;"></div>
					
			<div style="display: block; background-color: white; width: 150px; position: absolute;width: inherit; margin-left: 200px;     margin-top: 29px; z-index: 1;">&emsp;</div>	
			<div class="row">
				<div class="col-xs-4 p-tb-7">
					<a href="#" title="The Window of West Sumatera">The Window of West Sumatera</a>
				</div>
				<div class="col-xs-4 text-center p-tb-7">
					<!--<a href="login.html" title="Belanja dan dapatkan Cashback ke Moni Coins" rel="nofollow">Belanja dan dapatkan Cashback ke Moni Coins</a>-->
				</div> 
				<div class="col-xs-4 text-right p-tb-7">
					<a class="mp-contact_link" href="tel:081213149001" title="Butuh bantuan pemesanan? 0812 1314 9001">Butuh bantuan pemesanan? 
					<span class="icon-whatsapp m-l-3 m-r-3"></span> 0812 1314 9001</a>	
				</div>
				
			</div>

		</div>

		
		
	</div>

	<div class="custom-duramenu nav-container" id="header-duramenu">
		<div class="header-mini">
			<div class="header-mini-shadow">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div class="logo-container">
								<a href="?module=home" title="ikomart.id"><img src="./img/ikomart.jpeg" title="ikomart.id" alt="ikomart.id" /></a>
							</div>
							<div class="small-logo-container">
								<a href="?module=home" title="ikomart.id"><img src="./img/ikomart_logo.jpeg" title="ikomart.id" alt="ikomart.id" /></a>
							</div>
							<div class="link-menu">
								<a href="javascript:void(0);" id="show-menux"><i class="link-menu-icon fa fa-bars" aria-hidden="true"></i> Lihat Kategori</a>
							</div>
						</div>
						<div class="col-xs-6 text-center">
							<div class="search-container">
								<meta itemprop="name" content="Ikomart">
								<form class="form" method="post" action="?module=produk" itemprop="potentialAction" >
									<div class="form-group" id="form-search-container">
										<input itemprop="query-input" type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="Cari Produk" autocomplete="off">
										<button type="submit" class="btn btn-default search-inner-button" id="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
								</form>
							</div>
						
						</div>
						<div class="col-xs-4 p-l-0">
							<div class="header-action-menu">
								<ul class="nav navbar-nav navbar-left">
								<li>
								<?php
								session_start();
								//echo $_SESSION['login'];
								//echo $_SESSION['apl'];
									
									//error_reporting(0);
									//include "timeout.php";

									if($_SESSION['login']==1 && $_SESSION['dev'] == 0 && $_SESSION['apl'] == "ikomart"){
									?>
					                <li><a href="#" title="<?php echo $_SESSION['nama']; ?>"><?php echo $_SESSION['nama']; ?></a>
					                </li>
					                <li>
					                	<a href="./logout2.php" onclick="return newcart();">&nbsp;<i class="fa fa-power-off"></i>&nbsp;Keluar</a>
					                		</li>
									<?php  }else{ ?>
									<li><a href="?module=login" title="Masuk">Masuk</a></li>
									<li><a href="?module=register" title="registrasi">Registrasi</a></li>
									<li></li>
									<?php } ?>
								</li>
								</ul>
								<ul class="nav navbar-nav cart-menu " style="margin-left: 30px;">
										<li class="dropdown cart-summary-container">
											<a href="?module=cart" title="My Cart">
												<i class="fa fa-cart-plus fa-2x"></i>
												<div class="cart-sum" id="cart_sum">
													<?php 
														include "./cart/jml_cart.php";
													?>
												</div> 
											</a>
											<ul class="dropdown-menu for-cart">
												<li class="carts">
													<div class="row header">
														<div class="col-xs-6 p-a-0">
															<div class="title">Keranjang</div>
														</div>
													</div>
												<div class="cart-content">
													<div class="row second-header">
														<div class="col-xs-12">
															<a id="btnEmpty" href="?module=home" onclick="return delallcart();">Kosongkan Keranjang</a>
															<!-- <div class="reward">Anda belum memasukkan barang apapun</div> -->
															<div id="data_cart">
																<?php  include "./cart/index.php"  ?>
															</div>
															<a id="btnEmpty" href="?module=listorder" >Riwayat Pesanan</a>
														</div>
													</div>
												</div>
											</li></ul>
										</li>
									</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="relative algolia-search hidden">
				<div class="dropdown-menu tabbed-menu tabbed-mega-search arrow_box">
					<div class="header-search-result">
						<div class="container">
							<div class="row m-lr-0">
								<div class="col-xs-4">
									<div class="search-result-column" id="search-result-merchant">
										<div class="search-result-title">Brand</div>
										<ul id="search-result-merchant-list"></ul>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="search-result-column" id="search-result-product">
										<div class="search-result-title">Produk</div>
										<ul id="search-result-product-list"></ul>
										<div class="action text-center m-t-5">
											<a href="javascript:void(0)" class="btn btn-default-reverse btn-rectangular trackSearch" id="btn-see-all-product" title="Lihat Semua Produk">Lihat Semua Produk</a>
										</div>
									</div>
									<div class="search-result-column p-t-0" id="search-result-category">
										<div class="search-result-title">Kategori / Sub Kategori</div>
										<ul id="search-result-category-list"></ul>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="search-result-column" id="search-result-product-tag">
										<div class="search-result-title">Manfaat Produk</div>
										<ul class="clearfix" id="search-result-product-tag-list"></ul>
									</div>
									<div class="search-result-column p-t-0" id="search-result-article">
										<div class="search-result-title">Blog</div>
										<ul class="clearfix" id="search-result-article-list"></ul>
										<div class="action text-center m-t-5">
											<a href="javascript:void(0)" class="btn btn-default-reverse btn-rectangular trackSearch" id="btn-see-all-article" title="Lihat Semua Artikel">Lihat Semua Artikel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container" id="main-menu">
				<nav class="navbar">
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav" id="content-nav">
						<?php
							$qhome = mysqli_query($con, "SELECT*FROM `group` ");
							while ($rhome = mysqli_fetch_array($qhome))
							{
								$id_group = $rhome['id_group'];
								$nama_group = $rhome['nama_group'];
							
							?>
							<li class="dropdown tabbed-mega">
								<a href="javascript:void(0);" class="dropdown-toggle" title="<?php echo $nama_group;?>" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nama_group;?> <span class="caret"></span></a>
								<div class="dropdown-menu tabbed-menu tabbed-mega-menu tabbed-height-360">
									<ul>
										<?php
										$nop=1;
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
										<li class="nav-category" data-category-slug="<?php echo ucfirst(strtolower($nama_kelompok)); ?>">
											<a href="?module=produk&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok; ?>" title="<?php echo ucfirst(strtolower($nama_kelompok)); ?>" class="mp-nav_link"><i class="fa fa-angle-right m-l-5"></i><?php echo ucfirst(strtolower($nama_kelompok)); ?></a>
											<?php 
												//echo $id_kelompok; 
												
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
											<div class="tabbed-menu-content<?php  if($nop==1){ echo " active-tab-content ";} ?> container">
												<div class="row">
													<div class="col-xs-8" style="padding: 0 60px;">
														<p class="lead"><?php echo $deskripsi_kelompok; ?></p><hr />
														<ul class="submegamenu-list">
															<?php
															//echo $sqlkelompok;
															$qkelompok = mysqli_query($con,$sqlkelompok );
															while ($rkelompok = mysqli_fetch_array($qkelompok))
															{
																$nama = $rkelompok['nama'];	
																$id_kategori = $rkelompok['id_kategori'];	
																//echo $nama_kelompok;
															?>
															<li class="nav-subcategory" data-subcategory-slug="<?php echo ucfirst(strtolower($nama)); ?>"><a href="?module=produk&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok."&id_kategori=".$id_kategori; ?>" class="mp-nav_link" title="<?php echo ucfirst(strtolower($nama)); ?>"><?php echo ucfirst(strtolower($nama)); ?></a></li>
															<?php
																
															}
															?>
														</ul>
													</div>
												</div>
											</div>
										</li>
										<?php
										$nop++;
										}
										?>
										
									</ul>
								</div>
							</li>
							<?php
							}
							?>
							<!--<li><a href="brand.html" class="mp-nav_link" title="Brand Kami">Brand Kami</a></li> 
							<li><a href="stores.html" class="mp-nav_link" title="Find A Store">Find A Store</a></li> 
							<li><a href="promo.html" class="mp-nav_link" title="Promo">Promo</a></li> -->
							<li><a href="?module=blog" class="mp-nav_link" title="Blog">Blog</a></li> 
						</ul>
					</div>
				</nav>
			</div></div></div>
</header>


<div class="clearfix"></div>
<div class="content-space">
 <!-- diini lah kita kasih artikel nya --> 
	<?php include "isi.php";?>   
</div>



<footer id="site-footer">

	<div class="container">
		<div class="footer-menu">
			<hr class="m-b-30">
			<div class="row">
				<div class="col-xs-2">
					<div class="logo-container">
						<a href="index.php" title="ikomart.id"><img src="./img/ikomart.jpeg" title="ikomart.id" alt="ikomart.id"></a>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="menu-title">Ikomart</div>
					<div class="menu-info">
						<div class="menu-info-list">
							<div class="image"><i class="fa fa-phone"></i></div>
							<div class="text"><a href="tel:081213149001" title="0812 1314 9001">0812 1314 9001</a></div>
						</div>
						<div class="menu-info-list">
							<div class="image"><i class="fa fa-whatsapp"></i></div>
							<div class="text"><a href="tel:0818089752660" title="0818 0897 5266">0818 0897 5266</a></div>
						</div>
						<div class="menu-info-list">
							<div class="image"><i class="fa fa-envelope"></i></div>
							<div class="text"><a href="mailto:cs.uranglapau@ikomart.id" title="cs.uranglapau@ikomart.id">cs.uranglapau@ikomart.id</a></div>
						</div>
						<div class="menu-info-list">
							<div class="image"><i class="fa fa-map-o"></i></div>
							<div class="text"><strong>Kantor Pusat : </strong><br/>PT. Iko Minang Ritel <br/>( Ikomart )<br/>Jalan Mr. Asa’ad No. 9, Sanjai Bukittinggi. Sumatera Barat</div>
						</div>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="menu-title">Informasi</div>
					<div class="menu-list">
						<ul class="nav">
							<li><a href="?module=about" title="Tentang Kami">Tentang Kami</a></li>
							<li><a href="?module=info" title="Informasi Pengiriman">Informasi Pengiriman</a></li>
							<!-- <li><a href="stores.html" title="Find A Store">Find A Store</a></li>
							<li><a href="promo.html" title="Promo">Promo</a></li> -->
							<li><a href="?module=blog" title="Blog">Blog</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="menu-title">Pembayaran</div>
					<div class="menu-list-icon" style="width: 160px;">
						<ul class="nav">
							<li><img src="img/mandiri.jpg" style="width: auto;height:31px;"> </li>
							<li><img src="img/banknagari.png" style="width: auto;height:31px;"> </li>
							<li><img src="img/ovo.png" style="width: auto;height:31px;"> </li>
							<li><img src="img/linkaja.png" style="width: auto;height:31px;"> </li>
							<li><img src="img/gopay.png" style="width: auto;height:31px;"> </li>
							<li><img src="img/danalogo.png" style="width: auto;height:31px;"> </li>
							<li>COD</li>
						</ul>
					</div>
				</div>
				<!-- <div class="col-xs-32">
					<div class="menu-title">Bantuan</div>
					<div class="menu-list">
						<ul class="nav">
							<li><a href="contact-us.html" title="Hubungi Kami">Hubungi Kami</a></li>
							<li><a href="terms.html" title="Syarat & Ketentuan">Syarat & Ketentuan</a></li>
							<li><a href="privacy.html" title="Kebijakan Privasi">Kebijakan Privasi</a></li>
							<li><a href="blog/metode-pengiriman-kami.html" title="Pengiriman">Pengiriman</a></li>
						</ul>
					</div>
				</div> -->
				
				<div class="col-xs-2">
					<div class="menu-title">Ikuti Kami</div>
					<div class="menu-list-icon" style="width: 160px;">
						<ul class="nav">
							<li><a href="https://www.facebook.com/ikomart.id/" title="Ikomart Facebook" target="_blank"><div class="socmed sm-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
							<li><a href="https://www.instagram.com/ikomart.id/" title="Ikomart Instagram" target="_blank"><div class="socmed sm-insta"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
							<!-- <li><a href="../twitter.com/Ikomart.html" title="Ikomart Twitter" target="_blank"><div class="socmed sm-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
							<li><a href="../www.linkedin.com/company/Ikomart.html" title="Ikomart Linkedin" target="_blank"><div class="socmed sm-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
							<li><a href="../www.youtube.com/channel/UCmS2waBQIWaltQm4BG3BV4Q.html" title="Ikomart Youtube" target="_blank"><div class="socmed sm-youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></div></a></li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="footer-bottom-menu"><div class="row"><div class="col-xs-12">Copyright © 2020 PT. Iko Minang Ritel (Ikomart.id). All rights reserved.</div></div>
		</div>
	</div>
</footer>
<script type="text/javascript">var user_identity = "guest";</script>
<!-- <script type="text/javascript" src="../www.googleadservices.com/pagead/f.txt"></script> -->

<!--<script src="js/all.js"></script>
<script src="min/index62b6.html?f=/assets/js/pages/product-box.js&amp;20191031_1500"></script> -->
<script src="assets/js/custom.js"></script> 
<script src="assets/vendor/swiper/js/swiper.min.js"></script> 
<script src="assets/js/pages/home.js"></script>  
<script src="aset/plugins/jQuery/jquery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="js/cart.js?t=<?php echo milliseconds(); ?>" type="text/javascript"></script>
<script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
	}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 </body>

</html>