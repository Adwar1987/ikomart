<?php

include "../../inc/inc.library.php";

$aksi="module/price/price_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../image/tarif/";

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
		

<h3 class="box-title margin text-center">Data Tarif</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Tarif </h3>
		<?php 
	// Tampilkan data dari Database
	if($_SESSION['dev'] ==1){

	?>
		<a class="btn btn-default pull-right" href="?module=upload">Import Tarif Via Excel</a>

	<?php } ?>
		<a class="btn btn-default pull-right" href="?module=price&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data Tarif</a>	

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-4">Nama Produk</th>
		<th class="col-sm-2">Harga Jual</th> 
		<th class="col-sm-2">Harga Pasar</th> 
		<th class="col-sm-2">Tgl Awal</th> 
		<th class="col-sm-2">Tgl Akhir</th>
		<th class="col-sm-2">Sts Promo</th>
		<th class="col-sm-2">Sts Box</th>
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
if($_SESSION['dev'] ==1){
	$sql = "SELECT
				harga.id_harga,
				harga.id_produk,
				harga.nama_produk,
				harga.deskripsi,
				harga.harga_jual,
				harga.harga_pasar,
				harga.sts_promo,
				harga.sts_paket,
				harga.tgl_awal_promo,
				harga.tgl_akhir_promo,
				harga.id_price,
				harga.id_approver,
				harga.sts_aktif
			FROM harga
			ORDER BY id_harga DESC";
}elseif($_SESSION['dev'] ==2){
	$sql = "SELECT
			harga.id_harga,
			harga.id_produk,
			harga.nama_produk,
			harga.deskripsi,
			harga.harga_jual,
			harga.harga_pasar,
			harga.sts_promo,
			harga.sts_paket,
			harga.tgl_awal_promo,
			harga.tgl_akhir_promo,
			harga.id_price,
			harga.id_approver,
			harga.sts_aktif,
			produk.id_penjual
		FROM harga, produk
		where harga.id_produk = produk.id_produk AND
			 produk.id_penjual= '".$_SESSION['id']."'
		ORDER BY id_harga DESC";
}
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_harga'];
//echo $data['gambar'];
?>

	<tr>
	<td><?php echo $data['id_harga']; ?></td>
	<td><?php echo $data['nama_produk']; ?></td>
	<td><?php echo format_angka($data['harga_jual']); ?></td>
	<td><?php echo format_angka($data['harga_pasar']); ?></td>
	<td><?php echo $data['tgl_awal_promo']; ?></td>
	<td><?php echo $data['tgl_akhir_promo']; ?></td>
	<td><?php if ($data['sts_promo']=='1'){ echo 'Aktif';}else{echo 'Non Aktif';} ?></td>
	<td><?php if ($data['sts_paket']=='1'){ echo 'Ya';}else{echo 'Tidak';} ?></td>
	<td>
		<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_harga'];?>" href="?module=price&aksi=edit&id_harga=<?php echo $data['id_harga'];?>"><i class="glyphicon glyphicon-edit"></i></a>
		<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus data tarif" href="<?php echo $aksi ?>?module=price&aksi=hapus&id_harga=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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

$datafile = mysqli_query($con, "select max(id_harga) as lastid from harga");
$edit=mysqli_fetch_array($datafile);
$id_harga = $edit['lastid'] + 1; 
		
?>
<!----- ------------------------- TAMBAH DATA MASTER pegawai ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Baru Tarif</h3>
<hr/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=price&aksi=tambah" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
	<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-user-md"></i> Informasi Tarif</h3>
			<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
		<i class="fa fa-minus"></i></a>
	</div>	
	<div class="box-body">
	  <div class="form-group">
		<label class="col-sm-2 control-label">ID Tarif</label>
		<div class="col-sm-2">
		  <input type="text" class="form-control" required="required" name="id_harga" readonly >
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nama Produk</label>
		<div class="col-sm-5">
		  <input list="listproduk" type="text" name="nama_produk" id="nama_produk" class="form-control" onchange="ambildata_produk()"/>
			<datalist id="listproduk" >
			<?php $q = mysqli_query ($con,"SELECT * FROM `produk` order by nama_produk");
				while ($k = mysqli_fetch_array($q)){ ?>
				<option data-id="<?php echo $k['id_produk']; ?>" value="<?php echo $k['nama_produk']; ?>"></option>
				<?php	} ?>
			</datalist>
		</div>
		<div class="col-sm-2">
		  <input type="hidden" class="form-control" required="required" readonly name="id_produk" id="id_produk">
		</div>
	  </div>
	   
	   <div class="form-group">
		<label class="col-sm-2 control-label">Harga Jual</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="harga_jual" id="harga_jual" onkeyup = "javascript:this.value=Comma(this.value);">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Harga Pasar</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="harga_pasar" id="harga_pasar" onkeyup = "javascript:this.value=Comma(this.value);">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Tgl. Awal Promo</label>
		<div class="col-sm-3">
		  <input type="date" class="form-control" required="required" name="tgl_awal_promo" id="tgl_awal_promo">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Tgl. Awal Akhir</label>
		<div class="col-sm-3">
		  <input type="date" class="form-control" required="required" name="tgl_akhir_promo" id="tgl_akhir_promo">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Promo</label>
		<div class="col-sm-3">
		  <input type="checkbox" name="sts_promo" id="sts_promo" value='1'>
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Box</label>
		<div class="col-sm-3">
		  <input type="checkbox" name="sts_paket" id="sts_paket" value='1'>
		</div>
	  </div>
	</div>  
