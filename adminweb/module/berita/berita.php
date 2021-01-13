<?php

include "../../inc/inc.library.php";

$aksi="module/berita/berita_aksi.php"; 
date_default_timezone_set("Asia/Jakarta"); 

$folder = "../image/blog/";

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
<h3 class="box-title margin text-center">Data Blog</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Blog </h3>
		<a class="btn btn-default pull-right" href="?module=berita&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Blog</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-5">Judul</th>
		<th class="col-sm-3">Jenis Blog</th> 
		<th class="col-sm-3">Sumber</th> 
		<th class="col-sm-2">Tanggal</th> 
		<th class="col-sm-1">Gambar</th> 
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from mst_berita ORDER BY id_berita DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_berita'];
?>

	<tr>
	<td><?php echo $data['id_berita']; ?></td>
	<td><?php echo $data['judul']; ?></td>
	<td><?php 
		$datablog=mysqli_query($con,"select * from blog p where id_blog='".$data['id_blog']."'");
		$rblog=mysqli_fetch_array($datablog);
		echo $rblog['nama_blog']; 
		?></td>
	<td><?php echo $data['sumber']; ?></td>
	<td><?php echo nama_hari($data['tanggal']).", ".Indonesia2Tgl($data['tanggal']);?></td>
  <td><a href="<?php echo $folder.$data['img'];?>" target="_blank" > klik lihat </a>
	<!-- <td><img border="0" style="width:100%;height:auto;" src="<?php echo $folder.$data['img'];?>"></td> -->
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_berita'];?>" href="?module=berita&aksi=edit&id_berita=<?php echo $data['id_berita'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus Semua Data blog" href="<?php echo $aksi ?>?module=berita&aksi=hapus&id_berita=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

$datafile = mysqli_query($con, "select max(id_berita) as lastid from mst_berita");
$edit=mysqli_fetch_array($datafile);
$id_berita = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru Blog</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=berita&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Blog</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID berita</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_berita" readonly value ="<?php echo $id_berita; ?> " >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul berita</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul" id="judul" onchange="set_alias()">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Alias produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" readonly name="alias" id="alias">
    </div>
  </div>
  
    <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Blog</label>
    <div class="col-sm-5">
      <select name="id_blog" class="form-control">
		<option value=" "> -- Pilih Jenis Blog -- </option>
		<?php 
			$sql = "SELECT * FROM `blog` order by nama_blog";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_blog'];
			$nama_blog = $tampilkan['nama_blog'];
		?>
		<option value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_blog)) ; ?></option>
		<?php 
			}
		?>
	  </select>
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
      <input type="text" class="form-control" required="required" name="link">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
    </div>
  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Isi Blog</label>
	 <div class="col-sm-9">
       <textarea name="isi" class="form-control ckeditor" placeholder="Isi Blog" rows="5" required=""></textarea>
	 </div>
   </div>
   
<div class="form-group">
      <label class="col-sm-2 control-label">Gambar</label>
	  <div class="col-sm-5">
		   <input type="file" name="img" class="form-control" style="width:50%;" id="uploadImage" onchange="PreviewImage();">
			<p class="help-block">Kosongkan jika tidak ingin diganti.</p>
			<img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Gambar" />
	  </div>
	  	<div class="col-sm-4">
	 	<input type="hidden" class="form-control" name="img_lama">
	</div> 
   </div>
   
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent)
	 {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
	}
	}
	
	function set_alias() {
		var judul=$('#judul').val();
		//alert(judul);
		var alias = judul.replace(/ /gi, "_");
		$('#alias').val(alias);
			
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
$data=mysqli_query($con,"select * from mst_berita p where p.id_berita='$_GET[id_berita]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data Blog</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=berita&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Data Blog </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID berita</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_berita']; ?>" name="id_berita" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul berita</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul" id="judul" value="<?php echo $edit['judul']; ?>" onchange="set_alias()">
    </div>
  </div>
 <div class="form-group">
    <label class="col-sm-2 control-label">Alias Blog</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="alias" id="alias" readonly value="<?php echo $edit['alias']; ?>">
    </div>
  </div>
  
    <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Blog</label>
    <div class="col-sm-5">
      <select name="id_blog" class="form-control">
		<option value=" "> -- Pilih Jenis Blog -- </option>
		<?php 
			$sql = "SELECT * FROM `blog` order by nama_blog";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_blog'];
			$nama_blog = $tampilkan['nama_blog'];
		?>
		<option 
		<?php 
			if ($edit['id_blog']==$Kode){
				echo ' selected ';
			}
		?>
		value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_blog)) ; ?></option>
		<?php 
			}
		?>
	  </select>
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
      <input type="text" class="form-control" required="required" name="link" value="<?php echo $edit['link']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo $edit['tanggal']; ?>">
	</div>
  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Isi Blog</label>
	 <div class="col-sm-9">
       <textarea name="isi" class="form-control ckeditor" placeholder="Isi Blog" rows="5" required=""><?php echo $edit['isi']; ?></textarea>
	 </div>
   </div>
   
  <div class="form-group">
    <label class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-5">
		<input type="file" name="img" class="form-control" style="width:50%;" value="<?php echo $folder.$edit['img'];?>" id="uploadImage" onchange="PreviewImage();">
		<p class="help-block">Kosongkan jika tidak ingin diganti.</p>
		<img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Gambar" />
    </div> 
	<div class="col-sm-4">
	 	<input type="text" class="form-control" name="img_lama" value="<?php echo $edit['img'];?>">
		<img border="0" style="width:100%;height:auto;" src="<?php  echo $folder.$edit['img']; ?>">
	</div>  
  </div> 
<script type="text/javascript">
	function PreviewImage() {
  	var oFReader = new FileReader();
  	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
  	oFReader.onload = function (oFREvent)
  	 {
  		document.getElementById("uploadPreview").src = oFREvent.target.result;
  	}
	}
	function set_alias() {
		var judul=$('#judul').val();
		//alert(judul);
		var alias = judul.replace(/ /gi, "_");
		$('#alias').val(alias);
			
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
