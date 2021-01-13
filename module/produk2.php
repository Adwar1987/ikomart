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
<div canvas="container">
		<div class="content-container">
			<div class="all-product-list-container">
				<div class="bg-container">
					<div class="ui grid container m-b-0">
						<div class="sixteen wide column">
							<h1 class="top-title">Produk-Produk Ikomart</h1>
						</div>
					</div>
					<div class="container-iko">
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
										LIMIT 50";
								
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
								
								$sqltarif= "select*from harga where id_produk='$id_produk' AND ( tgl_awal_promo <= CURDATE()   AND	 tgl_akhir_promo >= CURDATE()  )";
								$datatarif = mysqli_query($con, $sqltarif);
								$tarif=mysqli_fetch_array($datatarif);
								$harga_jual = $tarif['harga_jual'];
								$harga_pasar = $tarif['harga_pasar'];
								$tgl_awal_promo = $tarif['tgl_awal_promo'];
								$tgl_akhir_promo = $tarif['tgl_akhir_promo'];
								//echo $nama_kelompok;
						?>
					<div class="m-t-5 m-b-5 product-box-container" data-uuid="<?php echo $id_produk; ?>" data-type="non">
						<div class="ui grid container m-b-5">
							<div class="six wide column p-lr-0" style="margin-left: -8px;">
								<div class="image-container ">
									<!-- <div class="flag-container">
										<img class="icon-delivery" src="./img/icons-value-3-v2.png?w=80&amp;auto=format" title="Dikirim oleh ikomart" alt="Dikirim oleh ikomart">
									</div> -->
									<a href="?prd=iko&p=<?php echo $alias; ?>" >
										<img class="lazy product-image" src="<?php 
										if($gambar=='' || $gambar==null || !file_exists($sts_mobile."image/produk/".$gambar)){
											echo $sts_mobile."img/wmark.png?t=".milliseconds();
										}else{
											echo $sts_mobile."image/produk/".$gambar."?t=".milliseconds();
										}
										?>" title="<?php echo $nama_produk; ?>" alt="<?php echo $nama_produk; ?>" />
										<div class="sold-overlay hidden">
											<div class="sold-text">Sold Out</div>
										</div>
									</a>
								</div>
							</div>
							<div class="ten wide column p-r-0">
								<div class="desc-container">
									<input type="hidden" name="_token" value="<?php echo $id_produk; ?>">
									<div class="item-name first-line ellipsis-wrapper auto-min-height">
										<a href="?prd=iko&p=<?php echo $alias; ?>" title="<?php echo $nama_produk; ?>" ><?php echo $nama_produk; ?></a>
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
									<div class="item-point"><span class="label"><?php echo $stok; ?></span></div>
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
									<input type="hidden" name="order_item_date" value="2020-07-24">
									<div class="product-box-action-container">
										<input type="hidden" name="last_qty" value="0">
										<div class="loading-container">
											<div class="ui button fluid green rectangular"><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></div>
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
										 	} ?>
										 	
										 </button>
									</div>
									<!--	<div class="qty-container hidden" data-qty-min="0" data-qty-max="2295" data-step="1" data-is-pre-order="0" data-availability-type="limited_stock">
											<div class="green ui buttons">
												<button type="button" class="ui button qty-min"><i class="fa fa-minus" aria-hidden="true"></i></button>
												<div class="ui form">
													<div class="field"><input type="text" pattern="\d*" class="qty-number" name="order_qty" value="0" placeholder="Jumlah" maxlength="6" data-qty-min="1" data-qty-max="999999" onkeypress="return check_qty_format_valid(event,this)"></div>
												</div>
												<button type="button" class="ui button qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
											</div>
										</div>-->
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
					<!-- <div class="pagination-wrap">
						<div class="pagination">
							<div class="pagination-first list-inline-pagination disabled"></div>
							<div class="pagination-previous disabled list-inline-pagination"><i class="fa fa-angle-left"></i></div>
							<div style="display: inline-table; vertical-align: middle; margin: 0 5px;">
								<span class="list-inline-pagination current">Halaman 1/1</span><br><span class="list-inline-pagination">Total 9 hasil pencarian</span>
							</div>
							<div class="pagination-next disabled list-inline-pagination"><i class="fa fa-angle-right"></i></div>
							<div class="pagination-first list-inline-pagination disabled"><a href="featured.html"><i class="fa fa-angle-double-right"></i></a></div>
						</div>
					</div> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

	$(".container-iko").pagify(6, ".product-box-container");

    </script>
				</div>
			</div>
		</div>
</div>