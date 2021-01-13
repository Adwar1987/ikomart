<?php
$aksi="module/ongkirln/ongkir_aksi.php";
//include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER ongkir ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Ongkir Luar Negeri</h3>
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
 $sql ="SELECT max(id_negara) as terakhir from `negara`";
  $hasil = mysqli_query($con,$sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $nextID = $lastID + 1;
?> 
<form class="form-horizontal" action="<?php echo $aksi?>?module=ongkirln&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">No. ID</label>
    <div class="col-sm-5">
     <input type="text" name="id_negara" id="id_negara" class="form-control" required="required" value="<?php  echo $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Negara</label>
    <div class="col-sm-7">
     <input type="text" name="nm_negara" class="form-control" required="required">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">Ongkos Kirim</label>
    <div class="col-sm-5">
     <input type="number" name="tarif" class="form-control" required="required">
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
		<th>Nama Negara</th> 
		<th>Ongkir</th>
		<th class="col-sm-2">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT*FROM negara
		ORDER BY id_negara";
//echo $sql;
$tampil = mysqli_query($con,$sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_negara'];

?>

	<tr>
	<td><?php echo $tampilkan['id_negara']; ?></td> 
	<td><?php echo $tampilkan['nm_negara']; ?></td>
	<td><?php echo format_angka($tampilkan['tarif']); ?></td>
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=ongkirln&aksi=edit&id_negara=<?php echo $tampilkan['id_negara'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=ongkirln&aksi=hapus&id_negara=<?php echo $tampilkan['id_negara'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA ID <?php echo $tampilkan['id_negara'];?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

</script>
<!----- ------------------------- END TAMBAH DATA MASTER ongkir ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($con,"SELECT*FROM negara WHERE id_negara ='$_GET[id_negara]'	");
$edit=mysqli_fetch_array($data);
?>

<!----- ------------------------- EDIT DATA MASTER ongkir ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data ongkir </h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=ongkirln&aksi=edit" role="form" method="post">   
         
<div class="form-group">
    <label class="col-sm-3 control-label">No. ID</label>
    <div class="col-sm-5">
      <input type="text" name="id_negara" class="form-control" readonly value="<?php echo $edit['id_negara']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Nama Negara</label>
    <div class="col-sm-5">
      <input type="text" name="nm_negara" class="form-control" value="<?php echo $edit['nm_negara']?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label">Ongkos Kirim</label>
    <div class="col-sm-5">
      <input type="number" name="tarif" class="form-control" value="<?php echo $edit['tarif']?>">
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

<!----- ------------------------- END EDIT DATA MASTER ongkir ------------------------- ----->
<?php
break;
}
?>
