<?php
$aksi="module/jabatan/jabatan_aksi.php";
include "../../koneksi.php";
switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER jabatan ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Jabatan</h3>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Jabatan</h3>		 	
		</div>		
	<div class="box-body">
	<?php
$sql ="SELECT max(id_jabatan) as terakhir from jabatan";
  $hasil = mysqli_query($connect,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "JAB".sprintf("%03s",$nextNoUrut);
?> 
	 <form class="form-horizontal" action="<?php echo $aksi?>?module=jabatan&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Jabatan</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="id_jabatan" value="<?php echo  $nextID; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Jabatan</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="nm_jabatan" placeholder="Nama Jabatan">
    </div>
  </div><div class="form-group">
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
		Data Master Jabatan</h3>	
		</div>		
	<div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">No</th> 
		<th>Nama jabatan</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM jabatan";
$tampil = mysqli_query($connect, $sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_jabatan'];

?>

	<tr>
	<td><?php echo $no++; ?></td> 
	<td><?php echo $tampilkan['nm_jabatan']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=jabatan&aksi=edit&id_jabatan=<?php echo $tampilkan['id_jabatan'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=jabatan&aksi=hapus&id_jabatan=<?php echo $tampilkan['id_jabatan'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER jabatan ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($connect, "select * from jabatan where id_jabatan='$_GET[id_jabatan]'");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER jabatan ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data jabatan "<?php echo $_GET['id_jabatan']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=jabatan&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID jabatan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_jabatan" value="<?php echo $edit['id_jabatan']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Jabatan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nm_jabatan"value="<?php echo $edit['nm_jabatan']; ?>">
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=jabatan">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER jabatan ------------------------- ----->
<?php
break;
}
?>