</div>
	<div class="form-group">
		<label class="col-sm-2"></label>
		<div class="col-sm-5">
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
	function ambildata_produk() {
		var  nama_produk = $('#nama_produk').val();
		//alert(nama_produk);
        var abc = $("#listproduk option[value='" + $('#nama_produk').val() + "']").attr('data-id');
        $('#id_produk').val(abc)
        //alert(abc);
    };

	function Comma(Num) { //function to add commas to textboxes
        Num += '';
		Num = Num.replace(/[^\d]+/g, '');
        Num = Num.replace('.', ''); 
        x = Num.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        return x1 + x2;
    }
</script>
<!----- ------------------------- END TAMBAH DATA MASTER pegawai ------------------------- ----->
<?php
break;
case "edit":
$data=mysqli_query($con,"select * from harga p where p.id_harga='$_GET[id_harga]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data Tarif</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=price&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
	<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-user-md"></i> Informasi Tarif</h3>
			<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
		<i class="fa fa-minus"></i></a>
	</div>	
	<div class="box-body">
	  <div class="form-group">
		<label class="col-sm-2 control-label">ID Tarif</label>
		<div class="col-sm-2">
		  <input type="text" class="form-control" required="required" name="id_harga" readonly value="<?php echo $edit['id_harga']; ?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nama Produk</label>
		<div class="col-sm-5">
		  <input list="listproduk" type="text" name="nama_produk" id="nama_produk" class="form-control" onchange="ambildata_produk()" value="<?php echo $edit['nama_produk']; ?>"/>
			<datalist id="listproduk" >
			<?php $q = mysqli_query ($con,"SELECT * FROM `produk` order by nama_produk");
				while ($k = mysqli_fetch_array($q)){ ?>
				<option data-id="<?php echo $k['id_produk']; ?>" value="<?php echo $k['nama_produk']; ?>"></option>
				<?php	} ?>
			</datalist>
		</div>
		<div class="col-sm-2">
		  <input type="hidden" class="form-control" required="required" readonly name="id_produk" id="id_produk" value="<?php echo $edit['id_produk']; ?>">
		</div>
	  </div>
	   
	   <div class="form-group">
		<label class="col-sm-2 control-label">Harga Jual</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="harga_jual" id="harga_jual" value="<?php echo format_angka($edit['harga_jual']); ?>" onkeyup = "javascript:this.value=Comma(this.value);">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Harga Pasar</label>
		<div class="col-sm-3">
		  <input type="text" class="form-control" required="required" name="harga_pasar" id="harga_pasar" value="<?php echo format_angka($edit['harga_pasar']); ?>" onkeyup = "javascript:this.value=Comma(this.value);">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Tgl. Awal Promo</label>
		<div class="col-sm-3">
		  <input type="date" class="form-control" required="required" name="tgl_awal_promo" id="tgl_awal_promo" value="<?php echo $edit['tgl_awal_promo']; ?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Tgl. Awal Akhir</label>
		<div class="col-sm-3">
		  <input type="date" class="form-control" required="required" name="tgl_akhir_promo" id="tgl_akhir_promo" value="<?php echo $edit['tgl_akhir_promo']; ?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Promo</label>
		<div class="col-sm-3">
			<?php if($edit['sts_promo']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_promo" id="sts_promo" value="1">
		</div>
	  </div>

	  <div class="form-group">
		<label class="col-sm-2 control-label">Status Box</label>
		<div class="col-sm-3">
			<?php if($edit['sts_paket']=='1'){$chec="checked"; } else {$chec="";}?>
		  <input type="checkbox" <?php echo $chec; ?> name="sts_paket" id="sts_paket" value="1">
		</div>
	  </div>
	</div>  
</div>
	<div class="form-group">
		<label class="col-sm-2"></label>
		<div class="col-sm-5">
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
	function ambildata_produk() {
		var  nama_produk = $('#nama_produk').val();
		//alert(nama_produk);
        var abc = $("#listproduk option[value='" + $('#nama_produk').val() + "']").attr('data-id');
        $('#id_produk').val(abc)
        //alert(abc);
    };
	function Comma(Num) { //function to add commas to textboxes
        Num += '';
		Num = Num.replace(/[^\d]+/g, '');
        Num = Num.replace('.', ''); 
        x = Num.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        return x1 + x2;
    }
</script>
 
 
<!----- ------------------------- END EDIT DATA MASTER pegawai ------------------------- ----->


<?php
break;
} 
?>
