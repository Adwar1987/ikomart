<?php
$aksi="module/wilayah/wilayah_aksi.php";
//include "../../koneksi.php";
 
switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER wilayah ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master wilayah</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data wilayah</h3>		 	
		</div>		
	<div class="box-body">
	<?php
 $sql ="SELECT max(id_kab) as terakhir from `kabupaten`";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=wilayah&aksi=tambah" role="form" method="post">             

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
  <div class="form-group">
    <label class="col-sm-4 control-label">No. ID</label>
    <div class="col-sm-5">
     <input type="text" name="id_kab" id="id_kab" class="form-control" readonly required="required">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kota/Kabupaten</label>
    <div class="col-sm-7">
     <input type="text" name="nama" class="form-control" required="required">
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
		Data Master wilayah</h3>	
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">ID</th> 
		<th width="20%">Nama</th> 
		<th>Nama Prov.</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT
		kabupaten.id_kab,
		kabupaten.id_prov,
		kabupaten.nama,
		provinsi.nama AS nama_prov
		FROM
		provinsi,
		kabupaten 
		WHERE provinsi.id_prov = kabupaten.id_prov
		ORDER BY id_kab";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_kab'];

?>

	<tr>
	<td><?php echo $tampilkan['id_kab']; ?></td> 
	<td><?php echo $tampilkan['nama']; ?></td>
	<td><?php echo $tampilkan['nama_prov']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=wilayah&aksi=edit&id_kab=<?php echo $tampilkan['id_kab'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=wilayah&aksi=hapus&id_kab=<?php echo $tampilkan['id_kab'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA ID <?php echo $tampilkan['id_kab'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
	            	//alert (ulasan);
	            	if(id_prov == ""){
						//return ("Isi Dulu Dong !");
						alert ("Isi Dulu Dong !");
						$('#id_prov').focus();
					}else{
		                $.ajax({
		                    url: "./module/wilayah/get_wilayah.php",
		                    method: "GET",
		                    data: {
		                        id_prov: id_prov
		                    },
		                    success: function(respons) {
								//alert(respons);
		                        var obj = respons.split('|');
								//alert((obj[0]));
		                        $('#id_kab').val(obj[0]);
			                 }
			            });
	       			}
	}
</script>
<!----- ------------------------- END TAMBAH DATA MASTER wilayah ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"SELECT
		kabupaten.id_kab,
		kabupaten.id_prov,
		kabupaten.nama,
		provinsi.nama as nama_prov
		FROM
		kabupaten,
		provinsi 
		WHERE provinsi.id_prov = kabupaten.id_prov AND
		 id_kab='$_GET[id_kab]'	");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER wilayah ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data wilayah </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=wilayah&aksi=edit" role="form" method="post">   

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
    <label class="col-sm-3 control-label">No. ID</label>
    <div class="col-sm-3">
      <input type="text" name="id_kab" class="form-control" readonly value="<?php echo $edit['id_kab']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Nama Kota/Kabupaten</label>
    <div class="col-sm-5">
      <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama']?>">
    </div>
  </div>
  
	<div class="form-group">
		<label class="col-sm-4"></label>
		<div class="col-sm-5">
		<hr/>
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<a href="?module=wilayah">
			<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
		</div>
	</div>

</form>
</div>
</div>

<!----- ------------------------- END EDIT DATA MASTER wilayah ------------------------- ----->
<?php
break;
}
?>
