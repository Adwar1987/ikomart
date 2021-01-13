<?php

include "../../inc/inc.library.php";

$aksi="module/adu/adu_aksi.php"; 
date_default_timezone_set("Asia/Jakarta");

$folder = "../img/adu/";

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
<h3 class="box-title margin text-center">Data Saran & Pengaduan</h3>
<hr/>

	<div class="box box-solid box-primary">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Data Saran & Pengaduan </h3>

	</div>
		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">ID</th>
		<th class="col-sm-2">Tanggal</th>
		<th class="col-sm-2">Subjek</th>
		<th class="col-sm-2">Pelapor</th>
		<th class="col-sm-2">No.Telp</th>
		<th class="col-sm-6">Isi</th> 
		<th class="col-sm-1">Aksi</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT a.id_adu,
			 CONCAT(b.nm_tgl,' ', c.nm_bln, ' ',thn) as tanggal,
			 a.subjek,
			 a.nm,
			 a.email,
			a.no_telp,
			a.alamat,
			a.isi
from trs_adu a 
left join mst_tgl b on b.id_tgl = a.id_tgl
left join mst_bln c on c.id_bln = a.id_bln
ORDER BY no_urut DESC";
//echo $sql;
$tampil = mysqli_query($con,$sql);
if (!$tampil)
{exit("Error in SQL");}
$no=1;
while ($data = mysqli_fetch_array($tampil)) { 
$Kode = $data['id_adu'];
?>

	<tr>
	<td><?php echo $data['id_adu']; ?></td>
	<td><?php echo $data['tanggal']; ?></td>
	<td><?php echo $data['subjek']; ?></td>
	<td><?php echo $data['nm']; ?></td>
	<td><?php echo $data['no_telp']; ?></td>
	<td><?php echo $data['isi']; ?></td>
	<td align="center">
	<a class="btn btn-xs btn-info"   data-toggle="tooltip" title="Edit Data <?php echo $data['id_adu'];?>" href="?module=adu&aksi=edit&id_adu=<?php echo $data['id_adu'];?>"><i class="glyphicon glyphicon-edit"></i></a>
	<a class="btn btn-xs btn-warning"   data-toggle="tooltip" title="Hapus Semua Data Pelaporan Masalah" href="<?php echo $aksi ?>?module=adu&aksi=hapus&id_adu=<?php echo $Kode;?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
	</td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<?php
break;
case "edit":
$data=mysqli_query($con,"SELECT a.id_adu,
			 CONCAT(b.nm_tgl,' ', c.nm_bln, ' ',thn) as tanggal,
			 a.subjek,
			 a.nm,
			 a.email,
			a.no_telp,
			a.alamat,
			a.isi
from trs_adu a 
left join mst_tgl b on b.id_tgl = a.id_tgl
left join mst_bln c on c.id_bln = a.id_bln
where a.id_adu='$_GET[id_adu]'");
$edit=mysqli_fetch_array($data);
?>


<h3 class="box-title margin text-center">Edit Data Saran & Pengaduan</h3>
<hr/>

<form class="form-horizontal" id="form_edit" action="<?php echo $aksi?>?module=adu&aksi=edit" role="form" method="post" enctype="multipart/form-data">             

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-comment-o"></i> Informasi Data Saran & Pengaduan </h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i></a>
</div>	
	<div class="box-body">  
  <div class="form-group">
    <label class="col-sm-2 control-label">ID Pengaduan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly value="<?php echo $edit['id_adu']; ?>" name="id_adu" >
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly name="tanggal" value="<?php echo $edit['tanggal']; ?>">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Subjek</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly name="subjek" value="<?php echo $edit['subjek']; ?>">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Pelapor</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly name="nm" value="<?php echo $edit['nm']; ?>">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">E-mail</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly name="email" value="<?php echo $edit['email']; ?>">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly name="alamat" value="<?php echo $edit['alamat']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Isi</label>
	 <div class="col-sm-9">
       <textarea name="isi" class="form-control" placeholder="Isi adu" readonly rows="4" ><?php echo $edit['isi']; ?></textarea>
	 </div>
   </div>
 </div>

<div class="box box-solid box-primary">
<div class="box-header">
<h3 class="btn btn disabled box-title">
<i class="fa fa-comment-o "></i> Respon Saran dan Pengaduan</h3>
	<a class="btn btn-default btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
	<i class="fa fa-minus"></i>
	</a></div>	
	<script language="javascript">
	  function addRow(tableID) {

	   var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;
	   //var row = table.insertRow(rowCount);
	   var row = table.insertRow(1);
	   var box_html = ('<input type="date" class="form-control" name="tanggal2[]" value="<?php echo date("Y-m-d"); ?>">');
	   
	   var box_html2 = ('<textarea name="isi2[]" class="form-control" placeholder="Isi adu" style="margin: 0px; width: 615px; height: 88px;" rows="4" ></textarea><input type="hidden" class="form-control"   data-toggle="tooltip"  name="id_adu_item[]">');
	   
	   var box_html3 = ('<a class="add-box btn btn-primary" href="<?php echo $aksi; ?> ?module=adu&aksi=hapus_item&id_adu=<?php echo $id_adu; ?>"> <i class="fa fa-ban"> </i> Hapus</a>');
	   

	   var cell2 = row.insertCell(0);
	   cell2.innerHTML = box_html;
	   
	    /* var element3 = document.createElement("select");
	    element3.type = "text";
	   element3.name = "id_alat[]";
	   element3.innerHTML = box_html;
	   cell2.appendChild(element3); */ 
	   

	   var cell3 = row.insertCell(1);
	   cell3.innerHTML = box_html2;
	   /* var element2 = document.createElement("input");
	   element2.type = "number";
	   element2.name = "jumlah[]";
	   cell3.appendChild(element2); */
	   
	   var cell1 = row.insertCell(2);
	   cell1.innerHTML = box_html3;
	   v/* ar element1 = document.createElement("input");
	   element1.type = "checkbox";
	   element1.name="chkbox[]";
	   cell1.appendChild(element1); */

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
	
	<div class="box-body">
		<center>
		<p class="text-box" >
			<a onclick="addRow('example1')" class="add-box btn btn-primary" href="#"> <i class="fa fa-plus"> </i> Tambah</a>
			
		</p>
		</center>
		<div style="padding: 20px 0px 0px 0px;">
			<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr class="text-green">
					
					<th class="col-sm-1">Tanggal Respon</th>
					<th class="col-sm-3">Respon</th>
					<th class="col-sm-1">Status Hapus</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				// Tampilkan data dari Database
				$sql2 = "SELECT a.id_adu,
									 CONCAT(b.nm_tgl,' ', c.nm_bln, ' ',thn) as tanggal,
									 a.isi,
									 a.id_adu_item
						from trs_adu_item a 
						left join mst_tgl b on b.id_tgl = a.id_tgl
						left join mst_bln c on c.id_bln = a.id_bln
						where id_adu='". $edit['id_adu']."' ";
				//echo $sql2 ;
				$a = mysqli_query($con,$sql2 );
				$no = 0;
				while ($data = mysqli_fetch_array($a)) { ?>
				<tr>
			
					<td><?php echo $data['tanggal']; ?></td>
					<td><?php echo $data['isi']; ?></td>
					<input type="hidden" class="form-control"   data-toggle="tooltip"  value="<?php echo $data['id_adu_item'];?>"   name="id_adu_item[]">
					<input type="hidden" class="form-control"   data-toggle="tooltip"  value="<?php echo $data['tanggal'];?>"   name="tanggal2[]">
					  <input type="hidden" class="form-control"   data-toggle="tooltip"  value="<?php echo $data['isi'];?>"   name="isi2[]">

					<td class="col-sm-1">
						<a class="add-box btn btn-primary" href="<?php echo $aksi; ?> ?module=adu&aksi=hapus_item&id_adu=<?php echo $data['id_adu']; ?>&id_adu_item=<?php echo $data['id_adu_item']; ?>" onclick="return confirm('Anda yakin Hapus Stock Barang <?php echo $data['id_adu_item']; ?>	?')"> <i class="fa fa-ban"> </i> Hapus</a>
					</td>
				<?php } ?>
				</tr>
			</tbody>
			</table>
		</div>
	
	
</div></div>
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i>Simpan</button>
<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> <i>Reset</i></button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div> 
  </div>
</div>
  
</form>
 
 
<!----- ------------------------- END EDIT DATA MASTER Saran & Pengaduan ------------------------- ----->


<?php
break;
} 
?>
