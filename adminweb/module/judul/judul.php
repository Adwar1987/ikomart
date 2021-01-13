<?php
$aksi="module/judul/judul_aksi.php";
include "../../koneksi.php";
switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER Judul ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Judul Pelatihan</h3>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Judul</h3>		 	
		</div>		
	<div class="box-body">
	<?php
$sql ="SELECT max(id_judul) as terakhir from judul";
  $hasil = mysqli_query($connect,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "JDL".sprintf("%03s",$nextNoUrut);
?> 
	 <form class="form-horizontal" action="<?php echo $aksi?>?module=judul&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Judul</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="id_judul" value="<?php echo  $nextID; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Judul</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="nm_judul" placeholder="Nama Judul">
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
		<i class="fa fa-male"></i>
		Data Master Judul</h3>	
		</div>		
	<div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">No</th> 
		<th>Nama Judul</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from judul";
$tampil = mysqli_query($connect, $sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_judul'];

?>

	<tr>
	<td><?php echo $no++; ?></td> 
	<td><?php echo $tampilkan['nm_judul']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=judul&aksi=edit&id_judul=<?php echo $tampilkan['id_judul'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=judul&aksi=hapus&id_judul=<?php echo $tampilkan['id_judul'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER Judul ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($connect, "select * from judul where id_judul='$_GET[id_judul]'");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER Judul ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Judul Pelatihan"<?php echo $_GET['id_judul']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=judul&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Judul </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_judul" value="<?php echo $edit['id_judul']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Judul</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nm_judul"value="<?php echo $edit['nm_judul']; ?>">
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=judul">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER Judul ------------------------- ----->
<?php
break;
}
?>