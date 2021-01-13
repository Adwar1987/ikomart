<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php 
// menghubungkan dengan koneksi
include "../../../inc/koneksi.php";
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>
<a href="../../?module=price">Kembali</a>
<table border="1px">
<tr>
	<th>No. </th>
	<th>Id Produk </th>
	<th>Nama Produk </th>
	<th>Harga Jual </th>
	<th>Harga Pasar </th>
	<th>Tgl. Awal </th>
	<th>Tgl. Akhir </th>
	<th>Promo </th>
	<th>Box  </th>
</tr>
<?php
// upload file xls
$target = basename($_FILES['filetarif']['name']) ;
move_uploaded_file($_FILES['filetarif']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filetarif']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filetarif']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$no = 1;
$date2 ="";
for ($i=2; $i<=$jumlah_baris; $i++){
$idnext=0; 

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	
		$id_produk     	= $data->val($i, 2);
		$nama_produk 	= $data->val($i, 3);
		$harga_jual  	= $data->val($i, 4);
		$harga_pasar  	= $data->val($i, 5);
		$tgl_awal_promo	= $data->val($i, 6);
		$tgl_akhir_promo= $data->val($i, 7);
		$sts_promo      = $data->val($i, 8);
		$sts_paket     	= $data->val($i, 9);
?>
<tr 
<?php if ( ($harga_jual) > 0) {
			//echo 'style="background:blue"';

		}else{
			echo 'style="background:#CD5C5C"';  // warna Indian Red
		
		}
?>

>
	<td><?php echo $no; ?></td>
	<td><?php echo $id_produk; ?></td>
	<td><?php echo $nama_produk; ?></td>
	<td><?php echo $harga_jual; ?></td>
	<td><?php echo $harga_pasar; ?></td>
	<td><?php echo $tgl_awal_promo; ?></td>
	<td><?php echo $tgl_akhir_promo; ?></td>
	<td><?php echo $sts_promo; ?></td>
	<td><?php echo $sts_paket; ?></td>
<?php

		// INSERT INTO `ikomart_db`.`harga` (`id_harga`, `id_produk`, `nama_produk`, `deskripsi`, `harga_jual`, `harga_pasar`, `sts_promo`, `tgl_awal_promo`, `tgl_akhir_promo`, `sts_paket`, `id_price`, `id_approver`, `sts_aktif`) VALUES ('1', '281', 'ABC Kecap Manis Botol 275ml', '', '13500', '14000', '1', '2020-08-01', '2020-12-31', '', NULL, NULL, NULL);
if ( ($harga_jual) > 0) {
		$dsql= "INSERT into `harga` (`id_produk`, `nama_produk`, `harga_jual`, `harga_pasar`, `tgl_awal_promo`, `tgl_akhir_promo`, `sts_promo`, `sts_paket`, `sts_aktif`) 
				VALUES ('$id_produk','$nama_produk','$harga_jual','$harga_pasar','$tgl_awal_promo','$tgl_akhir_promo','$sts_promo','$sts_paket','1')";

		mysqli_query($con,$dsql);
}

		$no++; 
	
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filetarif']['name']);

// alihkan halaman ke index.php
//header('location:../../index.php?module=price');
?>
</table>
<a href="../../?module=price">Kembali</a>