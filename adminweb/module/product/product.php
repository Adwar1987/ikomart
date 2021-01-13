<?php

include "../../inc/inc.library.php";

$aksi="module/product/product_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../image/produk/";

switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER medik ------------------------- ----->			
<h3 class="box-title margin text-center">Data produk</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data produk </h3>
		<a class="btn btn-default pull-right" href="?module=product&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data produk</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-4">Nama Produk</th>
		<th class="col-sm-2">Merk</th> 
		<th class="col-sm-2">Kategori</th> 
		<th class="col-sm-2">Kelompok</th> 
		<th class="col-sm-2">Group</th> 
		<th class="col-sm-1">Gambar</th>
		<th class="col-sm-2">Aktif</th>
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
if($_SESSION['dev'] ==1){
	$sql = "SELECT
			produk.id_produk,
			produk.nama_produk,
			produk.alias,
			produk.deskripsi,
			produk.stok,
			produk.views,
			produk.ukuran,
			produk.merk,
			produk.gambar,
			produk.id_penjual,
			produk.sts_aktif,
			categories.id_kategori,
			categories.nama,
			kelompok.id_kelompok,
			kelompok.nama_kelompok,
			group.id_group,
			group.nama_group
		FROM
			produk 
			left JOIN kelompok ON produk.id_kelompok = kelompok.id_kelompok
			left JOIN `group` ON `group`.id_group = produk.id_group
			left JOIN categories ON categories.id_kategori = produk.id_kategori 
		ORDER BY id_produk DESC";
}elseif($_SESSION['dev'] ==2){
	$sql = "SELECT
			produk.id_produk,
			produk.nama_produk,
			produk.alias,
			produk.deskripsi,
			produk.stok,
			produk.views,
			produk.ukuran,
			produk.merk,
			produk.gambar,
			produk.id_penjual,
			produk.sts_aktif,
			categories.id_kategori,
			categories.nama,
			kelompok.id_kelompok,
			kelompok.nama_kelompok,
			group.id_group,
			group.nama_group
		FROM
			produk 
			left JOIN kelompok ON produk.id_kelompok = kelompok.id_kelompok
			left JOIN `group` ON `group`.id_group = produk.id_group
			left JOIN categories ON categories.id_kategori = produk.id_kategori 
		WHERE produk.id_penjual= '".$_SESSION['id']."'
		ORDER BY id_produk db2_escape_string(string_literal)";
}
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_produk'];
//echo $data['gambar'];
?>

	<tr>
	<td><?php echo $data['id_produk']; ?></td>
	<td><?php echo $data['nama_produk']; ?></td>
	<td><?php echo $data['merk']; ?></td>
	<td><?php echo $data['nama']; ?></td>
	<td><?php echo $data['nama_kelompok']; ?></td>
	<td><?php echo $data['nama_group']; ?></td>
	</td>
	<td><a href="<?php echo '../image/produk/'.$data['gambar']."?t=".milliseconds();?>" target="_blank" > <?php 
	if($data['gambar']<>'' || $data['gambar']<> null){ echo 'klik lihat';} ?> </a>
	
	<!--<img border="0" style="width:100%;height:auto;" src="<?php 
								/*  if($data['gambar']=='' || $data['gambar']==null){
									echo '../img/ikomart.jpg';
								}else{
									echo '../image/produk/'.$data['gambar'];
								}   */
								//echo '../image/produk/'.$data['gambar'];
							?>">
	-->
	</td>
	<td><?php if ($data['sts_aktif']=='1'){ echo 'Ya';}else{echo 'Tidak';} ?></td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_produk'];?>" href="?module=product&aksi=edit&id_produk=<?php echo $data['id_produk'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<?php 
	if($_SESSION['dev'] ==1){
	?>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Non Aktif produk" href="<?php echo $aksi ?>?module=product&aksi=hapus&id_produk=<?php echo $Kode;?>"  alt="Non Aktif produk" onclick="return confirm('ANDA YAKIN AKAN NON AKTIF DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
	<?php
	}
	?>
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

$datafile = mysqli_query($con, "select max(id_produk) as lastid from produk");
$edit=mysqli_fetch_array($datafile);
$id_produk = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru produk</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=product&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi produk</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">ID produk</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" required="required" name="id_produk" readonly >
    </div>
  </div>
  <?php 
  	if($_SESSION['dev'] ==1){
  ?>
  <div class="form-group">
    <label class="col-sm-2 control-label">Penjual</label>
    <div class="col-sm-5">
      <select name="id_penjual" class="form-control">
		<option value=" "> -- Pilih Penjual -- </option>
		<?php 
			$sql = "SELECT * FROM `user_rekan` order by nama";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_user_rekan'];
			$nama_kelompok = $tampilkan['nama'];
		?>
		<option value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_kelompok)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>
  	<?php 
		}else{
	?>
	<input type="hidden" class="form-control" name="id_penjual" value="<?php echo $_SESSION['id']; ?>" >
	<?php 		
		}
	?>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="nama_produk" id="nama_produk" onchange="set_alias()">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Merk</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="merk">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Ukuran</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" required="required" name="ukuran">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Berat</label>
    <div class="col-sm-3">
      <input type="number" class="form-control" required="required" name="berat"> gram atau ml
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Stok</label>
    <div class="col-sm-3">
      <input type="number" class="form-control" required="required" name="stok">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Dijual Oleh</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="dijual">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Dikirim Oleh</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="dikirim">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Alias produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="alias" id="alias">
    </div>
  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Group</label>
	<div class="col-sm-6">
	  <table class="table table-bordered">
		<thead>
			<th>Status</th>
			<th>Nama Group</th>
		</thead>
		<tbody>
		<?php
			//$akses_group = explode(",", $edit['id_group']);
			$akses_group = '';
			$dataunit = mysqli_query ($con,"select * from `group`");
				while ($hasilunit = mysqli_fetch_array($dataunit)){ 
				if(in_array($hasilunit['id_group'], $akses_group)){$chec="checked"; } else {$chec="";}
				echo  '<tr>';
				echo  '<td><input '.$chec.' type="checkbox" name="baris[]" value="'.$hasilunit['id_group'].'"></input></td>';
				echo  '<td>'.$hasilunit['nama_group'].'</input></td>';
				echo  '</tr>';
				}
		?>
		</tbody>
	   </table>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Kelompok</label>
    <div class="col-sm-5">
      <select name="id_kelompok" class="form-control" required="required" onchange="ambildata_kelompok()">
		<option value=" "> -- Pilih Kelompok -- </option>
		<?php 
			$sql = "SELECT * FROM `kelompok` order by nama_kelompok";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_kelompok'];
			$nama_kelompok = $tampilkan['nama_kelompok'];
		?>
		<option value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_kelompok)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-5">
      <select name="id_kategori" id="id_kategori" class="form-control" required="required">
		<option value=" "> -- Pilih Kategori -- </option>
		<?php 
			$sql = "SELECT * FROM `categories` order by nama";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_kategori'];
			$nama = $tampilkan['nama'];
		?>
		<option value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>

  <div class="form-group">
		<label class="col-sm-2 control-label">Status Aktif</label>
		<div class="col-sm-3">
		  <input type="checkbox" name="sts_aktif" id="sts_aktif" value='1'>
		</div>
	  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Deskripsi produk</label>
	 <div class="col-sm-9">
       <textarea name="deskripsi" class="form-control ckeditor" placeholder="deskripsi" rows="5" required=""></textarea>
	 </div>
   </div>
   
     <div class="form-group">
    <label class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-5">
		<input type="file" name="gambar" class="form-control" style="width:50%;" value="<?php echo $edit['gambar'];?>" id="uploadImage" onchange="PreviewImage();">
		<p class="help-block">Kosongkan jika tidak ingin diganti .</p>
		<img border="0" style="width:100%;height:auto;" src="../image/produk/<?php echo $edit['gambar'];?>" id="uploadPreview" width="400" alt="Preview Gambar" />
		<input type="hidden" class="form-control" name="gambar_lama" value="">
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
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent)
	 {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
	}
	}
