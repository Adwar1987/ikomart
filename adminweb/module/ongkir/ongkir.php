<?php
$aksi="module/ongkir/ongkir_aksi.php";
//include "../../koneksi.php";
//include "../../koneksi.php";
 
switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER ongkir ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Ongkir Dalam Negeri</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Ongkir</h3>		 	
		</div>		
	<div class="box-body">
	<?php
 $sql ="SELECT max(id_kab) as terakhir from `ongkir`";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=ongkir&aksi=tambah" role="form" method="post">             

   <input type="hidden" name="id_ongkir" id="id_ongkir" class="form-control">
   <input type="hidden" name="sts_aktif" id="sts_aktif" value="1">
  <div class="form-group">
    <label class="col-sm-4 control-label">Provinsi</label>
    <div class="col-sm-5">

		<select name="id_prov" id="id_prov" onchange="ambilkode_prov()" class="form-control" />
			<option data-value=" "> -- provinsi -- </option>
		<?php $q = mysqli_query ($con,"select * from provinsi");
			while ($k = mysqli_fetch_array($q)){ 
		?>
			<option value="<?php echo $k['id_prov']; ?>" 
		<?php (@$h['id_prov']==$k['id_prov'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
			</option> <?php	} ?>
		</select>
    </div>
  </div>
 <!--  <div class="form-group">
    <label class="col-sm-4 control-label">No. ID</label>
    <div class="col-sm-5">
     <input type="text" name="id_kab" id="id_kab" class="form-control" required="required">
    </div>
  </div> -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kota</label>
    <div class="col-sm-7">
    	<select name="id_kab" id="id_kab" onchange="ambilnama_kota()" class="form-control">
			<option >
			</option> 
		</select>
     
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kecamatan</label>
    <div class="col-sm-7">
    	<select name="id_kec" id="id_kec" onchange="ambilnama_kec()" class="form-control">
			<option >
			</option> 
		</select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kelurahan</label>
    <div class="col-sm-7">
    	<select name="id_kel" id="id_kel" onchange="ambilnama_kel()" class="form-control">
			<option >
			</option> 
		</select>
		<input type="hidden" name="nama" id="nama" class="form-control">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">Ongkos Kirim</label>
    <div class="col-sm-5">
     	<input type="number" name="ongkir" class="form-control" required="required">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Pengirim</label>
    <div class="col-sm-5">
     	<select name="id_kirim" id="id_kirim"  class="form-control">
			<option value=" "> -- Pilih Pengirim -- </option>
			<?php
				$q = mysqli_query ($con,"select * from mst_kirim");
				while ($k = mysqli_fetch_array($q)){ 
			?>
			<option value="<?php echo $k['id_kirim']; ?>"> <?php  echo $k['nama_kirim']; ?>
			</option> 
			<?php	
				}
			?>								
		</select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Waktu Pengiriman</label>
    <div class="col-sm-3">
		<input type="text" name="waktu_kirim" id="waktu_kirim">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-7">
	<hr/>
      	<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
		<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i><i> Reset</i></button> 
    </div>
  </div>
</form>
	</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
<div class="col-md-6">
	<div class="box box-solid box-danger">
		<div class="box-header">
		<h3 class="btn disabled box-title">
		<i class="fa fa-institution"></i>
		Data Master ongkir</h3>	
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">ID</th> 
		<th width="20%">Nama</th> 
		<th>Nama Prov.</th> 
		<th>Ongkir</th>
		<th>Pengirim</th>
		<th>Waktu</th>
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT
		ongkir.id_ongkir,
		ongkir.id_kab,
		ongkir.id_prov,
		ongkir.nama,
		ongkir.ongkir,
		ongkir.waktu_kirim,
		provinsi.nama AS nama_prov,
		mst_kirim.nama_kirim
		FROM
		provinsi,
		ongkir 
		left JOIN mst_kirim ON mst_kirim.id_kirim = ongkir.id_kirim
		WHERE provinsi.id_prov = ongkir.id_prov
		ORDER BY id_ongkir";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_ongkir'];

?>

	<tr>
	<td><?php echo $tampilkan['id_ongkir']; ?></td> 
	<td><?php echo $tampilkan['nama']; ?></td>
	<td><?php echo $tampilkan['nama_prov']; ?></td> 
	<td><?php echo format_angka($tampilkan['ongkir']); ?></td>
	<td><?php echo $tampilkan['nama_kirim']; ?></td> 
	<td><?php echo $tampilkan['waktu_kirim']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=ongkir&aksi=edit&id_ongkir=<?php echo $tampilkan['id_ongkir'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=ongkir&aksi=hapus&id_ongkir=<?php echo $tampilkan['id_ongkir'];?>"  alt="No Aktif Data" onclick="return confirm('ANDA YAKIN AKAN NON AKTIF DATA ID <?php echo $tampilkan['id_ongkir'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
	</td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>

<script type="text/javascript">
	function ambilkode_prov() {
		var id_prov=$('#id_prov').val();
	            	//alert (id_prov);
	            	if(id_prov == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_prov').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: { id_prov: id_prov },
		                    success: function(respons) {
								//alert(respons);
		                        //var obj = respons.split('|');
								//alert((obj[0]));
		                        //$('#id_kab').val(obj[0]);
		                        $('#id_kab').html(respons);
			                 }
			            });
	       			}
	}
	function ambilnama_kota() {
		var id_kab=$('#id_kab').val();
	            	//alert (id_kab);
	            	if(id_kab == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_kab').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: {id_kab: id_kab},
		                    success: function(respons) {
								//alert(respons);
		                        var obj = respons.split('|');
								//alert((obj[0]));
		                        $('#nama').val(obj[0]);
		                        $('#id_kec').html(obj[1]);
			                 }
			            });
	       			}
	}

	function ambilnama_kec() {
		var id_kec=$('#id_kec').val();
	            	//alert (id_kab);
	            	if(id_kec == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_kec').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: {id_kec: id_kec},
		                    success: function(respons) {
								//alert(respons);
		                        var obj = respons.split('|');
								//alert((obj[0]));
		                        $('#nama').val(obj[0]);
		                        $('#id_kel').html(obj[1]);
			                 }
			            });
	       			}
	}

	function ambilnama_kel() {
		var id_kel=$('#id_kel').val();
	            	//alert (id_kab);
	            	if(id_kel == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_kel').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: {id_kel: id_kel},
		                    success: function(respons) {
								//alert(respons);
		                        var obj = respons.split('|');
								//alert((obj[0]));
		                        $('#nama').val(obj[0]);
			                 }
			            });
	       			}
	}
