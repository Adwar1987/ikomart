<?php
$aksi="module/lokasi/lokasi_aksi.php";
include "../../koneksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER lokasi ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master Lokasi</h3>
<center> <div class="batas"> </div></center>
<hr/>
	<div class="box box-solid box-danger">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-map-marker"></i>
		Data Master Lokasi </h3>
		<a class="btn btn-default pull-right"href="?module=lokasi&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data</a>		
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red">
		<th class="col-sm-1">No</th>		
		<th>Nama Lokasi</th>
		<th>Alamat</th> 
		<th class="col-sm-2">No. Hp</th> 
		<th class="col-sm-1">Aksi</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM lokasi_krj";
$tampil = mysqli_query($connect, $sql);
$no=1;
while ($tampilkan = mysqli_fetch_array($tampil)) { 

$Kode = $tampilkan['id_lokasi'];
?>

	<tr>
	<td><?php echo $no++; ?></td>	
	<td><?php echo $tampilkan['nm_lokasi']; ?></td>
	<td><?php echo $tampilkan['alamat_lokasi']; ?></td>
	<td><?php echo $tampilkan['no_hp']; ?></td>
	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=lokasi&aksi=edit&id_lokasi=<?php echo $tampilkan['id_lokasi'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=lokasi&aksi=hapus&id_lokasi=<?php echo $tampilkan['id_lokasi'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
	</td>
	
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER lokasi ------------------------- ----->
<?php 
break;
 case "tambah": 
//ID
$sql ="SELECT max(id_lokasi) as terakhir from lokasi_krj";
  $hasil = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "LOK".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA MASTER lokasi ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Master lokasi</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=lokasi&aksi=tambah" role="form" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">ID lokasi </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_lokasi" value="<?php echo  $nextID; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Lokasi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nm_lokasi" placeholder="Nama lokasi">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor HP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp" value="+62">
    </div>
  </div>
<div class="form-group">
    <label class="col-sm-4 control-label">alamat</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="alamat" placeholder="Alamat">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i> Reset</i></button>
    </div>
  </div> 
</form> 
<!----- ------------------------- END TAMBAH DATA MASTER lokasi ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysqli_query($connect, "select * from lokasi_krj where id_lokasi='$_GET[id_lokasi]'");
$edit=mysqli_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER lokasi ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data lokasi "<?php echo $_GET['id_lokasi']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=lokasi&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID lokasi </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_lokasi" value="<?php echo $edit['id_lokasi']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama lokasi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nm_lokasi"value="<?php echo $edit['nm_lokasi']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor Hp</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp"value="<?php echo $edit['no_hp']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="alamat"value="<?php echo $edit['alamat_lokasi']; ?>">
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=lokasi">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER lokasi ------------------------- ----->
<?php
break;
}
?>