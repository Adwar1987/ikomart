<?php
include "../../../inc/koneksi.php";

if (isset($_GET['id_kelompok'])) {
	$id_kelompok=$_GET['id_kelompok'];
	//echo $id_group;
	$query="SELECT*FROM categories
	WHERE id_kelompok = '$id_kelompok'";
	//echo $query;
	$eksekusi=mysqli_query($con,$query);
	echo '<option value=""> -- Pilih Kategori -- </option>';
	while ($data = mysqli_fetch_array($eksekusi)) { 
	?>
		<option value="<?php echo $data['id_kelompok']; ?>"> <?php  echo $data['nama']; ?></option> 
	<?php	
	//echo "<script>$('#wilayah_awal').hide();</script>";
	}
}

?>