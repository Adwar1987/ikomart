<?php

include "../../inc/inc.library.php";

$aksi="module/video/video_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../img/video/";

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
<h3 class="box-title margin text-center">Data video</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data video </h3>
		<a class="btn btn-default pull-right" href="?module=video&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data video</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-5">Judul</th>
		<th class="col-sm-3">Sumber</th> 
		<th class="col-sm-2">Tanggal</th> 
		<th class="col-sm-1">Video</th> 
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from mst_video ORDER BY id_video DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_video'];
?>

	<tr>
	<td><?php echo $data['id_video']; ?></td>
	<td><?php echo $data['judul']; ?></td>
	<td><?php echo $data['sumber']; ?></td>
	<td><?php 
	
	$sqlcek ="select
    	a.id_video, a.judul, a.sum, a.sumber, a.link, a.isi,
    	b.nm_tgl, c.nm_bln, a.thn, d.nm_hr, a.img
    from mst_video a
    left join mst_tgl b on b.id_tgl = a.id_tgl
    left join mst_bln c on c.id_bln = a.id_bln
    left join mst_hr d on d.id_hr = a.id_hr
    where a.id_video = '$Kode'";
	//echo $sqlcek."<br>";
	$qb = mysqli_query($con,$sqlcek );         
	$rb = mysqli_fetch_array($qb);     
	if ( $rb['thn'] > 0 ){
    	                                     
		echo $rb['nm_hr'].", ".$rb['nm_tgl']." ".$rb['nm_bln']." ".$rb['thn'];                           
	}else{ 

		echo nama_hari($data['tanggal']).", ".Indonesia2Tgl($data['tanggal']); 
	}
	?></td>
	<td>https://www.youtube.com/embed/<?php echo $data['link'];?><iframe width="200" height="150" src="https://www.youtube.com/embed/<?php echo $data['link'];?>" frameborder="0" allowfullscreen></iframe> </td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_video'];?>" href="?module=video&aksi=edit&id_video=<?php echo $data['id_video'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus Semua Data Pelaporan Masalah video Medik" href="<?php echo $aksi ?>?module=video&aksi=hapus&id_video=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

$datafile = mysqli_query($con, "select max(id_video) as lastid from mst_video");
$edit=mysqli_fetch_array($datafile);
$id_video = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru video</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=video&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi video</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID video</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_video" readonly value ="<?php echo $id_video; ?> " >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul video</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul">
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Topik</label>
    <div class="col-sm-9">
      <textarea name="sum" class="form-control ckeditor" placeholder="Isi Topik" rows="3" required=""></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Narasumber</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="sumber">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Link</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="link" id="uploadImage" onchange="PreviewImage();">
	  <iframe width="200" height="150" id="uploadPreview"  src="https://www.youtube.com/embed/<?php echo $edit['link'];?>" frameborder="0" allowfullscreen></iframe>
	
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
	  <input type="hidden" class="form-control" name="id_tgl" value="0">
    </div>
  </div>
   
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	var cek  = document.getElementById("uploadImage").value;
	//alert(cek);
	document.getElementById("uploadPreview").src = 'https://www.youtube.com/embed/'+cek;
	}
</script>

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
$data=mysqli_query($con,"select * from mst_video p where p.id_video='$_GET[id_video]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data video</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=video&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Data video </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID video</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_video']; ?>" name="id_video" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul video</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul" value="<?php echo $edit['judul']; ?>">
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Topik</label>
    <div class="col-sm-9">
	  <textarea name="sum" class="form-control ckeditor" placeholder="Isi Topik" rows="3" required=""><?php echo $edit['sum']; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Narasumber</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="sumber" value="<?php echo $edit['sumber']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Link</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="link" value="<?php echo $edit['link']; ?>"  id="uploadImage"  onchange="PreviewImage();">
	  
	  <iframe width="200" height="150" id="uploadPreview"  src="https://www.youtube.com/embed/<?php echo $edit['link'];?>" frameborder="0" allowfullscreen></iframe>
	  	  https://www.youtube.com/embed/<?php echo $edit['link'];?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo $edit['tanggal']; ?>">
	</div>
	<label class="col-sm-2 control-label">Tanggal Format Lama</label>
	<div class="col-sm-2">
	  <input type="text" class="form-control" name="tgl" value="<?php echo $edit['id_tgl'].'/'.$edit['id_bln'].'/'.$edit['thn']; ?>">
	 </div>
	 <div class="col-sm-1">
	  <input type="text" class="form-control" name="id_tgl" value="<?php echo $edit['id_tgl']; ?>">
    </div>
  </div>
   
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	var cek  = document.getElementById("uploadImage").value;
	//alert(cek);
	document.getElementById("uploadPreview").src = 'https://www.youtube.com/embed/'+cek;
	}
</script>
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
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
