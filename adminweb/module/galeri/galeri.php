<?php

include "../../inc/inc.library.php";

$aksi="module/galeri/galeri_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../img/galeri/";

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
<!----- ------------------------- MENAMPILKAN DATA MASTER GALERI------------------------- ----->			
<h3 class="box-title margin text-center">Data Galeri</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Galeri </h3>
		<a class="btn btn-default pull-right" href="?module=galeri&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Galeri</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-5">Judul</th>
		<th class="col-sm-3">Keterangan</th> 
		<th class="col-sm-2">Tanggal</th> 
		<th class="col-sm-1">Foto Kecil</th> 
		<th class="col-sm-1">Aksi</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * from mst_galeri ORDER BY id_galeri DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_galeri'];
?>

	<tr>
	<td><?php echo $data['id_galeri']; ?></td>
	<td><?php echo $data['judul']; ?></td>
	<td><?php echo $data['ket']; ?></td>
	<td><?php 
	$sqlcek ="select
    	a.id_galeri, a.judul, a.ket, a.folder, a.foto_kecil, 
    	b.nm_tgl, c.nm_bln, a.thn, d.nm_hr, a.foto_kecil
    from mst_galeri a
    left join mst_tgl b on b.id_tgl = a.id_tgl
    left join mst_bln c on c.id_bln = a.id_bln
    left join mst_hr d on d.id_hr = a.id_hr
    where a.id_galeri = '$Kode'";
	//echo $sqlcek."<br>";
	$qb = mysqli_query($con,$sqlcek );         
	$rb = mysqli_fetch_array($qb);     
	if ( $rb['thn'] > 0 ){
    	                                     
		echo $rb['nm_hr'].", ".$rb['nm_tgl']." ".$rb['nm_bln']." ".$rb['thn'];                           
	}else{ 

		echo nama_hari($data['tanggal']).", ".Indonesia2Tgl($data['tanggal']); 
	}
	?></td>
	<td><img border="0" style="width:100%;height:auto;" src="<?php 
									echo '../img/galeri/'.$data['folder']."/".$data['foto_kecil'];
							?>"></td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_galeri'];?>" href="?module=galeri&aksi=edit&id_galeri=<?php echo $data['id_galeri'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus  Data Galeri " href="<?php echo $aksi ?>?module=galeri&aksi=hapus&id_galeri=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

$datafile = mysqli_query($con, "select max(id_galeri) as lastid from mst_galeri");
$edit=mysqli_fetch_array($datafile);
$id_galeri = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru Galeri</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=galeri&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Galeri</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID Galeri</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_galeri" readonly value ="<?php echo $id_galeri; ?> " >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul Galeri</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul">
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-9">
      <textarea name="ket" class="form-control ckeditor" placeholder="Isi Topik" rows="3" required=""></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
	  <input type="hidden" class="form-control" name="id_tgl" value="0">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Folder</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="folder">
    </div>
  </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Gambar</label>
	  <div class="col-sm-5">
       <input type="file" name="foto_kecil" class="form-control" >
        <p class="help-block">Kosongkan jika tidak ingin diganti ( size 32 x 37 pixels ).</p>
	  </div>
	  	<div class="col-sm-4">
			<input type="hidden" class="form-control" name="foto_kecil_lama">
		</div> 
   </div>
  </div>	
<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="glyphicon glyphicon-briefcase"></i> Detail Gambar </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i>
	</a></div>	

<div class="box-body">
	
<div class="form-group">
<div id="main">
    <div class="my-form">
        <center>
			<p class="text-box">
                <a onclick="addRow('dataTable')" class="add-box btn btn-primary"" href="#"> <i class="fa fa-plus"> </i> Tambah</a>
				<a onclick="deleteRow('dataTable')" class="add-box btn btn-primary"" href="#"> <i class="fa fa-ban"> </i> Hapus</a>
            </p>
		</center>
		<div style="padding: 20px 20px 20px 20px;">
			<table id="dataTable" class="table table-bordered table-striped"> 

				<tr class="text-green">
					
					<th class="col-sm-3">File</th>
					<th class="col-sm-2">Foto</th>
					<th class="col-sm-1">Status Hapus</th>
				</tr>
				<tr>
					<td>
						<input type="file" name="foto_kecil2[]" class="form-control" id="uploadImage" onchange="PreviewImage();">
						<input type="hidden" name="add_id_galeri_foto[]">
					</td>
					<td>
						<img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Foto" />
					</td>
					<td class="col-sm-1"><input name="chk" type="checkbox" /></td>
				</tr>
			</table>
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
function addRow(tableID) {

	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;
	   //var row = table.insertRow(rowCount);
	   var row = table.insertRow(1);
	   
	   var box_html = ('<input type="file" name="foto_kecil2[]" class="form-control" id="uploadImage" onchange="PreviewImage();"><input type="hidden" name="add_id_galeri_foto[]">');
	   
	   var box_html2 = ('<img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Foto" />');
	   
	   var box_html3 = ('<input name="chk" type="checkbox">');
	   

	   var cell2 = row.insertCell(0);
	   cell2.innerHTML = box_html;
	   

	   var cell3 = row.insertCell(1);
	   cell3.innerHTML = box_html2;
	   
	   var cell1 = row.insertCell(2);
	   cell1.innerHTML = box_html3;

	  }

	  function deleteRow(tableID) {
	   try {
	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;

	   for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[2].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
		 table.deleteRow(i);
		 rowCount--;
		 i--;
		}


	   }
	   }catch(e) {
		alert(e);
	   }
	  }
