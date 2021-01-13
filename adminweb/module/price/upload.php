
	
<a href="?module=price">Kembali</a>
<br/><br/>
<?php 
include "../../../inc/koneksi.php";
?>

<form method="post" enctype="multipart/form-data" action="module/price/upload_aksi.php">
Format Extention Excel: xls<br>
Format kolom: <br>
	| no	| id_produk | nm_produk | hrg_jual | hrg_pasar | tgl_awal | tgl_akhir | sts_promo | sts_box |

<br>

	  Pilih File: 
	<input name="filetarif" type="file" required="required"> 
	<input name="upload" type="submit" value="Import">
</form>

<br/><br/>

