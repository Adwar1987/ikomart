<?php
include "../../../inc/koneksi.php";

if (isset($_GET['id_group'])) {
$id_group=$_GET['id_group'];
//echo $id_group;
$query="SELECT*FROM provinsi
WHERE id_prov = '$provinsi'";
//echo $query;
$eksekusi=mysqli_query($con,$query);
if (mysqli_num_rows($eksekusi)==0) {
//echo '<tr><td colspan="7″><center><div class="alert alert-danger" role="alert">spesies dengan keyword "'.$keyword.'" tidak ditemukan</div></center></td></tr>';

}
while ($data = mysqli_fetch_array($eksekusi)) { 
?>
	<option value=""> -- kabupaten -- </option>
	<?php $q = mysqli_query ($con,"select * from kabupaten where id_prov ='$provinsi'");
	while ($k = mysqli_fetch_array($q)){ ?>
	<option value="<?php echo $k['id_kab'].$k['nama']; ?>" 
	<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
	</option> <?php	} ?>
	
<?php	
//echo "<script>$('#wilayah_awal').hide();</script>";
}
}

if (isset($_GET['kabupaten'])) {
$kabupaten=substr($_GET['kabupaten'],0,4);
//echo $kabupaten;
$query="SELECT*FROM kabupaten
WHERE id_kab = '$kabupaten'";
//echo $query;
$eksekusi=mysqli_query($con,$query);
if (mysqli_num_rows($eksekusi)==0) {
//echo '<tr><td colspan="7″><center><div class="alert alert-danger" role="alert">spesies dengan keyword "'.$keyword.'" tidak ditemukan</div></center></td></tr>';

}
while ($data = mysqli_fetch_array($eksekusi)) { 
?>
	<option value=""> -- kecamatan -- </option>
	<?php $q = mysqli_query ($konek,"select * from kecamatan where id_kab ='$kabupaten'");
	while ($k = mysqli_fetch_array($q)){ ?>
	<option value="<?php echo $k['id_kec'].$k['nama']; ?>" 
	<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
	</option> <?php	} ?>
	
<?php	
//echo "<script>$('#wilayah_awal').hide();</script>";
}
}

if (isset($_GET['kecamatan'])) {
$kecamatan=substr($_GET['kecamatan'],0,6);
//echo $kecamatan;
$query="SELECT*FROM kecamatan
WHERE id_kec = '$kecamatan'";
//echo $query;
$eksekusi=mysqli_query($con,$query);
if (mysqli_num_rows($eksekusi)==0) {
//echo '<tr><td colspan="7″><center><div class="alert alert-danger" role="alert">spesies dengan keyword "'.$keyword.'" tidak ditemukan</div></center></td></tr>';

}
while ($data = mysqli_fetch_array($eksekusi)) { 
?>
	<option value=""> -- kelurahan -- </option>
	<?php $q = mysqli_query ($con,"select * from kelurahan where id_kec ='$kecamatan'");
	while ($k = mysqli_fetch_array($q)){ ?>
	<option value="<?php echo $k['id_kel'].$k['nama']; ?>" 
	<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
	</option> <?php	} ?>
	
<?php	
//echo "<script>$('#wilayah_awal').hide();</script>";
}
}
?>