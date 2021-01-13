<?php
$aksi="module/blog/blog_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER blog ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master blog</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data blog</h3>		 	
		</div>		
	<div class="box-body">
	<?php
 $sql ="SELECT max(id_blog) as terakhir from `blog`";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=blog&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Group</label>
    <div class="col-sm-5">
      <input type="text" name="id_blog" class="form-control" value="<?php echo $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Group</label>
    <div class="col-sm-5">
     <input type="text" name="nama_blog" class="form-control" required="required">
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
		Data Master blog</h3>	
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
$sql = "SELECT *FROM `blog` ORDER BY id_blog";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_blog'];

?>

	<tr>
	<td><?php echo $tampilkan['id_blog']; ?></td> 
	<td><?php echo $tampilkan['nama_blog']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=blog&aksi=edit&id_blog=<?php echo $tampilkan['id_blog'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=blog&aksi=hapus&id_blog=<?php echo $tampilkan['id_blog'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA ID <?php echo $tampilkan['id_blog'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER blog ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"select * from `blog` where id_blog='$_GET[id_blog]'	");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER blog ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data blog </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=blog&aksi=edit" role="form" method="post">             
<div class="form-group">
    <label class="col-sm-3 control-label">ID Group</label>
    <div class="col-sm-5">
      <input type="text" name="id_blog" class="form-control" readonly value="<?php echo $edit['id_blog']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Nama Group</label>
    <div class="col-sm-5">
      <input type="text" name="nama_blog" class="form-control" value="<?php echo $edit['nama_blog']?>">
    </div>
  </div>
  
	<div class="form-group">
		<label class="col-sm-4"></label>
		<div class="col-sm-5">
		<hr/>
			<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			<a href="?module=blog">
			<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
		</div>
	</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER blog ------------------------- ----->
<?php
break;
}
?>
