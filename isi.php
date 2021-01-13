<?php

if(isset($_GET['module'] )){
	if ($_GET['module'] == "home") {
		include "module/home.php";	
	}else if ($_GET['module'] == "about") {
		include "module/tentang_kami.php";
	}else if ($_GET['module'] == "info") {
		include "module/info.php";
	}else if ($_GET['module'] == "produk") {
		include "module/produk.php";
	}else if ($_GET['module'] == "produk2") {
		include "module/produk2.php";
	}else if ($_GET['module'] == "barang_asli") {
		include "module/barang_asli.php";		
	}else if ($_GET['module'] == "login") {
		include "pelanggan/login.php";	
	}else if ($_GET['module'] == "mitra") {
		include "mitra/login.php";		
	}else if ($_GET['module'] == "register") {
		include "module/register.php";		
	}else if ($_GET['module'] == "blog") {
		include "module/blog.php";		
	}else if ($_GET['module'] == "bc") {
		include "module/bc.php";		
	}else if ($_GET['module'] == "cart") {
		include "module/cart.php";		
	}else if ($_GET['module'] == "order") {
		include "module/order.php";	
	}else if ($_GET['module'] == "cetak_order") {
		include "module/cetak/cetak_order.php";	
	}else if ($_GET['module'] == "listorder") {
		include "module/listorder.php";		
	}else if ($_GET['module'] == "reset") {
		include "pelanggan/proses.php";	
	}
}else if ($_GET['prd'] == "iko") {	
		include "module/barang.php";
}else{
	include "module/home.php";
	
}
			
?>