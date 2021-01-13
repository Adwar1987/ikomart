<?php
	
	$id_blog='';
	if(isset($_GET['id_blog'])){
		$id_blog = $_GET['id_blog'];
	}

	$search_input_blog='';
	if(isset($_POST['search_input_blog'])){
		$search_input_blog = $_POST['search_input_blog'];
	}
	if(isset($_GET['search_input_blog'])){
		$search_input_blog = $_GET['search_input_blog'];
	}
	unset($_POST);
	//echo $search_input_blog;
?>

<div class="content-space">
	<div class="container ">
		<div class="row">
			<div class="col-xs-8">
				<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="index.php" itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name">Home</span></a>
						<meta itemprop="position" content="1">
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="?module=blog" itemscope itemtype="http://schema.org/Thing" itemprop="item"><span itemprop="name">Blog</span></a>
						<meta itemprop="position" content="1">
					</li>
				</ol>
			</div>
			<!-- <div class="col-xs-4 text-right"><div class="top-item-title-link "><a href="blog/contributor.html" title="Lihat Semua Kontributor">Lihat Semua Kontributor <i class="fa fa-angle-right m-l-5"></i></a></div></div>  -->
		</div>
		<div class="sw-article-category-list">
			<select name="id_blog" id="id_blog" onchange="ambildata_blog()"  class="form-control" style="width: 200px;">
				<option value=""> -- Semua Kategori -- </option>
				<?php
					$sqlblog = "SELECT*FROM blog ORDER BY id_blog";
					//echo $sqlkelompok;
					$qblog = mysqli_query($con,$sqlblog );
					while ($rblog = mysqli_fetch_array($qblog)){ ?>
				<option 
					<?php if($id_blog == $rblog['id_blog']){ echo " selected ";} ?>
					value="<?php echo $rblog['id_blog']; ?>" 
					<?php (@$h['id_blog']==$rblog['id_blog'])?print(" "):print(""); ?>> <?php  echo $rblog['nama_blog']; ?>
				</option> 			
				<?php
					}
				?>
			</select>
		<!-- 	<div class="swiper-container">
				<div class="swiper-wrapper p-tb-10">
				<?php
					$sqlblog = "SELECT*FROM blog ORDER BY id_blog";
					//echo $sqlkelompok;
					$qblog = mysqli_query($con,$sqlblog );
					while ($rblog = mysqli_fetch_array($qblog))
				{
						$id_blog2 = $rblog['id_blog'];	
						$nama_blog = $rblog['nama_blog'];	
				?>
					<div class="eight"><a href="?module=blog&id_blog=<?php echo $id_blog2; ?>" title="<?php echo $nama_blog; ?>" class="sw-article-category-link"><?php echo $nama_blog; ?></a></div>
				<?php
					}
				?>
				</div>
			</div> -->
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row border-b p-tb-12 m-b-10 m-lr-0">
					<div class="col-xs-4 p-a-0"><h1 class="top-item-title">Ikomart Blog</h1></div>
					<div class="col-xs-8 p-r-0">
						<div class="form-group m-b-0">
							<div class="search-page-container">
								<form class="form" method="post" action="?module=blog"><div class="form-group m-b-0"><input type="text" class="form-control" name="search_input_blog" id="search_input_blog" value="" placeholder="Cari Artikel"><button type="submit" class="btn btn-default btn-search-page"><i class="fa fa-search" aria-hidden="true"></i></button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php include "bc.php"; ?>
				<hr/>
				<div class="col-xs-12 p-a-0">
					<h2 class="top-item-title">Artikel Terbaru</h2>
				</div>
				<div class="container-iko">
				<div class="row">
					<div class="product-box-container articles">
					
					<?php
						if ($search_input_blog==''){
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
											WHERE mst_berita.id_blog LIKE '%$id_blog%'  
											ORDER BY mst_berita.tanggal desc ";
						}else{
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
											WHERE mst_berita.judul LIKE '%$search_input_blog%'  
											ORDER BY mst_berita.tanggal desc";
						}
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
								<?php
								$folder = "image/blog/";
								if($vb == 'm') {
									$folder = "../image/blog/";
								}
								//echo $folder;
								?>
								<a href="?module=blog&id_berita=<?php echo $id_berita; ?>"><img class="lazy" style="width: 100%;height: 240px;" src="<?php echo $folder.$img;?>?w=400&amp;auto=format&amp;q=50" data-original="<?php echo $folder.$img;?>?w=400&auto=format&q=50" title="<?php echo $judul;?>" /></a>
							</div>
							<div class="desc-container ">
								<!-- <div class="item-logo"><span class="icon icon-tips"></span></div> -->
								<div class="item-category"><?php echo $nama_blog;?></div>
								<div class="item-name item-wrapper m-b-5"><a href="?module=blog&id_berita=<?php echo $id_berita; ?>"><div><?php echo $judul;?></div></a></div>
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
	<!-- 			<div class="pagination-wrap"><div class="pagination"><div class="pagination-previous disabled list-inline-pagination"><i class="fa fa-angle-left"></i></div><a href="blog.html" class="list-inline-pagination current">1</a></li><a href="blog4658.html?page=2" class="list-inline-pagination ">2</a></li><a href="blog9ba9.html?page=3" class="list-inline-pagination ">3</a></li><a href="blogfdb0.html?page=4" class="list-inline-pagination ">4</a></li><a href="blogaf4d.html?page=5" class="list-inline-pagination ">5</a></li><span class="list-inline-pagination"> ... </span><a href="blog8c06.html?page=25" class="list-inline-pagination">25</a><div class="pagination-next list-inline-pagination"><a href="blog4658.html?page=2"><i class="fa fa-angle-right"></i></a></div></div></div> -->

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<?php
		$folderjs = "./js/";
		if($vb == 'm') {
			$folderjs = "../js/";
		}
	//echo $folder;
	?>
	<script src="<?php echo $folderjs; ?>jquery.min.js"></script>
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

    <script type="text/javascript">
    function ambildata_blog() {

		var id_blog = $('#id_blog').val();
		location.href = '?module=blog&id_blog='+id_blog;
	}
    </script>
			</div>
		</div>
	</div>
</div>

