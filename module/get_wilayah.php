<?php
include "../inc/koneksi.php";
include "../inc/inc.library.php";
 
 
if (isset($_GET['id_kirim'])) {
	$id_kirim=($_GET['id_kirim']);
	?>
		<option data-value=""> -- provinsi -- </option>
		<?php $q = mysqli_query ($con,"SELECT
			provinsi.id_prov,
			provinsi.nama
			FROM
			ongkir
			LEFT JOIN provinsi ON ongkir.id_prov = provinsi.id_prov
			WHERE ongkir.id_kirim = '$id_kirim'
			GROUP BY provinsi.id_prov
			ORDER BY provinsi.nama");
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_prov']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> <?php	} ?>
		
	<?php	
	//echo "<script>$('#wilayah_awal').hide();</script>";
	
}

if (isset($_GET['negara'])) {
	$negara=($_GET['negara']);

	$query="SELECT*FROM negara
	WHERE nm_negara = '$negara'";
	//echo $query;
	$ekstarif=mysqli_query($con,$query);
	$datarif=mysqli_fetch_array($ekstarif);
	$ongkir = $datarif['tarif']; 
	$id_kirim = $datarif['id_kirim']; 
	echo $ongkir."|";
	//echo $keyword;
	?>
		<option data-value=""> -- provinsi -- </option>
		<?php $q = mysqli_query ($con,"select * from provinsi");
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_prov']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> <?php	} 
	echo "|";
	$querymst_kirim ="SELECT*FROM mst_kirim WHERE id_kirim='$id_kirim'";
	//echo $query;
	?>
		<option data-value="">-- Pilih Pengiriman -- </option>
		<?php $q = mysqli_query ($con, $querymst_kirim);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>"
		<?php (@$h['id_kirim']==$k['id_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']; ?>
		</option> <?php	} 

}


if (isset($_GET['provinsi'])) {
	$provinsi=substr($_GET['provinsi'],0,2);
	/* $kabupaten=substr($_GET['kabupaten'],0,4);
	$kecamatan=substr($_GET['kecamatan'],0,6);
	$kelurahan=substr($_GET['kelurahan'],0,10); */
	//$id_kirim=$_GET['id_kirim2'];
	//echo $keyword;
	$sql = "SELECT
		Max(ongkir.id_kel) as id_kel,
		Max(ongkir.id_kec) as id_kec,
		Max(ongkir.id_kab) as id_kab,
		Max(ongkir.id_prov) as id_prov,
		Max(ongkir.nama) nama
		FROM
		ongkir
		Where ongkir > 0 AND
		sts_aktif = '1' AND
		id_kirim <> '1' AND
		id_prov = '$provinsi'
		GROUP BY nama
		ORDER BY nama";
	//echo $sql;
	?>
		<option data-value=""> -- kabupaten -- </option>
		<?php $q = mysqli_query ($con, $sql);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_kab']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> <?php	} ?>
		
	<?php	
	//echo "<script>$('#wilayah_awal').hide();</script>";
	
}

if (isset($_GET['filterprov'])) {
	$filterprov = $_GET['filterprov'];
	//echo $filterprov;
	$query ="SELECT
			provinsi.id_prov,
			provinsi.nama
			FROM
			ongkir
			LEFT JOIN provinsi ON ongkir.id_prov = provinsi.id_prov
			WHERE ongkir.id_kirim = '$filterprov'
			GROUP BY provinsi.id_prov
			ORDER BY provinsi.nama";
	//echo $query;

	?>
		<option data-value=""> -- Provinsi -- </option>
		<?php 
		$no =1 ;
		$q = mysqli_query ($con, $query);
		while ($k = mysqli_fetch_array($q)){ 
		?>
		<option data-value="<?php echo $k['id_prov']; ?>" 
		<?php if($no == 1){ echo " selected ";} 
		(@$h['id_prov']==$k['id_prov'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> 
	<?php	
			$no++;
		} 
	?>
		
	<?php	
	//echo "<script>$('#wilayah_awal').hide();</script>";
}

if (isset($_GET['filterkab'])) {
	$filterkab=$_GET['filterkab'];
	//echo $keyword;
	?>
		<option data-value=""> -- kabupaten -- </option>
		<?php $q = mysqli_query ($con,"select * from kabupaten where id_kirim ='$filterkab'");
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_kab']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> <?php	} ?>
		
	<?php	
	//echo "<script>$('#wilayah_awal').hide();</script>";
}

if (isset($_GET['kabupaten'])) {
	$kabupaten=substr($_GET['kabupaten'],0,4);
	//echo $kabupaten;
	//$id_kirim2=$_GET['id_kirim2'];


	$query="SELECT *FROM kecamatan
		Where id_kab = '$kabupaten' ORDER BY nama";
	//echo $query;
	?>
	<option data-value=""> -- kecamatan -- </option>
		<?php $q = mysqli_query ($con, $query);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_kec']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> 
	<?php	} 
	echo "|";
	$querymst_kirim = "SELECT
			ongkir.id_kirim,
			mst_kirim.nama_kirim,
			ongkir.ongkir
			FROM
			ongkir ,
			mst_kirim
			WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
					ongkir.id_kab='$kabupaten' AND
					ongkir.id_kirim  <> '1'
			GROUP BY ongkir.id_kirim ";
	?>
		<option data-value="">-- Pilih Pengiriman -- </option>
		<?php $q = mysqli_query ($con, $querymst_kirim);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>"
		<?php (@$h['id_kirim']==$k['id_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']." (Rp. ".format_angka($k['ongkir']).")"; ?>
		</option> <?php	} 
}

if (isset($_GET['kabupaten2'])) {
	$kabupaten=($_GET['kabupaten2']);
	//echo $kabupaten;
	//$id_kirim2=$_GET['id_kirim2'];
	$query="SELECT *FROM kabupaten
		Where nama = '$kabupaten' ORDER BY nama";
	$ekstarif=mysqli_query($con,$query);
	$datarif=mysqli_fetch_array($ekstarif);
	$id_kab = $datarif['id_kab']; 
	//echo $ongkir;

	$query="SELECT *FROM kecamatan
		Where id_kab = '$id_kab' ORDER BY nama";
	//echo $query;
	?>
	<option data-value=""> -- kecamatan -- </option>
		<?php $q = mysqli_query ($con, $query);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_kec']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> 
	<?php	} 
	echo "|";
	$querymst_kirim = "SELECT
			ongkir.id_kirim,
			mst_kirim.nama_kirim,
			ongkir.ongkir
			FROM
			ongkir ,
			mst_kirim
			WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
					ongkir.id_kab='$id_kab' AND
					ongkir.id_kirim  <> '1'
			GROUP BY ongkir.id_kirim ";
	?>
		<option data-value="">-- Pilih Pengiriman -- </option>
		<?php $q = mysqli_query ($con, $querymst_kirim);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>"
		<?php (@$h['id_kirim']==$k['id_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']." (Rp. ".format_angka($k['ongkir']).")"; ?>
		</option> <?php	} 
}

if (isset($_GET['kecamatan'])) {
	$kecamatan=substr($_GET['kecamatan'],0,6);
	//echo $kecamatan;
	$query ="SELECT*FROM kelurahan
	WHERE id_kec = '$kecamatan'";
	//echo $query;
	?>
		<option data-value=""> -- kelurahan -- </option>
		<?php $q = mysqli_query ($con, $query);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['id_kel']; ?>" 
		<?php (@$h['nama']==$k['nama'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
		</option> 
	<?php	}
	//echo "<script>$('#wilayah_awal').hide();</script>";
}

if (isset($_GET['kelurahan'])) {
	$kelurahan= $_GET['kelurahan'];
	$id_kab= $_GET['id_kab'];
	$kabupaten= $_GET['kabupaten3'];
	if(empty($id_kab)){
		$query="SELECT *FROM kabupaten
			Where nama = '$kabupaten' ORDER BY nama";
		$ekstarif=mysqli_query($con,$query);
		$datarif=mysqli_fetch_array($ekstarif);
		$id_kab = $datarif['id_kab']; 
	}
	//echo $kecamatan;
	$querymst_kirim = "SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir, 
					ongkir.waktu_kirim
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							ongkir.id_kel='$kelurahan' AND
							ongkir.id_kirim = '1' AND
							sts_aktif = '1'
					GROUP BY ongkir.id_kirim 

					UNION

					SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir, 
					ongkir.waktu_kirim
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							ongkir.id_kab='$id_kab' AND
							ongkir.id_kirim <> '1' AND
							sts_aktif = '1'
					GROUP BY ongkir.id_kirim ";
		//echo $querymst_kirim ;
	?>
		<option data-value="">-- Pilih Pengiriman -- </option>
		<?php $q = mysqli_query ($con, $querymst_kirim);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>"
		<?php (@$h['id_kirim']==$k['id_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']." (Rp. ".format_angka($k['ongkir']).") ".$k['waktu_kirim']; ?>
		</option> <?php	} 
	//echo "<script>$('#wilayah_awal').hide();</script>";
}

if (isset($_GET['kelurahan2'])) {
	$kelurahan= $_GET['kelurahan2'];
	$query="SELECT *FROM kelurahan
		Where nama = '$kelurahan' ORDER BY nama";
	$ekstarif=mysqli_query($con,$query);
	$datarif=mysqli_fetch_array($ekstarif);
	$id_kab = substr($datarif['id_kel'],0,4); 
	$id_kel = $datarif['id_kel']; 
	//echo $kecamatan;
	$querymst_kirim = "SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir, 
					ongkir.waktu_kirim
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							ongkir.id_kel='$id_kel' AND
							ongkir.id_kirim = '1' AND
							sts_aktif = '1'
					GROUP BY ongkir.id_kirim 

					UNION

					SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir, 
					ongkir.waktu_kirim
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							ongkir.id_kab='$id_kab' AND
							ongkir.id_kirim <> '1' AND
							sts_aktif = '1'
					GROUP BY ongkir.id_kirim ";
		//echo $querymst_kirim ;
	?>
		<option data-value="">-- Pilih Pengiriman -- </option>
		<?php $q = mysqli_query ($con, $querymst_kirim);
		while ($k = mysqli_fetch_array($q)){ ?>
		<option data-value="<?php echo $k['nama_kirim']; ?>" data-id_kirim="<?php echo $k['id_kirim']; ?>"
		<?php (@$h['id_kirim']==$k['id_kirim'])?print(" "):print(""); ?>> <?php  echo $k['nama_kirim']." (Rp. ".format_angka($k['ongkir']).") ".$k['waktu_kirim']; ?>
		</option> <?php	} 
	//echo "<script>$('#wilayah_awal').hide();</script>";
}

if (isset($_GET['kirim'])) {
	$id_kirim =$_GET['kirim'];
	$id_kel= $_GET['id_kel'];
	$id_kab= $_GET['id_kab'];
	$kelurahan= $_GET['kelurahan3'];

	if($id_kel==""){
		$query="SELECT *FROM ongkir
		Where nama = '$kelurahan' ORDER BY nama";
		$ekstarif=mysqli_query($con,$query);
		$datarif=mysqli_fetch_array($ekstarif);
		//$id_kab = substr($datarif['id_kel'],0,2); 
		$id_kel = $datarif['id_kel']; 
	}

	$kabupaten= $_GET['kabupaten3'];
	if($id_kab==""){
		$query="SELECT *FROM kabupaten
			Where nama = '$kabupaten' ORDER BY nama";
		$ekstarif=mysqli_query($con,$query);
		$datarif=mysqli_fetch_array($ekstarif);
		$id_kab = $datarif['id_kab']; 
	}
	//echo $kabupaten;
	if( $id_kirim == '1'){
		$query="SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							( ongkir.id_kel='$id_kel' ) AND
							ongkir.id_kirim = '$id_kirim' AND
							sts_aktif = '1'";
	}else{
		$query="SELECT
					ongkir.id_kirim,
					mst_kirim.nama_kirim,
					ongkir.ongkir
					FROM
					ongkir ,
					mst_kirim
					WHERE ongkir.id_kirim = mst_kirim.id_kirim AND
							( ongkir.id_kab='$id_kab')AND
							ongkir.id_kirim = '$id_kirim' AND
							sts_aktif = '1'";
	}
	//echo $query;
	$ekstarif=mysqli_query($con,$query);
	$datarif=mysqli_fetch_array($ekstarif);
	$ongkir = $datarif['ongkir']; 
	if (empty($ongkir)) {
		$ongkir =0;
	}
	echo $ongkir;
}

if (isset($_GET['alamat'])) {
	$vb = '';
	if (isset($_GET['vb'])) {
		$vb = 'm';
	}
	?>
		<thead>
			<tr>
				<th>Penerima</th>
				<th>Alamat</th>
				<th>No.Telp</th>
				<th>Wilayah</th>
			</tr>
		</thead>
	<?php
	$id_user=$_GET['alamat'];
	//echo $id_user;
	$query="SELECT*FROM `order`
	WHERE id_user_pelanggan = '$id_user' AND
			(sts_non IS NULL or sts_non ='')
	GROUP BY alamat_tujuan, provinsi, kabupaten, kecamatan, kelurahan
	ORDER BY nama_penerima";
	//echo $query;
	$eksekusi=mysqli_query($con,$query);
	if (mysqli_num_rows($eksekusi)==0) {
	echo '<tr><td colspan="3″><center><div class="alert alert-danger" role="alert">Belum ada riwayat alamat</div></center></td></tr>';

	}
	while ($data = mysqli_fetch_array($eksekusi)) { 
	?>
		<tr class="pilih" data-id_order="<?php echo $data['id_order']; ?>" data-nama_penerima="<?php echo $data['nama_penerima']; ?>" data-no_telp="<?php echo $data['no_telp']; ?>" data-negara="<?php echo $data['negara']; ?>" data-provinsi="<?php echo $data['provinsi']; ?>" data-kabupaten="<?php echo $data['kabupaten']; ?>" data-kecamatan="<?php echo $data['kecamatan']; ?>" data-kelurahan="<?php echo $data['kelurahan']; ?>" data-alamat_tujuan="<?php echo $data['alamat_tujuan']; ?>" data-kode_pos="<?php echo $data['kode_pos']; ?>" data-vb="<?php echo $vb; ?>" >
	<?php
		echo "<td>".$data['nama_penerima']."</td><td>".$data['alamat_tujuan']."</td><td>".$data['no_telp']."</td><td>".$data['kelurahan'].". ".$data['kecamatan'].". ".$data['kabupaten'].". ".$data['provinsi']."</td>";
		if($vb == 'm') {
	?>
			<td><a href="javascript:void(0);" onclick="return del_alamat2('<?php echo $data["id_order"]; ?>');" >X</a></td></tr>;
	<?php
		}else{
	?>
			<td><a href="javascript:void(0);" onclick="return del_alamat('<?php echo $data["id_order"]; ?>');" >X</a></td></tr>;
	<?php
		}
	}
}

if (isset($_GET['delalamat'])) {
	$id_user=$_GET['id_user'];
	$id_order=$_GET['delalamat'];
	//echo $id_user;

	$querydel="UPDATE `order` SET sts_non = '1'
			Where id_order = '$id_order'";
	//echo $querydel."<br>";
	$delalamat=mysqli_query($con,$querydel);
	
}
?>