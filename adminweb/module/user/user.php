<?php
$aksi="module/user/user_aksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA User ------------------------- ----->			
<h3 class="box-title margin text-center">Data User</h3>
<center> <div class="batas"> </div></center>
<hr/>
	<div class="box box-solid box-info">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa  fa-user-secret"></i>
		Data User </h3>
		<a class="btn btn-default pull-right"href="?module=user&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah data</a>		
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-sm-1">ID user</th>
		<th>Nama</th>
		<th class="col-sm-2">Username</th>
		<th class="col-sm-2">Level</th> 
		<th class="col-sm-1">Status</th> 
		<th class="col-sm-1">Akses</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM user";
$tampil = mysqli_query($con,$sql);
while ($tampilkan = mysqli_fetch_array($tampil)) { 
$Kode = $tampilkan['id_user'];
$blokir = $tampilkan['blokir'];?>

	<tr>
	<td><?php echo $tampilkan['id_user']; ?></td>
	<td><?php echo $tampilkan['nama']; ?></td>
	<td><?php echo $tampilkan['user']; ?></td>
	<td><?php 
	if($tampilkan['level']=="1"){ echo "Director";}
	elseif($tampilkan['level']=="2"){ echo "Manager";}
	elseif($tampilkan['level']=="3"){ echo "staf";}
	?></td>
	<td><?php if  ( $blokir== 'Y' ) {
				echo "<a class='btn btn-xs btn-warning' disabled >NonAktif</a>";}
				else {echo "<a class='btn btn-xs btn-success' disabled>Aktif</a>"; }   ?></td>
	<td align="center">
	<?php if ( $blokir== 'N' ) { ?>
	<a class="btn btn-xs btn-warning"  data-toggle="tooltip" title="Blokir User??" href="<?php echo $aksi ?>?module=user&aksi=yes&id_user=<?php echo $tampilkan['id_user']; ?>" onclick="return confirm('Apakah anda yakin ingin blokir <?php echo $tampilkan['user']; ?> ?')"><i class="glyphicon glyphicon-ok"></i></a>
	<?php }
	else { ?>
	<a class="btn btn-xs btn-success" data-toggle="tooltip" title="UnBlokir User??" href="<?php echo $aksi ?>?module=user&aksi=no&id_user=<?php echo $tampilkan['id_user']; ?>" onclick="return confirm('Apakah anda yakin UnBlokir <?php echo $tampilkan['user']; ?>?')"><i class="glyphicon glyphicon-remove"></i></a>
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

<!----- ------------------------- END MENAMPILKAN DATA User ------------------------- ----->
<?php 
break;
 case "tambah": 
//ID otomatis
?>
<!----- ------------------------- TAMBAH DATA User ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data User</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=user&aksi=tambah" role="form" method="post">  
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama user">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">Departemen </label>
    <div class="col-sm-5">
      <select name="id_unit_krj" class="form-control">
		<option value=" "> -- Pilih Departemen -- </option>
		<?php 
			$sql = "SELECT * FROM unit_krj";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_unit_krj'];
			$nm_unit_krj = $tampilkan['nm_unit_krj'];
		?>
		<option value="<?php echo $Kode ; ?>"><?php echo $nm_unit_krj ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Level </label>
    <div class="col-sm-5">
      <select name="level" class="form-control">
		<option value=" "> -- Pilih Level -- </option>
		<option value="1">Director</option>
		<option value="2">Manager</option>
		<option value="3">staf</option>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No. HP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp" placeholder="No. HP">
    </div>
  </div>

<hr/>
<div class="form-group">
    <label class="col-sm-4 control-label">Username</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="user" placeholder="user">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" required="required" name="pass" minlength="5"value="12345">
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
<!----- ------------------------- END TAMBAH DATA User ------------------------- ----->
<?php	
break;
}
?>
