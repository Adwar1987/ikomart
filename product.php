<!-- <script src="js/cart.js" type="text/javascript"></script> -->
<?php
	include "inc/koneksi.php";
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

	$search_input='';
	if(isset($_POST['search_input'])){
		$search_input = $_POST['search_input'];
	}
	if(isset($_GET['search_input'])){
		$search_input = $_GET['search_input'];
	}
	//unset($_POST);
	//echo $id_group;

	//echo $id_produk;

	if ($id_group=='' && $search_input==''){
		$method = getenv('REQUEST_METHOD');
		//echo $_SERVER['SERVER_NAME'];
		//echo $_SERVER['PATH_INFO'];
		
		$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
		//$data = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		$data  = $alias ;
		//echo $data;
		$sqlproduk= "SELECT produk.id_produk,
							produk.alias,
							produk.nama_produk
					FROM	produk 
					WHERE produk.alias = '$data'";
		//echo $sqlproduk;
		$qproduk= mysqli_query($con,$sqlproduk );
		$edit=mysqli_fetch_array($qproduk);
		$id_produk = '';
		$id_produk = $edit['id_produk'] ; 
		$alias = $edit['alias'] ; 
		$nama_produk = $edit['nama_produk'] ; 
		
		if ($id_produk =='') { 
		//echo "<script> addcart('".$id_produk."','".$nama_produk."'); </script>";
			//echo "<script> window.location.reload(history.back()); </script>";
		} else{
			//echo "<script> addcart('".$id_produk."','".$nama_produk."'); </script>";
			//echo "<script>location.href='../?module=barang&id_produk=".$id_produk."&alias=".$alias."';</script>";
			//echo "<script>location.href='../../index.php';</script>";
		}
	?>
			<iframe src="module/barang_asli.php?id_produk=<?php echo $id_produk; ?>" scrolling="no" style="top:0; left:0; bottom:0; right:0; width:100%; height:800px; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;" title="produk" sandbox="allow-modals allow-forms allow-popups allow-scripts allow-same-origin" layout="responsive"></iframe>
	<?php
			
		
	}else{
		echo "<script>location.href='../?module=produk&id_group=".$id_group."&id_kelompok=".$id_kelompok."&id_kategori=".$id_kategori."&search_input=".$search_input."';</script>";
	}
?>