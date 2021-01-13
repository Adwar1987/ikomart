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
	
	$search_input='';
	if(isset($_POST['search_input'])){
		$search_input = $_POST['search_input'];
	}
	if(isset($_GET['search_input'])){
		$search_input = $_GET['search_input'];
	}
	//unset($_POST);
	//echo $id_group;
	if ($id_group=='' && $search_input==''){
		$method = getenv('REQUEST_METHOD');
		//echo $_SERVER['SERVER_NAME'];
		//echo $_SERVER['PATH_INFO'];
		
		$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
		$data = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
		//echo $data;
		$sqlproduk= "SELECT produk.id_produk,
							produk.alias
					FROM	produk 
					WHERE produk.alias = '$data'";
		//echo $sqlproduk;
		$qproduk= mysqli_query($con,$sqlproduk );
		$edit=mysqli_fetch_array($qproduk);
		$id_produk = '';
		$id_produk = $edit['id_produk'] ; 
		$alias = $edit['alias'] ; 
		
		if ($id_produk =='') { 
		?>
		<script type="text/javascript"> 
			window.location.reload(history.back());
		</script>
		<?php
		} else{
			echo "<script>location.href='../?module=barang&id_produk=".$id_produk."&alias=".$alias."';</script>";
			//echo "<script>location.href='../../index.php';</script>";
			
		}
	}else{
		echo "<script>location.href='../?module=produk&id_group=".$id_group."&id_kelompok=".$id_kelompok."&id_kategori=".$id_kategori."&search_input=".$search_input."';</script>";
	}
?>