<?php
$aksi="module/bayar/bayar_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER bayar ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master bayar</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data bayar</h3>		 	
		</div>		
	<div class="box-body">
	<?php
 $sql ="SELECT max(id_bayar) as terakhir from `mst_bayar`";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=bayar&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Group</label>
    <div class="col-sm-5">
      <input type="text" name="id_bayar" class="form-control" value="<?php echo $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Group</label>
    <div class="col-sm-5">
     <input type="text" name="nama_bayar" class="form-control" required="required">
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
		Data Master bayar</h3>	
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">ID</th> 
		<th>Nama Group</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT *FROM `mst_bayar` ORDER BY id_bayar";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_bayar'];

?>

	<tr>
	<td><?php echo $tampilkan['id_bayar']; ?></td> 
	<td><?php echo $tampilkan['nama_bayar']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=bayar&aksi=edit&id_bayar=<?php echo $tampilkan['id_bayar'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=bayar&aksi=hapus&id_bayar=<?php echo $tampilkan['id_bayar'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA ID <?php echo $tampilkan['id_bayar'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER bayar ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"select * from `mst_bayar` where id_bayar='$_GET[id_bayar]'	");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER bayar ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data bayar </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=bayar&aksi=edit" role="form" method="post">             
<div class="form-group">
    <label class="col-sm-3 control-label">ID Group</label>
    <div class="col-sm-5">
      <input type="text" name="id_bayar" class="form-control" readonly value="<?php echo $edit['id_bayar']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Nama Group</label>
    <div class="col-sm-5">
      <input type="text" name="nama_bayar" class="form-control" value="<?php echo $edit['nama_bayar']?>">
    </div>
  </div>
  
	<div class="form-group">
		<label class="col-sm-4"></label>
		<div class="col-sm-5">
		<hr/>
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<a href="?module=bayar">
			<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
		</div>
	</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER bayar ------------------------- ----->
<?php
break;
}
?>
