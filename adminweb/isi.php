<?php
include "../inc/koneksi.php";

if ($_GET['module'] == "home") {
	include "module/home.php";
}
else if ($_GET['module'] == "user") {
	include "module/user/user.php";
}
else if ($_GET['module'] == "user_rekan") {
	include "module/user_rekan/user_rekan.php";
}
else if ($_GET['module'] == "user_pelanggan") {
	include "module/user_pelanggan/user_pelanggan.php";
}
else if ($_GET['module'] == "edit_user") {
	include "module/edit_user.php";
}
else if ($_GET['module'] == "product") {
	include "module/product/product.php";
}
else if ($_GET['module'] == "price") {
	include "module/price/price.php";
}
else if ($_GET['module'] == "order") {
	include "module/order/order.php";
}
else if ($_GET['module'] == "unit_krj") {
	include "module/unit_krj/unit_krj.php";
}	
else if ($_GET['module'] == "group") {
	include "module/group/group.php";
}
else if ($_GET['module'] == "kelompok") {
	include "module/kelompok/kelompok.php";
}
else if ($_GET['module'] == "kategori") {
	include "module/kategori/kategori.php";
}
else if ($_GET['module'] == "blog") {
		include "module/blog/blog.php";	
}
else if ($_GET['module'] == "wilayah") {
		include "module/wilayah/wilayah.php";	
}
else if ($_GET['module'] == "ongkir") {
		include "module/ongkir/ongkir.php";	
}
else if ($_GET['module'] == "ongkirln") {
		include "module/ongkirln/ongkir.php";	
}
else if ($_GET['module'] == "kirim") {
		include "module/kirim/kirim.php";	
}
else if ($_GET['module'] == "bayar") {
		include "module/bayar/bayar.php";	
}
else if ($_GET['module'] == "berita") {
		include "module/berita/berita.php";	
}
else if ($_GET['module'] == "galeri") {
	include "module/galeri.php";		
}
else if ($_GET['module'] == "video") {
	include "module/video.php";		
}
else if ($_GET['module'] == "upload") {
	include "module/price/upload.php";		
}
?>