<?php

include "../../inc/inc.library.php";

$aksi="module/banner/banner_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../img/banner/";

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
<!----- ------------------------- MENAMPILKAN DATA MASTER banner------------------------- ----->			
<h3 class="box-title margin text-center">Data banner</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data banner </h3>
		<a class="btn btn-default pull-right" href="?module=banner&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data banner</a>	

	</div>
		
	<div class="box-body">
	<table id="example2" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-5">Judul</th>
		<th class="col-sm-2">Tanggal</th> 
		<th class="col-sm-1">Foto Kecil</th> 
		<th class="col-sm-1">Status Tampil</th> 
		<th class="col-sm-1">Aksi</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from mst_banner ORDER BY id_banner DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_banner'];
?>

	<tr>
	<td><?php echo $data['id_banner']; ?></td>
	<td><?php echo $data['judul']; ?></td>
	<td><?php echo nama_hari($data['tanggal']).", ".Indonesia2Tgl($data['tanggal']); ?></td>
	<td><img border="0" style="width:100%;height:auto;" src="<?php 
									echo '../img/banner/'.$data['folder']."/".$data['foto'];
							?>"></td>
	<td><?php 
	if($data['sts_tampil']=='1'){
		echo "Ya";
	}else{
		echo "Tidak";
	}	?></td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_banner'];?>" href="?module=banner&aksi=edit&id_banner=<?php echo $data['id_banner'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus  Data banner " href="<?php echo $aksi ?>?module=banner&aksi=hapus&id_banner=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

$datafile = mysqli_query($con, "select max(id_banner) as lastid from mst_banner");
$edit=mysqli_fetch_array($datafile);
$id_banner = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru banner</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=banner&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi banner</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID banner</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_banner" readonly value ="<?php echo $id_banner; ?> " >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul banner</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Status Tampil</label>
	<div class="col-sm-9">
	  <input  class="minimal" name="sts_tampil" type="radio" value="1" /> Ditampilkan &nbsp;&nbsp;
	  <input class="minimal" name="sts_tampil" type="radio" value="0" /> Tidak Ditampilkan
    </div>
  </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Gambar</label>
	  <div class="col-sm-5">
       <input type="file" name="foto" class="form-control" >
        <p class="help-block">Kosongkan jika tidak ingin diganti ( size 32 x 37 pixels ).</p>
	  </div>
	  	<div class="col-sm-4">
			<input type="hidden" class="form-control" name="foto_lama">
		</div> 
   </div>
  </div>	

  <div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="?module=banner" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>

<!----- ------------------------- END TAMBAH DATA MASTER pegawai ------------------------- ----->
<?php
break;
case "edit":
$data=mysqli_query($con,"select * from mst_banner p where p.id_banner='$_GET[id_banner]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data banner</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=banner&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="glyphicon glyphicon-briefcase"></i> Informasi Data banner</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID banner</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_banner']; ?>" name="id_banner" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul banner</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul" value="<?php echo $edit['judul']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo $edit['tanggal']; ?>">
	</div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Status Tampil</label>
	<div class="col-sm-9">
	  <input  class="minimal" name="sts_tampil" type="radio" value="1" <?php if(($edit['sts_tampil'])== "1")
				{echo "checked=\"checked\"";};?>/> Ditampilkan &nbsp;&nbsp;
	  <input class="minimal" name="sts_tampil" type="radio" value="0" <?php if(($edit['sts_tampil'])== "0")
				{echo "checked=\"checked\"";};?>/> Tidak Ditampilkan
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-5">
		<input type="file" name="foto" class="form-control" style="width:50%;">
		<p class="help-block">Kosongkan jika tidak ingin diganti ( size 32 x 37 pixels ).</p>
    </div> 
	<div class="col-sm-4">
	 	<input type="text" class="form-control" name="foto_lama" value="<?php echo $edit['foto'];?>">
	</div>  
  </div> 
 
	
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="?module=banner" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
