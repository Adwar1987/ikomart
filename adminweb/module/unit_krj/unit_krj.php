<?php
$aksi="module/unit_krj/unit_krj_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER unit_krj ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Unit kerja</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Unit Kerja</h3>		 	
		</div>		
	<div class="box-body">
	<?php
$sql ="SELECT max(id_unit_krj) as terakhir from unit_krj";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "UKJ".sprintf("%03s",$nextNoUrut);
?> 
	 <form class="form-horizontal" action="<?php echo $aksi?>?module=unit_krj&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Unit Kerja</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="id_unit_krj" value="<?php echo  $nextID; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Unit Kerja</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="nm_unit_krj" placeholder="Nama Unit Kerja">
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
		<i class="fa fa-institution"></i>
		Data Master Unit Kerja</h3>	
		</div>		
	<div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">No</th> 
		<th>Nama Unit Kerja</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM unit_krj";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_unit_krj'];

?>

	<tr>
	<td><?php echo $no++; ?></td> 
	<td><?php echo $tampilkan['nm_unit_krj']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=unit_krj&aksi=edit&id_unit_krj=<?php echo $tampilkan['id_unit_krj'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=unit_krj&aksi=hapus&id_unit_krj=<?php echo $tampilkan['id_unit_krj'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER unit_krj ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"select * from unit_krj where id_unit_krj='$_GET[id_unit_krj]'");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER unit_krj ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data unit_krj "<?php echo $_GET['id_unit_krj']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=unit_krj&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Unit Kerja </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_unit_krj" value="<?php echo $edit['id_unit_krj']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Unit Kerja</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nm_unit_krj"value="<?php echo $edit['nm_unit_krj']; ?>">
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=unit_krj">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER unit_krj ------------------------- ----->
<?php
break;
}
?>
