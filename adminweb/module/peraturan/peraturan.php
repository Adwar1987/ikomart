<?php
//include "../../koneksi.php";
$folder = "../files/peraturan/";
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
$aksi="module/peraturan/peraturan_aksi.php";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER str ------------------------- ----->			
<h3 class="box-title margin text-center">Data peraturan</h3>
<center> <div class="batas"> </div></center>
<hr/>
<div class="nav-tabs-custom">

<div class="tab-content">
<div class="tab-pane active" id="dat">
<section id="new">
	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Daftar Peraturan </h3>	
		<a class="btn btn-default pull-right" href="?module=peraturan&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Dokumen</a>	
		</div>	

<!-- awal script -->
	<form class="form-horizontal" action="../gm/module/laporan/cetak_sk.php" method="post">             
		<div class="form-group">
			<label class="col-sm-4 control-label">Tanggal</label>
			<div class="col-sm-3">
				<div class="input-group">
				  <div class="input-group-addon">
				  
					<i class="fa fa-calendar"></i>
				  </div>
				  <input type="text" name="tanggal" required="required" class="form-control pull-right" id="reservation"/>
				</div><!-- /.input group -->
			</div>
			<div class="col-sm-1">
				<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
			</div>
		</div>  
	</form>
<!-- akhir script -->	
		
	<div class="box-body">
	<table id="example1" class="table table-bordeblue table-brosuriped">
<thead>
	<tr class="text-blue">
		<th class="col-sm-1">No.</th>
		<th class="col-sm-1">No. Peraturan</th>
		<th class="col-sm-3">Nama Dokumen</th>
		<th class="col-sm-2">Dokumen</th> 
		<th class="col-sm-1">AKSI</th> 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from peraturan ";
$tampil = mysqli_query($con,$sql);
$no=1;
while ($k = mysqli_fetch_array($tampil)) { 
$Kode = $k['id_sk'];
$dokfile = $k['dokumen'];
//$tmt=IndonesiaTgl($k['tgl_awal']);
?>

	<tr>	
	<td><?php echo $k['id_sk']; ?></a></td>
	<td><?php echo $k['no_sk']; ?></a></td>
	<td><?php echo $k['nm_sk']; ?></a></td>
	<?php 
		$sqlfile = "SELECT * FROM file_dok 
		 where  id='$dokfile'";
		// echo $sqlfile;
		$dok_file = mysqli_query($con,$sqlfile);
		$isi_file=mysqli_fetch_array($dok_file );
	?>
	<td><?php echo $isi_file['judul']; ?></td>
	<td align="center">
	<a  class="btn btn-xs btn-info" href="?module=peraturan&aksi=edit&id_sk=<?php echo $Kode ;?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i> Pilih</a>	
	<a class="btn btn-xs btn-warning" href="<?php echo $aksi ?>?module=peraturan&aksi=hapus&id_sk=<?php echo $Kode ;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
	</td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
</section>
</div>

</div>
<!----- ------------------------- END MENAMPILKAN DATA MASTER brosur ------------------------- ----->
<?php 
break;
case "tambah": 
?>
<!----- ------------------------- TAMBAH DATA MASTER brosur ------------------------- ----->
<?php
  $hasil = mysqli_query($con,"SELECT max(cast(id_sk as int)) as terakhir from peraturan ORDER BY cast(id_sk as int)"); $data = mysqli_fetch_array($hasil);
  $lastID = $data['terakhir']; 
  $nextID = $lastID + 1;
?>
<h3 class="box-title margin text-center">Tambah Data Dokumen Baru</h3>
<hr/>

	<div class="box-body">
<form class="form-horizontal" action="<?php echo $aksi?>?module=peraturan&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             
  <div class="form-group">
    <label class="col-sm-4 control-label">ID.</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" readonly required="required" name="id_sk" value="<?php echo $nextID;?>">
    </div>
</div>
 <div class="form-group">
    <label class="col-sm-4 control-label">No. Dokumen</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="no_sk">
    </div>
</div>
 <div class="form-group">
    <label class="col-sm-4 control-label">Nama Dokumen </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="nm_sk">
    </div>
</div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">Upload Dokumen</label>
    <div class="col-sm-6">
		<input type="file" name="dokumen">
		<input type="hidden" class="form-control" name="dokumen_lama">
    </div>
  </div>     

  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-diPK"></i> Simpan</button>
		<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i><i>Reset</i></button>
		<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>
</div> 
<?php 
break;
case "edit" :

$data=mysqli_query($con,"select * from peraturan where id_sk='$_GET[id_sk]'");
$edit=mysqli_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER brosur ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Dokumen</h3>
<hr/>


	<div class="box-body">
<form class="form-horizontal" action="<?php echo $aksi?>?module=peraturan&aksi=edit" role="form" method="post" enctype="multipart/form-data">       

<div class="form-group">
    <label class="col-sm-4 control-label">ID</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" readonly name="id_sk" value="<?php echo $edit['id_sk'];?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">No. Dokumen</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="no_sk" value="<?php echo $edit['no_sk'];?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Dokumen</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="nm_sk" value="<?php echo $edit['nm_sk']; ?>">
    </div>
</div>
  
 <div class="form-group">
    <label class="col-sm-4 control-label">Upload Dokumen</label>
    <div class="col-sm-5">
		<input type="file" name="dokumen" >
		<input type="hidden" class="form-control" name="dokumen_lama" value="<?php echo $edit['dokumen'];?>">
		<?php 
			$sql2 = "select * from peraturan, file_dok where peraturan.dokumen = file_dok.id and id_sk='$_GET[id_sk]'"; 
			//echo 	$sql2;
			$s2=mysqli_fetch_array(mysqli_query($con,	$sql2 ));
		?>
		<input type="text" class="form-control" value="<?php echo $s2['judul'];?>">
		<a href="<?php echo $folder.$s2['judul']; ?> ">view file</a>
				
    </div>
	
  </div>  

  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-diPK"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i><i>Reset</i></button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>
</div> 
<!----- ------------------------- END EDIT DATA MASTER brosur ------------------------- ----->
<?php
break;
}
?>

