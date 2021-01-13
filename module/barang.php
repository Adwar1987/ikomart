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

	$id_produk='';
	if(isset($_GET['id_produk'])){
		$id_produk = $_GET['id_produk'];
	}

	if(isset($_POST['id_produk'])){
		$id_produk = $_POST['id_produk'];
	}

	$alias='';
	if(isset($_GET['p'])){
		$alias = $_GET['p'];
	}

	$id_user = '';
	if(!empty($_SESSION['id_user_pelanggan'])) {
	 	$id_user=$_SESSION['id_user_pelanggan'];
	 }


?>
<style>
        .rating {
            border: none;
            float: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label::before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating>label {
            color: #ddd;
            float: right;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #f7d106;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #fce873;
        }


        #hasil {
            font-size: 20px;
        }

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
<input type="hidden" name="id_produk"  id="id_produk" class="form-control" value="<?php echo $id_produk; ?>" >
<input type="hidden" name="alias"  id="alias" class="form-control" value="<?php echo $alias; ?>" >
<input type="hidden" name="id_user"  id="id_user" class="form-control" value="<?php echo $id_user; ?>" >
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
											produk.alias = '$alias'";
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

								//ambil rata-rata jumlah rating
								$q      = $con->query("SELECT AVG(rate) AS jml FROM rating WHERE id_produk = '" . $id_produk  . "'")->fetch_assoc();
								$hasil  = ceil($q['jml']);

								$id_session = milliseconds();
								//$cek    = $con->query("SELECT * FROM `rating` WHERE ipuser = '" . md5($_SERVER['REMOTE_ADDR']) . "'");
								$cek    = $con->query("SELECT * FROM `rating` WHERE id_produk = '" . $id_produk  . "'");
								if ($cek->num_rows > 0) {
								    $cek = $cek->fetch_assoc();
								    $c   = $cek['rate'];
								}
						?>
			<div class="row">
				<div class="col-xs-12">
					<ol class="breadcrumb" itemscope >
						<li itemprop="itemListElement" itemscope ><a href="?module=home" itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name">Home</span></a><meta itemprop="position" content="1"></li>
						<li itemprop="itemListElement" itemscope ><a href="?module=produk<?php if($vb == 'm') {echo "2";}else{echo "";}?>&id_group=<?php echo $id_group."&id_kelompok=".$id_kelompok; ?>" itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama_kelompok)); ?></span></a><meta itemprop="position" content="2"></li>
						<li itemprop="itemListElement" itemscope ><a href="?module=produk<?php if($vb == 'm') {echo "2";}else{echo "";}?>&id_kelompok=<?php echo $id_group."&id_kelompok=".$id_kelompok."&id_kategori=".$id_kategori2; ?>" itemscope  itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama)); ?></span></a><meta itemprop="position" content="3"></li>
						<li class=active itemprop="itemListElement" itemscope ><a href="#" itemscope  itemprop="item"><span itemprop="name"><?php echo ucfirst(strtolower($nama_produk)); ?></span></a><meta itemprop="position" content="4"></li>
					</ol>
				</div>
			</div>
			<div class="row">
						<div class="col-xs-<?php if($vb == 'm') {echo "12";}else{echo "7";}?>">
							<div class="image-container" height:"410px">
								<div class="flag-container">
									<!-- <img class="icon-delivery big" src="./img/icons-value-3-v2.png?w=120&amp;auto=format" title="Dikirim oleh <?php echo $dikirim; ?>" alt="Dikirim oleh <?php echo $dikirim; ?>"> -->
								</div>
								<img itemprop="image" class="thumb-main product-zoom" src="<?php 
										if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
											echo $sts_mobile."img/wmark.png?w=300&amp;auto=format&amp;&t=".milliseconds();
										}else{
											echo $sts_mobile."image/produk/".$gambar."?w=300&amp;auto=format&amp;q=50&t=".milliseconds();
										}
										?>?auto=format&amp;q=50&amp;w=560" data-zoom-image="<?php 
										if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
											echo $sts_mobile."img/wmark.png?w=300&amp;auto=format&amp;q=50&t=".milliseconds();
										}else{
											echo $sts_mobile."image/produk/".$gambar."?w=300&amp;auto=format&amp;q=50&t=".milliseconds();
										}
										?>" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
								<div class="sold-overlay hidden" title="<?php echo $nama_produk; ?>">
									<div class="sold-text">Sold Out</div>
								</div>
							</div>
						</div>
				<div class="col-xs-<?php if($vb == 'm') {echo "12";}else{echo "5";}?>">
					
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
									<input class="rating" id="hasil2" data-show-clear="false" data-show-caption="false" data-size="xs" data-display-only="true" value="Rating <?php echo $hasil . '.0'; ?>">
								</div>
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
								<!--<div class="item-review-link m-l-10">
									<a href="javascript:void(0);" class="go-to-product-review" title="13 Ulasan">13 Ulasan</a> | <a href="../login.html" title="Berikan Ulasan" rel="nofollow">Berikan Ulasan</a>
								</div>
								-->
							</div>
						
							<div class="action-container m-t-15 m-b-15">
								<div class="btn-container ">
									<button id="produk"+  value="<?php echo $id_produk; ?>" onclick="return addcart('<?php echo $id_produk; ?>','<?php echo $nama_produk; ?>');" href="javascript:void(0);" class="btn <?php if($stok==0 || $stok==null || $harga_jual < 1){echo "btn-warning-reverse"; }else{echo "btn-primary";} ?> btn-block btn-rectangular <?php if($stok==0 || $stok==null || $harga_jual < 1){echo 'disabled-link'; }else{echo 'buy data-text="Beli Sekarang" title="Beli Sekarang"';} ?> " ><?php
										 	if($stok==0 || $stok==null){
										 		echo "Stok Kosong"; 
										 	}else{
										 		if($harga_jual >0){
										 		 	echo "Beli Sekarang"; 
										 		 }else{ 
										 		 	echo "Harga Belum Ada"; 
										 		 }
										 	} ?>
										 	
										 </button>
								</div>
							</div>
							
							
							<!--<div class="promo-free-shipping"><i class="icon icon-shop"></i><p>Dikirim oleh ikomart (Kota Jakarta Barat)</p></div>
							<div class="promo-free-shipping "><i class="icon icon-free-shipping"></i><p>Gratis ongkir s/d <sup class='pricing'>Rp</sup> 20.000 dengan min.order <sup class='pricing'>Rp</sup> 150.000 ke seluruh Indonesia untuk produk berlogo Dikirim ikomart!</p></div> -->
							<hr class="m-t-10 m-b-10">
							<div class="row ">
								<div class="col-xs-12">
									<div class="desc-left-label">Keterangan Produk</div>
								</div>
								<div class="col-xs-12">
									<div class="desc-right-value">
										<div><span style="font-weight: "><?php echo $deskripsi; ?></span></div>
									</div>
								</div>
							</div>
							<hr class="m-t-10 m-b-10">
								<div class="row border-bs share-product">
									<div class="col-xs-6">
										<div class="label-share">Share Produk Ini</div>
									</div>
									<div class="col-xs-6">
										<div class="menu-list-icon text-right">
											<ul class="nav">
												<li><a href="https://facebook.com/sharer/sharer.php?u=https://www.ikomart.id/?prd=iko&p=<?php echo $alias; ?>" title="Share Facebook" target="_blank" data-href="?prd=iko&p=<?php echo $alias; ?>" data-layout="button_count" rel="nofollow"><div class="socmed sm-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
												<li><a href="https://twitter.com/sharea109.html?url=https://www.ikomart.id/?prd=iko&p=<?php echo $alias; ?>" title="Share Twitter" target="_blank" rel="nofollow"><div class="socmed sm-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
												<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.ikomart.id/?prd=iko&p=<?php echo $alias; ?>" title="Share Linkedin" target="_blank" rel="nofollow"><div class="socmed sm-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
											</ul>
										</div>
									</div>
								</div>
							
						</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="product-review-container bg-white p-b-30" \>
		<div class="container">
			<hr class="bold">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 text-center">
					
						<div class="top-item-title m-b-10">Ulasan - <?php echo $nama_produk; ?></div>
						<div itemprop="aggregateRating" itemscope>
							<div class="m-b-15">
								
								<div id="hasil" ><span itemprop="ratingValue">Rating <?php echo $hasil . '.0'; ?></span></div>
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
					        	<div class="m-l-5" style="display: inline-block; vertical-align: super;">
					        		<span id="reviewCount"><?php
						        		$sqlproduk = "SELECT * FROM `rating` WHERE id_produk = '" . $id_produk . "'";
										$result= mysqli_query($con,$sqlproduk );
										//echo $sqlproduk;
									    //hitung row
										$row_cnt = mysqli_num_rows($result);
										echo $row_cnt; 
									?></span> Ulasan</div>
							</div>
						</div>
				</div>

				<div class="col-xs-8 col-xs-offset-2 text-center">
						<hr style="clear: both">
						<div class="top-item-title">
							<form id="rating" class="rating col-xs-<?php if($vb == 'm') {echo "8";}else{echo "7";}?>" role="form" method="POST">
								
								<input type="radio" class="rate" id="star5" name="rating" value="5" <?php if (isset($c) && $c == '5') {
				                                                                                        echo 'checked';
				                                                                                    } ?> />
				                <label for="star5" title="Sempurna - 5 Bintang"></label>

				                <input type="radio" class="rate" id="star4" name="rating" value="4" <?php if (isset($c) && $c == '4') {
				                                                                                        echo 'checked';
				                                                                                    } ?> />
				                <label for="star4" title="Sangat Bagus - 4 Bintang"></label>

				                <input type="radio" class="rate" id="star3" name="rating" value="3" <?php if (isset($c) && $c == '3') {
				                                                                                        echo 'checked';
				                                                                                    } ?> />
				                <label for="star3" title="Bagus - 3 Bintang"></label>

				                <input type="radio" class="rate" id="star2" name="rating" value="2" <?php if (isset($c) && $c == '2') {
				                                                                                        echo 'checked';
				                                                                                    } ?> />
				                <label for="star2" title="Tidak Buruk - 2 Bintang"></label>

				                <input type="radio" class="rate" id="star1" name="rating" value="1" <?php if (isset($c) && $c == '1') {
				                                                                                        echo 'checked';
				                                                                                    } ?> />
				                <label for="star1" title="Buruk - 1 Bintang"></label>
				                <br>
				                <input type="hidden" name="id_produk2"  id="id_produk2" class="form-control" value="<?php echo $id_produk; ?>" >
								
								
							</form>
							<br>
							<div class="col-xs-12" style="width: <?php if($vb == 'm') {echo "300";}else{echo "800";}?>px;" >
								 <label for="ulasan" title="Ulasan Anda">Ulasan Anda</label>
						          	<textarea name="ulasan" id="ulasan" class="form-control" ><?php echo $ulasan; ?></textarea>
						    </div>
						         <div class="m-t-15">
						<?php
							$sqlrating2 = "SELECT
										`cart`.id_produk,
										`cart`.nama_produk,
										`order`.id_user_pelanggan
										FROM
										`cart` ,
										`order`
										WHERE
										`cart`.id_session = `order`.id_order AND
										`order`.sts_bayar = '1' AND
										`order`.id_user_pelanggan = '$id_user' AND
										`cart`.id_produk = '$id_produk'";
							//echo $sqlrating2;
							$result2= mysqli_query($con,$sqlrating2 );
							$row_cnt2 = mysqli_num_rows($result2);
							//echo "row:".$row_cnt2."<br>"; 
							if($row_cnt2 > 0){
								$nama_produk = $rrating2['nama_produk'];
								//echo $nama_pelanggan;
								if($vb == 'm') {
									echo '<button id="btnsimpanm" class="btn btn-primary" href="javascript:void(0);">Berikan Ulasan</button>';
								}else{
									echo '<button id="btnsimpan" class="btn btn-primary" href="javascript:void(0);">Berikan Ulasan</button>';
								}
						?>
									<!--<button id="btnsimpan" class="btn btn-primary" href="javascript:void(0);">Berikan Ulasan</button>-->
						<?php
							}else{
						?>
									<button id="btntolaksimpan" class="btn btn-primary" href="javascript:void(0);">Berikan Ulasan</button>
						<?php
							}
						?>
								</div>

						</div>
				</div>
			</div>
				<div class="col-xs-10 col-xs-offset-1">
				<hr class="bold">
					<div class="container-iko">
					<div class="row">
						<?php
							$sqlrating= "SELECT
										rating.rate,
										rating.ulasan,
										rating.tgl_rate,
										user_pelanggan.nama
										FROM
										user_pelanggan,
										rating 
										WHERE
										user_pelanggan.id_user_pelanggan = rating.id_user_pelanggan AND
										rating.id_produk = '$id_produk'
										ORDER BY rating.tgl_rate DESC";
							//echo $sqlrating;
							$qrating= mysqli_query($con,$sqlrating );
							while ($rrating = mysqli_fetch_array($qrating))
							{
								$rate = $rrating['rate'];
								$ulasan = $rrating['ulasan'];
								$tgl_rate = $rrating['tgl_rate'];
								$nama_pelanggan = $rrating['nama'];
								//echo $nama_pelanggan;
						?>
				
					<div class="product-box-container" id="list_ulasan" itemprop="review" itemscope">
						<div class="col-xs-10 col-xs-offset-1">
							<div class="top-review-list m-b-20">
								<div id="star" class="col-xs-12 text-center">
					                <?php
					                for ($i = 0; $i < $rate; $i++) {
					                    echo '<span class="on"><i class="fa fa-star"></i></span>';
					                }

					                for ($i = 5; $i > $rate; $i--) {
					                    echo '<span class="off"><i class="fa fa-star"></i></span>';
					                }
					                ?>
					        	</div>
								<div itemprop="name" class="review-title-message"></div>
								<div class="m-b-5">
									<strong itemprop="author"><?php echo $nama_pelanggan; ?></strong> on <span itemprop="datePublished"><?php echo Indonesia2Tgl($tgl_rate); ?></span><span class="verified"><i class="fa fa-check" aria-hidden="true"></i><em>Verified Purchase</em></span>
								</div>
								<p itemprop="description"><?php echo $ulasan; ?></p>
							</div>
						</div>
						<hr style="clear: both;">
					</div>
						<?php
							}
						?>
					<!-- <div class="text-center"><a href="paket-komplit-chimi-keripik-ubi/reviews.html" class="btn btn-warning-reverse" title="Baca Selengkapnya">Baca Selengkapnya <i class="fa fa-angle-right m-l-5"></i></a></div> -->
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

	<!--<script src="./aset/plugins/jQuery/jquery-2.1.4.min.js"></script>-->
	<script type="text/javascript">
        $(document).ready(function() {
           /* $("#rating .rate").click(function() {*/
            $("#btnsimpan").click(function() {
            	var id_user=$('#id_user').val();
				if(id_user=='') {
				 	alert('Anda Belum login, Silahkan login..!');
					location.href = '?module=login';
				}else{

	            	var etoken=$('#etoken').val();
	            	var id_produk2=$('#id_produk2').val();
	            	/*var rating=$('#rating').val();*/
	            	/*var rating= document.getElementsByName('rating')[0].value;*/
	            	var checkedValue = null; 
					var inputElements = document.getElementsByClassName('rate');
					for(var i=0; inputElements[i]; ++i){
					      if(inputElements[i].checked){
					           checkedValue = inputElements[i].value;
					           break;
					      }
					}
	            	var ulasan=$('#ulasan').val();
	            	//alert (ulasan);
	            	if(ulasan == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#ulasan').focus();
					}else{
		                $.ajax({
		                    url: "module/proses.php",
		                    method: "POST",
		                    data: {
		                        rating: checkedValue, ipuser : etoken, id_produk2 : id_produk2, ulasan : ulasan
		                    },
		                    success: function(obj) {
								//alert(obj);
								
		                        var obj = obj.split('|');

		                        $('#star' + obj[0]).attr('checked');
		                        $('#hasil').html('Rating ' + obj[1] + '.0');
		                        $('#star').html(obj[2]);
		                        alert("terima kasih atas penilaian anda");
								$('#ulasan').val('');
								$('#reviewCount').html(obj[3]);
								$('#hasil2').val('Rating ' + obj[1] + '.0');
								$('#list_ulasan').html(obj[4]);
			                 }
			            });
	       			}
	       		}
       		});
			
			$("#btnsimpanm").click(function() {
            	var id_user=$('#id_user').val();
				if(id_user=='') {
				 	alert('Anda Belum login, Silahkan login..!');
					location.href = '?module=login';
				}else{

	            	var etoken=$('#etoken').val();
	            	var id_produk2=$('#id_produk2').val();
	            	/*var rating=$('#rating').val();*/
	            	/*var rating= document.getElementsByName('rating')[0].value;*/
	            	var checkedValue = null; 
					var inputElements = document.getElementsByClassName('rate');
					for(var i=0; inputElements[i]; ++i){
					      if(inputElements[i].checked){
					           checkedValue = inputElements[i].value;
					           break;
					      }
					}
	            	var ulasan=$('#ulasan').val();
	            	//alert (ulasan);
	            	if(ulasan == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#ulasan').focus();
					}else{
		                $.ajax({
		                    url: "../module/proses.php",
		                    method: "POST",
		                    data: {
		                        rating: checkedValue, ipuser : etoken, id_produk2 : id_produk2, ulasan : ulasan
		                    },
		                    success: function(obj) {
								//alert(obj);
								
		                        var obj = obj.split('|');

		                        $('#star' + obj[0]).attr('checked');
		                        $('#hasil').html('Rating ' + obj[1] + '.0');
		                        $('#star').html(obj[2]);
		                        alert("terima kasih atas penilaian anda");
								$('#ulasan').val('');
								$('#reviewCount').html(obj[3]);
								$('#hasil2').val('Rating ' + obj[1] + '.0');
								$('#list_ulasan').html(obj[4]);
			                 }
			            });
	       			}
	       		}
       		});

       		 $("#btntolaksimpan").click(function() {
       		 	alert('Anda belum melakukan pembayaran order untuk produk ini, Silahkan lakukan pembayaran order..!');
       		 });
        });

        /*function disableButton() {
			var btn = document.getElementById('btnsimpan');
			btn.disabled = true;
			btn.innerText = 'Posting...'
		}*/
    </script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<!--<script src="./js/jquery.min.js"></script>-->
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
				var pagination = $('<div class="pagination" style="padding-left: 10px;display: flex;align-items: center;justify-content: center;"></div>').append('<a class="pagination-previous nav prev disabled list-inline-pagination" data-next="false"><</a>');

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

	$(".container-iko").pagify(3, ".product-box-container");

    </script>