</script>

</div>
	
  <div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="?module=galeri" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>

<!----- ------------------------- END TAMBAH DATA MASTER pegawai ------------------------- ----->
<?php
break;
case "edit":
$data=mysqli_query($con,"select * from mst_galeri p where p.id_galeri='$_GET[id_galeri]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data Galeri</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=galeri&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="glyphicon glyphicon-briefcase"></i> Informasi Data Galeri</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID Galeri</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_galeri']; ?>" name="id_galeri" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Judul galeri</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="judul" value="<?php echo $edit['judul']; ?>">
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-9">
	  <textarea name="ket" class="form-control ckeditor" placeholder="Isi Topik" rows="3" required=""><?php echo $edit['ket']; ?></textarea>
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
   <div class="form-group">
    <label class="col-sm-2 control-label">Folder</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="folder" value="<?php echo $edit['folder']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-5">
		<input type="file" name="foto_kecil" class="form-control" style="width:50%;">
		<p class="help-block">Kosongkan jika tidak ingin diganti ( size 32 x 37 pixels ).</p>
    </div> 
	<div class="col-sm-4">
	 	<input type="text" class="form-control" name="foto_kecil_lama" value="<?php echo $edit['foto_kecil'];?>">
	</div>  
  </div> 
  <div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="glyphicon glyphicon-briefcase"></i> Detail Gambar </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i>
	</a></div>	
<div class="box-body">
<div id="main">
    <div class="my-form">
        <center>
			<p class="text-box">
                <a onclick="addRow('dataTable')" class="add-box btn btn-primary"" href="#"> <i class="fa fa-plus"> </i> Tambah</a>
            </p>
		</center>
		<div style="padding: 20px 20px 20px 20px;">
			<table id="dataTable" class="table table-bordered table-striped"> 

				<tr class="text-green">
					
					<th class="col-sm-3">File</th>
					<th class="col-sm-2">Foto</th>
					<th class="col-sm-1">Status Hapus</th>
				</tr>
				<?php 
				// Tampilkan data dari Database
				 $asql="SELECT * FROM mst_galeri, mst_galeri_foto 
						where mst_galeri.id_galeri =  mst_galeri_foto.id_galeri  and
						 mst_galeri_foto.id_galeri='$_GET[id_galeri]'";
				//echo $asql;
				$a = mysqli_query($con,$asql);

				while ($data = mysqli_fetch_array($a))  { ?>
				<tr>
					<td>
						<input type="file" name="foto_kecil2[]" class="form-control" id="uploadImage" onchange="PreviewImage();" >
						<p class="help-block">Kosongkan jika tidak ingin diganti.</p>
						<input type="hidden" name="id_galeri_foto[]" value="<?php echo $data['id_galeri_foto'];?>">
						<input type="hidden" name="foto_kecil_lama2[]" value="<?php echo $data['foto_kecil'];?>">
					</td>
					<td>
						<img border="0" style="width:100%;height:auto;" src="<?php  echo "../img/galeri/".$data['folder']."/".$data['foto_kecil']; ?>" id="uploadPreview" width="400" alt="Preview Foto" />
					</td>
					<td class="col-sm-1"><a class="add-box btn btn-primary" href="<?php echo $aksi; ?> ?module=galeri&aksi=hapus_detail&id_galeri=<?php echo $_GET['id_galeri']; ?>&id_galeri_foto=<?php echo $data['id_galeri_foto']; ?>" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS GAMBAR ID <?php echo $data['id_galeri_foto']; ?>	?')" > <i class="fa fa-ban"> </i> Hapus</a></td>
				</tr>
<?php } ?>
			</table>
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
function addRow(tableID) {

	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;
	   //var row = table.insertRow(rowCount);
	   var row = table.insertRow(1);
	   
	   var box_html = ('<input type="file" name="foto_kecil3[]" class="form-control" id="uploadImage" multiple onchange="PreviewImage();"><input type="hidden" name="add_id_galeri_foto[]">');
	   
	   var box_html2 = ('<img border="0" style="width:100%;height:auto;" src="#" id="uploadPreview" width="400" alt="Preview Foto" />');
	   
	   var box_html3 = ('<a class="add-box btn btn-primary" href="<?php echo $aksi; ?> ?module=galeri&aksi=hapus_detail&id_galeri=<?php echo $_GET['id_galeri']; ?>&id_galeri_foto=<?php echo $data['id_galeri_foto']; ?>" onclick="return confirm('+"'ANDA YAKIN AKAN MENGHAPUS GAMBAR ID <?php echo $data['id_galeri_foto']; ?>	?'" + ')" > <i class="fa fa-ban"> </i> Hapus</a>');
	   

	   var cell2 = row.insertCell(0);
	   cell2.innerHTML = box_html;
	   

	   var cell3 = row.insertCell(1);
	   cell3.innerHTML = box_html2;
	   
	   var cell1 = row.insertCell(2);
	   cell1.innerHTML = box_html3;

	  }

	  function deleteRow(tableID) {
	   try {
	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;

	   for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[2].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
		 table.deleteRow(i);
		 rowCount--;
		 i--;
		}


	   }
	   }catch(e) {
		alert(e);
	   }
	  }
</script>

</div>
</div>
</div>	
	
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="?module=galeri" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
</form>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