</script>
<script type="text/javascript">
	function set_alias() {
		var nama_produk=$('#nama_produk').val();
		//alert(nama_produk);
		var alias = nama_produk.replace(/ /gi, "_");
		$('#alias').val(alias);
			
	}

	function ambildata_group() {
			var id_group=$('#id_group').val();
			//alert(id_group);
			 if (id_group=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'module/product/get_group.php',
				type:'GET',
				dataType:'html',
				data:'id_group='+id_group,
				success:function (respons) {
					$('#id_kelompok').html(respons);
				}, 
				
			})  
			$('#id_kategori').html("");
			} 
		}
	function ambildata_kelompok() {
			var id_kelompok=$('#id_kelompok').val();
			//alert(id_kelompok);
			 if (id_kelompok=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'module/product/get_group.php',
				type:'GET',
				dataType:'html',
				data:'id_kelompok='+id_kelompok,
				success:function (respons) {
					//alert(respons);
					$('#id_kategori').html(respons);
				}, 
			})  
			//$('#kelurahan').html("");
			} 
		}
</script>
<!----- ------------------------- END TAMBAH DATA MASTER pegawai ------------------------- ----->
<?php
break;
case "edit":
$data=mysqli_query($con,"select * from produk p where p.id_produk='$_GET[id_produk]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data produk</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=product&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-user-md"></i> Informasi Data produk </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
		</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID produk</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_produk']; ?>" name="id_produk" >
	  <input type="hidden" class="form-control"  value="<?php echo $edit['id_upload']; ?>" name="id_upload" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Penjual</label>
    <div class="col-sm-5">
      <select name="id_penjual" class="form-control">
		<option value=" "> -- Pilih Penjual -- </option>
		<?php 
			$sql = "SELECT * FROM `user_rekan` order by nama";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_user_rekan'];
			$nama_kelompok = $tampilkan['nama'];
		?>
		<option 
		<?php 
			if ($edit['id_penjual']==$Kode){
				echo ' selected ';
			}
		?>value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_kelompok)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="nama_produk" id="nama_produk" value="<?php echo $edit['nama_produk']; ?>" onchange="set_alias()">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Merk</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="merk" value="<?php echo $edit['merk']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Ukuran</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" required="required" name="ukuran" value="<?php echo $edit['ukuran']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Berat</label>
    <div class="col-sm-3">
      <input type="number" class="form-control" required="required" name="berat" value="<?php echo $edit['berat']; ?>"> gram atau ml
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Stok</label>
    <div class="col-sm-3">
      <input type="number" class="form-control" required="required" name="stok" value="<?php echo $edit['stok']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Dijual Oleh</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="dijual" value="<?php echo $edit['dijual']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Dikirim Oleh</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="dikirim" value="<?php echo $edit['dikirim']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Alias produk</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="required" name="alias" id="alias" value="<?php echo $edit['alias']; ?>">
    </div>
  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Group</label>
	<div class="col-sm-6">
	  <table class="table table-bordered">
		<thead>
			<th>Status</th>
			<th>Nama Group</th>
		</thead>
		<tbody>
		<?php
			$akses_group = explode(",", $edit['id_group']);
			$dataunit = mysqli_query ($con,"select * from `group`");
				while ($hasilunit = mysqli_fetch_array($dataunit)){ 
				if(in_array($hasilunit['id_group'], $akses_group)){$chec="checked"; } else {$chec="";}
				echo  '<tr>';
				echo  '<td><input '.$chec.' type="checkbox" name="baris[]" value="'.$hasilunit['id_group'].'"></input></td>';
				echo  '<td>'.$hasilunit['nama_group'].'</input></td>';
				echo  '</tr>';
				}
		?>
		</tbody>
	   </table>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Kelompok</label>
    <div class="col-sm-5">
      <select name="id_kelompok" id="id_kelompok" class="form-control" onchange="ambildata_kelompok()">
		<option value=" "> -- Pilih Kelompok -- </option>
		<?php 
			$sql = "SELECT * FROM `kelompok` order by nama_kelompok";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_kelompok'];
			$nama_kelompok = $tampilkan['nama_kelompok'];
		?>
		<option 
		<?php 
			if ($edit['id_kelompok']==$Kode){
				echo ' selected ';
			}
		?>
		value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama_kelompok)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-5">
      <select name="id_kategori" id="id_kategori" class="form-control">
		<option value=" "> -- Pilih Kategori -- </option>
		<?php 
			$id_kelompok = $edit['id_kelompok'];
			$sql = "SELECT * FROM `categories` WHERE id_kelompok = '$id_kelompok'order by nama";
			$tampil = mysqli_query($con,$sql);
			while ($tampilkan = mysqli_fetch_array($tampil)) { 
			$Kode = $tampilkan['id_kategori'];
			$nama = $tampilkan['nama'];
		?>
		<option 
		<?php 
			if ($edit['id_kategori']==$Kode){
				echo ' selected ';
			}
		?>
		value="<?php echo $Kode ; ?>"><?php echo ucfirst(strtolower($nama)) ; ?></option>
		<?php 
			}
		?>
	  </select>
    </div>
  </div>

  <div class="form-group">
		<label class="col-sm-2 control-label">Status Aktif</label>
		<div class="col-sm-3">
			<?php if($edit['sts_aktif']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_aktif" id="sts_aktif" value="1">
		</div>
	  </div>
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Deskripsi produk</label>
	 <div class="col-sm-9">
       <textarea name="deskripsi" class="form-control ckeditor" placeholder="deskripsi" rows="5" required=""><?php echo $edit['deskripsi']; ?></textarea>
	 </div>
   </div>
   
     <div class="form-group">
    <label class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-5">
		<input type="file" name="gambar" class="form-control" style="width:50%;" value="<?php echo $edit['gambar'];?>" id="uploadImage" onchange="PreviewImage();">
		<p class="help-block">Kosongkan jika tidak ingin diganti .</p>
		<img border="0" style="width:100%;height:auto;" src="../image/produk/<?php echo $edit['gambar'];?>" id="uploadPreview" width="400" alt="Preview Gambar" />
    </div> 
	<div class="col-sm-4">
	 	<input type="text" class="form-control" name="gambar_lama" value="<?php echo $edit['gambar'];?>">
		<!-- <img border="0" style="width:100%;height:auto;" src="<?php  echo $edit['gambar']; ?>"> -->
	</div>  
  </div> 

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

<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent)
	 {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
	}
	}
</script>
<script type="text/javascript">
	function set_alias() {
		var nama_produk=$('#nama_produk').val();
		//alert(nama_produk);
		var alias = nama_produk.replace(/ /gi, "_");
		$('#alias').val(alias);
			
	}
		function ambildata_group() {
			var id_group=$('#id_group').val();
			//alert(id_group);
			 if (id_group=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'module/product/get_group.php',
				type:'GET',
				dataType:'html',
				data:'id_group='+id_group,
				success:function (respons) {
					$('#id_kelompok').html(respons);
				}, 
				
			})  
			$('#id_kategori').html("");
			} 
		}
		function ambildata_kelompok() {
			var id_kelompok=$('#id_kelompok').val();
			//alert(id_kelompok);
			 if (id_kelompok=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'module/product/get_group.php',
				type:'GET',
				dataType:'html',
				data:'id_kelompok='+id_kelompok,
				success:function (respons) {
					//alert(respons);
					$('#id_kategori').html(respons);
				}, 
			})  
			//$('#kelurahan').html("");
			} 
		}
	</script>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
