<?php
$aksi="module/mst_kontrak/mst_kontrak_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER mst_kontrak ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Dokumen</h3>
<center> <div class="batas"> </div></center>
<br/>
<div class="row">
<div class="col-md-6">
	<div class="box box-solid box-warning">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-plus"></i>
		Tambah Data Dokumen</h3>		 	
		</div>		
	<div class="box-body">
	<?php
$sql ="SELECT max(id_jns_kontrak) as terakhir from mst_kontrak";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
	 <form class="form-horizontal" action="<?php echo $aksi?>?module=mst_kontrak&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Dokumen</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="id_jns_kontrak" value="<?php echo  $nextID; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Dokumen</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" required="required" name="jns_kontrak" >
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
		Data Master Dokumen</h3>	
		</div>		
	<div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">No</th> 
		<th>Jenis Dokumen</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM mst_kontrak";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_jns_kontrak'];

?>

	<tr>
	<td><?php echo $no++; ?></td> 
	<td><?php echo $tampilkan['jns_kontrak']; ?></td> 
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=mst_kontrak&aksi=edit&id_jns_kontrak=<?php echo $tampilkan['id_jns_kontrak'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=mst_kontrak&aksi=hapus&id_jns_kontrak=<?php echo $tampilkan['id_jns_kontrak'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
<!----- ------------------------- END TAMBAH DATA MASTER mst_kontrak ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"select * from mst_kontrak where id_jns_kontrak='$_GET[id_jns_kontrak]'");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER mst_kontrak ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Dokumen "<?php echo $_GET['id_jns_kontrak']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=mst_kontrak&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Dokumen </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_jns_kontrak" value="<?php echo $edit['id_jns_kontrak']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Dokumen</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="jns_kontrak"value="<?php echo $edit['jns_kontrak']; ?>">
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=mst_kontrak">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER mst_kontrak ------------------------- ----->
<?php
break;
}
?>
