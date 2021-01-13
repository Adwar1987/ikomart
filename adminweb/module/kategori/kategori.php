<?php
$aksi="module/kategori/kategori_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER categories ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Kategori</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Kategori</h3>		 	
		</div>		
	<div class="box-body">
	<?php
 $sql ="SELECT max(id_kategori) as terakhir from categories";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Kategori</label>
    <div class="col-sm-5">
      <input type="text" name="id_kategori" class="form-control" value="<?php echo $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kategori</label>
    <div class="col-sm-5">
     <input type="text" name="nama" class="form-control" required="required">
    </div>
  </div>
<div class="form-group">
    <label class="col-sm-4 control-label">Kelompok</label>
    <div class="col-sm-5">
     	<select name="id_kelompok" id="id_kelompok"  class="form-control">
			<option value=" "> -- Pilih Kelompok -- </option>
			<?php
				$q = mysqli_query ($con,"select * from kelompok");
				while ($k = mysqli_fetch_array($q)){ 
			?>
			<option value="<?php echo $k['id_kelompok']; ?>"> <?php  echo $k['nama_kelompok']; ?>
			</option> 
			<?php	
				}
			?>								
		</select>
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
		Data Master Kategori</h3>	
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">ID</th> 
		<th>Kategori</th> 
		<th>Kelompok</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT categories.id_kategori,
categories.nama,
categories.id_kelompok,
kelompok.nama_kelompok
FROM
categories
LEFT JOIN kelompok ON kelompok.id_kelompok = categories.id_kelompok
ORDER BY id_kategori";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_kategori'];

?>

	<tr>
	<td><?php echo $tampilkan['id_kategori']; ?></td> 
	<td><?php echo $tampilkan['nama']; ?></td>
	<td><?php echo $tampilkan['nama_kelompok']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=kategori&aksi=edit&id_kategori=<?php echo $tampilkan['id_kategori'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=kategori&aksi=hapus&id_kategori=<?php echo $tampilkan['id_kategori'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA ID <?php echo $tampilkan['id_kategori'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER kategori ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"select * from categories where id_kategori='$_GET[id_kategori]'");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER categories ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Kategori </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=edit" role="form" method="post">             
<div class="form-group">
    <label class="col-sm-3 control-label">Kategori</label>
    <div class="col-sm-5">
      <input type="text" name="id_kategori" class="form-control" readonly value="<?php echo $edit['id_kategori']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Kategori</label>
    <div class="col-sm-5">
      <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama']?>">
    </div>
  </div>

 <div class="form-group">
    <label class="col-sm-3 control-label">Kelompok</label>
    <div class="col-sm-5">
      	<select name="id_kelompok" id="id_kelompok"  class="form-control">
			<option value=" "> -- Pilih Kelompok -- </option>
			<?php
				$q = mysqli_query ($con,"select * from kelompok");
				while ($k = mysqli_fetch_array($q)){ ?>
			<option 
			<?php if($edit['id_kelompok'] == $k['id_kelompok']){ echo " selected ";} ?>
				value="<?php echo $k['id_kelompok']; ?>" 
			<?php (@$h['id_kelompok']==$k['id_kelompok'])?print(" "):print(""); ?>> <?php  echo $k['nama_kelompok']; ?>
			</option> 
			<?php
			 }
			 ?>
		</select>
    </div>
  </div>
  
	<div class="form-group">
		<label class="col-sm-4"></label>
		<div class="col-sm-5">
		<hr/>
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<a href="?module=kategori">
			<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
		</div>
	</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER categories ------------------------- ----->
<?php
break;
}
?>
