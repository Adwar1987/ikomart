<?php

include "../../inc/inc.library.php";

$aksi="module/profil/profil_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../img/profil/";

function umur($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }

      $selisih=$tahun." Thn ".$bulan." Bln ";
    return $selisih;
}

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER medik ------------------------- ----->			
<h3 class="box-title margin text-center">Data Profil</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Profil </h3>
		<a class="btn btn-default pull-right" href="?module=profil&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Profil</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-2">Judul</th>
		<th class="col-sm-6">Isi</th> 
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from mst_profil ORDER BY id_profil DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_profil'];
?>

	<tr>
	<td><?php echo $data['id_profil']; ?></td>
	<td><?php echo $data['keterangan']; ?></td>
	<td><?php echo $data['isi']; ?></td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_profil'];?>" href="?module=profil&aksi=edit&id_profil=<?php echo $data['id_profil'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus Semua Data Pelaporan Masalah" href="<?php echo $aksi ?>?module=profil&aksi=hapus&id_profil=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
	</td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER medik ------------------------- ----->

<?php 
break;
case "tambah": 

$datafile = mysqli_query($con, "select max(id_profil) as lastid from mst_profil");
$edit=mysqli_fetch_array($datafile);
$id_profil = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru Profil</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=profil&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Profil</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID Profil</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_profil" readonly value ="<?php echo $id_profil; ?> " >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="keterangan">
    </div>
  </div>
     <div class="form-group">
    <label class="col-sm-2 control-label">Isi</label>
	 <div class="col-sm-9">
       <textarea name="isi" class="form-control ckeditor" placeholder="Isi Profil" rows="5" required=""><?php echo $edit['isi']; ?></textarea>
	 </div>
   </div>
        	
  <div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>

<!----- ------------------------- END TAMBAH DATA MASTER pegawai ------------------------- ----->
<?php
break;
case "edit":
$data=mysqli_query($con,"select * from mst_profil p where p.id_profil='$_GET[id_profil]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data Profil</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=profil&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Data Profil </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID Profil</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_profil']; ?>" name="id_profil" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="keterangan" value="<?php echo $edit['keterangan']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Isi</label>
	 <div class="col-sm-9">
       <textarea name="isi" class="form-control ckeditor" placeholder="Isi Profil" rows="5" required=""><?php echo $edit['isi']; ?></textarea>
	 </div>
   </div>
  	
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i>Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