</script>
<!----- ------------------------- END TAMBAH DATA MASTER ongkir ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"SELECT
		ongkir.id_ongkir,
		ongkir.id_kel,
		ongkir.id_kec,
		ongkir.id_kab,
		ongkir.id_prov,
		ongkir.nama,
		ongkir.ongkir,
		ongkir.id_kirim,
		ongkir.sts_aktif,
		provinsi.nama as nama_prov
		FROM
		ongkir,
		provinsi 
		WHERE provinsi.id_prov = ongkir.id_prov AND
		 id_ongkir='$_GET[id_ongkir]'	");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER ongkir ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data ongkir </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=ongkir&aksi=edit" role="form" method="post">   

<div class="form-group">
    <label class="col-sm-3 control-label">No. ID</label>
    <div class="col-sm-3">
      <input type="text" name="id_ongkir" class="form-control" readonly value="<?php echo $edit['id_ongkir']?>">
    </div>
  </div>

<div class="form-group">
    <label class="col-sm-3 control-label">Provinsi</label>
    <div class="col-sm-3">
		<select name="id_prov" id="id_prov"  readonly class="form-control" />
			<option data-value=" "> -- provinsi -- </option>
		<?php $q = mysqli_query ($con,"select * from provinsi WHERE id_prov='".$edit['id_prov']."'");
			while ($k = mysqli_fetch_array($q)){ 
		?>
			<option 
		<?php if($edit['id_prov'] == $k['id_prov']){ echo " selected ";} ?>
			value="<?php echo $k['id_prov']; ?>" 
		<?php (@$h['id_prov']==$k['id_prov'])?print(" "):print(""); ?>> <?php  echo $k['nama']; ?>
			</option> <?php	} ?>
		</select>
    </div>
  </div>      

  <div class="form-group">
    <label class="col-sm-3 control-label">Nama Wilayah</label>
    <div class="col-sm-5">
    	<input type="hidden" name="id_kab" class="form-control" readonly value="<?php echo $edit['id_kab']?>">
    	<input type="hidden" name="id_kec" id="id_kec" readonly class="form-control" value="<?php echo $edit['id_kec']?>">
    	<input type="hidden" name="id_kel" id="id_kel" readonly class="form-control" value="<?php echo $edit['id_kel']?>">
		<input type="text" name="nama" id="nama" class="form-control" readonly value="<?php echo $edit['nama']?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Ongkos Kirim</label>
    <div class="col-sm-5">
      <input type="number" name="ongkir" class="form-control" value="<?php echo $edit['ongkir']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Pengirim</label>
    <div class="col-sm-5">
     	<select name="id_kirim" id="id_kirim"  class="form-control">
			<option value=" "> -- Pilih Pengirim -- </option>
			<?php
				$q = mysqli_query ($con,"select * from mst_kirim");
				while ($k = mysqli_fetch_array($q)){ 
			?>
			<option 
			<?php if($edit['id_kirim'] == $k['id_kirim']){ echo " selected ";} ?>
			value="<?php echo $k['id_kirim']; ?>"> <?php  echo $k['nama_kirim']; ?>
			</option> 
			<?php	
				}
			?>								
		</select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Waktu Pengiriman</label>
      <div class="col-sm-3">
		  <input type="text" name="waktu_kirim" id="waktu_kirim" value=" <?php echo $edit['waktu_kirim'];?>">
		
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Status Aktif</label>
      <div class="col-sm-3">
			<?php if($edit['sts_aktif']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_aktif" id="sts_aktif" value="1">
		</div>
  </div>
  
	<div class="form-group">
		<label class="col-sm-4"></label>
		<div class="col-sm-5">
		<hr/>
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<a href="?module=ongkir">
			<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
		</div>
	</div>

</form>
</div>
</div>
<script type="text/javascript">
	function ambilkode_prov() {
		var id_prov=$('#id_prov').val();
	            	//alert (id_prov);
	            	if(id_prov == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_prov').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: { id_prov: id_prov },
		                    success: function(respons) {
								//alert(respons);
		                        //var obj = respons.split('|');
								//alert((obj[0]));
		                        //$('#id_kab').val(obj[0]);
		                        $('#id_kab').html(respons);
			                 }
			            });
	       			}
	}
	function ambilnama_kota() {
		var id_kab=$('#id_kab').val();
	            	//alert (id_kab);
	            	if(id_kab == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_kab').focus();
					}else{
		                $.ajax({
		                    url: "./module/ongkir/get_wilayah.php",
		                    method: "GET",
		                    data: {id_kab: id_kab},
		                    success: function(respons) {
								//alert(respons);
		                        var obj = respons.split('|');
								//alert((obj[0]));
		                        $('#nama').val(obj[0]);
		                        //$('#listkab').html(respons);
			                 }
			            });
	       			}
	}
</script>

<!----- ------------------------- END EDIT DATA MASTER ongkir ------------------------- ----->
<?php
break;
}
?>
