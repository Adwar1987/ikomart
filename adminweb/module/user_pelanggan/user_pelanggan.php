<?php
$aksi="module/user_pelanggan/user_pelanggan_aksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA user_pelanggan ------------------------- ----->			
<h3 class="box-title margin text-center">Data User Pelanggan</h3>
<center> <div class="batas"> </div></center>
<hr/>
	<div class="box box-solid box-info">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-user_pelanggan-secret"></i>
		Data user_pelanggan </h3>
		<a class="btn btn-default pull-right"href="?module=user_pelanggan&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah data</a>		
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-sm-1">ID user Pelanggan</th>
		<th class="col-sm-2">Nama</th>
		<th class="col-sm-1">E-mail</th> 
		<th class="col-sm-1">Status</th> 
		<th class="col-sm-1">Akses</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM user_pelanggan";
$tampil = mysqli_query($con,$sql);
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_user_pelanggan'];
$blokir = $tampilkan['blokir'];?>

	<tr>
	<td><?php echo $tampilkan['id_user_pelanggan']; ?></td>
	<td><?php echo $tampilkan['nama']; ?></td>
	<td><?php echo $tampilkan['email']; ?></td>
	<td><?php if  ( $blokir== 'Y' ) {
				echo "<a class='btn btn-xs btn-warning' disabled >NonAktif</a>";}
				else {echo "<a class='btn btn-xs btn-success' disabled>Aktif</a>"; }   ?></td>
	<td align="center">
	<?php if ( $blokir== 'N' ) { ?>
	<a class="btn btn-xs btn-warning"  data-toggle="tooltip" title="Blokir user_pelanggan??" href="<?php echo $aksi ?>?module=user_pelanggan&aksi=yes&id_user_pelanggan=<?php echo $tampilkan['id_user_pelanggan']; ?>" onclick="return confirm('Apakah anda yakin ingin blokir <?php echo $tampilkan['user_pelanggan']; ?> ?')"><i class="glyphicon glyphicon-ok"></i></a>
	<?php }
	else { ?>
	<a class="btn btn-xs btn-success" data-toggle="tooltip" title="UnBlokir user_pelanggan??" href="<?php echo $aksi ?>?module=user_pelanggan&aksi=no&id_user_pelanggan=<?php echo $tampilkan['id_user_pelanggan']; ?>" onclick="return confirm('Apakah anda yakin UnBlokir <?php echo $tampilkan['user_pelanggan']; ?>?')"><i class="glyphicon glyphicon-remove"></i></a>
	<?php } ?>
	</td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA user_pelanggan ------------------------- ----->
<?php 
break;
 case "tambah": 
//ID otomatis
?>
<!----- ------------------------- TAMBAH DATA user_pelanggan ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data User Pelanggan</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=user_pelanggan&aksi=tambah" role="form" method="post">  
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Pelanggan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Pelanggan">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">E-mail</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="email" placeholder="email">
    </div>
  </div> 

 <div class="form-group">
    <label class="col-sm-4 control-label">No. HP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp" placeholder="No. HP">
    </div>
  </div> 

<hr/>
<!-- <div class="form-group">
    <label class="col-sm-4 control-label">username</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="user_pelanggan" placeholder="user_pelanggan">
    </div>
  </div> -->  
  <div class="form-group">
    <label class="col-sm-4 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" required="required" name="pass" minlength="5"value="">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i>Reset</i></button>
    </div>
  </div> 
</form> 
<!----- ------------------------- END TAMBAH DATA user_pelanggan ------------------------- ----->
<?php	
break;
}
?>
